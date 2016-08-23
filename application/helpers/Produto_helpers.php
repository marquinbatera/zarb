<?php
class Produto_helpers
{
	protected $CI;
	
	public function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->model('produto_model');
	}
	
	public function getProdutos()
	{
		$arr = array();
		$res = $this->CI->produto_model->getProdutos();
		
		if( empty($res) )
		{
			return null;
		}
		
		foreach($res as $r){
			$arr[ $r['id_produto'] ] = $r['desc_produtos'];
		}
		
		return $arr;
	}
}

?>