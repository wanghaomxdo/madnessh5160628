var app = app || {};

/*-- html5-template
====================================================== */
app.template = function(){};
/* loader */
app.template.loader = function(){};
app.template.loader.init= function(){
    // loader
    var getSource = function(){
        var res = [];
        res.push("img/loading/e-1.jpg");
        res.push("img/p1/bg.gif");
        res.push("img/share-icon1.jpg");
        res.push("img/transparent.png");
        res.push("img/transparent.png");
        res.push("img/p2/bg.png");
        res.push("img/p3/bg.png");
        return res;
    }

    new mo.Loader(getSource(),{
        loadType : 1,
        minTime : 100,
        onLoading : function(count,total){
            //console.log('onloading:single loaded:',arguments)
            $(".loader h1").html(' '+Math.round(count/total*100)+'%');
            $(".loader .l-7").height(230-(Math.round(count/total*100)*2.3));
        },
        onComplete : function(time){
            console.log('oncomplete:all source loaded:',arguments);
            app.template.destory();
            app.template.loader.done_callback.call();
            app.template.loader.done_callback2.call();
        }
    });
    $(".audio-icon").hide();
};
app.template.loader.done_callback = function(){};
app.template.loader.done_callback2 = function(){};

app.template.destory = function(){
    $(".loader").remove();
};

/* Landscape */
app.template.Landscape = function(){};
app.template.Landscape.init= function(){
    var Landscape = new mo.Landscape({
        pic: 'js/motion/landscape.png',
        picZoom: 3,
        mode:'portrait',//portrait,landscape
        prefix:'Shine'
    });
};

/* pageslide swiper */
app.template.swiper = function(){};
app.template.swiper.mySwiper = {};
app.template.swiper.pageXY = [];
app.template.swiper.init = function(){
    app.template.loader.done_callback = this.bind;
};
app.template.swiper.bind = function(){
 $(".swiper-container").css("display", "block");
    app.template.swiper.mySwiper = new Swiper ('.swiper-container', {
        speed:500,
        lazyLoading : true,
        lazyLoadingInPrevNext : true,
         //nextButton: '.swiper-button-next',
         //prevButton: '.swiper-button-prev',
        //direction : 'vertical',
        onInit: function(swiper){ //Swiper2.x的初始化是onFirstInit
            swiperAnimateCache(swiper); //隐藏动画元素 
            swiperAnimate(swiper); //初始化完成开始动画 
            app.template.swiper.on_pageslideend(0);
        }, 
        onSlideChangeStart: function(swiper){
            swiperAnimate(swiper); //每个slide切换结束时也运行当前slide动画
            if (swiper.activeIndex == 2) {
                setTimeout(function(){
                $(".p3 .e3-1").show();
                }, 1000);
            }else if (swiper.activeIndex == 1) {
                setTimeout(function(){
                $(".p2 .e2-8").show();
                }, 2000);
            }
            app.template.swiper.on_pageslideend(swiper.activeIndex);
            app.template.swiper.mySwiper.lockSwipes();
        },
        onSlideChangeEnd: function(swiper){
            },
        onSliderMove: function(swiper, event){}
    });

    app.template.swiper.lock();
};
app.template.swiper.lock = function(){
    app.template.swiper.mySwiper.lockSwipes();
};
app.template.swiper.on_pageslideend = function(index){};

app.template.swiper.next = function(){
    app.template.swiper.mySwiper.unlockSwipes();
    app.template.swiper.mySwiper.slideNext();
};

app.template.swiper.prev = function(){
    app.template.swiper.mySwiper.unlockSwipes();
    app.template.swiper.mySwiper.slidePrev();
};

app.template.swiper.to = function(index){
    app.template.swiper.mySwiper.unlockSwipes();
    app.template.swiper.mySwiper.slideTo(index);
};

app.template.touch = function(){};
app.template.touch.eventlistener_handler = function(e){

    //e.stopPropagation();  // 阻止事件传递
    e.preventDefault();     // 阻止浏览器默认动作(网页滚动)
};


app.template.touch.init = function(){

    // fastclick
    FastClick.attach(document.body);

    document.body.addEventListener("touchmove", function(e) {
        //e.stopPropagation();  // 阻止事件传递
        e.preventDefault();     // 阻止浏览器默认动作(网页滚动)
    });

    $("body").on("doubleTap longTap swipeLeft swipeRight", function(e){
        // e.stopPropagation();  // 阻止事件传递
        e.preventDefault();   // 阻止浏览器默认动作(网页滚动)
        return false;
    });
};


app.template.data = {};
app.template.data.add = function(key, value){
    app.template.data[key] = value;
};
app.template.data.get = function(key){
    return app.template.data[key];
};

/*-- tools
====================================================== */
app.tools = function(){};
app.tools.random = function(n, m){
    var c = m-n+1;  
    return Math.floor(Math.random() * c + n);
};

app.tools.getpageurlwithoutparam = function(){
    var url = window.location.href;
    return url.substring(0, url.indexOf("?"));
};

