<?php

class Admin_OrdersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$orders = Order::where('customerId', '=', Session::get('idcustomer'))->get(); //retorna un arreglo con todas las ordenes pertenecientes al cliente
		return View::make('admin/orders/orderlist')->with('orders', $orders);
		//return $orders;
	}

	public function actionMostrarLista($id)
	{
		//$customer = Customer::find($id);
		$orders = Order::where('customerId', '=', $id)->get();
		return View::make('admin/orders/orderlist')->with('orders', $orders);
		//$orders = Order::where('customerId', '=', '$customer->id');
	}

	public function actionAdministrarLista($id){
		//$customer = Customer::find($id);
		$orders = Order::where('customerId', '=', $id)->get();
		return View::make('admin/adminOrderList')->with('orders', $orders);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//return 'form para crear las ordenes';
		$id = Session::get('idcustomer');
		$customer = Customer::find($id);
		return View::make('admin/orders/new_order')->with('customer', $customer);
	}

	public function actionPackingList()
	{
		return View::make('admin/orders/new_pack');
	}


	/**
	 * Store a newly created resource in storage.{{  }}
	 *
	 * @return Response
	 */
	public function store()
	{
			//creamos un nuevo objeto para nuestro usuario
			$order = new Order;
			//obtenemos la data enviada por el usuario
			$dataOrder = Input::all();
			//revisamos si la data es valida
			if ($order->isValid($dataOrder)) {
				//si lo es se la asignamos a la orden
				$order->fill($dataOrder);
				// y guardamos la orden
				$order->save();
				//enviamos al formulario de producto con el array de datos de la orden
				$numero = Input::get('numero');
				return Redirect::route('admin.products.create', array('numero' => $numero));
			}else{
				//en caso de error regresa a la accion crear con los errores encontrados
				return Redirect::route('admin.orders.create')->withInput()->withErrors($order->errors);
			}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//se recupera el elemento que se desea mostrar con la funcion find por medio del parametro $id
		$order = Order::find($id);
		//se evalua si es nulo, lo que significa que no trajo ningun registro que corresponda a ese $id
		if (is_null($order)) {
			//en ese caso nos lleva a error 404
			App::abort(404);
		}
		//en caso que si exista, envia la información a la vista del detalle (customer)
		$products = Product::where('idOrder', '=', $order->numero)->paginate();
		return View::make('admin/orders/order', array('order'=>$order, 'products'=>$products));//)->with('order', $order);
		//return 'aqui mostramos la info de la orden';
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//return 'aqui editamos la orden';
		$order = Order::find($id);
		//revisamos si la orden existe
		if (is_null($order))
		{
			// en caso que no exista genera pagina de error
			App::abort(404);
		}
		//en caso que exista se empaqueta la ruta y el parametro ID
		$form_data = array('route' => array('admin.orders.update', $order->id), 'method' => 'PATCH');
		//se envia una variable para el manejo del nombre del formulario
		$action = 'Editar';
		//añadimos los productos pertenecientes a esta orden
		$productos = Product::where('idOrder', '=', $order->numero)->paginate();
		//retorna el formulario de editar con los parametros
		return View::make('admin/adminOrder', compact('order', 'productos', 'form_data'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		return 'aca almacena la orden actualizada';
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
