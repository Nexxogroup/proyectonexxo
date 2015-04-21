<?php 

use Jenssegers\Mongodb\Model as Eloquent;

class Product extends Eloquent{

	/**
	*
	*@var string
	*/
	protected $collection = 'products';

	/**
	*
	*
	*@var array
	*/
	//propiedad para definir los errores
	public $errors;
	//indicamos los campos llenable en este modelo
	protected $fillable = array('idOrder', 'producto', 'item', 'cantidad', 'precio', 'color', 'talla', 'remarks', 'attachmentFile', 'totalproducto');
	//cuantos elementos por pagina
	protected $perPage = 10;

	public function isValid($data){
		$rules = array(
			'idOrder'			=> 'required',
			'producto' 			=> 'required',
			'item' 				=> 'required',
			'cantidad' 			=> 'required|numeric',
			'precio' 			=> 'required|numeric',
			'color' 			=> 'required',
			'talla' 			=> 'required',
			'attachmentFile' 	=> 'required');
		$validator = Validator::make($data, $rules);
		if ($validator->passes()) {
			return true;
		}
		$this->errors = $validator->errors();
		return false;
	}

	//declaramos la relacion con la colleccion forms
	public function order(){
		return $this->belongsTo('Order');
	}
	

}

 ?>