/*
 * This function refresh the order value.
 */
function refreshOrder() {
    $(".order").each(function(idx) {
        $(this).text(idx);
    });
}

/*
 * This function adds a new person form.
 */
function addIndividual() {
    elem = $(".individual-form:first").clone(true).removeClass("hidden");
    elem.find(".order").text($(".individual-form").length);
    $(".reg").append(elem);
}

/*
 * This function removes an existing person item.
 */
function removeIndividual(item) {
    item.closest(".individual-form").remove();
    if ($(".individual-form").length == 1) {
        addIndividual();
    }
    refreshOrder();
}

/*
 * This function add a new team form.
 */
function addTeam() {
    elem = $(".team-form:first").clone(true).removeClass("hidden");
    elem.find(".order").text($(".team-form").length);
    $(".reg").append(elem);
}

/*
 * This function removes an existing team item.
 */
function removeTeam(item) {
    item.closest(".team-form").remove();
    if ($(".team-form").length == 1) {
        addTeam();
    }
    refreshOrder();
}

/*
 * This function post the login information from
 * the web to the controller.
 */
function postLogin() {
    var mail = $("#mail").val();
    var password = $("#password").val();
    if (mail == "") {
        alert('用户名不能为空！');
        $("#mail").focus();
        return;
    }
    if (password == "") {
        alert('密码不能为空！');
        $("#password").focus();
        return;
    }
    var pass = $.md5(password);
    var data = {
        mail: mail,
        password: pass
    };
    $.post(controller, data, function(data) {
        if (data.code == "200") {
            window.location.assign(directto);
        } else {
            alert(data.msg);
        }
    });
}

/*
 * This function posts the signup information to
 * the signup controller.
 */
function postSignup() {
    var school = $("#school").val();
    var assoc = $("#assoc").val();
    var province = $("#province").val();
    var address = $("#add").val();
    var zipcode = $("#zip").val();
    var leader = $("#leader").val();
    var tel = $("#tel").val();
    var mail = $("#mail").val();
    var password = $.md5($("#password").val());
    var passconf = $.md5($("#passconf").val());

    //The following part of code is for front-end validation.

    if (school == "") {
        alert("学校名不能为空！");
        $("#school").focus();
        return;
    }
    if (assoc == "") {
        alert("协会名不能为空！");
        $("#assoc").focus();
        return;
    }
    if (address == "") {
        alert("邮寄地址不能为空！")
        $("#add").focus();
    }
    if (zipcode == "") {
        alert("邮政编码不能为空！")
        $("#zip").focus();
    }
    if (zipcode.length != 6) {
        alert("邮政编码位数不正确！")
        $("#zip").focus();
        return;
    }
    if (leader == "") {
        alert("领队名不能为空！");
        $("#leader").focus();
        return;
    }
    if (tel == "") {
        alert("领队电话不能为空！");
        $("#tel").focus();
        return;
    }
    if (tel.length != 11) {
        alert("领队电话输入有误，请检查后重新输入！")
        $("#tel").focus();
        return;
    }
    if (mail == "") {
        alert("邮箱不能为空！");
        $("#mail").focus();
        return;
    }
    if (password == "") {
        alert("密码不能为空！");
        $("#password").focus();
        return;
    }
    if (passconf == "") {
        alert("请确认您的密码！");
        $("#passconf").focus();
        return;
    }
    if (passconf != password) {
        alert("两次输入的密码不同，请重新确认！");
        $("#passconf").focus();
        return;
    }

    //Organize the data and post to the controller.
    var data = {
        school: school,
        association_name: assoc,
        province: province,
        address: address,
        zipcode: zipcode,
        leader: leader,
        tel: tel,
        mail: mail,
        password: password,
        passconf: passconf
    };
    $.post(controller, data, function(data) {
        if (data.code == "200") {
            alert("注册成功！请登录您的邮箱查看激活邮件！");
            window.location.assign(directto);
        } else {
            alert(data.msg);
            window.location.reload();
        }
    })

}

/*
 * This function is called when clicking 'save'.
 * It will store the individual information into cookie.
 */
function cacheIndividual() {
    var data =[];
    $(".individual-form[class!='individual-form hidden']").each(function() {
        var name = $("input[name='name']", this).val();
        var gender = $("select[name='gender']", this).val();
        var id_card = $("input[name='id_card']", this).val();
        var race = $("select[name='race']", this).val();
        var accommodation = $("input[name='accommodation']", this).val();
        var meal = $("input[name='meal']", this).val();
        var tel = $("input[name='tel']", this).val();
        data[data.length] = {
            name: name,
            gender: gender,
            id_card: id_card,
            race: race,
            tel: tel,
            accommodation: accommodation,
            meal: meal
        };
    });
    $.cookie.json = true;
    $.cookie('individual', data, {path: '/'});
    alert("保存成功！");
}

/*
 * This function is called when clicking 'save' in team form.
 * It restores the team info into cookie.
 */
function cacheTeam() {
    var data = [];
    $(".team-form[class!='team-form hidden']").each(function() {
        var first = $("select[name='first']", this).val();
        var second = $("select[name='second']", this).val();
        var third = $("select[name='third']", this).val();
        data[data.length] = {
            first: first,
            second: second,
            third: third
        };
        $.cookie.json = true;
        $.cookie('team', data, {path: '/'});
        alert("保存成功！");
    });
}

/* End of file race.js */
/* Location: ./assets/js/race.js */
