<!--网页首部-->
@include('front.front_header')
<!--/网页首部-->

<div class="blog-all-content-bg">
    <div class="container">
        <div class="row">

            <!--博客固定左部导航-->

            @include('front.front_leftnav')

            <!--/博客固定左部导航-->

            <!--博客中间内容-->

            @if($IsSearch)
           <div class="col-xs-7 mt40 pr0 pl20" style="margin-left:200px;margin-bottom:1000px;">

         @if($articles->count()==0)
            <div style="background:rgb(10,155,246);width:100%;font-size:20px;color:white;padding: 15px 30px;margin-bottom:20px;">很抱歉,暂无该关键字</div>

                  <!--最新文章排行-->
                <div class="blog-most-news mt20 mb20 blog-content-bg">

                    <div class="row ml0 mr0">
                        <a class="blog-content-title mt0 mb0">最新文章排行</h2>
                            <a class="blog-content-more-info">查看更多></p>
                    </div>

                    <div class="blog-most-news-box">
                    @foreach($article_the_newest as $article)
                        <a class="blog-most-news-title" href="article/{{$article->id}}"><p class="blog-num-1">{{$article->id}}</p> <p> {{$article->title}}</p> </a>
                   
                    @endforeach
                    </div>

                </div>
                <!--/最新文章排行-->



                @foreach($categorys as $category)
                <!--HTML技术-->
                <div class="blog-most-news mb20 blog-content-bg">

                    <div class="row ml0 mr0">
                        <a class="blog-content-title mt0 mb0">{{$category->name}}</h2>
                            <a class="blog-content-more-info" href="/category/{{$category->id}}">查看更多></p>
                    </div>

                    <div class="blog-most-news-box">
                     @foreach($categorys->find($category->id)->Article()->get()->take(5) as $article)
                        <a class="blog-most-news-title" href="/article/{{$article->id}}"><p>{{$article->id}}.{{$article->title}}</p> </a>
                    @endforeach
                    </div>

                </div>
                <!--/HTML技术-->
             @endforeach
             
         @endif

           @if($articles->count()>0)
           <div style="background:rgb(10,155,246);width:100%;font-size:20px;color:white;padding: 15px 30px;margin-bottom:20px;"> 搜索结果({{$articles->count()}})</div>


     <div class="blog-most-news  blog-content-bg">

                    <div class="blog-most-news-box">
                   @foreach($articles as $article)
                        <a class="blog-most-news-title" href="/article/{{$article->id}}"><p>{{$article->id}}.{{$article->title}}</p></a>
                 @endforeach   
                    </div>

                </div>
         @endif

           </div>
            @else
            <div class="col-xs-7 mt40 pr0 pl20" style="margin-left:200px;">

                <!--轮播图-->
                <div id="myCarousel" class="carousel slide index-carousel-style" data-ride="carousel" data-interval="3000">
                    <!-- 轮播（Carousel）指标  -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>

                    <!-- 轮播（Carousel）项目 -->
                    <div class="carousel-inner blog-index-content-img">
                        <div class="item active">
                            <img src="{{asset("/blog_front_static/images/banner.jpg")}}" alt="First slide">
                        </div>
                        <div class="item">
                            <img src="{{asset("/blog_front_static/images/banner.jpg")}}" alt="Second slide">
                        </div>
                        <div class="item">
                            <img src="{{asset("/blog_front_static/images/banner.jpg")}}" alt="Third slide">
                        </div>
                    </div>
                    <!-- 轮播（Carousel）导航
                    <a class="carousel-control left" href="#myCarousel" data-slide="prev">‹</a>
                    <a class="carousel-control right" href="#myCarousel" data-slide="next">›</a>
                    -->
                </div>
                <!--/轮播图-->


                <!--最新文章排行-->
                <div class="blog-most-news mt20 mb20 blog-content-bg">

                    <div class="row ml0 mr0">
                        <a class="blog-content-title mt0 mb0">最新文章排行</h2>
                            <a class="blog-content-more-info">查看更多></p>
                    </div>

                    <div class="blog-most-news-box">
                    @foreach($article_the_newest as $article)
                        <a class="blog-most-news-title" href="article/{{$article->id}}"><p class="blog-num-1">{{$article->id}}</p> <p> {{$article->title}}</p> </a>
                   
                    @endforeach
                    </div>

                </div>
                <!--/最新文章排行-->



                @foreach($categorys as $category)
                <!--HTML技术-->
                <div class="blog-most-news mb20 blog-content-bg">

                    <div class="row ml0 mr0">
                        <a class="blog-content-title mt0 mb0">{{$category->name}}</h2>
                            <a class="blog-content-more-info" href="/category/{{$category->id}}">查看更多></p>
                    </div>

                    <div class="blog-most-news-box">
                     @foreach($categorys->find($category->id)->Article()->get()->take(5) as $article)
                        <a class="blog-most-news-title" href="/article/{{$article->id}}"><p>{{$article->id}}.{{$article->title}}</p> </a>
                    @endforeach
                    </div>

                </div>
                <!--/HTML技术-->
             @endforeach

            </div>
            @endif
            <!--/博客中间内容-->

            <!--博客固定右部导航-->

            @include('front.front_rightnav')

            <!--博客固定右部导航-->


        </div>
    </div>
</div>


<!-- 网页尾部-->
@include('front.front_footer')
<!--/网页尾部-->