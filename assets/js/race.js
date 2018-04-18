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
    var order = getOrder(item);
    data.splice(order, 1);
    localStorage.setItem('individual', JSON.stringify(data));
    reloadIndividual();
    refreshOrder();
}

/*
 * This function gets the order of an individual.
 */
function getOrder(item) {
    return item.closest(".ind-item").find(".order").text() - 1;
}

/*
 * This function add a new team form.
 */
function addTeam() {
    elem = $(".team-form:first").clone(true).removeClass("hidden");
    elem.find(".order").text($(".team-form").find(".team-item").length);
    $(".reg").append(elem);
}

/*
 * This function removes an existing team item.
 */
function removeTeam(item) {
    item.closest(".team-item").remove();
    cacheTeam();
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
        }
    })

}

/*
 * This function is called when clicking 'save'.
 * It will store the individual information into cookie.
 */
function cacheIndividual(order) {
    if (order == "") {
        order = data.length;
    }
    var name = $("[name='name']").val();
    var gender = $("[name='gender']").val();
    var tel = $("[name='tel']").val();
    var ifrace = $("[name='ifrace']").val();
    var islam = $("[name='islam']").prop('checked');
    var id_type = $("[name='id_type']").val();
    var id_number = $("[name='id_number']").val();
    var dinner = $("[name='dinner']").prop('checked');
    var lunch = $("[name='lunch']").prop('checked');
    var race = $("[name='race']").prop('checked')*(gender == 1);
    var race_elite = $("[name='race_elite']").prop('checked')*(gender == 1);
    var race_f = $("[name='race']").prop('checked')*(gender == 2);
    var ifteam = $("[name='ifteam']").prop('checked');
    var rdb = $("[name='roadbike']").prop('checked')*(gender == 1);
    var rdb_elite = $("[name='roadbike_elite']").prop('checked')*(gender == 1);
    var rdb_f = $("[name='roadbike']").prop('checked')*(gender == 2);
    data[order] = {
        order: order,
        name: $.trim(name),
        gender: gender,
        id_type: id_type,
        id_number: $.trim(id_number),
        dinner: dinner,
        lunch: lunch,
        tel: $.trim(tel),
        ifrace: ifrace,
        ifteam: ifteam,
        rdb: rdb,
        rdb_elite: rdb_elite,
        rdb_f: rdb_f,
        race: race,
        race_elite: race_elite,
        race_f: race_f,
        islam: islam
    };
    localStorage.setItem('individual', JSON.stringify(data));
    reloadIndividual();
    refreshOrder();
    resetIndividual();
}

/*
 * This function fills a single row of ind-list.
 */
function fillIndividual(item) {
    elem = $(".ind-item:first").clone(true).removeClass("hidden");
    elem.find(".name").text(item.name);
    elem.find(".gender").text(GENDER[item.gender]);
    elem.find(".id_type").text(ID_TYPE[item.id_type]);
    elem.find(".id_number").text(item.id_number);
    elem.find(".dinner").text(JUDGE[+item.dinner]);
    elem.find(".lunch").text(JUDGE[+item.lunch]);
    elem.find(".tel").text(item.tel);
    if (item.race != 0) {
        elem.find(".race").text('山地男子大众组');
    }
    if (item.race_elite != 0) {
        elem.find(".race").text('山地男子精英组');
    }
    if (item.race_f != 0) {
        elem.find(".race").text('山地女子组');
    }
    if (item.ifteam != 0) {
        elem.find(".race").append(' 团体赛 ');
    }
    if (item.rdb != 0) {
        elem.find(".race").append(' 公路男子大众组');
    }
    if (item.rdb_elite != 0) {
        elem.find(".race").append(' 公路男子精英组');
    }
    if (item.rdb_f != 0) {
        elem.find(".race").append(' 公路女子组');
    }
    if (item.race == 0 && item.race_elite == 0 && item.race_f == 0 && item.rdb == 0 && item.rdb_elite == 0 && item.rdb_f == 0 && item.ifteam == 0) {
        elem.find(".race").append(' 不参加 ');
    }
    elem.find(".islam").text(JUDGE[+item.islam]);
    $(".ind-list").append(elem);
}

