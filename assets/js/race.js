/*
 * This function adds a new person form.
 */
function addIndividual() {
    $(".reg").append($(".individual-form:first").clone(true).removeClass("hidden"));
}

/*
 * This function removes an existing person item.
 */
function removeIndividual(item) {
    item.closest(".individual-form").remove();
}

/*
<<<<<<< HEAD
 * This function add a new team form.
 */
function addTeam() {
    $(".reg").append($(".team-form:first").clone(true).removeClass("hidden"));
}

/*
 * This function removes an existing team item.
 */
function removeTeam(item) {
    item.closest(".team-form").remove();
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
    //var pass = hex_md5(password);
    var data = {
        mail: mail,
        password: password
    };
    $.post(controller, data);
}

/* End of file race.js */
/* Location: ./assets/js/race.js */
