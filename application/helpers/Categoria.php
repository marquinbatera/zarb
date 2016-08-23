<?php
class Categoria
{
	protected $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->model('categoria_model');
	}
	
	public function getCategorias()
	{
		$arr = array();
		$res = $this->CI->categoria_model->getCategorias();
		
		if( empty($res) )
		{
			echo 'Categorias não encontrados';
			show_404();
		}
		
		foreach($res as $r){
			$arr[ $r['id_categoria'] ] = $r['desc_categoria'];
		}
		
		return $arr;
	}
}

?>