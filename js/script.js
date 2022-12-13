$(document).ready(function() {
	// $('#keyword').on('keyup', function(){
	// 	$('container').load('ajax/mahasiswa.php?keyword=' + $('#keyword').val());
	// });

	var keyword = document.getElementById('keyword');
	keyword.addEventListener('keyup', function(){
		console.log('oy bener');
	});
});