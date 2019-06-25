<?php

namespace App\Providers;
use DB;
use Illuminate\Support\ServiceProvider;

class CustomServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $website_title='';
//        $bloginfos=DB::table('blog_info')->where('id', 1)->first();
//        foreach ($bloginfos as $bloginfo){
//           $website_title=$bloginfo->website_title;
//        }
        view()->share('website_title','1');
        //view()->composer(['hello','home'],function($view){
     //   $view->with('user',array('name'=>'test','avatar'=>'/path/to/test.jpg'));  });


    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
