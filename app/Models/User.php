<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const IDENTIFIER = "user";

    protected $fillable = [
        'name',
        'lastname',
        'email',
        'login',
        'password',
        'status',
        'access_admin',
        'access_mobile'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'id' => 'integer',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function checklists(): HasMany {
        return $this->hasMany(Checklist::class, 'id', 'changed_by_user');
    }

    public function checklistsItens(): HasMany {
        return $this->hasMany(ChecklistItem::class, 'id', 'changed_by_user');
    }

    public function units(){
        return $this->belongsToMany(Unity::class, 'pivot_user_unit', 'user_id', 'unit_id');
    }

    public function usersGroups(){
        return $this->belongsToMany(UsersGroup::class, 'pivot_usgr_user', 'user_id', 'usgr_id');
    }

    public function checklistsMovs(): HasMany {
        return $this->hasMany(ChecklistMov::class, 'id', 'use_id');
    }

    public function checklistItemMov(): HasMany {
        return $this->hasMany(ChecklistItemMov::class, 'id', 'use_id');
    }
}
