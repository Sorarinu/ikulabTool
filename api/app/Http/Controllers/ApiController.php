<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Log;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function add(Request $request)
    {
        $sid = $request->input('studentId');
        $time = $request->input('time');

        Log::debug('sid: ' . $sid);
        Log::debug('time: ' . $time);
    }
}
