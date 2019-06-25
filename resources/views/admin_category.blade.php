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
                文章分类管理
              <!--   <small>所有授权用户列表</small> -->
              </h1>

            </section>

            <!-- Main content -->
            <section class="content">
              <!-- Your Page Content Here -->

<div class="row mb10"> 

<div class="col-xs-2">
<button id="addCat" class="btn btn-primary">添加新分类</button>
</div>

<div class="col-xs-6">
<form class="form-inline " action="" method="get">
  <div class="form-group">
    <input type="text" class="form-control" id="cat_name_search" name="cat_words">
  </div>
  <button type="submit" class="btn btn-default">搜索分类目录</button>
</form>
</div>
</div>

 <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">所有文章分类</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>分类名称</th>
                  <th>创建时间</th>
                  <th>上次修改时间</th>
                  <th>分类文章总数</th>
                  <th>操作</th>
                </tr>
                </thead>
                <tbody>

        @foreach ($cats as $cat)
                <tr>
                  <td>{{$cat->id}}</td>
                  <td id="{{$cat->name}}">{{$cat->name}}</td>
                  <td>{{$cat->created_at}}</td>
                  <td>{{$cat->updated_at}}</td>
                  <td><a href="/blog-admin/article/all?cat={{$cat->id}}">{{$all_cat->find($cat->id)->Article()->count()}} </a></td>
                  <td><a class="delCatRow" id="{{$cat->id}}" >删除</a>&nbsp;|&nbsp;<a class="editCatRow" id="{{$cat->id}}">编辑</a></td>
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