/*
 * This function adds a new person form.
 */
function addIndividual() {
    $(".reg").append($(".individual-form:first").clone(true).attr("class", "individual-form"));
    window.parent.setSize($('.mycontainer').height()+600);
}

/* End of file race.js */
/* Location: ./assets/js/race.js */
