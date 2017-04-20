<?php

namespace App\Http\Controllers;

use App\Library\CSV;
use App\Library\DbConnection;
use App\Timedata;
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

    public function download()
    {
        $users = Timedata::all(['studentId', 'in', 'out'])->toArray();
        $csvHeader = ['学籍番号', '入校時間', '退校時間'];
        return CSV::download($users, $csvHeader, 'attendList.csv');
    }
}
