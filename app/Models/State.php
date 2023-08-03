<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class State extends Model {

    protected $table = 'states';
    public $timestamps = true;

    public const IDENTIFIER = "stat";

    protected $fillable = [
        'id',
        'name',
        'acronym',
        'status'
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    public function cities(): BelongsTo {
        return $this->belongsTo(City::class);
    }
    
}