app.tools.getbaseurl = function(){
    var url = window.location.href;
    return url.substring(0, url.lastIndexOf("/") + 1);
};

app.tools.gotourl = function(url){
    window.location.href = url;
};

app.tools.geturlparam = function(param){
    var reg = new RegExp("(^|&)" + param + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg); 
    if (r != null) 
        return unescape(r[2]);
    else
        return undefined;
};

app.tools.substr = function(str, len){
    if(str.length > len)
        str = str.substring(0, len) + "...";

    return str;
};

app.tools.platform = function(){};
app.tools.platform.os = "";
app.tools.platform.debug = ""; // 强制开始指定os模式
app.tools.platform.init = function(){
    var u = navigator.userAgent;

    app.debug.console("userAgent:" + u);

    if(u.indexOf('Android') > -1 || u.indexOf('Linux') > -1)
        app.tools.platform.os = "android";
    else if(!!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/))
        app.tools.platform.os = "ios";

    if(app.tools.platform.debug == "ios")
        app.tools.platform.os = "ios";
    else if(app.tools.platform.debug == "android")
        app.tools.platform.os = "android";
};

/*-- debug
====================================================== */
app.debug = function(){};
app.debug.enable = false;
app.debug.maxline = 5;
app.debug.linecount = 0;
app.debug.console = function(str){
    if(app.debug.enable)
    {
        app.debug.linecount ++;

        if($("#debug").length > 0)
        {
            if(app.debug.linecount > app.debug.maxline)
            {
                app.debug.linecount = 0;
                $("#debug").html("<br/> #" + str);
            }
            else
                $("#debug").append("<br/> #" + str);
        }else
        {
            $("body").append("<div id='debug' class='debug'></div>");
            $("#debug").append("<br/> #" + str);
        }
    }
};

/*-- loading
====================================================== */
app.loading = function(){};
app.loading.init = function(){
  this.show_animation();
};

app.loading.show_animation = function(){
  $(".loader").show();
}; 



/*-- p1
====================================================== */
app.p1 = function(){

};
 
app.p1.init = function(){  
    // alert(document.body.clientHeight);//504
    // alert(document.body.offsetHeight);//504
    // alert(document.body.scrollHeight);//504
    // alert(window.innerHeight);
    //document.documentElement.style.height = window.innerHeight + 'px'; 
};


app.p1.bind_touch_event = function(){

  $(".p1 .e1-1").on("touchend", function(){
  	var openid = $OPENID;
  	$.post("db/finduser.php", {openid: openid},function(r){
  		console.log(r);
        if(r.code==0){
        	if(r.paystatus == "0"){
        		console.log("参加用户未选择支付方式");
                app.template.swiper.to(1);
        	}else if(r.paystatus == '3'){
                console.log("参加用户已选线下支付方式");
                $('#e3-2').text(r.name);
                $('#e3-3').text(r.email);
                $('#e3-4').text(r.phone);
                $('.e3-1').css("border-color","#c8225e");
                app.template.swiper.to(2);
            }else{
                console.log("参加用户已选线上支付方式");
                $('#e3-2').text(r.name);
                $('#e3-3').text(r.email);
                $('#e3-4').text(r.phone);
                app.template.swiper.to(2);
            }
        }else if(r.code==2){
        	app.template.swiper.to(1);
        }else{
        	showMask('Please try again.');
        }
    },'json');
      //app.template.swiper.to(1);
   });
};

app.p1.destory = function(){  
};

/*-- p2
====================================================== */
app.p2 = function(){};
app.p2.init = function(){
    $(".p2 .e2-1").on("touchend",function(){});
    app.p2.show_qrcode();
};

app.p2.show_qrcode = function () {
    app.template.data.add("openid", $OPENID);
    var url = app.tools.getbaseurl() + "player2.php?id=" + $OPENID;
    $("#qrcode").html("");
    var qrcode = new QRCode("qrcode");
    qrcode.makeCode(url);
}

showMask = function(data){
	$("#mask").show();
	document.getElementById("jumpword").innerHTML = data;
}
    $("#mask").click(function(){
      $(this).hide();
      $(this).children().show();
});

$(".p2 .e2-1").on("touchend",function(){
    var name = $("input[name=name]").val();
        email = $("input[name=email]").val();
        phone = $("input[name=phone]").val();
        whoyouare = $("#whoyouare").val();
        lookingforshmadness = $("#lookingforshmadness").val();
        payfor = $('#payfor').val();
    if (name == '' || name == 'Name') {
        showMask('Please enter your name.');
        return false;
    }
    if (email == '' || email == 'Email') {
        showMask('Please enter your email');
        return false;
    }else{
        var patt = new RegExp(/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/);
        if(!patt.test(email)){
             showMask('Please enter the correct email address.');
             return false;
         }
    }
    if (phone == '' || phone == 'Phone Number') {
        showMask('Please enter your phone number.');
        return false;
    }else{
         var patt = new RegExp(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/);
         if(!patt.test(phone)){
             showMask('Please enter the correct 11 phone number.');
             return false;
         }
    }
    if (lookingforshmadness == '' || whoyouare == '') {
        showMask('Please complete the information.');
        return false;
    }

    $('#e3-2').text(name);
    $('#e3-3').text(email);
    $('#e3-4').text(phone);

    var openid = $OPENID;
    var nickname = $NICKNAME;
    var headimgurl = $HEADIMGURL;
    if(payfor == 'pay for weichat'){
        app.p2.callpay();
    }else {
        $.post("db/adduser.php", {name: name,email: email,phone: phone,whoyouare: whoyouare,lookingforshmadness: lookingforshmadness,openid:openid,nickname:nickname,headimgurl:headimgurl},function(r){
            if(r.code == "0" || r.code == "1"){
                app.p2.post_addusernum();
            }else{
                showMask('Please try again.');
            }
        },'json');
    }
});

