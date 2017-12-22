<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helper\Dataviewer;

class Schedule extends Model
{
    use Dataviewer;
    protected $table = 'schedule';
    protected $fillable = [
        'id','user_id', 'claim' ,'datescheduled','created_at','updated_at'
    ];

   public static $tblcolumns = [
     'id','user_id', 'claim' ,'datescheduled','created_at','updated_at'
    ];

    public static $columns = ['id','user id', 'claim' ,'date scheduled','created at','updated at'];
}
