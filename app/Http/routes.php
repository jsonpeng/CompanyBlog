<?php
use Illuminate\Support\Facades\Input;
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'IndexController@index');
Route::get('/category/{id}','IndexController@category');
Route::get('/article/{id}','IndexController@Article');





/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


/*
Route::group(['middleware' => 'web'], function () {
Route::auth();

Route::get('/blog-admin/login', 'Auth\AuthController@login');
Route::post('/blog-admin/login','Auth\AuthController@loginApi');
Route::get('/blog-admin', 'Auth\AuthController@index');
Route::get('/blog-admin/logout', 'Auth\AuthController@logout');

});
*/


Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('auth/logout', 'Auth\AuthController@logout');

    Route::get('/blog-admin', 'HomeController@index');

    /*
 * 文章管理
 */
    Route::get('/blog-admin/article/write','ArticleController@adminArticleWrite'); //添加新文章
    Route::post('/blog-admin/upload','ArticleController@uploadImage');
    Route::post('/blog-admin/article/write','ArticleController@addArticle'); //添加新文章接口
    Route::post('/blog-admin/article/del/{id}','ArticleController@delArticle');
    Route::get('/blog-admin/article/edit/{id}','ArticleController@adminArticleEdit');
    Route::post('/blog-admin/article/edit/{id}','ArticleController@adminArticleEditApi');

    Route::get('/blog-admin/article/edit','ArticleController@articleYuLan'); //测试预览效果
    /*
     * 所有文章
     */
    Route::get('/blog-admin/article/all','ArticleController@allArticle');//所有文章列表
    /*
     * 文章分类管理
     */
    Route::get('/blog-admin/article/category','ArticleController@adminCategoryList');   //分类列表
    Route::post('/blog-admin/addcategory','ArticleController@addCategory');     //添加分类
    Route::post('/blog-admin/delcategory/{id}',function($id){                      //删除分类
        $num=DB::delete('delete from category where id= ?',[$id]);
        return response()->json([
            'status' => true,
            'code' => '200',
            'data' => [
                'message' =>$num,
                'current_time' => date('Y-m-d H:i:s')
            ]
        ]);
    });
    Route::post('/blog-admin/editcategory/{id}',function ($id){
        $catName = Input::get('cat_name_edit');

        DB::table('category')
            ->where('id', $id)
            ->update(
                array('name' => $catName,'updated_at'=>date('Y-m-d H:i:s'))
            );
        /*
            return response()->json([
                'status' => true,
                'code' => '200',
                'data' => [
                    'message' =>$catname,
                    'current_time' => date('Y-m-d H:i:s')
                ]
            ]);
        */
    });


    Route::get('/blog-admin/usermanage/userlist','HomeController@userlist');
    Route::get('/blog-admin/usermanage/adduser','HomeController@adduser');
    Route::post('/blog-admin/adduser','HomeController@adduserApi');
    Route::post('/blog-admin/deluser/{id}',function($id){
        $num=DB::delete('delete from users where id= ?',[$id]);
        return response()->json([
            'status' => true,
            'code' => '200',
            'data' => [
                'message' =>$num,
                'current_time' => date('Y-m-d H:i:s')
            ]
        ]);
    });

    Route::get('/blog-admin/usermanage/edituser/{id}','HomeController@edituser');
    Route::post('/blog-admin/edituser/{id}',function($id){
        $username = Input::get('username');
        $email = Input::get('email');
        $pwd = Input::get('password');
        $is_admin=Input::get('is_admin');
        DB::table('users')
            ->where('id', $id)
            ->update(
                array('is_admin'=>$is_admin,'name' => $username,'email'=>$email,'password'=>$pwd,'updated_at'=>date('Y-m-d H:i:s'))
            );
        return redirect('/blog-admin/usermanage/userlist');
    });
    /*
     * 网站基本信息设置
     */
    Route::get('/blog-admin/bloginfo','HomeController@blogInfoSet');
    Route::post('/blog-admin/bloginfo','HomeController@blogInfoSetApi');
});
