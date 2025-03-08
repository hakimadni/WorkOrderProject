<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'name',
        'route',
        'icon',
        'no_menu',
        'parent_id',
    ];

    /**
     * Get the children menus (submenus).
     */
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    /**
     * Get the parent menu.
     */
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function permission()
    {
        return $this->hasMany(Permission::class);
    }
}
