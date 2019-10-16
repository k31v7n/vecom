<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto_model extends CI_Model {

	private $producto;
	private $mensaje="";
	public function __construct()
	{
		$this->datoi=array();
		parent::__construct();
		if (isset($_SESSION['EmpresaID'])){
			$this->usuario = $_SESSION['UserID'];
			$this->empresa = $_SESSION['EmpresaID'];
		}
	}

	private function limpiar_dato_insert()
	{
		$this->datoi=array();
	}

	private function set_dato_insert($indice='', $valor='')
	{
		$this->datoi[$indice] = $valor;
	}

	private function set_mensaje($valor='')
	{
		$this->mensaje = $valor;
	}

	public function get_mensaje()
	{
		return $this->mensaje;
	}

	public function set_producto($valor='')
	{
		$this->producto = $this->db->where("producto", $valor)
								   ->get("producto")
								   ->row();
	}

	public function get_producto()
	{
		return $this->producto;
	}

	public function get_productos($args=array())
	{

		if (elemento($args, "existentes")) {
			$this->db->where("cantidad >", 0);
		}

		if (elemento($args, "termino")) {
			$t = $args["termino"];
			$this->db->where("(a.codigo = '{$t}' OR a.nombre LIKE '%{$t}%')", null, false);
		}

		return $this->db->select("
							a.*,
							concat(a.codigo, ' - ', a.nombre) as codigo_nombre,
							b.nombre as unidad_nombre,
							c.nombre as tipo_nombre,
							d.proveedor as proveedor_proveedor,
							d.nombre as proveedor_nombre,
							d.nit as proveedor_nit,
							d.direccion as proveedor_direccion,
							d.razon_social as proveedor_razon_social,
							e.codigo AS unidad_codigo
							")
						->from("producto a")
						->join("unidad_medida b", "b.unidad_medida = a.unidad_medida", "left")
						->join("producto_tipo c", "c.producto_tipo = a.producto_tipo", "left")
						->join("proveedor d", 	  "d.proveedor 	   = a.proveedor",     "left")
						->join("unidad_medida e", "e.unidad_medida = a.unidad_medida", "left")
						->where("a.activo", '1')
						->order_by("a.nombre", "ASC")
						->get()
						->result();
	}


	public function guardar_producto($args=array())
	{

		$this->limpiar_dato_insert();
		if (elemento($args, "codigo")) {
			$this->set_dato_insert("codigo", $args["codigo"]);
		}

	    if (elemento($args, "nombre")) {
	    	$this->set_dato_insert("nombre", $args["nombre"]);
	    }

	    if (elemento($args, "cantidad")) {
	    	$this->set_dato_insert("cantidad", $args["cantidad"]);
	    }else{
	    	$this->set_dato_insert("cantidad", "0");
	    }

	    if (elemento($args, "proveedor")) {
	    	$this->set_dato_insert("proveedor", $args["proveedor"]);
	    }

	    if (elemento($args, "unidad_medida")) {
	    	$this->set_dato_insert("unidad_medida", $args["unidad_medida"]);
	    }

	    if (elemento($args, "producto_tipo")) {
	    	$this->set_dato_insert("producto_tipo", $args["producto_tipo"]);
	    }

	    if (elemento($args, "precio_compra")) {
	    	$this->set_dato_insert("precio_compra", $args["precio_compra"]);
	    }

	    if (elemento($args, "precio_venta")) {
	    	$this->set_dato_insert("precio_venta", $args["precio_venta"]);
	    }

	    if (elemento($args, "incluye_iva")) {
	    	$this->set_dato_insert("incluye_iva", $args["incluye_iva"]);
	    }

	    if (elemento($args, "valor_iva")) {
	    	$this->set_dato_insert("valor_iva", $args["valor_iva"]);
	    }

	    if (elemento($args, "fecha_ingreso")) {
	    	$this->set_dato_insert("fecha_ingreso", $args["fecha_ingreso"]);
	    }

	    if (elemento($args, "fecha_vencimiento")) {
	    	$this->set_dato_insert("fecha_vencimiento", $args["fecha_vencimiento"]);
	    }

	    if (!$this->producto) {
	    	$this->set_dato_insert("usuario", $this->usuario);
	    }

	    if (isset($args['activo'])) {
	    	$this->set_dato_insert("activo", $args['activo']);
	    }

	    if ($this->producto) {
	    	$this->db->where("producto", $this->producto->producto);
    		if ($this->db->update("producto", $this->datoi)) {
    			$this->set_mensaje("Se actualizó correctamente el producto.");
    			$this->set_producto($this->producto->producto);
    			return $this->producto->producto;
    		}else{
    			$this->set_mensaje("No se pudo actualizar el producto.");
    		}
	    }else{
    		if ($this->db->insert("producto", $this->datoi)) {
    			$ide = $this->db->insert_id();
    			$this->set_mensaje("Se actualizó correctamente el producto.");
    			$this->set_producto($ide);
    			return $ide;
    		}else{
    			$this->set_mensaje("No se pudo actualizar el producto.");
    		}
	    }
	    
	    return false;
	}

	public function get_unidad_medida()
	{
		return $this->db->get("unidad_medida")->result();
	}

	public function get_producto_tipo()
	{
		return $this->db->get("producto_tipo")->result();
	}

	public function actualizar_cantidad()
	{
		$tc = $this->db->select("ifNull(SUM(a.cantidad), 0) as total_compra",false)
					   ->from("compra_detalle a")
					   ->join("compra b", "b.compra = a.compra", "left")
					   ->where("b.compra_estatus", 1)
					   ->where("a.producto", $this->producto->producto)
					   ->where("a.anulado", 0)
					   ->get()
					   ->row();

		$tv = $this->db->select("ifNull(SUM(a.cantidad), 0) as total_venta",false)
					   ->from("venta_detalle a")
					   ->join("venta b", "b.venta = a.venta", "left")
					   ->where_in("b.venta_estatus", [1, 2])
					   ->where("a.producto", $this->producto->producto)
					   ->where("a.anulado", 0)
					   ->get()
					   ->row();

		if ($this->guardar_producto([
			"cantidad" => $tc->total_compra - $tv->total_venta
		])) {
		 	return true;
		}

		return false;

	}
}
?>