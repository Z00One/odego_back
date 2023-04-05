<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    //
    public function testIndex()
    {
        
        $td = DB::select('select * from attend');
        return view('test', ['td' => $td]);

    }

}