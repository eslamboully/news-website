<?php
namespace App\Http\Eloquent;

use App\Admin\Category;
use App\Admin\News;
use App\Http\Interfaces\NewsInterface;

class NewsEloquent implements NewsInterface{
    public $date;
    public function getQueryNews()
    {
        $this->date = $date = date('Y-m-d');
        return News::query()->orderBy('created_at','desc')->where(['status'=>'active'])->where('started_at','<=',$date)->where('ended_at','>',$date);
    }
}