/*
 * This function reloads the data in the cookie.
 */
function reloadIndividual() {
    $(".ind-item:not(:hidden)").remove();
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
    form.find("[name='order']").val(order);
    form.find("[name='name']").val(item.name);
    form.find("[name='tel']").val(item.tel);
    form.find("[name='id_type']").val(item.id_type);
    form.find("[name='id_number']").val(item.id_number);
    form.find("[name='gender']").val(item.gender);
    if ( item.gender == 1){
        form.find("[name='race']").prop('checked', item.race == 1);
        form.find("[name='race_elite']").prop('checked', item.race_elite == 1);
        form.find("[name='roadbike']").prop('checked', item.rdb == 1);
        form.find("[name='roadbike_elite']").prop('checked', item.rdb_elite == 1);
    }
    if ( item.gender == 2){
        form.find("[name='race']").prop('checked', item.race_f == 1);
        form.find("[name='roadbike']").prop('checked', item.rdb_f == 1);
    }
    form.find("[name='ifrace']").val(item.ifrace);
    form.find("[name='islam']").prop('checked',item.islam == 1);
    form.find("[name='ifteam']").prop('checked', item.ifteam == 1);
    form.find("[name='dinner']").prop('checked', item.dinner == 1);
    form.find("[name='lunch']").prop('checked', item.lunch == 1);
    restrictIndividual();
}

/*
 * Add restrictions to the individual form.
 */
function restrictIndividual() {
    var lunch = $("[name='lunch']");
    var team = $("[name='ifteam']");
    var race = $("[name='race']");
    var race_elite = $("[name='race_elite']");
    var rdb = $("[name='roadbike']");
    var rdb_elite = $("[name='roadbike_elite']");
    var ifrace = ($("[name='ifrace']").val() == '1');
    var ismale = ($("[name='gender']").val() == '1');
    var race_s = race.prop('checked');
    var race_elite_s = race_elite.prop('checked');
    var rdb_s = rdb.prop('checked');
    var rdb_elite_s = rdb_elite.prop('checked');
    /*
     * If an individual attends the race, lunch must be checked.
     * Otherwise the race options are disabled.
     */
    if (ifrace) {
        lunch.prop('checked', true);
        lunch.prop('disabled', true);
        race.prop('disabled', false);
        team.prop('disabled', false);
        rdb.prop('disabled', false);
    } else {
        lunch.prop('disabled', false);
        race.prop('disabled', true);
        race.prop('checked', false);
        race_elite.prop('disabled', true);
        race_elite.prop('checked', false);
        team.prop('checked', false);
        team.prop('disabled', true);
        rdb.prop('disabled', true);
        rdb.prop('checked', false);
        rdb_elite.prop('disabled', true);
        rdb_elite.prop('checked', false);
        return;
    }
    if (ismale && ifrace) {
        race_elite.prop('disabled',false);
        rdb_elite.prop('disabled',false);
    } else {
        race_elite.prop('checked',false);
        rdb_elite.prop('checked',false);
        race_elite.prop('disabled',true);
        rdb_elite.prop('disabled',true);
    }
    if (race_s && ismale) {
        race_elite.prop('checked',false);
    }
    if (race_elite_s && ismale) {
        race.prop('checked',false);
    }
    if (rdb_s && ismale) {
        rdb_elite.prop('checked',false);
    }
    if (rdb_elite_s && ismale) {
        rdb.prop('checked',false);
    }
    if (!ismale) {
      race_elite.prop('disabled',true);
      rdb_elite.prop('disabled',true);
    }
    var ifteam = team.prop('checked');
    var indrace = (race.val() != '0');
}

/*
 * This function is called when 'edit' button is clicked.
 * It fills the form with existing data for editing.
 */
function editIndividual(item) {
    order = getOrder(item);
    fetchIndividual(order);
    $(".reg").find("[name='name']").focus();
}

/*
 * This function resets the individual form.
 */
