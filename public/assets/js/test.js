$(function(){

	
	var btn = "#cmd";

	var i = document.getElementById('cmd');

	$(btn).click(function(){
		$(this).addClass('on');
	},function(){
		$(this).stop();
	});
	i.innerHTML = 'おはようこんくりくふと';

});