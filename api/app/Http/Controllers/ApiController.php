<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Library\DbConnection;
use Log;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function add(Request $request)
    {
        $dbConn = new DbConnection();
        $sid = $request->input('studentId');
        $time = $request->input('time');

        Log::debug('sid: ' . $sid);
        Log::debug('time: ' . $time);

        $tmp = $dbConn->checkExistsAndStatus($sid);
        Log::debug(json_encode($tmp));

        if ($tmp === null) {
            $dbConn->insertEnterData($sid, $time);
        } else {
            $dbConn->updateExitData($tmp['id'], $time);
        }

        return response()->json(['status' => '200', 'studentId' => $sid, 'time' => $time]);
    }
}
