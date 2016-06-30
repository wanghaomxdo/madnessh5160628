/**
 * Created by Administrator on 2016/5/8.
 */
function addadmin() {
    var openid = $OPENID;
    var nickname = $NICKNAME;
    var headimgurl = $HEADIMGURL;
    $.post("db/addadmin.php", {openid:openid,nickname:nickname,headimgurl:headimgurl},function(r){
        if(r.code == "0"){
            alert("添加成功！");
        }else if (r.code == "1"){
            alert("管理员已添加！");
        }else{
            alert("添加失败，返回值："+r.code);
        }
    },'json');
}

function findId() {
    var openid = $ID;
    $.post("db/verification.php", {openid:openid},function(r){
        if(r.code == "0"){
            alert("核销成功！");
            document.getElementById('ver').innerHTML="已核销";
        }else{
            alert("核销失败，返回值："+r.code);
        }
    },'json');
}