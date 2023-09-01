<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model {

    protected $table = 'cities';
    public $timestamps = true;

    public const IDENTIFIER = "city";

    protected $fillable = [
        'id',
        'code',
        'name',
        'status',
        'stat_id'
    ];

    protected $casts = [
        'id' => 'integer',
        'code' => 'integer',
    ];

    public function state(): HasMany {
        return $this->hasMany(State::class);
    }
}