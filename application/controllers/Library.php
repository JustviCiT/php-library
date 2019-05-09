<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Library extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index( $status = NULL)
	{
		$data['status'] = $status;
		$data['nav_active'] = 'search';
		$data['query'] = $this->Library_model->get_last_ten_entries();

		$this->load->view('header');
		$this->load->view('nav',$data);
		$this->load->view('list',$data);
		$this->load->view('footer');
	}

	public function new_book( $status = NULL )
	{
		$data['status'] = $status;
		$data['action'] = 'new';
		$data['nav_active'] = 'new';

		$this->load->view('header');
		$this->load->view('nav',$data);
		$this->load->view('book',$data);
		$this->load->view('footer');
	}

	public function save_book()
	{	
		$nome_cognome = $this->input->post('autore');
		$titolo = $this->input->post('titolo');
		$key_book = $this->input->post('key_book');
		$key_auth = $this->input->post('key_auth');

		if( empty($nome_cognome) || empty($titolo) ){
			redirect(base_url().'new-book/error');
		}

		if( empty($key_book) || empty($key_book) ){
			$result = $this->Library_model->insert_book($nome_cognome, $titolo);
		}else{
			$result = $this->Library_model->update_book($nome_cognome, $titolo , $key_book, $key_auth);
		}

		if ($result !== FALSE){
			redirect(base_url().'get-book/'.$result.'/success');
		}else{
			redirect(base_url().'new-book/error');
		}
	}

	public function delete_book( $key = NULL )
	{	
		if ( is_null($key) ){
			redirect(base_url().'error');
		}

		$result = $this->Library_model->delete_book($key);

		if ($result !== FALSE){
			redirect(base_url().'success');
		}else{
			redirect(base_url().'error');
		}
	}

	public function get_book( $id = NULL, $status = NULL)
	{
/* 		var_dump($id);
		var_dump($status); */

		if ( is_null($id) ){
			$data['query'] = array();
		}else{
			$data['query'] = $this->Library_model->get_book($id);
		}

		$data['status'] = $status;
		$data['action'] = 'update';
		$data['nav_active'] = 'search';

		$this->load->view('header');
		$this->load->view('nav',$data);
		$this->load->view('book',$data);
		$this->load->view('footer');
	}

	public function search( )
	{
		$what = $this->input->post('search');

		$data['query'] = $this->Library_model->search_book($what);
		$data['status'] = NULL;
		$data['nav_active'] = 'search';

		$this->load->view('header');
		$this->load->view('nav',$data);
		$this->load->view('list',$data);
		$this->load->view('footer');
	}
}
