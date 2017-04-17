<?php

namespace App\Http\Controllers;

use App\Library\DbConnection;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Log;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dbConn = new DbConnection();
        $timedata = $dbConn->getData();
        Log::debug(json_encode($timedata));
        return view('index', ['timedata' => $timedata]);
    }
}
