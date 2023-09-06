<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model {

    protected $table = 'states';
    public $timestamps = true;

    public const IDENTIFIER = "stat";

    protected $fillable = [
        'id',
        'code',
        'name',
        'acronym',
        'status'
    ];

    protected $casts = [
        'id' => 'integer',
        'code' => 'integer',
    ];

    public function cities(): HasMany {
        return $this->hasMany(City::class, 'id', 'stat_id');
    }
    
}