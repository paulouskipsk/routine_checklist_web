<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChecklistItem extends Model {
    use SoftDeletes;

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
        'type_obs',
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

    public function checklist(): BelongsTo {
        return $this->belongsTo(Checklist::class, 'chkl_id', 'id');
    }

    public function sector(): BelongsTo {
        return $this->belongsTo(Sector::class, 'sect_id', 'id');
    }

    public function changedByUser(): BelongsTo {
        return $this->belongsTo(User::class, 'changed_by_user', 'id');
    }

    public function unitsNoApplicable(){
        return $this->belongsToMany(Unity::class, 'pivot_chit_unit_noapplicable', 'chit_id', 'unit_id');
    }

    public function checklistItensMovs(): HasMany {
        return $this->hasMany(ChecklistItemMov::class, 'chit_id', 'id');
    }

}
