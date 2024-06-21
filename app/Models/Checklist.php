<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checklist extends Model {
    use SoftDeletes;

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

    public function chklClassification(): BelongsTo {
        return $this->belongsTo(ChklClassification::class, 'chcl_id', 'id');
    }

    public function changedByUser(): BelongsTo {
        return $this->belongsTo(User::class, 'changed_by_user', 'id');
    }

    public function checklistItens(): HasMany {
        return $this->hasMany(ChecklistItem::class, 'chkl_id', 'id');
    }

    public function units(){
        return $this->belongsToMany(Unity::class, 'pivot_chkl_unit', 'chkl_id', 'unit_id')->withTimestamps();
    }

    public function usersGroups(){
        return $this->belongsToMany(UsersGroup::class, 'pivot_chkl_usgr', 'chkl_id', 'usgr_id')->withTimestamps();
    }

    public function checklistsMovs(): HasMany {
        return $this->hasMany(ChecklistMov::class, 'chkl_id', 'id');
    }

}
