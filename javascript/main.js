function getFaves(){
	$.ajax({
		url: 'ajax/getData.php',
		type: 'POST',
		data: {data_class: 'Favourite', data_method: 'getFavourites'},
		dataType: 'json',
		success: function(response){
			$('#fave-list').html(response.content);
		}
	});
}

function changeMainWeather(id){
	$.ajax({
		url: 'helpers/getWeather.php',
		type: 'POST',
		data: {woeId: id},
		dataType: 'json',
		success: function(response){
			$('#weather-container').html(response.content);
		}
	});
}


$(document).ready(function(){
	getFaves();

	$('#location').change(function(){
		var id = $(this).val();
		changeMainWeather(id);
	});
	
	$(document).on('click', '.favourite-location', function(){
		var id = $(this).attr('woeid');
		changeMainWeather(id);
		$('#location').val(id);
	});
	
	$('#addFavourite').click(function(){
		var id = $('#location').val();
		var location = $('#location option:selected').text();
		$.ajax({
			url: 'ajax/crud.php',
			type: 'POST',
			data: {woeId: id, location: location, type: 'add', data_class: 'Favourite'},
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
	
	$(document).on('click', '.delFavourite', function(){
		var id = $(this).attr('woeid');
		$.ajax({
			url: 'ajax/crud.php',
			type: 'POST',
			data: {woeId: id, type: 'del', data_class: 'Favourite'},
			dataType: 'json',
			success: function(response){
				if(response.success){
					getFaves();
				}
			}
		});
	});
});