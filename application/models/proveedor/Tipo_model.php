<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipo_model extends CI_Model {

	private $tipo     = null;
	private $mensaje  = "";
	
	public function __construct()
	{
		parent::__construct();
		$this->datoi   = array();
		if (isset($_SESSION['EmpresaID'])){
			$this->usuario = $_SESSION['UserID'];
			$this->empresa = $_SESSION['EmpresaID'];
		}
	}

	public function set_tipo($proveedor_tipo='')
	{
		$this->tipo = $this->db->where("proveedor_tipo", $proveedor_tipo)
								  ->get("proveedor_tipo")
								  ->row();
	}

	public function get_tipo()
	{
		return $this->tipo;
	}

	private function set_mensaje($valor='')
	{
		$this->mensaje=$valor;
	}

	public function get_mensaje()
	{
		return $this->mensaje;
	}

	private function set_dato_insert($indice='', $valor='')
	{
		$this->datoi[$indice] = $valor;
	}

	private function limpiar_dato_insert()
	{
		$this->datoi=array();
	}

	public function get_tipos()
	{
		return $this->db->get("proveedor_tipo")->result();
	}

	public function guardar($args=array())
	{
		$this->limpiar_dato_insert();

		if (elemento($args, "nombre")) {
			$this->set_dato_insert("nombre", $args["nombre"]);
		}

		if ($this->tipo) {

	    	$this->db->where("proveedor_tipo", $this->tipo->proveedor_tipo);
	    	if ($this->db->update("proveedor_tipo", $this->datoi)) {
	    		$id = $this->tipo->proveedor_tipo;

	    		$this->set_tipo($id);
	    		$this->set_mensaje("Se actualizó correctamente el tipo de proveedor.");
	    		return $id;

	    	}else{
	    		$this->set_mensaje("No se pudo actualizar el tipo de proveedor.");
	    	}
	    	
	    }else{

	    	if ($this->db->insert("proveedor_tipo", $this->datoi)) {
	    		$id = $this->db->insert_id();

	    		$this->set_tipo($id);
	    		$this->set_mensaje("Se guardó correctamente el tipo de proveedor.");
	    		return $id;

	    	}else{
	    		$this->set_mensaje("No se pudo guardar el tipo de proveedor.");
	    	}

	    }
	    return false;
	}

	
}
?>