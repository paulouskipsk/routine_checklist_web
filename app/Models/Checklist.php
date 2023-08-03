<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Checklist extends Model {

    protected $table = 'checklists';
    public $timestamps = true;

    public const IDENTIFIER = "chkl";

    protected $fillable = [
        'id',
        'description',
        'generate_time',
        'shelflife',
        'frequency',
        'frequency_composition',
        'status',
        'random',
        'changed_by_user',
    ];    
    
    protected $casts = [
        'id' => 'integer',
        'shelflife' => 'integer',
        'random' => 'boolean',
        'generate_time' => 'datetime:H:i',
        'changed_by_user' => 'integer'
    ];

    public function chklClassification(): HasMany {
        return $this->hasMany(ChklClassification::class);
    }

    public function changedByUser(): HasMany {
        return $this->hasMany(User::class);
    }

    public function checklistsItens(): BelongsTo {
        return $this->belongsTo(ChecklistItem::class);
    }

}

// 'userGroups',
// 'companies',
