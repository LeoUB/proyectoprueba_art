<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Agregar Articulo</title>
	<style type="text/css">
		background{
			color: orange;
		}
	</style>
</head>
<body>
	<header></header>

	<div class="main">

		<form method="POST" action="{{url('usuario/cargar_articulo')}}" enctype = "multipart/form-data">
			<div class="estado">
				@if($estado == '1')
					<h4>Correcto!</h4>
				@elseif($estado == '0')
					<h4>Incorrecto!</h4>
				@else
					<h4></h4>
				@endif
			</div>

			{{ csrf_field() }}
			<label>Nuevo Articulo</label><br><br>
			
			<div class="botones">
				<button type="submit">Agregar</button>
				<input type="button" name="canelar" value="Cancelar"><br><br><br>
			</div>



			<div class="imagen">
				<img src="/images/{{ $fotoart }}" value="fotoart" alt="Foto del Usuario" title="Usuario" width="200" ><br>
				<input type="file" name="image" accept="image/*"><br><br>
			</div>



			<div class="datos">
				<label for="nombre">Nombre del Articulo:</label>
				<input type="text" name = "name" placeholder="Nombre"/><br><br>
				

				<label >Categoria:</label>
				<select name="categorias" id="input_categorias_id">
					<option value=" ">--Elija una Categoria--</option>
					@foreach ($categorias as $categoria)
						<option value="{{$categoria->IdCategoria}}">{{$categoria->Nombre}}</option>
						
					@endforeach

				</select><br><br>

				<label for="desc">Descripcion:</label><br>
				<textarea name="desc" placeholder="Escriba Aqui"></textarea><br><br>
			</div>
		</form><br><br><br>
	</div>
	


	<footer></footer>
	

</body>
</html>