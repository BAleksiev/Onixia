window.onload = function() {
    serverTime();
    headerLine();
}

function mission(totShips) {
    for(i=0; i<totShips; i++) {
        var inputs = $('input.'+i).val();
        if(inputs > 0)
            var changed = true;
    }
    var option = $('select.mission option:selected').val();
    if(changed == true)
        if(option != '')
            $('.missionFeatures').show(200);
    if(option == '')
        $('.missionFeatures').hide(200);
}

function setMaximum(type,number) {
    if($('input.'+type).val() == 0) {
        $('input.'+type).val(number);
    } else {
        $('input.'+type).val(0);
    }
}

function headerLine() {
    $(window).scroll(function() {
        if($(window).scrollTop() >= 100)
            $('#res-title').fadeIn(0);
        else
            $('#res-title').fadeOut(0);
    });
}


function timer() {
    v = new Date();
    var time=document.getElementById('time');
    n = new Date();
    ss = pp;
    s = ss-Math.round((n.getTime()-v.getTime())/1000.);
    m = 0;
    h = 0;
    if(s <= 0)
        window.location.reload();
    
    if(s > 59) {
        m = Math.floor(s/60);
        s = s-m*60
    }
    if(m > 59) {
        h = Math.floor(m/60);
        m = m-h*60
    }
    if(s < 10)
        s = "0"+s
    if(m < 10)
        m = "0"+m

    time.innerHTML=h+":"+m+":"+s
    
    pp = pp-1;
    window.setTimeout("timer();",999);
}

function serverTime() {
    var today=new Date();
    var h=today.getHours();
    var m=today.getMinutes();
    var s=today.getSeconds();
    
    h=checkTime(h);
    m=checkTime(m);
    s=checkTime(s);
    
    document.getElementById('serverTime').innerHTML=h+":"+m+":"+s;
    document.getElementById('servertime').innerHTML=h+":"+m+":"+s;
    setTimeout('serverTime()',500);
}

function checkTime(i) {
    if(i < 10)
        i = "0" + i;
    
    return i;
}

function show_confirm(msg,path) {
    var r = confirm(msg);
    if(r == true) {
        window.location = path;
    }
}

function saveCoordinates(c1,c2,c3) {
    document.cookie = 'c1' + '=' + c1;
    document.cookie = 'c2' + '=' + c2;
    document.cookie = 'c3' + '=' + c3;
    window.location = 'fleets.php';
}

function setCookie(name,val) {
    document.cookie = name + '=' + val;
}

function deleteCookie(name) {
    document.cookie = name + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';
}