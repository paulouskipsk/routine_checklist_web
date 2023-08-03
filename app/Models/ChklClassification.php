<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function checklists(): BelongsTo {
        return $this->belongsTo(Checklist::class);
    }

    public function checklistsMovs(): BelongsTo {
        return $this->belongsTo(ChecklistMov::class);
    }
}
