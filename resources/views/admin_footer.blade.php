<footer class="main-footer" style="text-align:center;">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        博客后台管理系统
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2017 <a href="http://www.wiswebs.com" target="_blank">武汉智琛佳源科技有限公司</a>.</strong>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:;">
                        <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                            <p>Will be 23 on April 24th</p>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:;">
                        <h4 class="control-sidebar-subheading">
                            Custom Template Design
                            <span class="pull-right-container">
                  <span class="label label-danger pull-right">70%</span>
                </span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

        </div>
        <!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        <!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
                <h3 class="control-sidebar-heading">General Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Report panel usage
                        <input type="checkbox" class="pull-right" checked>
                    </label>

                    <p>
                        Some information about this general settings option
                    </p>
                </div>
                <!-- /.form-group -->
            </form>
        </div>
        <!-- /.tab-pane -->
    </div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="{{asset("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js")}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset("/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{asset("/bower_components/AdminLTE/dist/js/app.min.js")}}"></script>

<script src="{{asset("/blog_front_static/js/layer.js")}}"></script>

@if(Request::is('blog-admin/article/*'))  
<link rel="stylesheet" href="{{asset("/blog_front_static/layer/css/layui.css")}}">
<script src="{{asset("/blog_front_static/layer/layui.js")}}"></script>

<script>
layui.use('layedit', function(){
  var layedit = layui.layedit;
  layedit.set({
  uploadImage: {
    url: 'http://127.0.0.1/blog-admin/upload' //接口url
    ,
    type: 'post',
    before: function(input){
    console.log('文件上传中');
  }
  },success:function(res){

  }
});
  var layIndex=layedit.build('article_write',{
    height:500
  }); //建立编辑器

//测试预览效果
$('#article_yulan').click(function(){
 var title=$('input#article_title').val();
  var cid=$("input:checkbox[name='cid[]']:checked").attr("title");
  var content=layedit.getContent(layIndex);
  var use_md=$("input:radio[name='use_md']:checked").val();
  if (use_md==1){
   //content=encodeURIComponent(content);
   content=encodeURIComponent(content.replace(/<.*?>/ig,""));
  }

  window.open('/blog-admin/article/edit?title='+title+'&content='+content+'&category='+cid+'&use_md='+use_md);
/*
  layer.open({
  type: 2,
  title: false,
  closeBtn: 0, 
  shade: [0],
  area: ['1366px', '768px'],
  offset: 'lb', //坐下角弹出
  time: 1000, //1秒后自动关闭
  anim: 2,
  content: ['/blog-admin/article/edit?content='+content+'&title='+title+'&category='+cid, 'no'], //iframe的url，no代表不显示滚动条
  end: function(){ //此处用于演示
    layer.open({
      type: 2,
      title: '正在预览:'+title,
      shadeClose: true,
      shade: false,
      maxmin: true, //开启最大化最小化按钮
      area: ['1366px', '768px'],
      content: '/blog-admin/article/edit?title='+title+'&content='+content+'&category='+cid,
    });
  }
});
*/

});

  //ajax test
  $('#article_publish').click(function(){
    var title=$('input#article_title').val();
    var cid=new Array();
 
    $("input:checkbox[name='cid[]']:checked").each(function() {

      var cidValue=$(this).val();
          cid.push(cidValue);
   
    });
    var load_type=$("input:radio[name='load_type']:checked").val();
    var content=layedit.getContent(layIndex);


    $.ajax({
               type: "POST",
               url: "/blog-admin/article/write",
               data: 'title='+title+'&cid='+cid+'&load_type='+load_type+'&content='+content,
               success: function(data){
                   if(data.status==true && data.code=='200'){
                    layer.alert("添加文章成功!cid为"+data.data.message,{icon:1});
                     setTimeout(function(){
                      location.href="/blog-admin/article/all";
                     },500);  
                       //console.log('title='+title+'&cid='+cid+'load_type='+load_type+'content='+content);
                  }else if(data.status==false && data.code=='403'){
                     layer.alert("该文章标题已经存在!",{icon:5});
                   // location.href="/blog-admin/article/write"
                  }else if(data.status==false && data.code=='500'){
                        layer.alert("添加的字段中不能为空值!",{icon:5});
            
                      //location.href="/blog-admin/article/write"
                  }
               }
             });

  });

});

