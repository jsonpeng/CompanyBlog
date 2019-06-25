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
      <h1>网站基础信息设置</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Your Page Content Here -->
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">设置</h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <form  class="form horizontal" role="form" method="POST" action="/blog-admin/bloginfo">
               
              @foreach ($bloginfos as $bloginfo)   
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputUsername">网站标题</label>
                  <input type="text" class="form-control" name="website_title"  placeholder="输入网站标题" value="{{$bloginfo->website_title}}">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail">网站关键字</label>
                  <input type="text" class="form-control" name="website_keyword"  placeholder="输入网站关键字" value="{{$bloginfo->website_keyword}}">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword">网站描述</label>
                  <textarea class="form-control" rows="3" name="website_des" placeholder="输入网站描述">{{$bloginfo->website_des}}</textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword">公司简介</label>
                  <textarea class="form-control" rows="3" name="company_des" placeholder="输入公司简介">{{$bloginfo->company_des}}</textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail">联系电话</label>
                  <input type="text" class="form-control" name="contact_tel"  placeholder="输入联系电话" value="{{$bloginfo->contact_tel}}">
                </div>
              </div>
            @endforeach

              <!-- /.box-body -->

              <div class="box-footer">
                <input type="submit" value="设置" class="btn btn-primary" />
              </div>

            </form>
          </div>
          <!-- /.box --> </div>
      </div>
    </section>
    <!-- /.content --> </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  @include('admin_footer')
  <!--/Main Footer -->