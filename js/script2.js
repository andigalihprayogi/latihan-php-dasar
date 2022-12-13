$(document).ready(function() {
	// var keyword = document.getElementById('keyword');
	// keyword.addEventListener('keyup', function(){
	// 	console.log('oy bener');
	// });


	$('#tombol-cari').hide();

	// munculkan icon loader
	
	//ajacx manggunakan load
	// $('#keyword').on('keyup', function(){
	// 	$('#container').load('ajax/mahasiswa.php?keyword=' + $('#keyword').val());
	// });


	//$.get
	$('#keyword').on('keyup', function(){
			$('.loader').show();

			$.get('ajax/mahasiswa.php?keyword=' + $('#keyword').val(), function(data){
			$('#container').html(data);
			$('.loader').hide();
		})

	});
	
});

