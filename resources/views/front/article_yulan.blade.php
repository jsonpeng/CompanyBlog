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

            <div class="col-xs-7 mt40 pr0 pl20" style="margin-left:200px;margin-bottom:500px;">

               
                <div class="blog-most-news  blog-content-bg" style="padding-top:15px;padding-left:0px;">

                <div style="padding-left:15px;"> <a href="/" style="color:#ddd;"> 主页</a>><a href="/category/{{$cat}}" style="color:#ddd;">{{$cat}}</a>><a href="javascript:;" style="color:black;font-weight:500;">{{$title}} </a></div>
                   
                   <h1  style="text-align:center;font-weight:500;padding-left:0px;margin-bottom:20px;"> {{$title}}</h1>

                   <div style="padding-left:15px;margin:0 auto;display:table;padding-bottom:15px;"><span style="color:#ddd;">时间:{{$time}}</span> <span style="color:#ddd;margin-left:15px;margin-right:15px;">阅读(0)</span>  <a style="color:#ddd;margin-right:100px;"> 分享到</a></div>

                   <div style="border-bottom:.1px solid #ddd;margin-bottom:20px;"> </div>

     
         @if($use_md)
 <textarea id="text-input" oninput="this.editor.update()"
               style="display:none">
        {!! $content !!}
              </textarea>
    <div id="preview"> </div>
    @else
   <div style="text-align:left; padding-left:15px;padding-right:15px;word-break:break-all;word-wrap:break-word;"> 
    <div style="border-bottom:.1px solid #ddd;padding-bottom:25px;" id="article_content" >{!! $content !!}</div> 
      <div> 
    @endif
  

     <a style="text-align:left;color:#ddd;padding-top: 15px;
    display: inline-block;
    padding-bottom: 15px;" href="javascript:;">上一篇:没有了,已经是最新的一篇!</a>
   
     <a style="float:right;color:#ddd;padding-top: 15px;
    display: inline-block;
    padding-bottom: 15px;" href="javascript:;">下一篇:没有了,已经是最后一篇!</a>
    </div>
    </div>


                </div>
              

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