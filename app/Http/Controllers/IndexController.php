<?php

namespace App\Http\Controllers;

use App\Contracts\TestContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class IndexController extends Controller
{
    //
    public function show(TestContract $test){
//        $test->callMe('TestController');
        App::make('test')->callMe(123123123);
    }
}
