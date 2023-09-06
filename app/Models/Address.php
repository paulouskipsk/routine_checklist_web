<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model {
    use HasFactory;

    protected $table = 'adresses';
    public $timestamps = true;

    public const IDENTIFIER = "addr";

    protected $fillable = [
        'id',
        'street_name',
        'number',
        'cep',
        'neighborhood',
        'complement',
        "city_id"
    ];

    protected $casts = [
        'id' => 'integer',
        'city_id' => 'integer',
        'number' => 'integer',
    ];

    public function unity(): HasMany {
        return $this->hasMany(Unity::class, 'id', 'unit_id');
    }

    public function city(): BelongsTo {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
}
