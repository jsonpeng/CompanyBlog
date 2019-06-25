<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    protected $table = 'articles';
    public function Category()
    {
        return $this->belongsToMany('App\Category');
    }


    /*
     static function GetCatIdByArticleId($article_id){
        $aiticle=App\Articles::find($article_id);
        foreach ($aiticle->roles as $cat) {
            echo $cat->pivot->created_at;
        }
        return 0;
    }
    */
}
