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
        'chkl_type',
        'changed_by_user',
        'chcl_id'
    ];    
    
    protected $casts = [
        'id' => 'integer',
        'chcl_id'=>'integer',
        'shelflife' => 'integer',
        'changed_by_user' => 'integer'
    ];

    public function getFrequencyCompositionAttribute() {
        if (isset($this->attributes['frequency_composition']) && is_string($this->attributes['frequency_composition'])) {
            return explode(';', $this->attributes['frequency_composition']);
        } else {
            return [];
        }
    }

    public function setFrequencyCompositionAttribute($value) {
        if (is_array($value)) {
            $this->attributes['frequency_composition'] = implode(';', $value);
        } else if (is_string($value)) {
            $this->attributes['frequency_composition'] = $value;
        }
    }

    public function chklClassification(): HasMany {
        return $this->hasMany(ChklClassification::class);
    }

    public function changedByUser(): HasMany {
        return $this->hasMany(User::class);
    }

    public function checklistsItens(): BelongsTo {
        return $this->belongsTo(ChecklistItem::class);
    }

    public function units(){
        return $this->belongsToMany(Unity::class, 'pivot_chkl_unit', 'chkl_id', 'unit_id');
    }

    public function userGroups(){
        return $this->belongsToMany(userGroups::class, 'pivot_chkl_usgr', 'chkl_id', 'usgr_id');
    }

    public function checklistsMovs(): BelongsTo {
        return $this->belongsTo(ChecklistMov::class);
    }

}
