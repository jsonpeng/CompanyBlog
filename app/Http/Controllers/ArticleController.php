<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use DB;
use App\Articles;
use App\Category;
use Redirect,Response;

class ArticleController extends Controller
{
    /*
     * 写文章
     */
    public function adminArticleWrite(){
        $cats= DB::table('category')->get();
        view()->share('IsArticleWrite',true);
        return view('admin_article_write')->with('cats',$cats);
    }

    /*
     * 添加新文章 接口
     * code
     * 403文章标题已经存在
     * 500添加中的字段不能为空
     */
    public function addArticle(){
        $title = Input::get('title');
        $cids =Input::get('cid');
        $load_type=Input::get('load_type');
        $content=Input::get('content');
        $cid = explode(",", $cids);


        if (strlen($title) > 0  && strlen($cids) > 0 && strlen($load_type) > 0 && strlen($content) > 0) {
            $whetherHad = DB::table('articles')->where('title', $title)->first();
            if(!empty($whetherHad)){
                return response()->json([
                    'status' => false,
                    'code' => '403',
                    'data' => [
                        'current_time' => date('Y-m-d H:i:s')
                    ]
                ]);
                return;
            }
           $article_id= DB::table('articles')->insertGetId(
                array('title' => $title, 'load_type' => $load_type, 'content' => $content, 'published_at' => date('Y-m-d H:i:s'), 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'))
            );
            DB::table('events')->insertGetId(
                array('name' => '发布文章', 'article_name' =>$title , 'article_id' => $article_id, 'start_at' => date('Y-m-d H:i:s'))
            );

            //自动填充关联表字段
            for ( $i=0;$i<count($cid);$i++){
                $cat = Category::find($cid[$i]);
                $cat->Article()->attach($article_id);
            }
            $now_cat=Articles::find($article_id)->Category()->get();
            $content_name='';
            foreach ($now_cat as $cat){
                $content_name .=$cat->name;
            }
            if($load_type==1){
                $add_type='原创yuanchuang';
            }else{
                $add_type='转载zhuanzai';
            }
            DB::table('articles')
                ->where('id', $article_id)
                ->update(
                    array('cid'=>$title.$add_type.$content_name)
                );
            return response()->json([
                'status' => true,
                'code' => '200',
                'data' => [
                    'message' => $cid,
                    'current_time' => date('Y-m-d H:i:s')
                ]
            ]);
        }else{
            return response()->json([
                'status' => false,
                'code' => '500',
                'data' => [
                    'current_time' => date('Y-m-d H:i:s')
                ]
            ]);
        }

    }

    /*
     * 删除文章接口
     */
    public function delArticle($id){
        $article=Articles::find($id)->first();
//        foreach ($article as $articles){
//            $article_name=$articles->title;
//        }
        DB::table('events')->insertGetId(
            array('name' => '删除文章', 'article_name' =>$article->title, 'article_id' => $id, 'start_at' => date('Y-m-d H:i:s'))
        );
        $num=DB::delete('delete from articles where id= ?',[$id]);

        return response()->json([
            'status' => true,
            'code' => '200',
            'data' => [
                'message' =>$num,
                'current_time' => date('Y-m-d H:i:s')
            ]
        ]);
    }

    /*
     * 编辑文章信息
     */
    public function adminArticleEdit($id){
        $cats= DB::table('category')->get();
        $all=Articles::all();
        $articles= DB::table('articles')->where('id', $id)->first();
        view()->share('id',$id);
        view()->share('IsArticleEdit',true);
        view()->share('articles',$articles);
         return view('admin_articles_edit')->with('cats',$cats)->with('all',$all);
        //return view('admin_articles_edit', compact('id', '2', '3'))
    }


    /*
     * 编辑文章信息 接口
     */
    public function adminArticleEditApi($id){
        $title = Input::get('title');
        $cids =Input::get('cid');
        $load_type=Input::get('load_type');
        $content=Input::get('content');
       // $cid = explode(",", $cids);

        $article_id=DB::table('articles')
            ->where('id', $id)
            ->update(
                array('title' => $title, 'load_type' => $load_type, 'content' => $content, 'updated_at' => date('Y-m-d H:i:s'))
            );
        DB::table('events')->insertGetId(
            array('name' => '修改文章', 'article_name' =>$title, 'article_id' => $id, 'start_at' => date('Y-m-d H:i:s'))
        );
        return redirect('/blog-admin/article/all');

    }

/*
 * 文章预览测试
 */

    public function articleYuLan(Request $request){
        $time=date('Y-m-d H:i:s');
        $use_md=$request->input('use_md');
        $title=$request->input('title');
        $content=urldecode($request->input('content'));
        $cat=$request->input('category');
        if($use_md==1) {
            view()->share('use_md', true);
            //return view('front.article_yulan')->with('title',$title)->with('content',$content)->with('cat',$cat)->with('time',$time);
            //return $use_md;
        }
        //return $use_md;
        return view('front.article_yulan')->with('title',$title)->with('content',$content)->with('cat',$cat)->with('time',$time);
    }

/*
 * 所有文章列表
 */
    public function allArticle(Request $request){
        $cat_id= $request->input('cat');
        $article_word=$request->input('article_word');
        $all = Articles::all();
        if(strlen($cat_id)>0){
        $articles=Category::find($cat_id)->Article()->get();
            return view('admin_articles_all')->with('articles', $articles)->with('all', $all);
        }elseif (strlen($article_word)>0){
            $articles=   Articles::where('cid','like','%'.$article_word.'%')->get();
//            if(isset($articles)){
//             $id= Category::where('name','like','%'.$article_word.'%')->get();
//                foreach ($id as $ids) {
//                    $articles[0] = Category::find($ids)->Article()->get();
//                }
//            }
            return view('admin_articles_all')->with('articles', $articles)->with('all', $all);
        }else {
            $articles = DB::table('articles')->get();
            view()->share('IsArticleAll', true);
            return view('admin_articles_all')->with('articles', $articles)->with('all', $all);
        }
    }



/*
 * 上传图片
 */
public function uploadImage(){
    $file = Input::file('file');
    $allowed_extensions = ["png", "jpg", "gif"];
    if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
        return ['error' => 'You may only upload png, jpg or gif.'];
    }

    $destinationPath = 'uploads/images/';
    $extension = $file->getClientOriginalExtension();
    $fileName = str_random(10).'.'.$extension;
    $file->move($destinationPath, $fileName);
    $host="http://127.0.0.3/";
   // DB::insert('insert into articles (load_url) VALUES (?)',[$host.$destinationPath.$fileName]);

        return response()->json([
            'code' => '0',
            'msg'=>"",
            'data' => [
                'src'=>$host.$destinationPath.$fileName,
                'current_time' => date('Y-m-d H:i:s')
            ]
        ]);
}

