@extends('layouts.default')
@section('content')
    <h1>Búsqueda Cuponatic Test</h1>
    <p>Buscar por palabra clave</p>
	<form id="searchForm" method="post" class="form-horizontal" action="/api/productos/buscar">
		<input type="text" name="keyword">
		<button type="submit" class="search btn btn-primary">Buscar</button>
	</form>
	<div class="alerts">
	</div>

	<div class="results table-responsive" style="display: none;">
		<table class="table">
			<thead>
				<tr>
					<th>Imagen</th>
					<th>Título</th>
					<th>Precio</th>
					<th>Descripción</th>
					<th>Fecha Inicio</th>
					<th>Fecha Término</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
@endsection
@section('content_js')
	<script type="text/javascript">
		function jsonCallback(json){
			$('.results table tbody').html('')
		  	$('.results').show();
		  	if(Object.keys(json).length === 0) {
		  		$('.alerts').append('<div class="alert alert-danger" role="alert">No se encontraron resultados</div>');
		  	}else{
			  	$('.results thead').show();
			  	$.each(json, function(i, val) {
			  		$('.results table tbody').append('<tr>');
				  	$('.results table tbody tr:eq('+i+')').append('<td><img src="'+val.image+'" style="width: 100px;"></td>');
				  	$('.results table tbody tr:eq('+i+')').append('<td>'+val.title+'</td>');
				  	$('.results table tbody tr:eq('+i+')').append('<td>'+val.price+'</td>');
				  	$('.results table tbody tr:eq('+i+')').append('<td>'+val.description+'</td>');
				  	$('.results table tbody tr:eq('+i+')').append('<td>'+val.start_date+'</td>');
				  	$('.results table tbody tr:eq('+i+')').append('<td>'+val.end_date+'</td>');
			  		$('.results table tbody').append('</tr>');
				});
		  	}
		}

		function clearResults(){
			$('.alerts').html('');
			$('.results thead').hide();
			$('.results tbody').html('');
		}
		$(document.body).on('click', '.search', function(e){
			e.preventDefault();
			clearResults();
			$.ajax({
			  	url: $('#searchForm').attr('action'),
			  	type: "post",
			  	data: $('#searchForm').serialize(),
			  	beforeSend: function(){
			  		$('.search').attr('disabled', 'disabled');
			  	}
			})
			.fail(function (jqXHR, textStatus, error) {
				$('.search').removeAttr('disabled');
				$('.alerts').html('<div class="alert alert-danger" role="alert">'+$.parseJSON(jqXHR.responseText).error+'</div>');
			})
			.done(function(json){
				$('.search').removeAttr('disabled');
				jsonCallback(json.data);
			});
		})
	</script>
@endsection