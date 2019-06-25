<div class="col-xs-2 pl0 pr0 blog-content-bg" style="    position: fixed;
    z-index: 1000;
    width: 200px;">

    <div class="blog-left-header-img">
      <a href="/" >  <img src="{{asset("/blog_front_static/images/logo.png")}}" /></a>
    </div>

    <div class="blog-left-header-linklist">
        @foreach($categorys as $category)
        <a href="/category/{{$category->id}}"><img src="{{asset("/blog_front_static/images/left1.png")}}" />&nbsp;&nbsp;{{$category->name}}</a>
        @endforeach
    </div>

    <div class="blog-left-header-search">

        <form method="get" id="searchform" action="/" style="position:relative;">
            <input name="article_word" id="s" class="form-control" type="text" placeholder="输入关键字" style="height:38px;" >
            <button type="submit" class="blog-left-header-search-button"><img src="{{asset("/blog_front_static/images/search.png")}}" /></button>
        </form>

        <a class="blog-left-header-search-text pt5" href="/?article_word=div">div</a>

        <a class="blog-left-header-search-text pt5" href="/?article_word=html5">html5</a>

        <a class="blog-left-header-search-text pt5" href="/?article_word=css">css</a>

        <a class="blog-left-header-search-text pt5" href="/?article_word=轮播图">轮播图</a>

        <a class="blog-left-header-search-text pt5" href="/?article_word=html5">html5</a>

        <a class="blog-left-header-search-text pt5" href="/?article_word=框架">框架 </a>

        <a class="blog-left-header-search-text pt5" href="/?article_word=ico">ico</a>

    </div>


    <div class="blog-left-header-youqinglink">
        <a class="blog-left-header-youqinglink-first">友情链接</a>

        <a class="blog-left-header-youqinglink-yiliao mt20" target="_blank" href="http://www.weileyiyao.com">
            <p class="mb0">湖北医疗</p>
            <p class="mb0">www.weileyiyao.com</p>
        </a>

        <a class="blog-left-header-youqinglink-huake mt10" target="_blank" href="http://www.hzkj.com">
            <p class="mb0">华中科技大学</p>
            <p class="mb0">www.hzkj.com</p>
        </a>
    </div>


</div>