<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function state(): BelongsTo {
        return $this->belongsTo(State::class, 'stat_id', 'id');
    }

    public function adresses(): HasMany {
        return $this->hasMany(Address::class, 'id', 'city_id');
    }
}