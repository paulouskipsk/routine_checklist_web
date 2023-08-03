<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unity extends Model {
    use HasFactory;

    protected $table = 'units';
    public $timestamps = true;

    public const IDENTIFIER = "unit";

    protected $fillable = [
        'id',
        'fantasy_name',
        'corporate_name',
        'cnpj',
        'state_registration',
        'phone_fixed',
        'status'
    ];
    
    protected $casts = [
        'id' => 'integer',
    ];

    public function address(): HasMany {
        return $this->hasMany(Address::class);
    }

    public function users(){
        return $this->belongsToMany(User::class, 'pivot_user_unit', 'unit_id', 'user_id');
    }

    public function checklistsItensNoApplicable(){
        return $this->belongsToMany(ChecklistItem::class, 'pivot_chit_unit_noapplicable', 'unit_id', 'chit_id');
    }

    public function checklists(){
        return $this->belongsToMany(Checklist::class, 'pivot_chkl_unit', 'unit_id', 'chkl_id');
    }

    public function checklistsMovs(): BelongsTo {
        return $this->belongsTo(ChecklistMov::class);
    }

    
}
