<div class="blog-footer">

    <div class="container">

        <div class="row  blog-footer-row" >

            <a>关于我们</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<a>联系我们</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<a>网站地图</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<a>智琛佳源官网</a>

        </div>

        <p class="mt10 mb0">武汉智琛佳源科技有限公司&nbsp;版权所有</p>

        <p class="mt10 mb0">@2011-2017智琛佳源&nbsp;&nbsp;粤ICP备16019755号-1</p>
    </div>
</div>

</body>
@if($use_md)
<script src="http://45.32.248.21/static/markdown/markdown.min.js"></script>
<script>
      function Editor(input, preview) {
        this.update = function () {
          preview.innerHTML = markdown.toHTML(input.value);
        };
        input.editor = this;
        this.update();
      }
      var $ = function (id) { return document.getElementById(id); };
      new Editor($("text-input"), $("preview"));
    </script>
@endif
</html>