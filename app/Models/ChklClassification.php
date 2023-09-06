<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChklClassification extends Model {
    use HasFactory;

    protected $table = 'chkl_classifications';
    public $timestamps = true;

    public const IDENTIFIER = "chcl";

    protected $fillable = [
        'id',
        'description',
        'status'
    ];
    
    protected $casts = [
        'id' => 'integer',
    ];

    public function checklists(): HasMany {
        return $this->hasMany(Checklist::class, 'id', 'chkl_id');
    }

    public function checklistsMovs(): HasMany {
        return $this->hasMany(ChecklistMov::class, 'id', 'chim_id');
    }
}
