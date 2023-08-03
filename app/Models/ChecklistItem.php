<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
        'required_photo' => 'boolean',
        'contain_action_plan' => 'boolean',
        'hour_min' => 'datetime:H:i',
        'hour_max' => 'datetime:H:i',
        'chkl_id' => 'integer',
        'sect_id' => 'integer',
        'changed_by_user' => 'integer'
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

}




//  notApplicable;
// 'checklist',
// 'instruction',
// 'checklistActionPlan'
// 'sector'