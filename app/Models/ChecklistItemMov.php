<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChecklistItemMov extends Model {
    use HasFactory;

    protected $table = 'checklists_itens_movs';
    public $timestamps = true;

    public const IDENTIFIER = "chim";

    protected $fillable = [
        'id',
        'description',
        'observation',
        'sequence',
        'score',
        'status',
        'type',
        'hour_min',
        'hour_max',
        'shelflife',
        'end_date',
        'start_date',
        'response',
        'required_photo',
        'quant_photo',
        'user_id',
        'chit_id',
        'chmv_id',
        'sect_id',
    ];
    
    protected $casts = [
        'id' => 'integer',
        'sequence' => 'integer',
        'score' => 'integer',
        'shelflife' => 'integer',
        'hour_min' => 'datetime:H:i',
        'hour_max' => 'datetime:H:i',
        'chmv_id' => 'integer',
        'chit_id'=> 'integer',
        'sect_id' => 'integer',
        'user_id' => 'integer',
        'quant_photo' => 'integer'
    ];

    public function checklistMov(): BelongsTo {
        return $this->belongsTo(ChecklistMov::class, 'chmv_id', 'id');
    }

    public function checklistItem(): BelongsTo {
        return $this->belongsTo(ChecklistItem::class, 'chit_id', 'id');
    }

    public function sector(): BelongsTo {
        return $this->belongsTo(Sector::class, 'sect_id', 'id');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
