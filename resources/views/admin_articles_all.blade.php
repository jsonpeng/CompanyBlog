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
                文章列表
                <a class="blog-admin-write" href="/blog-admin/article/write">写文章</a> 
              </h1>

            </section>

            <!-- Main content -->
            <section class="content">
              <!-- Your Page Content Here -->

              <div class="row">
              <div class="col-xs-6">
              <form class="form-inline " action="" method="get" style="margin-bottom: 15px;">
  <div class="form-group">
    <input type="text" class="form-control" id="cat_name_search" name="article_word" placeholder="根据文章标题等关键字查找">
  </div>
  <button type="submit" class="btn btn-default">搜索文章</button>
</form>
              </div>
              </div>
 <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">所有文章</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>标题</th>
                  <th>是否原创</th>
                  <th>所属分类</th>
                  <th>创建时间</th>
                  <th>上次修改时间</th>
                  <th>操作</th>
                </tr>
                </thead>
                <tbody>

      @foreach ($articles as $article)
             
                <tr>
                  <td>{{$article->id}}</td>
                  <td><a href="/article/{{$article->id}}">{{$article->title}}</a></td>
                  <td> {{$article->load_type==1?'是':'否'}}</td>
                  <td>
                  @foreach ($all->find($article->id)->Category()->get() as $catname)
                        <a href="?cat={{$catname->id}}" style="margin-right:10px;"> {{$catname->name}}</a>
                  @endforeach
                  </td>
                  <td>{{$article->created_at}}</td>
                  <td>{{$article->updated_at}}</td>
                  <td><a class="delArticleRow" id="{{$article->id}}" href="javascript:;">删除</a>&nbsp;|&nbsp;<a class="editArticleRow" id="{{$article->id}}" href="/blog-admin/article/edit/{{$article->id}}">编辑</a></td>
                  <!--onclick="deluser({{$article->id}})"-->
                </tr>

        @endforeach

                </tbody>
              </table>
            </div>

        </div>
      </div>
    </div>
            </section>
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->

  <!-- Main Footer -->
@include('admin_footer')
  <!--/Main Footer -->