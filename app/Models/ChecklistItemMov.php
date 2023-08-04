<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'contain_action_plan',
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
        'required_photo' => 'boolean',
        'contain_action_plan' => 'boolean',
        'hour_min' => 'datetime:H:i',
        'hour_max' => 'datetime:H:i',
        'chmv_id' => 'integer',
        'chit_id',
        'sect_id' => 'integer',
        'user_id' => 'integer',
        'quant_photo' => 'integer'
    ];

    public function checklistMov(): HasMany {
        return $this->hasMany(ChecklistMov::class);
    }

    public function checklistItem(): HasMany {
        return $this->hasMany(ChecklistItem::class);
    }

    public function sector(): HasMany {
        return $this->hasMany(Sector::class);
    }

    public function user(): HasMany {
        return $this->hasMany(User::class);
    }
}
