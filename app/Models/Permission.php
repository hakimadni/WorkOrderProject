<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'role_menu_permissions'; // Custom table name
    protected $fillable = [
        'role_id',
        'menu_id',
        'can_create',
        'can_read',
        'can_update',
        'can_delete',
    ];

    /**
     * Relationship with Role.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Relationship with Menu.
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
