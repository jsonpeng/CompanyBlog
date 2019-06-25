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
            编辑文章
              <!--   <small>所有授权用户列表</small> -->
              </h1>

            </section>

            <!-- Main content -->
            <section class="content">
              <!-- Your Page Content Here -->

<div class="row"> 
<form class="layui-form" action="/blog-admin/article/edit/{{$id}}" method="POST">
<div class="col-xs-10">
  <div class="form-group">
    <input type="text" class="form-control" id="article_title" name="title" placeholder="在此输入标题" value="{{$articles->title}}">
  </div>


<h1 style="font-size:24px;">选择文章所在的分类</h1>

  <div class="layui-form-item">

    <div class="layui-input-inline ml0" style="width:600px;">
   
      @foreach ($cats as $cat)
         
        @foreach ($all->find($id)->Category()->lists('name') as $catname)
           @if($cat->name==$catname)
            <input type="checkbox" name="cid[]" title="{{$cat->name}}" value="{{$cat->id}}" checked>
            @endif
        @endforeach
            <input type="checkbox" name="cid[]" title="{{$cat->name}}" value="{{$cat->id}}"> 
      @endforeach
    </div>
     
  </div>


   <div class="layui-form-item">
  
    <div class="layui-input-block ml0" style="max-width:200px;">
    @if($articles->load_type==1)
      <input type="radio" name="load_type" value="1" title="原创" checked>
      <input type="radio" name="load_type" id="zhuanzai" value="0" title="转载" >
    @else
      <input type="radio" name="load_type" value="1" title="原创" >
      <input type="radio" name="load_type" id="zhuanzai" value="0" title="转载" checked>
    @endif
    </div>

   </div>

  <textarea  id="article_write" name="content" style="display: none;">{{$articles->content}}</textarea>

  <div class="blog-admin-fabu mt10">
<button class="btn btn-primary"  id="article_edit" type="submit">确定修改</button>
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