    /*
     * 管理员分类管理
     * 403 该分类已经被添加过
     * 500 添加的分类字段为空
     */
    public function adminCategoryList(Request $request){
        $cat_words=$request->input('cat_words');
        $all_cat = Category::all();
        if(strlen($cat_words)>0){
           $cats=Category::where('name','like','%'.$cat_words.'%')->get();
            return view('admin_category')->with('cats', $cats)->with('all_cat', $all_cat);
        }else {

            $cats = DB::table('category')->get();
            view()->share('IsCategory', true);
            return view('admin_category')->with('cats', $cats)->with('all_cat', $all_cat);
        }
    }

    public function addCategory(){
        $cat_name = Input::get('cat_name');

        $whetherCat = DB::table('category')->where('name', $cat_name)->first();
        if (strlen($cat_name) > 0) {
            if (!empty($whetherCat)) {
                return response()->json([
                    'status' => false,
                    'code' => '403',
                    'data' => [
                        'current_time' => date('Y-m-d H:i:s')
                    ]
                ]);
                return;
            }
            DB::table('category')->insertGetId(
                array('name' => $cat_name, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'))
            );
            return response()->json([
                'status' => true,
                'code' => '200',
                'data' => [
                    'message' => $cat_name,
                    'current_time' => date('Y-m-d H:i:s')
                ]
            ]);
        }else{
            return response()->json([
                'status' => false,
                'code'=>'500',
                'data' => [
                    'current_time' => date('Y-m-d H:i:s')
                ]
            ]);
        }
    }


}
