{{--hereda la estructura del Layout--}}
@extends ('layout')
{{-- sobreescribe el titulo --}}
@section ('title') Nueva Orden/New order @stop
{{--declara la seccion de contenido principal--}}
@section ('content')

<h1>Nueva Orden/New order</h1>
<br>
{{--construye un formulario entre los helpers de laravel form::open y form::close--}}
{{--envia la informacion a la ruta specificada por medio del metodo post(informacion oculta)--}}
{{Form::open(array('route' => 'admin.orders.store', 'method' => 'POST', 'role' => 'form'))}}

{{--evaluamos si existe algún error al ingresar la informacion y lo mostramos en pantalla --}}
@include('errors', array('errors' => $errors))
{{Form::text('customerId', $customer)}}
	<div class="row">
		<div class="form-group col-md-4">
			{{Form::label('numero', 'Numero de orden')}}
			{{Form::text('numero', null, array('placeholder' => 'Order number', 'class' => 'form-control'))}}
		</div>
		<div class="form-group col-md-4">
			{{Form::label('deliveryDate', 'Fecha de entrega/Delivery Date')}}
			<input class = "form-control" name="deliveryDate" type="date" id="deliveryDate" >
			
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-4">
			{{Form::label('proveedor', 'Proveedor')}}
			{{Form::text('proveedor', null, array('placeholder' => 'Supplier', 'class' => 'form-control'))}}
		</div>
		<div class="form-group col-md-4">
			{{Form::label('status', 'Estado/Status')}}
			<select class="form-control" id="status" name="status"><option value="produccion">Producci&oacute;n</option><option value="stock">Stock</option><!--option value="control de calidad">QC</option><option value="empaque">Empaque</option><option value="almacenado">Almacenado</option><option value="5">Despachado</option--></select>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-8">
			{{Form::label('descripcion', 'Observaciones')}}
			{{Form::text('descripcion', null, array('placeholder' => 'Remarks', 'class' => 'form-control'))}}
		</div>
	</div>
	<br>
	{{Form::button('Adicionar Producto / Add Product', array('type' => 'submit', 'class' => 'btn btn-primary', 'name' => 'add', 'value' => 'Adicionar'))}}
	<!--a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product / Adicionar producto</a>
	<a href="{{action('Admin_ProductsController@addProducto')}}" class="btn btn-primary">ensayar arreglo</a-->
	<!--br>
	{{Form::text('customerId', Session::get('idcustomer'));}}
	<br>
	<table class="table table-stirped" style="width: 900px">
		<tr>
			<th>Producto</th>
			<th>Item</th>
			<th>Cantidad</th>
			<th>ValorUnit</th>
			<th>ValorTotal</th>
			<th>Acciones</th>
			
		</tr>
		
	</table>
	{{Form::button('Save / Guardar', array('type' => 'submit', 'class' => 'btn btn-primary', 'name' => 'save', 'value' => 'Guardar'))}}

	{{Form::close()}}-->

@stop