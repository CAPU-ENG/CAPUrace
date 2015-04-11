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
function cacheIndividual(order) {
    var order = $("[name='order']").val();
    if (order == "") {
        order = data.length;
    }
    var name = $("[name='name']").val();
    var gender = $("[name='gender']").val();
    var tel = $("[name='tel']").val();
    var ifrace = $("[name='ifrace']").val();
    var islam = $("[name='islam']").val();
    var id_card = $("[name='id_card']").val();
    var accommodation = $("[name='accommodation']").val();
    var meal16 = $("[name='meal16']").prop('checked');
    var meal17 = $("[name='meal17']").prop('checked');
    var race = $("[name='race']").val();
    var ifteam = $("[name='ifteam']").prop('checked');
    var shimano16 = $("[name='shimano16']").val();
    var shimano17 = $("[name='shimano17']").val();
    var item = {
        order: order,
        name: name,
        gender: gender,
        id_card: id_card,
        accommodation: accommodation,
        meal16: meal16,
        meal17: meal17,
        tel: tel,
        ifrace: ifrace,
        ifteam: ifteam,
        race: race,
        islam: islam,
        shimano16: shimano16,
        shimano17: shimano17
    };
    data[order - 1] = item;
    $.cookie('individual', JSON.stringify(data));
    //$(".ind-item[class!=hidden]").remove();
    fillIndividual(item);
    refreshOrder();
}

/*
 * This function fills a single row of ind-list.
 */
function fillIndividual(item) {
    elem = $(".ind-item:first").clone(true).removeClass("hidden");
    elem.find(".name").text(item.name);
    elem.find(".gender").text(GENDER[item.gender]);
    elem.find(".id_card").text(item.id_card);
    elem.find(".accommodation").text(ACCOMMODATION[item.accommodation]);
    elem.find(".meal16").text(TF[item.meal16]);
    elem.find(".meal17").text(TF[item.meal17]);
    elem.find(".tel").text(item.tel);
    elem.find(".race").text(CAPURACE[item.race]);
    elem.find(".islam").text(JUDGE[item.islam]);
    elem.find(".shimano16").text(SHIMANO_RDB[item.shimano16]);
    elem.find(".shimano17").text(SHIMANO_MTB[item.shimano17]);
    $(".ind-list").append(elem);
}

/*
 * This function reloads the data in the cookie.
 */
function reloadIndividual() {
    $.each(data, function(order, item) {
        fillIndividual(item);
    })
}

/*
 * This function fetches a certain row of .ind-list and fill it into the form.
 */
function fetchIndividual(order) {
    var item = data[order];
    var form = $(".reg");
    form.find("[name='order']").val(item.order);
    form.find("[name='name']").val(item.name);
    form.find("[name='tel']").val(item.tel);
    form.find("[name='id_card']").val(item.id_card);
    form.find("[name='accommodation']").val(item.accommodation);
    form.find("[name='gender']").val(item.gender);
    form.find("[name='race']").val(item.race);
    form.find("[name='shimano16']").val(item.shimano16);
    form.find("[name='shimano17']").val(item.shimano17);
    form.find("[name='ifrace']").val(item.ifrace);
    form.find("[name='islam']").val(item.islam);
    form.find("[name='ifteam']").prop('checked', item.ifteam);
    form.find("[name='meal16']").prop('checked', item.meal16);
    form.find("[name='meal17']").prop('checked', item.meal17);
}

function editIndividual(item) {
    order = item.closest(".ind-item").find(".order").text() - 1;
    fetchIndividual(order);
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
    });
}

/* End of file race.js */
/* Location: ./assets/js/race.js */
