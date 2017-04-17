<?php

namespace App\Http\Controllers;

use app\Library\DbConnection;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        return view('index', ['timedata' => $dbConn->getData()]);
    }
}
