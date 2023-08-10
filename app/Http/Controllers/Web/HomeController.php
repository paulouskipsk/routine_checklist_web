<?php

namespace App\Http\Controllers\Web;

class HomeController extends ControllerWeb {

    public function home(){
        // $breadcrumbs = [
        //     ['url'=> '','label' => 'Index','active'=>false],
        //     ['url'=> '', 'label' => 'Index2','active'=>false],
        //     ['url'=> '/home','label' => 'Index3','active'=>true]
        // ];
        return view('home',/* compact('breadcrumbs')*/);
    }

}
