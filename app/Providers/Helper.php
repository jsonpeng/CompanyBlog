<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/22
 * Time: 10:11
 */
namespace App\Providers;
use DB;
use App\Articles;
use App\Category;
use Illuminate\Support\ServiceProvider;

class Helper extends  AppServiceProvider {
    public static function getCatName($id){
        $cate=Articles::find($id)->Category()->lists('name');
        return $cate;
}
}