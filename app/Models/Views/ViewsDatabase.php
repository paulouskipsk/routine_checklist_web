<?php

namespace App\Models\Views;

use Illuminate\Support\Facades\DB;
use stdClass;

class ViewsDatabase extends stdClass {
    protected $fillable = [];
    protected $casts = [];

    protected function castAttributes() {
        foreach ($this->fillable as $value) {
            
        }
    }

}