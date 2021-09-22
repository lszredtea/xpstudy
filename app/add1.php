
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>学生信息添加</title>

    <link rel="stylesheet" href="../public/layui-v2.6.8/layui/css/layui.css">
    <script src="../public/jquery-1.8.3.js"></script>
    <script src="../public/layui/layui.js"></script>



</head>
<body>
<form class="layui-form">
    <div class="layui-form-item">


    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">姓名</label>
        <div class="layui-input-block">
            <input type="text" name="sname"   lay-verify="required|sname " placeholder="请输入姓名，只能输入中文姓名" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">学号</label>
        <div class="layui-input-block">
            <input type="number" name="snum" lay-verify="required|num|snum"  placeholder="学号必须是8位数" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">手机号</label>
        <div class="layui-input-block">
            <input type="number" name="tel"  lay-verify="required|num|phone|" placeholder="请输入你的手机号" autocomplete="off" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">出生日期</label>
        <div class="layui-input-block">
            <input type="text" name="birth"   id="test1"   placeholder="选择你的出生日期" autocomplete="off" class="layui-input">
        </div>
    </div>


    <div class="layui-form-item">
        <label class="layui-form-label">性别</label>
        <div class="layui-input-block">
            <input type="radio" name="gender" value="1" title="男" checked>
            <input type="radio" name="gender" value="0" title="女" >
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn xp_btn" type="button"  lay-submit lay-filter="demo">立即提交</button>

        </div>
    </div>


</form>

<script>

    layui.use(['form','layer','laydate'],function(){
        var laydate = layui.laydate;
        var form = layui.form;
        var layer = layui.layer;
        //执行一个laydate实例
        laydate.render({
            elem:'#test1'
            ,value: '1995-05-10'
        })

        //表单提交
        form.on('submit(demo)',function(data){

            $.post("save.php",data.field,function(res){
                if (res.status==1) {
                    layer.msg(res.msg);
                }
            },"json")
        })

        //表单字段验证
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
            }

            ,snum:function(value,item){
                if (value.length != 8 ) {
                    return '学号只能是8位数字';
                }
            }
        })

        // 验证姓名与学号是否已存在
        $("[name='sname'],[name='snum']").blur(function(){
            var data={};
            data.sname = $("[name='sname']").val();
            data.snum = $("[name='snum']").val();
            $.post("user_v.php",data,function(res){
                if (res) {
                    layer.msg(res.msg);
                }

            },"json")
        })
    });





</script>
</body>
</html>