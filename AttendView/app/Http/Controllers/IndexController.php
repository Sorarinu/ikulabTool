<?php

namespace App\Http\Controllers;

use App\Library\CSV;
use App\Library\DbConnection;
use App\Timedata;
use App\Library\GoogleChart;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Log;
use Carbon\Carbon;

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
        $graphData = $this->getGraph();
        return view('index', ['timedata' => $timedata, 'graphData' => $graphData]);
    }

    public function download()
    {
        $users = Timedata::all(['studentId', 'in', 'out'])->toArray();
        $csvHeader = ['学籍番号', '入校時間', '退校時間'];
        return CSV::download($users, $csvHeader, 'attendList.csv');
    }

    public function getGraph()
    {
        $items = array();
        $dbConn = new DbConnection();
        $data = $dbConn->getData();

        foreach($data as $item) {
            $items[$item['studentId']] = 0;
        }

        $_graphData[] = ['学籍番号', '時間'];
        foreach($data as $item) {
            if($item['out'] !== '0000-00-00 00:00:00') {
                $in = new Carbon($item['in']);
                $out = new Carbon($item['out']);
                $items[$item['studentId']] += $in->diffInHours($out);
            }
        }

        foreach($data as $d) {
            $_graphData[] = [$d['studentId'], $items[$d['studentId']]];
        }

        Log::debug($_graphData);

        $graphData = array();

        foreach($_graphData as $key => $val) {
          if(!in_array($val,$graphData)) {
            $graphData[] = $val;
          }
        }

        Log::debug($graphData);

        return $graphData;
    }
}
