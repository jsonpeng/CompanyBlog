<?php

namespace App\Providers;

use DB;
use Illuminate\Support\ServiceProvider;
use App\Articles;
use App\Category;

class AppServiceProvider extends ServiceProvider
{

   var $IsIndex=false;


    public  function __construct($IsIndex){
        $this->IsIndex = $IsIndex;

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {

        try {
            $info='';
            $bloginfos = DB::table('blog_info')->where('id', 1)->first();
            if(empty($bloginfos)) {
                DB::table('blog_info')->insertGetId(
                    array('website_title' => $info, 'website_keyword' => $info, 'website_des' => $info, 'company_des' => $info, 'contact_tel' => $info, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'))
                );
                view()->share('website_title',$info);
                view()->share('website_keyword', $info);
                view()->share('website_des', $info);
                view()->share('company_des', $info);
                view()->share('contact_tel', $info);

            }
            if(!empty($bloginfos)){
                view()->share('website_title', $bloginfos->website_title);
                view()->share('website_keyword', $bloginfos->website_keyword);
                view()->share('website_des', $bloginfos->website_des);
                view()->share('company_des', $bloginfos->company_des);
                view()->share('contact_tel', $bloginfos->contact_tel);
            }


        }catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        /*
         *front
         */
        $categorys=Category::all();
        view()->share('categorys',$categorys);


        /*
         * admin
         */

        //view()->share('IsAdmin',false);
        view()->share('use_md',false);
//        view()->share('IsAdmin',true);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