app.p2.post_addusernum = function () {
    success = true;
    var numbers=2;
    var openid = $OPENID;
    $.post("db/addusernum.php", {openid: openid,numbers: numbers,outtradeno:'',paystatus:3},function(r){
        if(r.code == 0){
            $('.e3-1').css("border-color","#c8225e");
            app.template.swiper.to(2);
        }else{
            alert('Please try again.');
        }
    },'json');
};

var success = false;
app.p2.bind_touch_event = function(){
    // 解决点击证件类型光标闪跳问题
    $(".e2-6").on("focus", function(){
        app.p2.disabled_alltextinput();
    });

    $(".e2-6").on("blur change", function(){
        app.p2.enabled_alltextinput();
    });

    $(".e2-7").on("focus", function(){
        app.p2.disabled_alltextinput();
    });

    $(".e2-7").on("blur change", function(){
        app.p2.enabled_alltextinput();
    });   
};

//点击下拉框后禁用所有文本框
app.p2.disabled_alltextinput = function(){
    $(".e2-3").attr("disabled", "disabled");
    $(".e2-4").attr("disabled", "disabled");
    $(".e2-5").attr("disabled", "disabled");
};

app.p2.enabled_alltextinput = function(){
    $(".e2-3").removeAttr("disabled");
    $(".e2-4").removeAttr("disabled");
    $(".e2-5").removeAttr("disabled");
};

app.p2.callpay = function(){
    if (typeof WeixinJSBridge == "undefined"){
        if( document.addEventListener ){
            document.addEventListener('WeixinJSBridgeReady', app.p2.jsapicall, false);
        }else if (document.attachEvent){
            document.attachEvent('WeixinJSBridgeReady', app.p2.jsapicall);
            document.attachEvent('onWeixinJSBridgeReady', app.p2.jsapicall);
        }
    }else{
        app.p2.jsapicall();
    }
};
app.p2.jsapicall = function(){
    WeixinJSBridge.invoke(
        'getBrandWCPayRequest', $JSAPIPARAMETERS, function(res){
            if(res.err_msg == "get_brand_wcpay_request:ok" )
            {
                $.post("../../db/finduser.php", {openid: $OPENID}, function(data){
                    if(data.code==0)
                    {
                        app.template.swiper.to(2);
                    }else{
                        alert("Payment Declined! Please contact us!");
                    }


                },'json');
            }else{
                alert("Payment Declined!");
            }
        }
    );
};

app.p2.destory = function(){};

/*-- p3
 ====================================================== */
app.p3 = function(){};
app.p3.init = function(){
    app.p3.show_qrcode();
};

app.p3.show_qrcode = function () {
    app.template.data.add("openid", $OPENID);
    var url = app.tools.getbaseurl() + "player2.php?id=" + $OPENID;
    $("#qrcode").html("");
    var qrcode = new QRCode("qrcode");
    qrcode.makeCode(url);
}

app.p3.bind_touch_event = function(){
}

/*-- for android
====================================================== */
var fuckandroid = {};
fuckandroid.app = function(){};
fuckandroid.app.p1 = function(){};
fuckandroid.app.p1.bind_touch_event = function(){
};

/*-- page init
====================================================== */
(function(){
    // 检测OS
    app.tools.platform.init();

    // 兼容android(如果开启android模式则重写响应函数用来)
    if(app.tools.platform.debug == "android"
     || app.tools.platform.os == "android")
    {
    }

    // 框架
    app.template.touch.init();
    app.template.loader.init();
    app.template.swiper.init();
    app.template.Landscape.init();

    /* loading */
    app.loading.init();
    
    /* page init */
    app.template.swiper.on_pageslideend = function(index){
        switch(index)
        {
            case 0:
                app.p1.init();
                break;
            case 1:
                app.p1.destory();
                app.p2.init();
                break;
            case 2:
                app.p2.destory();
                app.p3.init();
                break;
            // case 3:
            //     app.p3.destory();
            //     //app.p4.init();
            //     break;
            // case 4:
            //     app.p5.init();
            //     break;
        }
    };
     app.p1.bind_touch_event();
     app.p2.bind_touch_event();
     app.p3.bind_touch_event();
     //app.p4.bind_touch_event();
     app.debug.enable = false;
})();

