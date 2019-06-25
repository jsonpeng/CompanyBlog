<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use League\Flysystem\Exception;
use Validator;
use Redirect;
use DB;
use Auth;
use App\Articles;
use App\Category;
use App\Events;
use Cookie;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    /*
 * 后台首页
 */
    public function index(Request $request){
        $article=Articles::all();
        $category=Category::all();
        $events=Events::where([])->orderBy('start_at','desc')->take(10)->get();
        $type= $request->input('type');

        if(strlen($type)>0) {
            $events=Events::where('name',$type)->orderBy('start_at','desc')->take(10)->get();
        }
        view()->share('IsIndex',true);
        return view('admin_template')->with('article',$article)->with('category',$category)->with('events',$events);
    }

    /*
     * 添加用户 视图
     */
    public function adduser(){
        view()->share('IsAddUser',true);
        return view('admin_adduser');
    }

    /*
     * 添加用户 数据接口
     * code 参数
     * 403 用户名已存在
     * 405 邮箱已使用
     * 500 输入字段为空
     */
    public function adduserApi(Request $request){
        $inputs = $request->all();
        $username = Input::get('username');
        $email=Input::get('email');
        $pwd=bcrypt(Input::get('password'));
        $is_admin=Input::get('is_admin');
        if(strlen($username)>0 && strlen($email) && strlen($pwd)>0){
            $whetherUser= DB::table('users')->where('name', $username)->first();
            $whetherEmail= DB::table('users')->where('email', $email)->first();
            if(!empty($whetherUser)){
                return response()->json([
                    'status' => false,
                    'code' => '403',
                    'data' => [
                        'current_time' => date('Y-m-d H:i:s')
                    ]
                ]);
                return;
            } else if(!empty($whetherEmail)){
                return response()->json([
                    'status' => false,
                    'code' => '405',
                    'data' => [
                        'current_time' => date('Y-m-d H:i:s')
                    ]
                ]);
                return;
            }

            //$this->validator($inputs);
           // $user = User::create($inputs);
           $id = DB::table('users')->insertGetId(
                array('name'=>$username,'email' => $email,'password'=>$pwd,'is_admin'=>$is_admin,'created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s'))
            );
            return redirect('/blog-admin/usermanage/userlist');
//            return response()->json([
//                'status' => true,
//                'code' => '200',
//                'data' => [
//                    'message' =>$id,
//                    'current_time' => date('Y-m-d H:i:s')
//                ]
//            ]);
        }else {
            return response()->json([
                'status' => false,
                'code'=>'500',
                'data' => [
                    'current_time' => date('Y-m-d H:i:s')
                ]
            ]);
        }
    }

    /*
     * 根据用户id 删除用户
     */
    public function deluserApi(){
        $userid = Route::input('id');
        $num=DB::delete('delete from users where id= ?',[$userid]);
        return response()->json([
            'status' => true,
            'code' => '200',
            'data' => [
                'message' =>$userid,
                'current_time' => date('Y-m-d H:i:s')
            ]
        ]);
    }

    public function edituser($id){
            $users=DB::table('users')->where('id', $id)->first();
        return view('admin_edituser')->with('users',$users)->with('id',$id);
    }

    /*
     * 用户列表
     */
    public function userlist(){
        $users = DB::table('users')->get();
        view()->share('IsUserList',true);
        return view('admin_userlist')->with('users',$users);
    }

    /*
     * 网站基础信息设置
     */
    public function blogInfoSet(){
        $bloginfos=DB::table('blog_info')->get();
        view()->share('IsBlogInfo',true);
        return view('admin_bloginfo')->with('bloginfos',$bloginfos);

    }

    /*
     * 网站基础信息设置接口
     */
    public function blogInfoSetApi(){
        $website_title = Input::get('website_title');
        $website_keyword=Input::get('website_keyword');
        $website_des=Input::get('website_des');
        $company_des=Input::get('company_des');
        $contact_tel=Input::get('contact_tel');

        DB::table('blog_info')
            ->where('id', 1)
            ->update(
                array('website_title'=>$website_title,'website_keyword' => $website_keyword,'website_des'=>$website_des,'company_des'=>$company_des,'contact_tel'=>$contact_tel,'updated_at'=>date('Y-m-d H:i:s'))
            );

        return  redirect('/blog-admin/bloginfo');

    }
}
