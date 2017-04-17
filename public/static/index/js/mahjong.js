	//广告轮播	
	var aLength=$(".banner-box a").length;
	$(".banner-box>div").css("width",aLength*2.4+"rem");
	var timer=setInterval(function(){
		$(".banner-box>div").animate({marginLeft:-2.4+'rem'},400,function(){
			$(".banner-box>div>a").eq(0).appendTo($(".banner-box>div"));
			$(".banner-box>div").css("marginLeft",0);
		});									
	},3000)
	//对话输入框
	$(".input-field input").focus(function(){
		$(".input-field>span").hide();
	})
	$(".input-field input").blur(function(){
		if($(this).val()==""){
			$(".input-field>span").show();
		}
	})
	//查看对话
	function downUp(obj){
		if($(obj).hasClass("active")){
			$(obj).removeClass("active");
			$(".home-box>header,.home-box>main").slideDown(300);
			$(".talk").css("height","2rem");
			$(".talk").css("overflow","hidden");
			$(".talk").css("paddingBottom",".1rem");
			$(".talk .btn-down-up").css("top","3.3rem");
		}else{
			$(obj).addClass("active");			
			$(".home-box>header,.home-box>main").slideUp(300);
			$(".talk").css("height","100%");
			$(".talk").css("overflow","scroll");
			$(".talk").css("paddingBottom","1rem");
			$(".talk .btn-down-up").css("top",".15rem");
		}
	}	
	//兑换弹窗
	function xchange(){
		$(".perfect-data").show();
	}	
	//房间选择
	function houseSelect(obj){
		$(obj).addClass("active").siblings(".active").removeClass("active");
		$(".room-detail").hide().eq($(obj).index()).show();
	}	
	//麻将匹配
	function mahjonMate(){		
		$(".mahjong").fadeIn(200);
	}
	//斗地主匹配
	function landlordnMate(){
		$(".landlord").fadeIn(200);
		countdown1($(".landlords .count-down>span:last-child"));
	}	
	//匹配中-麻将
	function matchingIn1(obj){
		$(obj).parents(".mate-case").fadeOut(200);
		$(".matchings").fadeIn(200);
		countdown1($(".matchings .count-down>span:last-child"));
	}	
	//倒计时
	function countdown1(select){
		console.log('count')
			var n=60;
			var m=60;
			var f=2;
			var timer=setInterval(function(){
				n--;
				if(n==0){				
					m--;n=60;					
				}else if(m==0){
					f--;m=60;				
				}else if(f==0){
					n=0;m=0;f=0;
					clearInterval(timer);
				}
				select.html(bu(f)+':'+bu(m)+':'+bu(n));
			},1000/60)		
	}
	//补零
	function bu(n){
		return n<10?'0'+n:''+n;
	}
	//匹配中-斗地主
	function matchingIn2(obj){
		$(obj).parents(".mate-case").fadeOut(200);
		$(".landlords").fadeIn(200);
	}
	//取消匹配
	function returnPage(obj){
		$(obj).parents(".mate-case").fadeOut(200);
	}
	//麻将多选
	function multiselect(obj){
		if(!$(obj).hasClass("active")){
			$(obj).addClass("active");
		}else{
			$(obj).removeClass("active");
		}
	}
	//创建房间
	function establish(){
		$(".establish-one").fadeIn(200);		
	}
	//加入房间按钮
	function addRoom(){
		$(".establish-one").show();
		$("#select-play-method").attr("data-source","2");
	}
	//房号输入框
	$(".room-number input").focus(function(){
		$(".room-number>span").hide();
	})
	$(".room-number input").blur(function(){
		if($(this).val()==""){
			$(".room-number>span").show();
		}
	})
	//麻将-创建房间-返回按钮
	function returnbtn(obj){
		$(obj).parents(".mate-case").hide();
		$(".establish-one").show();
	}
	function nextbtn(obj){
		var data=$(obj).attr("data-source");
		$(obj).parents(".mate-case").hide();
		if(data==1){			
			$(".mahjong-next-step").show();
		}else if(data==2){
			$(".select-bottom").show();
		}	
	}
	//麻将-创建房间-第二步-创建房间
	function selectSpecies(obj){
		$(obj).addClass("active").siblings(".active").removeClass("active");	
		var species=($(obj).attr("data-money"));
		$(".establish-two").attr("data-species",species);
		if(!$(".establish-two input").val()==""){
			$(".found-two>p>span:last-child").addClass("active");
		}
	}
	//麻将-创建房间-第二步-创建房间
	$(".establish-two input").blur(function(){
		var inputval=$(this).val();
		var species=$(".establish-two").attr("data-species");
		if(!inputval==''&&!species==0){
			$(".found-two>p>span:last-child").addClass("active");
		}
	})
	//余额不足-其他规则
	function rulebtn(obj){
		$(obj).parents(".mate-case").hide();
		$(".mahjong-next-step").show();
	}
	//提醒准备按钮{
	function remindIntend(obj){
		var nickname=$(obj).next().find(".nickname").html();		
		$(".prepare-prompt>span").html(nickname);
		$(".prepare-prompt").show();
		$(".mate-in").hide();
	}
	//踢人按钮
	function playerBtn(obj){
		$(".player-box").show();
	}
	//准备按钮
	function cancelPrepare(obj){
		if($(obj).hasClass("active")){
			$(obj).removeClass("active");
		}else{
			$(obj).addClass("active");
		}
	}
	//取消踢人
	function playerCancel(obj){
		$(obj).parents(".mate-case").hide();
	}
	//解散按钮
	function dismiss(){
		$(".dismiss").show();
	}
	//兑换金币输入框
	$(".exchange-import input").focus(function(){
		$(".exchange-import div span").hide();
	})
	$(".exchange-import input").blur(function(){
		if($(this).val()==""){
			$(".exchange-import div span").show();
		}
	})
	//商城确认购买弹窗
	function purchaseBtn(obj,goodsId){
		var fix = $(obj).parent().find(".fix").html();
		var chief = $(obj).parent().find(".chief").html();
		$("#goodsId").val(goodsId);
		$(".purchase p>span:first-child").html(fix);
		$(".purchase p>span:last-child").html(chief);
		$(".purchase").show();
	}
	//商城购买成功弹窗
	function purchaseSuccess(obj){
		var fix = $(obj).parents(".purchase").find("span.fix-su").html();
		$(obj).parents(".mate-case").hide();
		$(".recharge p>span").html(fix);		
		$(".recharge").show();
	}
	//商城购买失败弹窗
	function purchaseFailed(obj){
		var fix = $(obj).parents(".purchase").find("span.fix-su").html();
		$(obj).parents(".mate-case").hide();
		$(".failed p>span").html(fix);		
		$(".failed").show();
	}
	//排行
	function seniority(obj){
		var index=$(obj).index();
		$(obj).addClass("active").siblings(".active").removeClass("active");
		$(".sen-box").eq(index).addClass("active").siblings(".active").removeClass("active");
	}
	//日榜-分数排行
	function sister(obj){
		var index=$(obj).index();
		$(obj).addClass("active").siblings(".active").removeClass("active");
		$(".sun-box .sun-list-box").eq(index).addClass("active").siblings(".active").removeClass("active");
	}
	//玩家列表
	function playerList(obj){
		var index=$(obj).index();
		$(obj).addClass("active").siblings(".active").removeClass("active");
		$(".player table").hide().eq(index).show();
	}
	//兑换金币输入框
	$(".room-import input").focus(function(){
		$(".room-import span").hide();
	})
	$(".room-import input").blur(function(){
		if($(this).val()==""){
			$(".room-import span").show();
		}
	})
	//进入游戏提示
	function enterPrompt(obj){
		if($(obj).hasClass("no-enter")){
			var name=$(obj).parents(".people-list").find(".nickname").html();
			$(".noenter-prompt>span").html(name);
			$(".noenter-prompt").show();
			$(".enter-prompt").hide();
			$(".room-import").hide();
		}else{
			var roomnumber=$(".all-ready header>div>span").html();
			var title=$(".all-ready header>h4").html();
			$(".enter-prompt>span:last-child").html(roomnumber);
			$(".enter-prompt>span:first-child").html(title);
			$(".enter-prompt").show();
			$(".noenter-prompt").hide();
			$(".room-import").hide();
		}
		$(".all-ready form").hide();
	}
	//兑换金币输入框
	$(".fraction-import>div input").focus(function(){
		$(".fraction-import>div span").hide();
	})
	$(".fraction-import>div input").blur(function(){
		if($(this).val()==""){
			$(".fraction-import>div span").show();
		}
	})
	//结算提示
	function balance(obj){
		var name = $(obj).parents(".people-list").find(".nickname").html();
		if($(obj).hasClass("wrong")){			
			$(".enter-prompt>span").html(name);
			$(".mate-in").hide();
			$(".enter-prompt").show();
			$(".noenter-prompt").hide();
		}else{
			$(".noenter-prompt>span").html(name);
			$(".mate-in").hide();
			$(".enter-prompt").hide();
			$(".noenter-prompt").show();
		}
	}
	
	
