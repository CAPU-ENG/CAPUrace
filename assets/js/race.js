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
<<<<<<< HEAD
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
        if (data.code != "200") {
            window.location.assign(registration);
        } else {
            alert(data.msg);
        }
    });
}

/* End of file race.js */
/* Location: ./assets/js/race.js */
