<?php

namespace App\Models;

use App\HasPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

class Role extends Model
{
    use HasFactory, HasPermissions;

    protected $fillable = [
        'name',
        'auth_code',
    ];

    /*
|--------------------------------------------------------------------------
| Relationships
|--------------------------------------------------------------------------
*/
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_has_permissions', 'role_id', 'permission_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_has_roles', 'role_id', 'user_id');
    }


    /**
     * Get direct permissions for role. 
     */
    public function getAllPermissions(): Collection
    {
        return $this->permissions->map(fn($perm) => strtolower($perm['auth_code']));
    }
}
