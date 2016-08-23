<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Home_model','home_model');
		$this->load->library('form_validation');
		$this->load->library('ion_auth');
		$this->load->library('session');

		$company_id['company_id'] = 5;
		$this->session->set_userdata($company_id);
	}

	public function index()
	{
		if ($this->ion_auth->logged_in())
		{

			$id        = $this->ion_auth->get_user_id();
			$user_id   = $this->home_model->getAllWhere($id, 'id', 'users');
			
			$userdata  = array(
				'nome' => $user_id[0]['username'],
				'id_user'  => $user_id[0]['id']
			);	
		
			$this->session->set_userdata($userdata);
			redirect(base_url('vendas/listVendas'), 'refresh');

			$this->parser->parse('layoutPrincipal', $data);
				
		}else{
			$data = array(
				'view'   => 'login/signin',
				'title' => 'OTL Software',
				'additional' => null,
				);

			$this->parser->parse('layoutDelivery', $data);
		}

	}

	// public function esqueciSenha()
	// {
	// 	$data = array(
	// 		'view'   => 'login/reset-password',
	// 		'title' => 'OTL Software',
	// 		'message' => null,
	// 		'additional' => null,
	// 		);

	// 	$this->parser->parse('layoutDelivery', $data);
	// }

	// public function recuperaConta()
	// {
	// 	$data = array(
	// 		'view'   => 'login/new-password',
	// 		'title' => 'OTL Software',
	// 		'message' => null,
	// 		'additional' => null,
	// 		);

	// 	$this->parser->parse('layoutDelivery', $data);
	// }
}
