<?php

/**
 * Created by PhpStorm.
 * User: Sorarinu
 * Date: 2017/04/17
 * Time: 16:08
 */

namespace app\Library;

use App\Timedata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;

class DbConnection
{
    private $request;

    public function __construct()
    {
    }

    public function getData()
    {
        return Timedata::all();

    }
}
