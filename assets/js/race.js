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

/* End of file race.js */
/* Location: ./assets/js/race.js */
