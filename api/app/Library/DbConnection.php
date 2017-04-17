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

    /**
     * @param $sid 学籍番号
     * @return null
     */
    public function checkExistsAndStatus($sid)
    {
        $result = DB::table('timedata')->select('id')->where('studentId', '=', $sid)->where('status', '=', 0)->get();

        if (isset($result[0])) {
            return $result[0];
        } else {
            return null;
        }
    }

    public function insertEnterData($sid, $time)
    {
        try {
            $data = [
                'studentId' => $sid,
                'in' => $time,
                'status' => 0,
            ];

            DB::table('timedata')->insert($data);

            return response()->json(['status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['status' => $e->getCode(), 'message' => $e->getMessage()]);
        }
    }

    public function updateExitData($id, $time)
    {
        try {
            $timedata = Timedata::find($id);
            $timedata->out = $time;
            $timedata->status = 1;
            $timedata->save();

            return response()->json(['status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['status' => $e->getCode(), 'message' => $e->getMessage()]);
        }
    }
}