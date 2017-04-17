<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timedata extends Model
{
    protected $table = 'timedata';
    protected $fillable = ['id', 'studentId', 'in', 'out', 'status'];
}
