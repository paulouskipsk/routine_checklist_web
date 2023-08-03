<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'is_admin' => 'bool',
        'is_user_mobile' => 'bool',
    ];

    public function checklists(): BelongsTo {
        return $this->belongsTo(Checklist::class);
    }

    public function checklistsItens(): BelongsTo {
        return $this->belongsTo(ChecklistItem::class);
    }
}

// unidades