</script>

@endif

<script>
//添加用户
function adduser(){
 var USERNAME=$("input#username").val(); 
 var EMAIL=$("input#email").val(); 
 var PWD=$("input#password").val(); 
 var IS_ADMIN=$('input:radio:checked').val();
     $.ajax({
               type: "POST",
               url: "/blog-admin/adduser",
               data: "username="+USERNAME+"&email="+EMAIL+"&password="+PWD+"&is_admin="+IS_ADMIN,
               success: function(data){
          if(data.status==true && data.code=='200'){
 layer.alert("添加用户成功!",{icon:3});
 setTimeout(function(){
location.href="/blog-admin/usermanage/userlist";
},300);
}else if(data.status==false && data.code=='500'){
   layer.alert("添加字段中不可为空!",{icon:5});
}else if(data.status==false && data.code=='403'){
  layer.alert("用户名已存在!",{icon:5});  
}else if(data.status==false && data.code=='405'){
  layer.alert("邮箱已存在!",{icon:5});
}
        }
          });
}


$(document).ready(function(){
  //删除用户
$(".delRow").click(function() { 
var userid=$(this).attr("id"); 
 layer.confirm('确定删除该用户吗?', {
  btn: ['确定','取消'] //按钮
}, function(){
    $.ajax({
               type: "POST",
               url: "/blog-admin/deluser/"+userid,
               success: function(data){
                  if(data.status==true && data.code=='200'){
         layer.alert("删除成功!",{icon:1});
            $("#" + userid).parent().parent().remove();
        }
        }
          });
},function(){
  layer.closeAll();
});
       



});


//删除当前文章
$(".delArticleRow").click(function() { 
var articleid=$(this).attr("id") ;
 layer.confirm('确定删除该文章吗?', {
  btn: ['确定','取消'] //按钮
}, function(){
  $.ajax({
               type: "POST",
               url: "/blog-admin/article/del/"+articleid,
               success: function(data){
                  if(data.status==true && data.code=='200'){
         layer.alert("删除文章成功!",{icon:1});
            $("#" + articleid).parent().parent().remove();
        }
        }
          });
},function(){
  layer.closeAll();
});
        
});

//删除文章分类
$(".delCatRow").click(function() { 
var catid=$(this).attr("id");
  layer.confirm('确定删除该文章吗?', {
  btn: ['确定','取消'] //按钮
}, function(){
 $.ajax({
               type: "POST",
               url: "/blog-admin/delcategory/"+catid,
               success: function(data){
                  if(data.status==true && data.code=='200'){
         layer.alert("删除文章分类成功!",{icon:1});
            $("#" + catid).parent().parent().remove();
        }
        }
          });
},function(){
  layer.closeAll();
});
        



});

//编辑修改用户
$(".editRow").click(function() { 
    var is_admin_value=1;
    var is_admin_title='是';
    var is_admin_title_rel='是';
    var userid=$(this).attr("id");
    var username=$(this).parent().parent().children('td').eq(1).attr("id");
    var email=$(this).parent().parent().children('td').eq(2).attr("id");
    var password =$(this).parent().parent().children('td').eq(3).attr("id");
    var is_admin=$(this).parent().parent().children('td').eq(4).attr("id");
    if(is_admin==1){
is_admin_value=0;
is_admin_title='否';
    }else{
      is_admin_title_rel='否';
    }
 layer.open({
        type: 1,
        closeBtn: false,
        shift: 7,
        shadeClose: true,
        content: "<div style='width:350px;'><div style='width:320px;margin-left: 3%;' class='form-group has-feedback'><p>请输入新用户名</p><input id='newusername' class='form-control' type='text' name='username' value='"+username+"'/></div>" +
        "<div style='width:320px;margin-left: 3%;' class='form-group has-feedback'><p>请输入新邮箱</p><input id='newemail' class='form-control' type='email' name='email' value='"+email+"' /></div>"+
        "<div style='width:320px;margin-left: 3%;' class='form-group has-feedback'><p>请输入新密码</p><input id='newpassword' class='form-control' type='password' name='password' value='"+password+"' /></div>"+"<div style='width:320px;margin-left: 3%;' class='form-group has-feedback'><p>选择授权</p><input id='newauthrity'  type='radio' name='new_is_admin' value='"+is_admin+"' title='"+is_admin+"' checked/>"+is_admin_title_rel+"<input id='newauthrity'  type='radio' name='new_is_admin' value='"+is_admin_value+"' title='"+is_admin_value+"' style='margin-left: 15px;' />"+is_admin_title+"</div>"+
        "<button style='margin-top:5%;width:80%;margin:0 auto;margin-bottom:5%;' type='button' class='btn btn-block btn-primary btn-lg' onclick='updateUser("+userid+")'>修改</button></div>"
    });

});

//编辑修改文章分类
//editCatRow
$(".editCatRow").click(function(){
    var catid=$(this).attr("id");
    var cat_name_edit=$(this).parent().parent().children('td').eq(1).attr("id");
    layer.open({
        type: 1,
        closeBtn: false,
        shift: 7,
        shadeClose: true,
        content: "<div style='width:350px;'><div style='width:320px;margin-left: 3%;' class='form-group has-feedback'><p>请输入文章分类</p><input id='cat_name_edit' class='form-control' type='text' name='cat_name_edit' value='"+cat_name_edit+"' /></div>" +
  "<button style='margin-top:5%;width:80%;margin:0 auto;margin-bottom:5%;' type='button' class='btn btn-block btn-primary btn-lg' onclick='editCategory("+catid+")'>修改</button></div>"
    });
});


//添加文章分类
$("#addCat").click(function(){
 layer.open({
        type: 1,
        closeBtn: false,
        shift: 7,
        shadeClose: true,
        content: "<div style='width:350px;'><div style='width:320px;margin-left: 3%;' class='form-group has-feedback'><p>请输入文章分类</p><input id='cat_name' class='form-control' type='text' name='cat_name' /></div>" +
  "<button style='margin-top:5%;width:80%;margin:0 auto;margin-bottom:5%;' type='button' class='btn btn-block btn-primary btn-lg' onclick='addCategory()'>添加</button></div>"
    });
});

});

