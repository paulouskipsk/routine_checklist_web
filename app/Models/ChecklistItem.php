<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChecklistItem extends Model {

    protected $table = 'checklists_itens';
    public $timestamps = true;

    public const IDENTIFIER = "chit";

    protected $fillable = [
        'id',
        'description',
        'sequence',
        'score',
        'status',
        'type',
        'hour_min',
        'hour_max',
        'shelflife',
        'required_photo',
        'quant_photo',
        'contain_action_plan',
        'chkl_id',
        'sect_id',
        'changed_by_user',
    ];
    
    protected $casts = [
        'id' => 'integer',
        'sequence' => 'integer',
        'score' => 'integer',
        'shelflife' => 'integer',
        'chkl_id' => 'integer',
        'sect_id' => 'integer',
        'changed_by_user' => 'integer',
        'quant_photo' => 'integer'
    ];

    public function checklist(): HasMany {
        return $this->hasMany(Checklist::class);
    }

    public function sector(): HasMany {
        return $this->hasMany(Sector::class);
    }

    public function changedByUser(): HasMany {
        return $this->hasMany(User::class);
    }

    public function unitsNoApplicable(){
        return $this->belongsToMany(Unity::class, 'pivot_chit_unit_noapplicable', 'chit_id', 'unit_id');
    }

    public function checklistItemMov(): BelongsTo {
        return $this->belongsTo(ChecklistItemMov::class);
    }

}
