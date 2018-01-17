<?php

namespace App\Traits;

use App\Model\PermissionModel;
use App\Model\RoleModel;

/**
 * Trait ContainerAwareTrait
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Traits
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
trait HasPermissionsTrait
{

    /**
     * 
     * @param string $name
     * @return boolean|$this
     */
    public function givePermission(string $name)
    {
        if (!$permission = PermissionModel::where('name', $name)->first()) {
            return false;
        }
        if ($this->permissions->contains($permission)) {
            return false;
        }
        $this->permissions()->save($permission);
        return $this;
    }

    /**
     * 
     * @return $this
     */
    public function giveAllPermissions()
    {
        $permissions = PermissionModel::all();
        foreach ($permissions as $permission) {
            if (!$this->permissions->contains($permission)) {
                $this->permissions()->save($permission);
            }
        }
        return $this;
    }

    /**
     * 
     * @param string $name
     * @return boolean|$this
     */
    public function giveRole(string $name)
    {
        if (!$role = RoleModel::where('name', $name)->first()) {
            return false;
        }
        if ($this->roles->contains($role)) {
            return false;
        }
        $this->roles()->save($role);
        return $this;
    }

    /**
     * 
     * @return $this
     */
    public function giveAllRoles()
    {
        $roles = PermissionModel::all();
        foreach ($roles as $role) {
            if (!$this->roles->contains($role)) {
                $this->roles()->save($role);
            }
        }
        return $this;
    }

    /**
     * 
     * @param PermissionModel $permission
     * @return boolean
     */
    protected function hasPermission(PermissionModel $permission)
    {
        return (bool) $this->permissions->where('name', $permission->name)->count();
    }

    /**
     * 
     * @param PermissionModel $permission
     * @return boolean
     */
    protected function hasPermissionTo(PermissionModel $permission)
    {
        return $this->hasPermissionThroughRole($permission) or $this->hasPermission($permission);
    }

    /**
     * 
     * @param PermissionModel $permission
     * @return boolean
     */
    protected function hasPermissionThroughRole(PermissionModel $permission)
    {
        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }

    /**
     * 
     * @param RoleModel $role
     * @return boolean
     */
    public function hasRole(RoleModel $role)
    {
        return (bool) $this->roles->where('name', $role->name)->count();
    }

    /**
     * 
     * @return $this
     */
    public function removeAllPermissions()
    {
        $this->permissions()->detach();
        return $this;
    }

    /**
     * 
     * @return $this
     */
    public function removeAllRoles()
    {
        $this->roles()->detach();
        return $this;
    }

    /**
     * 
     * @param string $name
     * @return boolean|$this
     */
    public function removePermission(string $name)
    {
        if (!$permission = PermissionModel::where('name', $name)->first()) {
            return false;
        }
        $this->permissions()->detach($name);
        return $this;
    }

    /**
     * 
     * @param string $name
     * @return boolean|$this
     */
    public function removeRole(string $name)
    {
        if (!$role = RoleModel::where('name', $name)->first()) {
            return false;
        }
        $this->roles()->detach($role);
        return $this;
    }

}
