<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChecklistMov extends Model {
    use HasFactory;

    protected $table = 'checklists_movs';
    public $timestamps = true;

    public const IDENTIFIER = "chmv";

    protected $fillable = [
        'id',
        'description',
        'generate_time',
        'shelflife',
        'frequency',
        'frequency_composition',
        'status',
        'is_free',
        'start_date',
        'end_date',
        'user_id',
        'chkl_id',
        'chcl_id',
        'unit_id',
    ];
    
    protected $casts = [
        'id' => 'integer',
        'generate_time' => 'timestamp',
        'shelflife' => 'integer',
        'start_date' => 'timestamp',
        'end_date' => 'timestamp',
        'user_id' => 'integer',
        'chkl_id' => 'integer',
        'chcl_id' => 'integer',
        'unit_id' => 'integer',
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

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function checklist(): BelongsTo {
        return $this->belongsTo(Checklist::class, 'chkl_id', 'id');
    }

    public function chklClassification(): BelongsTo {
        return $this->belongsTo(ChklClassification::class, 'chcl_id', 'id');
    }

    public function unity(): BelongsTo {
        return $this->belongsTo(Unity::class, 'unit_id', 'id');
    }

    public function checklistItemMov(): HasMany {
        return $this->hasMany(ChecklistItemMov::class, 'id', 'chim_id');
    }
    
    public function userGroups(){
        return $this->belongsToMany(userGroups::class, 'pivot_chmv_usgr', 'chmv_id', 'usgr_id');
    }
}