function resetIndividual() {
    var form = $(".reg");
    form.find("[name='order']").val("");
    form.find("[name='name']").val("");
    form.find("[name='tel']").val("");
    form.find("[name='id_type']").val("identity");
    form.find("[name='id_number']").val("");
    form.find("[name='gender']").val("1");
    form.find("[name='race']").prop('checked', false);
    form.find("[name='race_elite']").prop('checked', false);
    form.find("[name='ifrace']").val("0");
    form.find("[name='islam']").prop('checked', false);
    form.find("[name='ifteam']").prop('checked', false);
    form.find("[name='dinner']").prop('checked', false);
    form.find("[name='lunch']").prop('checked', false);
    form.find("[name='lunch']").prop('disabled', false);
    form.find("[name='roadbike']").prop('checked', false);
    form.find("[name='roadbike']").prop('disabled', true);
    form.find("[name='roadbike_elite']").prop('checked', false);
    form.find("[name='roadbike_elite']").prop('disabled', true);
    form.find("[name='race']").prop('disabled', true);
    form.find("[name='race_elite']").prop('disabled', true);
    form.find("[name='ifteam']").prop('disabled', true);
}

/*
 * This function post the individual data to the controller.
 */
function postIndividual() {
    var item = {
        data: data
    };
    $.each(item.data, function(order, ind) {
        ind.rdb = +ind.rdb;
        ind.ifteam = +ind.ifteam;
        ind.dinner = +ind.dinner;
        ind.lunch = +ind.lunch;
        ind.islam = +ind.islam;
    });
    $.post(controller, item, function(response) {
        if (response.code != "200") {
            alert(response.msg);
        } else {
            window.location.assign(directto);
        }
    }, "json");
}
function postForQuotaVerification() {
    $.post(controller, function(response) {
        if (response.code != "200") {
            alert(response.msg);
            window.location.assign(directtoregistration);
        } else {
            window.location.assign(directtofreeze);
        }
    }, "json");

}
/*
 * This function fills the team form using the data from the database.
 */
function reloadTeam() {
    $(".team-form:not(:hidden)").remove();
    $.each(data, function(order, item) {
        addTeam();
        elem = $(".team-item:last");
        elem.find(".order").text(item.order);
        elem.find("[name='first']").val(item.first);
        elem.find("[name='second']").val(item.second);
        elem.find("[name='third']").val(item.third);
        elem.find("[name='fourth']").val(item.fourth);
    });
    refreshOrder();
}

/*
 * This function is called when clicking 'save' in team form.
 * It restores the team info into localStorage.
 */
function cacheTeam() {
    data = [];
    $(".team-form:not(:hidden)").find(".team-item").each(function() {
        var order = $(".order", this).text();
        var first = $("select[name='first']", this).val();
        var second = $("select[name='second']", this).val();
        var third = $("select[name='third']", this).val();
        var fourth = $("select[name='fourth']", this).val();
        data[order - 1] = {
            order: order,
            first: first,
            second: second,
            third: third,
            fourth: fourth
        };
    });
    localStorage.setItem('team', JSON.stringify(data));
}

/*
 * This function is called when clicking 'submit' in the form.
 * It post the data to the controller.
 */
function postTeam() {
    cacheTeam();
    var individual = JSON.parse(localStorage.getItem('individual'));
    var team = JSON.parse(localStorage.getItem('team'));
    var count = 0;
    $.each(individual, function (i, item) {
        if (item['ifteam'] != "0")
            count++;
    });
    if (count % 4 || count / 4 != team.length) {
        alert('报名团体赛人数与实际参与人数不匹配！');
        return;
    }
    var item = {
        data: data
    };
    $.post(controller, item, function(response) {
        if (response.code != "200") {
            alert(response.msg);
        } else {
            window.location.assign(directto);
        }
    })
}

/*
 * This function is called when a navigation button is clicked.
 * It will highlight current tab.
 */

function addActive(curTab) {
    $('#nav1').removeClass("active");
    $('#nav2').removeClass("active");
    $('#nav3').removeClass("active");
    curTab.addClass("active");
}


/* End of file race.js */
/* Location: ./assets/js/race.js */
