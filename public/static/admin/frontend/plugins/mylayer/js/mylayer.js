
var mylayer={
    imgRootPath : '/static/frontend/plugins/mylayer/images/',
    //删除按钮方法
    closeFn:function(){
        $(".mylayer_shade,.mylayer_bomb-box").fadeOut(500);
    },
    //选择是否保留删除按钮和title方法
    selectTitltBtn:function(x,y){
        if(x){
            $(".mylayer_bomb-box").append(mylayer.imgs);
        }else{
            $(".mylayer_delete").remove();
        }
        if(y){
            $(".mylayer_title").css("display","block");
        }else{
            $(".mylayer_title").css("display","none");
            $(".mylayer_bomb-box").css("paddingTop",".25rem");
        }
    },
    //删除按钮
    get imgs(){
        return '<img class="mylayer_delete" src="'+this.imgRootPath+'mylayer_delete.png" onclick="mylayer.closeFn()">';
    },
    //选择支付方法
    selectPay:function(obj){
        $(obj).addClass("mylayer_active").siblings(".mylayer_active").removeClass("mylayer_active");
    },
    //五角星评价方法
    appraiseFn:function(obj){
        var index=$(obj).index();
        var length=$(".star_appraise>img").length;
        for(var i=0;i<index+1;i++){
            $(".star_appraise img").eq(i).attr("src","../images/mylayer_xx_two.png");
        }
        for(var i=index+1;i<length;i++){
            $(".star_appraise img").eq(i).attr("src","../images/mylayer_xx_one.png");
        }
    },
    layerOne:function(title,explain,content){
        this.title=title;
        this.explain=explain;
        this.content=content;
        var Bombbox='<div class="mylayer_shade"></div>\
            <div class="mylayer_bomb-box">\
            <div class="mylayer_title">'+this.title+'</div>\
            <div class="mylayer_explain">'+this.explain+'</div>\
            <a class="mylayer_know-btn" href="'+ _option.url+ '">'+this.content+'</a>\
            </div>';
        return $("body").append(Bombbox);
    },
    layerTwo:function(title,explain,content){
        this.title=title;
        this.explain=explain;
        this.content=content;
        var Bombbox='<div class="mylayer_shade"></div>\
            <div class="mylayer_bomb-box">\
                <div class="mylayer_title">'+this.title+'</div>\
                <div class="mylayer_explain">\
                <div class="mylayer_explain_t">'+this.explain+'\
                    <div class="star_appraise">\
                        <img src="../images/mylayer_xx_one.png" onclick="mylayer.appraiseFn(this)">\
                     <img src="../images/mylayer_xx_one.png" onclick="mylayer.appraiseFn(this)">\
                     <img src="../images/mylayer_xx_one.png" onclick="mylayer.appraiseFn(this)">\
                     <img src="../images/mylayer_xx_one.png" onclick="mylayer.appraiseFn(this)">\
                     <img src="../images/mylayer_xx_one.png" onclick="mylayer.appraiseFn(this)">\
                    </div>\
                </div>\
                <textarea id="appraise_field"></textarea>\
            </div>\
            <a class="mylayer_know-btn" href="'+_option.url+'">'+this.content+'</a>\
        </div>';
        return $("body").append(Bombbox);
    },
    layerThree:function(title,payExplain,content){
        this.title=title;
        this.payExplain=payExplain;
        this.content=content;
        var Bombbox = '<div class="mylayer_shade"></div>\
            <div class="mylayer_bomb-box">\
                <div class="mylayer_title">'+this.title+'</div>\
            <div class="mylayer_main">\
            <div class="mylayer_payone">'+this.payExplain+'<span>¥'+ _option.price + '</span></div>\
                <div class="mylayer_paytwo mylayer_active" onclick="mylayer.selectPay(this)">\
                <div class="mylayer_paytwo_l">\
                <img class="mylayer_paytwo_img1" src="'+this.imgRootPath+'Wechatone.png">\
                <img class="mylayer_paytwo_img2" src="'+this.imgRootPath+'Wechattwo.png">\
                </div> 微信支付\
                <div class="mylayer_paytwo_r">\
                <img class="mylayer_paytwo_img1" src="'+this.imgRootPath+'pitch_on.png">\
                <img class="mylayer_paytwo_img2" src="'+this.imgRootPath+'no_pitch_on.png">\
                </div>\
            </div>\
            <div class="mylayer_paythree" onclick="mylayer.selectPay(this)">\
                 <div class="mylayer_paythree_l">\
                   <img class="mylayer_paytwo_img1" src="'+this.imgRootPath+'integralone.png"/>\
                   <img class="mylayer_paytwo_img2" src="'+this.imgRootPath+'integraltwo.png"/>\
                </div>积分支付\
                <div class="integral">拥有' + _option.integral + '积分</div>\
                <div class="mylayer_paythree_r">\
                    <img class="mylayer_paytwo_img1" src="'+this.imgRootPath+'pitch_on.png">\
                    <img class="mylayer_paytwo_img2" src="'+this.imgRootPath+'no_pitch_on.png">\
                </div>\
            </div>\
            </div>\
            <a class="mylayer_know-btn" href="'+_option.url+'">'+this.content+'</a>\
            </div>';
        return $("body").append(Bombbox);
    },
    //提醒登录弹窗
    remindEntry : function(options){
        _option={
            url : "javascript:void(0);",
            titleContent:false,
            deleteBtn:true
        },
            $.extend(_option,options);
        mylayer.layerOne("","需登录才能咨询哟～","立即登陆");
        mylayer.selectTitltBtn(_option.deleteBtn,_option.titleContent);
    },
    //支付成功弹窗
    paySuccess:function(options){
        _option={
            url : "javascript:void(0);",
            titleContent:true,
            deleteBtn:true
        },
            $.extend(_option,options);
        mylayer.layerOne("支付成功","您已成功支付</br>可以向学长咨询啦～","我知道了");
        mylayer.selectTitltBtn(_option.deleteBtn,_option.titleContent);
    },
    //秒问提交成功弹窗
    secondAsk:function(options){
        _option = {
            url: "javascript:void(0);",
            titleContent:true,
            deleteBtn:false
        },
            $.extend(_option, options);
        mylayer.layerOne("提交成功","您的问题将会在</br>24小时内被学长回答</br>请耐心等待","我知道了");
        mylayer.selectTitltBtn(_option.deleteBtn,_option.titleContent);
    },
    //充值成功弹窗
    rechargeSuccess:function(options){
        _option = {
            url: "javascript:void(0);",
            titleContent:true,
            deleteBtn:false
        },
            $.extend(_option, options);
        mylayer.layerOne("充值成功","您已经成功充值</br>可以继续咨询啦～","我知道了");
        mylayer.selectTitltBtn(_option.deleteBtn,_option.titleContent);
    },
    //注册成功弹窗
    registerSuccess:function(options){
        _option = {
            url: "javascript:void(0);",
            titleContent:false,
            deleteBtn:false
        },
            $.extend(_option, options);
        mylayer.layerOne("","恭喜您～</br>注册成功，您可以登录了！","我知道了");
        mylayer.selectTitltBtn(_option.deleteBtn,_option.titleContent);
    },
    //更换手机号码弹窗
    renewalNumber:function(options){
        _option = {
            url: "javascript:void(0);",
            titleContent:false,
            deleteBtn:false
        },
            $.extend(_option, options);
        mylayer.layerOne("","恭喜您～</br>成功更换手机号码","我知道了");
        mylayer.selectTitltBtn(_option.deleteBtn,_option.titleContent);
    },
    //短信修改密码成功
    revisePasswordsuccess:function(options){
        _option = {
            url: "javascript:void(0);",
            titleContent:false,
            deleteBtn:false
        },
        $.extend(_option, options);
        mylayer.layerOne("","您已成功更换密码</br>请重新登录","立即登陆");
        mylayer.selectTitltBtn(_option.deleteBtn,_option.titleContent);
    },
    //重新登录弹窗
    againEntry:function(options){
        _option = {
            url: "javascript:void(0);",
            titleContent:false,
            deleteBtn:false
        },
            $.extend(_option, options);
        mylayer.layerOne("","您已重新更换号码</br>请重新登录","立即登录");
        mylayer.selectTitltBtn(_option.deleteBtn,_option.titleContent);
    },
    //评价弹窗
    appraise:function(options){
        _option = {
            url: "javascript:void(0);",
            titleContent:true,
            deleteBtn:true
        },
            $.extend(_option, options);
        mylayer.layerTwo("评价学长","评分:","提交评价");
        mylayer.selectTitltBtn(_option.deleteBtn,_option.titleContent);
    },
    //申请退款弹窗
    applyDrawback:function(options){
        _option = {
            url: "javascript:void(0);",
            titleContent:true,
            deleteBtn:true
        },
            $.extend(_option, options);
        mylayer.layerTwo("申请退款","申请理由:","提交申请");
        mylayer.selectTitltBtn(_option.deleteBtn,_option.titleContent);
        $(".star_appraise").css("display","none");
    },
    //拒绝退款弹窗
    refuseDrawback:function(options){
        _option = {
            url: "javascript:void(0);",
            titleContent:true,
            deleteBtn:true
        },
            $.extend(_option, options);
        mylayer.layerTwo("拒绝退款理由","拒绝理由:","提交申请");
        mylayer.selectTitltBtn(_option.deleteBtn,_option.titleContent);
        $(".star_appraise").css("display","none");
    },
    //支付弹窗
    pay:function(options) {
        _option = {
            url: "javascript:void(0);",
            price: 8,
            integral: 100,
            titleContent:true,
            deleteBtn:true
        }
        $.extend(_option, options);
        mylayer.layerThree("选择支付类型","支付图文咨询","确认支付");
        mylayer.selectTitltBtn(_option.deleteBtn,_option.titleContent);
    },
    //秒问支付弹窗
    secondDefray:function(options){
        _option = {
            url: "javascript:void(0);",
            price: 8,
            integral: 100,
            titleContent:true,
            deleteBtn:true
        },
            $.extend(_option, options);
        mylayer.layerThree("选择支付类型","秒问悬赏","确认支付");
        mylayer.selectTitltBtn(_option.deleteBtn,_option.titleContent);
    }


}

