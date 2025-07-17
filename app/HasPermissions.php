<?php

namespace App;

use App\Models\Permission;

trait HasPermissions
{

    /*
|--------------------------------------------------------------------------
| Permissions
|--------------------------------------------------------------------------
*/

    /**
     * Give permission for user or role
     */
    public function givePermissionTo($permissions): bool
    {
        $attached = $this->permissions()->syncWithoutDetaching($this->resolvePermissions($permissions));
        return count($attached['attached']) > 0;
    }

    /**
     * Remove permission from user or role
     */
    public function revokePermissionTo($permission): bool
    {
        return $this->permissions()->detach($this->resolveSinglePermission($permission)) > 0;
    }

    /**
     * Give all listed permissions for user or role
     */
    public function syncPermissions($permissions): bool
    {
        $synced = $this->permissions()->sync($this->resolvePermissions($permissions));
        return count($synced['attached']) + count($synced['detached']) + count($synced['updated']) > 0;
    }


    /**
     * Check if user or role has that permission
     */
    public function hasPermissionTo($permission): bool
    {
        return $this->getAllPermissions()->contains(strtolower($this->resolvePermissionValue($permission)));
    }

    /**
     * Check if user or role has any of listed permissions
     */
    public function hasAnyPermission(array $permissions): bool
    {
        $check = collect($permissions)->map(fn($perm) => strtolower($this->resolvePermissionValue($perm)));
        return $this->getAllPermissions()->intersect($check)->isNotEmpty();
    }

    /*
|--------------------------------------------------------------------------
| Helpers
|--------------------------------------------------------------------------
*/


    /**
     * Convert permission into permission ID, use as sync or attach 
     */
    protected function resolveSinglePermission($permission): ?int
    {
        return is_string($permission)
            ? Permission::where('auth_code', $permission)->value('id')
            : $permission->id ?? null;
    }


    /**
     * Convert any array of permissions into an array of permissions IDs, use as sync or attach 
     */
    protected function resolvePermissions($permissions): array
    {
        return collect($permissions)->map(function ($permission) {
            return is_string($permission)
                ? Permission::where('auth_code', $permission)->value('id')
                : $permission->id;
        })->filter()->all();
    }

    /**
     * It takes a single $permission input and returns a string of its value. 
     */
    protected function resolvePermissionValue($permission): string
    {
        return $permission instanceof \BackedEnum ? $permission->value : (string) $permission;
    }
}
