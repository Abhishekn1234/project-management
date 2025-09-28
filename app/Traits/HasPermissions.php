<?php

namespace App\Traits;

trait HasPermissions {
    public function hasPermission($perm){
        $permissions = session('permissions', []);
        return in_array($perm, $permissions);
    }
}
