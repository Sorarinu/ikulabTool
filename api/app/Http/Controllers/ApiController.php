<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Log;

class ApiController extends Controller
{
    public function add(Requests\Request $request)
    {
        $sid = $request->input('studentId');
        $time = $request->input('time');


        Log::debug('sid: ' . $sid);
        Log::debug('time: ' . $time);

        return response()->json(['status' => '200']);
    }
}
