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
            添加新文章
              <!--   <small>所有授权用户列表</small> -->
              </h1>

            </section>

            <!-- Main content -->
            <section class="content">
              <!-- Your Page Content Here -->

<div class="row"> 
<form class="layui-form" action="" method="POST">
<div class="col-xs-10">
  <div class="form-group">
    <input type="text" class="form-control" id="article_title" name="title" placeholder="在此输入标题">
  </div>


<h1 style="font-size:24px;">选择文章所在的分类</h1>

  <div class="layui-form-item">

    <div class="layui-input-inline ml0" style="width:600px;">
      @foreach ($cats as $cat)
      <input type="checkbox" name="cid[]" title="{{$cat->name}}" value="{{$cat->id}}">
      @endforeach
    </div>
     
  </div>



   <div class="layui-form-item">
  
    <div class="layui-input-block ml0" style="max-width:200px;">
      <input type="radio" name="load_type" value="1" title="原创" checked>
      <input type="radio" name="load_type" id="zhuanzai" value="0" title="转载">
    </div>

   </div>

    <div class="layui-form-item">
  
    <div class="layui-input-block ml0" style="max-width:600px;">
      <input type="radio" name="use_md" value="1" title="使用markdown编辑方式" checked>
      <input type="radio" name="use_md"  value="0" title="不使用markdown编辑方式">
    </div>

   </div>

 <a class="btn btn-default mb10" id="article_yulan">预览</a>

  <textarea  id="article_write" name="content" style="display: none;"></textarea>

  <div class="blog-admin-fabu mt10">
<a class="btn btn-primary"  id="article_publish">发布</a>  
</div>
</div>


</form>

</div>


            </section>
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->

  <!-- Main Footer -->
@include('admin_footer')
  <!--/Main Footer -->