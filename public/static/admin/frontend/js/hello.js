/**
 * Created by zengbenli on 2017/3/2.
 */
//底部导航
$("#nav").on("click","a",function(){
    $(this).addClass("active").siblings(".active").removeClass("active");
})
function consultFn(obj){
    var index=$(obj).index();
    $(obj).addClass("active").siblings(".active").removeClass("active");
    $(".news-list>div").eq(index).addClass("active").siblings(".active").removeClass("active");
}
//注册选择端口
function selectPort(obj){
    $(obj).addClass("active").siblings(".active").removeClass("active");
    $(".register .login-btn").eq($(obj).index()).addClass("active").siblings(".active").removeClass("active");
}
//验证码倒计时
var timeSwitch=false;
function countDown(obj){
    if(timeSwitch){
        return;
    }
    timeSwitch=true;
    var time=60;
    var timer=setInterval(function(){
        time--;
        var s=time+"秒后获取";
        $(obj).html(s);
        if(time==0){
            clearInterval(timer);
            timeSwitch=true;
            $(obj).html("获取验证码");
        }
    },1000)
}
//学长证件图片上传
function f_upfile(obj){
    var file=$('#fileImage')[0].files[0];
    var reader = new FileReader();
    if($('#fileImgBox img').length>2){
        alert('最多只能上传3张图片');
        return;
    }
    if(file.size>1000000){
        alert('图片不能超过1M');
        return;
    }
    for(var i=0;i<$('#fileImgBox img').length;i++){
        if(file.name==$('#fileImgBox img').eq(i).attr('name')){
            alert('你已选择此图片');
            return;
        }
    }
    reader.onload = (function(theFile){
        return function(e){
            var content='<img src="'+e.target.result+'">';
            $(content).appendTo($('#fileImgBox'));
            $("#fileImgBox .fileImg-img").remove();
            $("#fileImgBox img").click(function(){
                $(this).remove();
            })
            $('#fileImgBox').append(img);
        }
    })(file);
    reader.readAsDataURL(file);
}
//学弟评价
function answer_change(obj){
    $(obj).addClass("active").siblings(".active").removeClass("active");
    $(".answer-box").eq($(obj).index()).addClass("active").siblings(".active").removeClass("active");
}
function upward_btn(obj){
    $(obj).parent().slideUp(150);
    $(obj).parent().prev().find(".text-run").addClass("text-runoff");
}
function develop_fn(obj){
    $(obj).next().slideDown(150);
    $(obj).find(".text-run").removeClass("text-runoff");
}
//我的评价
function assess_change(obj){
    $(obj).addClass("active").siblings(".active").removeClass("active");
}
//积分明细
function integral_detail() {
    $(".shade-tier").fadeIn(150);
    $(".withdraw-detail").animate({
        right:0
    },150)
}
function integral_detail_fn() {
    $(".shade-tier").fadeOut(150);
    $(".withdraw-detail").animate({
        right:"-2.5rem"
    },150)
}
//状态切换
function status_fn(obj){
    $(obj).addClass("active").parent().siblings().find(".active").removeClass("active");
}
//更换头像
function renewal_fn(){
    $(".shade-storey").show();
    $(".renewal-box").show();
}
