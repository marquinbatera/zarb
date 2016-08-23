<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filial extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('ion_auth', 'ion_auth');
		$this->load->model('ion_auth_model');
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

	public function newFilial()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			if ($this->input->post()) {

				$nome       = $this->input->post('nome');


				$dados = array(
					'nome'       => $nome
				);

				//insere produto e retorna o id
				$user_id = $this->filial_model->setUser($dados);
				if ($user_id)
				{

					$this->session->set_flashdata('mensagem', 'Cadastro realizado com Sucesso!');
					$this->session->set_flashdata('alert', 'success');
					redirect(base_url('filial/listFilial'), 'refresh');
				}else{
					$this->session->set_flashdata('mensagem', 'Falha no cadastro, preencha os campos corretamente!');
					$this->session->set_flashdata('alert', 'warning');
					redirect(base_url('filial/newFilial'), 'refresh');
				}
			}

			$data = array(
				'view'   => 'filial/editFilial',
				'title' => 'ZARB',
				'additional' => null,
			);
			$this->parser->parse('layoutPrincipal', $data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('home/index'), 'refresh');
		}
	}

	public function listFilial()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			$filial = $this->filial_model->getUserList();
			$data = array(
				'view'   => 'filial/listFilial',
				'title' => 'ZARB',
				'message' => null,
				'additional' => null,
				'filial' => $filial
				);

			$this->parser->parse('layoutPrincipal', $data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('home/index'), 'refresh');
		}
	}

	public function buscaListaFilial() {
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			$filial = $this->filial_model->getUserList();
			$data['aaData'] = $filial;
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

	public function removeFilial()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			$filial = $this->input->post('id');

			$this->filial_model->excluirFilial($filial);

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
