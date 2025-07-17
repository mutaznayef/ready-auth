<?php

namespace App;

use App\HasPermissions;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Context;

trait HasRoles
{

    use HasPermissions;

    /*
|--------------------------------------------------------------------------
| Relationships
|--------------------------------------------------------------------------
*/
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_has_roles', 'user_id', 'role_id');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'user_has_permissions', 'user_id', 'permission_id');
    }

    /*
|--------------------------------------------------------------------------
| Roles
|--------------------------------------------------------------------------
*/

    /**
     * Give role for user
     */
    public function assignRole($roles): bool
    {
        $attached = $this->roles()->syncWithoutDetaching($this->resolveRoles($roles));
        return count($attached['attached']) > 0;
    }

    /**
     * Give group of roles for user
     */
    public function syncRoles($roles): bool
    {
        $synced = $this->roles()->sync($this->resolveRoles($roles));
        return count($synced['attached']) + count($synced['detached']) + count($synced['updated']) > 0;
    }

    /**
     * Remove role from user
     */
    public function removeRole($role): bool
    {
        return $this->roles()->detach($this->resolveRoleId($role)) > 0;
    }

    /**
     * Check if user has role.
     */
    public function hasRole(string $role): bool
    {
        return $this->roles->contains('auth_code', $role);
    }

    /**
     * Check if user has any of listed roles
     */
    public function hasAnyRole(array $roles): bool
    {
        return $this->roles()->whereIn('auth_code', $roles)->exists();
    }

    /**
     * Check if user has all listed roles
     */
    public function hasAllRoles(array $roles): bool
    {
        $userRoles = $this->roles->pluck('auth_code')->toArray();
        return empty(array_diff($roles, $userRoles));
    }

    /**
     * Get all roles for user
     */
    public function getRoleNames(): Collection
    {
        return $this->roles->pluck('auth_code');
    }

    /*
|--------------------------------------------------------------------------
| Permissions
|--------------------------------------------------------------------------
*/

    /**
     * Check if user has direct permission
     */
    public function hasDirectPermission(string $permission): bool
    {
        return $this->permissions->contains('auth_code', $permission);
    }

    /**
     * Get all direct permissions of user
     */
    public function getDirectPermissions(): Collection
    {
        return $this->permissions;
    }

    /**
     * Get all permissions of role
     * loadMissing() is a Laravel method used to eager load a relationship only if it hasn't been loaded already.
     */
    public function getPermissionsViaRoles(): Collection
    {
        return $this->roles->loadMissing('permissions')->flatMap(
            fn($role) => $role->permissions
        )->unique('id');
    }

    /**
     * Get all permissions of user
     */
    public function getAllPermissions(): Collection
    {
        if (Auth::id() === $this->id && Context::hasHidden('permissions')) {
            return Context::getHidden('permissions');
        }

        return $this->getDirectPermissions()
            ->merge($this->getPermissionsViaRoles())
            ->unique('id')
            ->map(fn($perm) => strtolower($perm['auth_code']));
    }


    /*
|--------------------------------------------------------------------------
| Helpers
|--------------------------------------------------------------------------
*/

    /**
     * Convert any array of roles into an array of roles IDs, use as sync or attach 
     */
    protected function resolveRoles($roles): array
    {
        return collect($roles)->map(function ($role) {
            return is_string($role)
                ? Role::where('auth_code', $role)->value('id')
                : $role->id;
        })->filter()->all();
    }

    /**
     * Convert role into role ID, use as sync or attach 
     */
    protected function resolveSingleRole($role): ?int
    {
        return is_string($role)
            ? Role::where('auth_code', $role)->value('id')
            : $role->id ?? null;
    }
}