//修改用户接口交互
function updateUser(userid){
 var USERNAME=$("input#newusername").val(); 
 var EMAIL=$("input#newemail").val(); 
 var PWD=$("input#newpassword").val(); 
 var IS_ADMIN=$('input:radio[name="new_is_admin"]:checked').val();
 //alert('IS_ADMIN:'+IS_ADMIN);
 
  $.ajax({
               type: "POST",
               url: "/blog-admin/edituser/"+userid,
               data: "username="+USERNAME+"&email="+EMAIL+"&password="+PWD+"&is_admin="+IS_ADMIN,
               success: function(data){
                 layer.alert("修改成功!",{icon:1});
                layer.closeAll();
             location.href="/blog-admin/usermanage/userlist";

        }
               });

}

//修改分类名称接口交互
function editCategory(catid){
var CATNAME=$("input#cat_name_edit").val();
  $.ajax({
               type: "POST",
               url: "/blog-admin/editcategory/"+catid,
               data: "cat_name_edit="+CATNAME,
               success: function(data){
                 layer.alert("修改成功!",{icon:1});
              layer.closeAll();
           location.href="/blog-admin/article/category";
          //alert(data.data);

        }
               });
}

//老方法的 删除用户
function deluser(userid){
     $.ajax({
               type: "POST",
               url: "/blog-admin/deluser/"+userid,
               success: function(data){
          if(data.status==true && data.code=='200'){
 layer.alert("删除成功!",{icon:1});
   $(this).parent().parent().remove();
   //location.href="/blog-admin/usermanage/userlist";
}
        }
          });
}


//添加新的文章分类
function addCategory(){
   var CATNAME=$("input#cat_name").val(); 

     $.ajax({
               type: "POST",
               url: "/blog-admin/addcategory",
               data: "cat_name="+CATNAME,
               success: function(data){
    if(data.status==true && data.code=='200'){
     layer.alert("添加文章分类成功!",{icon:1});
     layer.closeAll();
     location.href="/blog-admin/article/category";
}else if(data.status==false && data.code=='500'){
   layer.alert("添加字段中不可为空!",{icon:5});
}else if(data.status==false && data.code=='403'){
  layer.alert("该分类已存在!",{icon:5});  
}
             
        }
               });
}




</script>
</body>
</html>