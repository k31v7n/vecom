<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedor_model extends CI_Model {

	private $proveedor = null;
	private $mensaje   = "";

	public function __construct()
	{
		parent::__construct();
		$this->datoi=array();
		
		if (isset($_SESSION['EmpresaID'])){
			$this->usuario = $_SESSION['UserID'];
			$this->empresa = $_SESSION['EmpresaID'];
		}
	}

	public function set_proveedor($proveedor="")
	{
		$this->proveedor = $this->db->where("proveedor", $proveedor)
									->get("proveedor")
									->row();
	}

	public function get_proveedor()
	{
		return $this->proveedor;
	}

	private function set_mensaje($valor="")
	{
		$this->mensaje = $valor;
	}

	public function get_mensaje()
	{
		return $this->mensaje;
	}

	private function set_dato_insert($indice='', $valor='')
	{
		$this->datoi[$indice] = $valor;
	}

	private function limpiart_dato_insert()
	{
		$this->datoi = array();
	}

	public function get_proveedores($args=array())
	{
		return $this->db->select("
							a.*,
							b.nombre as nombre_tipo,
							c.nombre as nombre_clasificacion
							")
						->from("proveedor a")
						->join("proveedor_tipo b", "b.proveedor_tipo = a.proveedor_tipo", "left")
						->join("proveedor_clasificacion c", "c.proveedor_clasificacion = a.proveedor_clasificacion", "left")
						->where("activo", "1")
						->order_by("a.nombre", "asc")
		   				->get()
						->result();
	}

	public function get_tipo_pago()
	{
		return $this->db->get("tipo_pago")->result();
	}

	public function guardar_proveedor($args=array())
	{
		$this->limpiart_dato_insert();

		if (elemento($args, "nit")) {
			$this->set_dato_insert("nit", $args["nit"]);
		}

	    if (elemento($args, "nombre")) {
	    	$this->set_dato_insert("nombre", $args["nombre"]);
	    }

	    if (elemento($args, "razon_social")) {
	    	$this->set_dato_insert("razon_social", $args["razon_social"]);
	    }

	    if (elemento($args, "direccion")) {
	    	$this->set_dato_insert("direccion", $args["direccion"]);
	    }

	    if (elemento($args, "telefono")) {
	    	$this->set_dato_insert("telefono", $args["telefono"]);
	    }

	    if (elemento($args, "contacto")) {
	    	$this->set_dato_insert("contacto", $args["contacto"]);
	    }

	    if (elemento($args, "credito_contado")) {
	    	$this->set_dato_insert("credito_contado", $args["credito_contado"]);
	    }

	    if (elemento($args, "dias_credito")) {
	    	$this->set_dato_insert("dias_credito", $args["dias_credito"]);
	    }

	    if (elemento($args, "proveedor_tipo")) {
	    	$this->set_dato_insert("proveedor_tipo", $args["proveedor_tipo"]);
	    }

	    if (elemento($args, "proveedor_clasificacion")) {
	    	$this->set_dato_insert("proveedor_clasificacion", $args["proveedor_clasificacion"]);
	    }

	    if (isset($args["activo"])) {
	    	$this->set_dato_insert("activo", $args["activo"]);
	    }

		if (!$this->proveedor) {
	    	$this->set_dato_insert("usuario", $this->usuario);
	    	$this->set_dato_insert("empresa", $this->empresa);
		}
	    

	    if ($this->proveedor) {

	    	$this->db->where("proveedor", $this->proveedor->proveedor);
	    	if ($this->db->update("proveedor", $this->datoi)) {
	    		$id = $this->proveedor->proveedor;

	    		$this->set_proveedor($id);
	    		$this->set_mensaje("Se actualizó correctamente el proveedor.");
	    		return $id;

	    	}else{
	    		$this->set_mensaje("No se pudo actualizar el proveedor.");
	    	}
	    	
	    }else{

	    	if ($this->db->insert("proveedor", $this->datoi)) {
	    		$id = $this->db->insert_id();

	    		$this->set_proveedor($id);
	    		$this->set_mensaje("Se guardó correctamente el proveedor.");
	    		return $id;

	    	}else{
	    		$this->set_mensaje("No se pudo guardar el proveedor.");
	    	}

	    }
	    return false;
	}
}
?>