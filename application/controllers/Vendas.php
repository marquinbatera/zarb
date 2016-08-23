<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendas extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('ion_auth', 'ion_auth');
		$this->load->model('ion_auth_model');
		$this->load->model('vendedor_model');
		$this->load->model('user_model');
		$this->load->model('vendas_model');
		$this->load->model('filial_model');
	}

	public function index()
	{

		if ($this->ion_auth->logged_in())
		{
			$userId = $this->ion_auth->user()->row();
			$data = array(
				'view'   => 'index/index',
				'title' => 'OTL Software',
				'message' => "olá mundo!!",
				'userId' => $userId,
				'additional' => null,
				);

			$this->parser->parse('layoutPrincipal', $data);
		}else{
			$data = array(
				'view'   => 'login/signin',
				'title' => 'ZARB',
				'message' => null,
				'additional' => null,
				);

			$this->parser->parse('layoutDelivery', $data);
		}

	}

	public function newVenda()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			if ($this->input->post()) {

				$vendedor       = $this->input->post('vendedor');
				$plano   = $this->input->post('plano');
				$dataTime   = $this->input->post('dataTime');

				$dados = array(
					'id_vendedor'        => $vendedor,
					'id_plano'   => $plano,
					'data'       => $dataTime,
				);

				//insere produto e retorna o id
				if ($user_id = $this->vendas_model->setUser($dados))
				{
					
					$this->session->set_flashdata('mensagem', 'Cadastro realizado com Sucesso!');
					$this->session->set_flashdata('alert', 'success');
					redirect(base_url('vendas/listVendas'), 'refresh');
				}else{
					$this->session->set_flashdata('mensagem', 'Falha no cadastro, preencha os campos corretamente!');
					$this->session->set_flashdata('alert', 'warning');
					redirect(base_url('vendas/newVenda'), 'refresh');
				}
			}
			$planos = $this->user_model->getUserList();
			$vendedor = $this->vendedor_model->getUserList();
			$data = array(
				'view'   => 'vendas/editVendas',
				'title' => 'ZARB',
				'additional' => null,
				'planos' => $planos,
				'vendedor' => $vendedor
				);

			$this->parser->parse('layoutPrincipal', $data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('home/index'), 'refresh');
		}
	}

	public function listVendas()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			$produtos = $this->user_model->getUserList();
			$vendedor = $this->vendedor_model->getUserList();
			$filial = $this->filial_model->getUserList();
			$data = array(
				'view'   => 'vendas/listVendas',
				'title' => 'ZARB',
				'message' => null,
				'additional' => null,
				'produtos' => $produtos,
				'vendedor' => $vendedor,
				'filial' => $filial,
				);

			$this->parser->parse('layoutPrincipal', $data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('home/index'), 'refresh');
		}
	}

	public function buscaListaVendas() {
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			$filial = $this->input->post('filial');
			$vendedor = $this->input->post('vendedor');
			$plano = $this->input->post('plano');

			$vendas = $this->vendas_model->getListVendas($filial, $vendedor, $plano);
			$data['aaData'] = $vendas;
			echo json_encode($data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('home/index'), 'refresh');
		}
	}

	public function descricao()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			$user_id = $this->input->post('id');

			$produto = $this->user_model->getAllWhere($user_id, 'ID', 'produto');

			$data['descricao'] = $produto[0];

			echo json_encode($produto);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('home/index'), 'refresh');
		}
	}

	public function removeVenda()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			$venda = $this->input->post('id');

			$this->vendas_model->excluirVenda($venda);

			$data['mensagem'] = 'Exclusão realizada com sucesso!';
			$data['alert']    = 'success';

			echo json_encode($data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('home/index'), 'refresh');
		}
	}
}
