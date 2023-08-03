<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'status'
    ];

    protected $casts = [
        'id' => 'integer',
        'number' => 'integer',
    ];

    public function units(): BelongsTo {
        return $this->belongsTo(Unity::class);
    }

}
