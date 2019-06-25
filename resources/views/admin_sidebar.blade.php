<section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="{{asset("/bower_components/AdminLTE/dist/img/user2-160x160.jpg")}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>{{   Auth::user()->name }}</p>
            <!-- Status -->
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>

    <!-- search form (Optional) -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
    </form>
    <!-- /.search form -->

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->


 <li class="{{ Request::is('blog-admin') ? 'active' : '' }}"><a href="/blog-admin"><i class="fa fa-home"></i> <span>博客后台首页</span></a></li>


     <li class="{{ Request::is('blog-admin/article/*') ? 'active' : '' }}">
            <a href="#"><i class="fa fa-archive"></i> <span>博客文章管理</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ Request::is('blog-admin/article/write') ? 'active' : '' }}"><a href="/blog-admin/article/write">添加新文章</a></li>
                <li class="{{ Request::is('blog-admin/article/all') ? 'active' : '' }}"><a href="/blog-admin/article/all">全部文章</a></li>
                @if(Auth::user()->is_admin==1)
                <li class="{{ Request::is('blog-admin/article/category') ? 'active' : '' }}"><a href="/blog-admin/article/category">文章分类管理</a></li>
                @endif
            </ul>
        </li>
        
@if(Auth::user()->is_admin==1)
     <li class="{{ Request::is('blog-admin/usermanage/*')  ? 'active' : '' }}">
            <a href="#"><i class="fa fa-user"></i> <span>用户信息管理</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ Request::is('blog-admin/usermanage/adduser') ? 'active' : '' }}"><a href="/blog-admin/usermanage/adduser">添加新用户</a></li>
                <li class="{{ Request::is('blog-admin/usermanage/userlist') ? 'active' : '' }}"><a href="/blog-admin/usermanage/userlist">所有用户列表</a></li>   
            </ul>
        </li>

    <li class="{{Request::is('blog-admin/bloginfo') ? 'active' : '' }}"><a href="/blog-admin/bloginfo"><i class="fa fa-wrench"></i> <span>网站基础信息设置</span></a></li>
@endif

    </ul>
    <!-- /.sidebar-menu -->
</section>