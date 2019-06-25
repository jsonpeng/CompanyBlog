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
                添加新用户
              </h1>

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
              <h3 class="box-title">添加</h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <form  class="form horizontal" role="form" method="POST" action="/blog-admin/adduser">
              <div class="box-body">
              
                <div class="form-group">
                  <label for="exampleInputUsername">用户名</label>
                  <input type="text" class="form-control" name="username" id="username" placeholder="输入用户名">
                </div>

                 <div class="form-group">
                  <label for="exampleInputEmail">邮箱</label>
                  <input type="email" class="form-control" name="email" id="email"  placeholder="输入邮箱">
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword">密码</label>
                  <input type="password" class="form-control" name="password" id="password"  placeholder="输入密码">
                </div>

                <div class="form-group">
                  <label for="exampleInputFile">头像上传</label>
                  <input type="file" id="exampleInputFile">

                  <p class="help-block">选择你的头像上传</p>
                </div>

                <div class="form-group">
                    <label for="exampleInputAdmin">是否授权为管理员</label>
                    <input type='radio' name='is_admin' value="0" title="否" style="margin-left:25px;" checked/>否
                    <input type='radio' name='is_admin' value="1" title="是" style="margin-left:25px;" />是
                </div>
              
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="submit" value="添加"   class="btn btn-primary" />
              </div>
            </form>
          </div>
          <!-- /.box -->
         </div>
        </div>    
            </section>
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->




  <!-- Main Footer -->
@include('admin_footer')
  <!--/Main Footer -->