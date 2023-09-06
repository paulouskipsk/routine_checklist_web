<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sector extends Model {

    protected $table = 'sectors';
    public $timestamps = true;

    public const IDENTIFIER = "sect";

    protected $fillable = [
        'id',
        'description',
        'status'
    ];
    
    protected $casts = [
        'id' => 'integer',
    ];

    public function checklistsItens(): HasMany {
        return $this->hasMany(ChecklistItem::class, 'id', 'chit_id');
    }

    public function checklistItemMov(): HasMany {
        return $this->hasMany(ChecklistItemMov::class, 'id', 'sect_id');
    }
}