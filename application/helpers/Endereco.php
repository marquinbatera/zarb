<?php
class Endereco
{
	protected $CI;
	
	public function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->model('endereco_model');
	}
	
	public function getEstados()
	{
		$arr = array();
		$res = $this->CI->endereco_model->getEstados();
		
		if( empty($res) )
		{
			echo 'Estados não encontrados';
			show_404();
		}
		
		$arr['0'] = 'Selecione';
		foreach($res as $r){
			$arr[ $r['id_estado'] ] = $r['estado'];
		}
		
		return $arr;
	}


}

?>