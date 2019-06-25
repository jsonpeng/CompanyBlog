@include('admin_static_header')

        <div class="wrapper">

          <!-- Main Header -->
          @include('admin_header')
          <!--/Main Header-->

          <!-- Left side column. contains the logo and sidebar -->
          <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
          @include('admin_sidebar')
            <!-- /.sidebar -->

          </aside>

          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <h1>
               博客后台
                <small>首页</small>
              </h1>

            </section>

            <!-- Main content -->
            <section class="content">
        
            <div class="row ml0">
            <div class="col-xs-6" style="background:#fff;">
              <h3 style="border-bottom:.1px solid #ddd;">概览</h3>
              <div class="row ml0">
              <i class="fa fa-archive"></i><a class="ml5" href="/blog-admin/article/all">{{$article->count()}}篇文章</a><i class="fa fa-bars ml50"></i><a class="ml5"href="/blog-admin/article/category">{{$category->count()}}个文章分类</a> </div>
              <h4>使用<a href="http://www.golaravel.com/" target="_blank">Laravel5</a>创作</h4>
            </div>
            </div>

          <div class="row ml0 mt30">
            <div class="col-xs-6" style="background:#fff;">
               <h3 style="border-bottom:.1px solid #ddd;">动态</h3>
                 @foreach ($events as $event)
                <div class="mb10">{{$event->start_at}}  @if($event->name=='发布文章')<i class="fa fa-check ml50"></i>@elseif($event->name=='修改文章') <i class="fa fa-pencil ml50"></i>@elseif($event->name=='删除文章')<i class="fa fa-times-circle ml50"></i> @endif<a  href="?type={{$event->name}}" >{{$event->name}}</a> <a class="ml50" href="@if($event->name=='删除文章')javascript:;@else blog-admin/article/edit/{{$event->article_id}} @endif"> {{$event->article_name}}</a> </div>
                 @endforeach
            </div>

          </div>
          
    @if(Auth::user()->is_admin==1)
          <div class="row ml0 mt30">
          <div class="col-xs-6" style="background:#fff;">
               <h3 style="border-bottom:.1px solid #ddd;">提示</h3>
          <div class="mb10"> 请先<a href="/blog-admin/article/category"> 创建文章分类</a>后开始<a href="/blog-admin/article/write">写文章</a></div>
               </div>
          </div>
    @endif
              <!-- Your Page Content Here -->
            </section>
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->

  <!-- Main Footer -->
@include('admin_footer')
  <!--/Main Footer -->