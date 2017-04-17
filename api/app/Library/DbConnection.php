<?php

/**
 * Created by PhpStorm.
 * User: Sorarinu
 * Date: 2017/04/17
 * Time: 16:08
 */

namespace app\Library;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;

class DbConnection
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param $sid 学籍番号
     * @return bool
     */
    public function checkExists($sid)
    {
        $result = DB::table('timedata')->select('studentId')->where('studentId', '=', $sid)->where('status', '<>', 1)->get();

        if (isset($result[0])) {
            return true;
        } else {
            return false;
        }
    }
}