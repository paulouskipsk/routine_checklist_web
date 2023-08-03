<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function checklistsItens(): BelongsTo {
        return $this->belongsTo(ChecklistItem::class);
    }
}