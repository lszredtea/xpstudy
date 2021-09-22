<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>学生信息添加</title>



    <script src="../public/jquery-1.8.3.js";></script>
    <script type="text/javascript" src="../public/layui-v2.6.8/layui/layui.js"> </script>
    <link rel="stylesheet" href="../public/layui-v2.6.8/layui/css/layui.css">

</head>
<body>

<form class="layui-form">
<div class="layui-form-item">
    <label class="layui-form-label">姓名</label>
    <div class="layui-input-block">
        <input type="text" name="sname" required  lay-verify="required|sname" placeholder="请输入姓名" autocomplete="off" class="layui-input">
    </div>
</div>
    <div class="layui-form-item">
        <label class="layui-form-label">学号</label>
        <div class="layui-input-block">
            <input type="number" name="snum" required  lay-verify="required|snum" placeholder="学号必须是8位" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">手机号</label>
        <div class="layui-input-block">
            <input type="number" name="tel" required  lay-verify="required|phone|number" placeholder="请输入手机号" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">出生日期</label>
        <div class="layui-input-block">
            <input type="text" name="birth" id="test12" required  lay-verify="required" placeholder="请选择出生日期" autocomplete="off" class="layui-input">
        </div>
    </div>
<!--<div class="layui-form-item">-->
<!--    <label class="layui-form-label">密码</label>-->
<!--    <div class="layui-input-inline">-->
<!--        <input type="password" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">-->
<!--    </div>-->
<!---->
<!--</div>-->

    <div class="layui-form-item">
        <label class="layui-form-label">性别</label>
        <div class="layui-input-block">
            <input type="radio" value="1" name="gender" title="男" checked>
            <input type="radio" value="0" name="gender" title="女">
            <input type="radio" value="2" name="gender" title="未知">
        </div>
    </div>

<!--<div class="layui-form-item layui-form-text">-->
<!--    <label class="layui-form-label">文本域</label>-->
<!--    <div class="layui-input-block">-->
<!--        <textarea name="desc" placeholder="请输入内容" class="layui-textarea"></textarea>-->
<!--    </div>-->
<!--</div>-->
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button type="button" class="layui-btn" lay-submit lay-filter="demo">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>

<script>
    //Demo
    //使用layui的多个模块
    layui.use(['form','laydate','layer'], function(){
        var form = layui.form;

        var layer=layui.layer;
        var laydate=layui.laydate;
        //监听提交
        // form.on('submit(demo)', function(data){
        //     layer.msg(JSON.stringify(data.field));
        //     return false;
        // });
        //初始化date实例
        laydate.render({
            elem: '#test12',
            value:'1990-01-01'
            //,type: 'date' //默认，可不填
        });
        //表单提交
        form.on('submit(demo)', function (data) {
            // console.log(data.elem) //被执行事件的元素DOM对象，一般为button对象
            // console.log(data.form) //被执行提交的form对象，一般在存在form标签时才会返回
            console.log(data.field) //当前容器的全部表单字段，名值对形式：{name: value}
            // return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
            $.post("save.php",data.field,function (res){
                if(res.status==1){
                    layer.msg(res.msg());
                }
            })
        });
        form.verify({
            sname: function(value, item){ //value：表单的值、item：表单的DOM对象
                if(!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)){
                    return '用户名不能有特殊字符';
                }
                if(/(^\_)|(\__)|(\_+$)/.test(value)){
                    return '用户名首尾不能出现下划线\'_\'';
                }
                if(/^\d+\d+\d$/.test(value)){
                    return '用户名不能全为数字';
                }

                //如果不想自动弹出默认提示框，可以直接返回 true，这时你可以通过其他任意方式提示（v2.5.7 新增）
                if(value === 'xxx'){
                    alert('用户名不能为敏感词');
                    return true;
                }

            }

            //我们既支持上述函数式的方式，也支持下述数组的形式
            //数组的两个值分别代表：[正则匹配、匹配不符时的提示文字]
            ,pass: [
                /^[\S]{6,12}$/
                ,'密码必须6到12位，且不能出现空格'
            ]
            ,snum:function (value,item){
                if(value.length!=8){
                    return '学号必须是8位';
                }

            }
        },'json');
        $("[name='sname'],[name='snum']").blur(function(){
            var data={};
            data.sname = $("[name='sname']").val();
            data.snum = $("[name='snum']").val();
            $.post("user_v.php",data,function(res){
                if (res) {
                    layer.msg(res.msg);
                }

            },"json")
        });


    });

</script>
</body>
</html>