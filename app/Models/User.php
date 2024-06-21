<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'access_operator',
        'access_mobile',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'unity_logged'
    ];

    protected $casts = [
        'id' => 'integer',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function setAccessAdminAttribute($value) {
        if ($value == 'on' || $value == 'S') {
            $this->attributes['access_admin'] = 'S';
        } else if (is_string($value)) {
            $this->attributes['access_admin'] = 'N';
        }
    }

    public function setAccessOperatorAttribute($value) {
        if ($value == 'on' || $value == 'S') {
            $this->attributes['access_operator'] = 'S';
        } else if (is_string($value)) {
            $this->attributes['access_operator'] = 'N';
        }
    }

    public function setAccessMobileAttribute($value) {
        if ($value == 'on' || $value == 'S') {
            $this->attributes['access_mobile'] = 'S';
        } else if (is_string($value)) {
            $this->attributes['access_mobile'] = 'N';
        }
    }

    public function checklists(): HasMany {
        return $this->hasMany(Checklist::class, 'changed_by_user', 'id');
    }

    public function checklistsItens(): HasMany {
        return $this->hasMany(ChecklistItem::class, 'changed_by_user', 'id');
    }

    public function units(){
        return $this->belongsToMany(Unity::class, 'pivot_user_unit', 'user_id', 'unit_id');
    }

    public function unityLogged(){
        return $this->hasOne(Unity::class,'id', 'unity_logged');
    }

    public function usersGroups(){
        return $this->belongsToMany(UsersGroup::class, 'pivot_usgr_user', 'user_id', 'usgr_id');
    }

    public function checklistsMovs(): HasMany {
        return $this->hasMany(ChecklistMov::class, 'use_id', 'id');
    }

    public function checklistItemMov(): HasMany {
        return $this->hasMany(ChecklistItemMov::class, 'use_id', 'id' );
    }
}
