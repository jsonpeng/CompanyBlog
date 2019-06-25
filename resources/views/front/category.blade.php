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

            <div class="col-xs-7 mt40 pr0 pl20" style="margin-left:200px;margin-bottom:1000px;">

                <!--HTML技术-->
                <div class="blog-most-news  blog-content-bg">

                    <div class="row ml0 mr0 ">
                   
                        <a class="blog-content-title mt0 mb0">{{$categorys->find($cat_id)->name}}</a>
              
                    </div>

                    <div class="blog-most-news-box">
                   @foreach($categorys->find($cat_id)->Article()->get() as $article)
                        <a class="blog-most-news-title" href="/article/{{$article->id}}"><p>{{$article->id}}.{{$article->title}}</p></a>
                 @endforeach
                   
                    </div>

                </div>
                <!--/HTML技术-->

            </div>

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