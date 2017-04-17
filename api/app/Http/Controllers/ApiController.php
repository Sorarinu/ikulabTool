<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Log;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function add(Request $request)
    {
        //$sid = $request->input('studentId');
        //$time = $request->input('time');

        $sid = $request->get('studentId');
        $time = $request->get('time');

        Log::debug('sid: ' . $);
        Log::debug('time: ' . $time);

        return response()->json(['status' => '200']);
    }
}
