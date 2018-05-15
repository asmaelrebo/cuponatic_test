@extends('layouts.default')
@section('content')
    <h1>Estadisticas Cuponatic Test</h1>
	<div class="panel panel-default">
		<div class="panel-heading">20 Productos más buscados</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>Título</th>
							<th>Búsquedas</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($most_searched AS $key => $value){ ?>
							<tr>
								<td><?=$value->title;?></td>
								<td><?php 
									if(!empty($value->search_statistics)) {
									$show = 0; 
										foreach ($value->search_statistics as $ss) {
											if($show<5){
												$show++;
												echo '<span class="label label-info">'.$ss->keyword.'</span> ';
											}
										}
									}
								?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<ul>
			
			</ul>
		</div>
	</div>
@endsection
