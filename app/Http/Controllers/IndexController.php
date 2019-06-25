<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Articles;
use App\Category;

class IndexController extends Controller
{
    //首页
    public function  index(Request $request){
        view()->share('IsSearch',false);
        view()->share('IsNone',false);
        $article_the_newest=Articles::where([])->orderBy('published_at','desc')->take(5)->get();
        $article_word=$request->input('article_word');
        $articles='';
        if (strlen($article_word)>0) {
            $articles = Articles::where('cid', 'like', '%' . $article_word . '%')->get();
                view()->share('IsSearch', true);
        }

        return view('front.front_index')->with('articles',$articles)->with('article_the_newest',$article_the_newest);
    }

    public function category($id){
        return view('front.category')->with('cat_id',$id);
    }

    public function Article($id){
        $single_article=Articles::find($id);
        $category_name=Articles::find($id)->Category()->first();
        $last_article=Articles::find($this->getLastArticleId($id));
        $next_article=Articles::find($this->getNextArticleId($id));
        return view('front.article')->with('article',$single_article)->with('category',$category_name)->with('last_article',$last_article)->with('next_article',$next_article);
    }


    protected function getLastArticleId($id)
    {
        return Articles::where('id', '<', $id)->max('id');
    }
    protected function getNextArticleId($id)
    {
        return Articles::where('id', '>', $id)->min('id');
    }
}
