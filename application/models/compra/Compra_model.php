<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compra_model extends CI_Model {

	private $compra = null;
	private $mensaje  = "";
	public  $limite   = 20;
	public function __construct()
	{
		parent::__construct();
		$this->datoi   = array();
		if (isset($_SESSION['EmpresaID'])){
			$this->usuario = $_SESSION["UserID"];
			$this->empresa = $_SESSION["EmpresaID"];
		}
	}

	public function get_limite()
	{
		return $this->limite;
	}

	public function set_compra($compra='')
	{
		$this->compra = $this->db->where("compra", $compra)
								  ->get("compra")
								  ->row();
	}

	public function get_compra()
	{
		return $this->compra;
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

	public function get_tipo_pago()
	{
		return $this->db->get("tipo_pago")
						->result();
	}

	public function guardar($args=array())
	{
		if (elemento( $args, "fecha_factura")) {
			$this->set_dato_insert("fecha_factura", $args["fecha_factura"]);
		}

	    if (elemento( $args, "serie")) {
	    	$this->set_dato_insert("serie", $args["serie"]);
	    }

	    if (elemento( $args, "valor_base")) {
	    	$this->set_dato_insert("valor_base", $args["valor_base"]);
	    }

	    if (elemento( $args, "valor_iva")) {
	    	$this->set_dato_insert("valor_iva", $args["valor_iva"]);
	    }

	    if (elemento( $args, "monto")) {
	    	$this->set_dato_insert("monto", $args["monto"]);
	    }

	    if (elemento( $args, "factura_numero")) {
	    	$this->set_dato_insert("factura_numero", $args["factura_numero"]);
	    }

	    if (elemento( $args, "concepto")) {
	    	$this->set_dato_insert("concepto", $args["concepto"]);
	    }

	    if (elemento( $args, "proveedor")) {
	    	$this->set_dato_insert("proveedor", $args["proveedor"]);
	    }

	    if (elemento( $args, "tipo_pago")) {
	    	$this->set_dato_insert("tipo_pago", $args["tipo_pago"]);
	    }

	    if (elemento( $args, "moneda")) {
	    	$this->set_dato_insert("moneda", $args["moneda"]);
	    }

	    if (elemento( $args, "compra_estatus")) {
	    	$this->set_dato_insert("compra_estatus", $args["compra_estatus"]);
	    }
	    
	    if (elemento( $args, "fecha_pago")) {
	    	$this->set_dato_insert("fecha_pago", $args["fecha_pago"]);
	    }

	    if (!$this->compra) {
	    	$this->set_dato_insert("usuario", $this->usuario);
	    }

	    if ($this->compra) {

	    	$this->db->where("compra", $this->compra->compra);
	    	if ($this->db->update("compra", $this->datoi)) {
	    		$id = $this->compra->compra;

	    		$this->set_compra($id);
	    		$this->set_mensaje("Se actualizó correctamente la compra.");
	    		return $id;

	    	}else{
	    		$this->set_mensaje("No se pudo actualizar la compra.");
	    	}
	    	
	    }else{

	    	if ($this->db->insert("compra", $this->datoi)) {
	    		$id = $this->db->insert_id();

	    		$this->set_compra($id);
	    		$this->set_mensaje("Se guardó correctamente la compra.");
	    		return $id;

	    	}else{
	    		$this->set_mensaje("No se pudo guardar la compra.");
	    	}

	    }
	    return false;

	}

	public function buscar($args=array())
	{
		return $this->db->select("
							a.*,
							b.nombre as proveedor_nombre,
							c.nombre as tipo_pago_nombre,
							d.nombre as moneda_nombre,
							d.codigo as moneda_codigo,
							e.nombre as estatus_nombre
						")
						->from("compra a")
						->join("proveedor b", "b.proveedor = a.proveedor")
						->join("tipo_pago c", "c.tipo_pago = a.tipo_pago")
						->join("moneda d", "d.moneda = a.moneda")
						->join("compra_estatus e", "e.compra_estatus = a.compra_estatus")
						->where("a.compra_estatus != ", 3)//Estado eliminado
						->get()
						->result();
	}

	public function actualizar_total()
	{
		$cant = $this->db->select("ifNULL(SUM(total), 0) as monto_compra")
						 ->from("compra_detalle")
						 ->where("compra", $this->compra->compra)
						 ->where("anulado", 0)
						 ->get()
						 ->row();
		$d = [
			"valor_base" => $cant->monto_compra / 1.12,
			"valor_iva" => ($cant->monto_compra / 1.12) * 0.12,
			"monto" => $cant->monto_compra
		];
		if ($this->guardar($d)){
			$this->set_mensaje("Se actualizó correctamente el monto total de la compra");
			return true;
		}else{
			$this->set_mensaje("No se pudo actualizar el monto total de la compra");
		}

		return false;
	}
}
?>