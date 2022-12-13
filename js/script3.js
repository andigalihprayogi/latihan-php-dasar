$(document).ready(function() {
	$('#keyword').on('keyup', function(){
		$('container').load('ajax/mahasiswa.php?keyword=' + $('#keyword').val());
	});

	

});
