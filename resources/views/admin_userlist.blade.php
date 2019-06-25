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
                用户列表
              <!--   <small>所有授权用户列表</small> -->
              </h1>

            </section>

            <!-- Main content -->
            <section class="content">
              <!-- Your Page Content Here -->
 <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">所有用户</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>用户名</th>
                  <th>邮箱</th>
                  <th>是否授权</th>
                  <th>创建时间</th>
                  <th>上次登录时间</th>
                  <th>上次修改时间</th>
                  <th>操作</th>
                </tr>
                </thead>
                <tbody>

      @foreach ($users as $user)
                <tr>
                  <td>{{$user->id}}</td>
                  <td id="{{$user->name}}">{{$user->name}}</td>
                  <td id="{{$user->email}}">{{$user->email}}</td>
                  <td id="{{$user->is_admin}}">{{$user->is_admin==1?'是':'否'}} </td>
                  <td>{{$user->created_at}}</td>
                  <td>{{$user->last_login}} </td>
                  <td>{{$user->updated_at}}</td>
                  <td><a class="delRow" id="{{$user->id}}" >删除</a>&nbsp;|&nbsp;<a href="/blog-admin/usermanage/edituser/{{$user->id}}" id="{{$user->id}}">编辑</a><!--class="editRow"--></td>
                  <!--onclick="deluser({{$user->id}})"-->
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