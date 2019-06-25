<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>登录</title>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="description" content=""/>
    <meta name="keywords" content="" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" type="image/x-icon" href="http://zcjy2.wiswebs.com/wp-content/themes/website/images/logo-min.png">
    <link rel="stylesheet" type="text/css" href="{{asset("/blog_front_static/css/all.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("/blog_front_static/css/admin.css")}}">

</head>
<body ng-app="loginform">

<div class="compare-login-form">
    <h2 style="color:white;">武汉智琛佳源科技有限公司</h2>
    <hr />

    <form ng-controller="login" class="compare-form-style" name="registerForm" action="" method="post">
          {!! csrf_field() !!}

        <p style="margin:0;text-align:center">登录 </p>
        <div class="form-group mt15" >
            <label >用户名</label>
            <input type="text" class="form-control" name="name" placeholder="请输入用户名" ng-model="formData.name" ng-minlength="6" ng-maxlength="16" required>
        </div>
        <p>
    <span style="color: red" ng-show="registerForm.name.$invalid">
                        <span ng-show="registerForm.name.$error.minlength">*用户名不得少于6位</span>
                        <span ng-show="registerForm.name.$error.maxlength">*用户名不得超过16位</span>

                    </span>
        </p>

        <div class="form-group">
            <label >密码</label>
            <input type="password" class="form-control" name="password" placeholder="请输入密码" ng-model="formData.password"  ng-minlength="6" ng-maxlength="16" required>
        </div>
        <p>
    <span style="color: red" ng-show="registerForm.password.$invalid">
                        <span ng-show="registerForm.password.$error.minlength">*密码不得少于6位</span>
                        <span ng-show="registerForm.password.$error.maxlength">*密码不得超过16位</span>
                    </span>
        </p>


        <div ng-show="!registerForm.name.$invalid && !registerForm.password.$invalid">
            <span class="icon-ok" style="color: green">通过登录验证</span>
            <hr />
        </div>

        <div class="form-group">
            <input type="button"  value="登录" class="btn btn-primary"  ng-controller="login" ng-click="asave()"  ng-disabled="registerForm.name.$invalid || registerForm.password.$invalid " />
        </div>
    </form>

</body>
<script src="{{asset("/blog_front_static/js/aj.js")}}"></script>
<script src="http://zcjy2.wiswebs.com/wp-content/themes/website/js/jquery.min.js"></script>
<script src="{{asset("/blog_front_static/js/layer.js")}}"></script>
<script type="text/javascript">
    var app=angular.module('loginform',[])
    app.config(['$interpolateProvider', function($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }]);

    app.controller('login',['$scope','$http',function($scope,$http){
$scope.asave=function(){
  $http({
    method:'POST',
    url:'/blog-admin/login',
    data:$.param($scope.formData),
    headers:{'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'}
  }).success(function (data){
console.log('success data'+data);
console.log('success data.status:'+data.status);
if(data.status==true && data.code=='200'){
 layer.confirm('用户'+data.data.message.name+'您已登录成功!', {
  btn: ['确定'] //按钮
}, function(){
   location.href="/blog-admin?uid="+data.data.message.name;
});
}else if(data.status==true && data.code=='301'){
 layer.confirm('管理员'+data.data.message.name+'您已登录成功!', {
  btn: ['确定'] //按钮
}, function(){
   location.href="/blog-admin";
});
}else if(data.status==false && data.code=='500'){
 layer.alert("用户名或密码错误!",{icon:5});
}else if(data.status==false && data.code=='404'){
 layer.alert("没有此用户!",{icon:4});
}
 })
 };
    }]);

</script>
</html>


