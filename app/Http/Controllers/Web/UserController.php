<?php

namespace App\Http\Controllers\Web;

use App\Enums\Status;
use App\Models\User;
use App\Utils\Functions;
use Illuminate\Http\Request;

class UserController extends ControllerWeb {

    public function getUsersByName(Request $request) {
        $users = User::where('name', 'ilike', "%$request->name%")->whereStatus(Status::ACTIVE)->get();
        if(Functions::nullOrEmpty($users)) return [];

        return $users;
    }
}