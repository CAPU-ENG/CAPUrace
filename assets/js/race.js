$(document).ready(function() {
	$('.processorBox li').click(function(){
		var i = $(this).index();
		var j=i+1;
		setTimeout(function() {
			window.parent.setSize($('#step'+j).height()+400);
		}, 300);
		$('.processorBox li').removeClass('current').eq(i).addClass('current');
		$('.step').fadeOut(300).eq(i).fadeIn(500);
	});
	$('#nextBtn1').click(function(){
		setTimeout(function() {
			window.parent.setSize($('#step2').height()+400);
		}, 300);
		$('.processorBox li').removeClass('current').eq(1).addClass('current');
		$('.step').fadeOut(300).eq(1).fadeIn(500);
	});
	$('#nextBtn2').click(function(){
		setTimeout(function() {
			window.parent.setSize($('#step3').height()+400);
		}, 300);
		$('.processorBox li').removeClass('current').eq(2).addClass('current');
		$('.step').fadeOut(300).eq(2).fadeIn(500);
	});
});

/*
 * This function adds a new person form.
 */
function addIndividual() {
    newperson = $(".individual-form:first").clone(true);
    $(".reg").append(newperson);
    window.parent.setSize($('.mycontainer').height()+600);
}

/* End of file race.js */
/* Location: ./assets/js/race.js */
