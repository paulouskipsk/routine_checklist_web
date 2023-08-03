<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model {

    protected $table = 'users_groups';
    public $timestamps = true;

    public const IDENTIFIER = "usgr";

    protected $fillable = [
        'id',
        'name',
        'status'                                                                                                                     
    ];
    
    protected $casts = [
        'id' => 'integer',
    ];

    public function users(){
        return $this->belongsToMany(User::class, 'pivot_usgr_user', 'usgr_id', 'user_id');
    }
    

}