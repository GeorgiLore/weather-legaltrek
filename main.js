function getFaves(){
	$.ajax({
		url: 'favourites.php',
		type: 'POST',
		dataType: 'json',
		success: function(response){
			$('#fave-list').html(response.content);
		}
	});
}


$(document).ready(function(){
	getFaves();

	$('#location').change(function(){
		var id = $(this).val();
		$.ajax({
			url: 'getWeather.php',
			type: 'POST',
			data: {woeId: id},
			dataType: 'json',
			success: function(response){
				$('#weather-container').html(response.content);
			}
		});
	});
	
	$('#addFav').click(function(){
		var id = $('#location').val();
		var location = $('#location option:selected').text();
		$.ajax({
			url: 'addDelFave.php',
			type: 'POST',
			data: {woeId: id, location: location, type: 'add'},
			dataType: 'json',
			success: function(response){
				if(response.success){
					getFaves();
				} else if(response.exists){
					alert('Location already added to favourites!');
				}
			}
		});
	});
	
	$(document).on('click', '.delFav', function(){
		var id = $(this).attr('woeid');
		$.ajax({
			url: 'addDelFave.php',
			type: 'POST',
			data: {woeId: id, type: 'del'},
			dataType: 'json',
			success: function(response){
				if(response.success){
					getFaves();
				}
			}
		});
	});
});