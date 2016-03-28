<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('upload');
		$this->load->helper('download');
	}

	public function Index()
	{
		$this->load->view('home');
	}

	public function Upload(){

		$folder = random_string('alpha');
		$path = "./uploads/".$folder;

		if ( ! is_dir($path)) {
        mkdir($path, 0777, $recursive = true);
    }

		$configUpload['upload_path']   = $path;
		$configUpload['allowed_types'] = 'jpg|png|gif|pdf|zip|rar|doc|xls';
		$configUpload['encrypt_name']  = TRUE;

		$this->upload->initialize($configUpload);

		if ( ! $this->upload->do_upload('arquivo'))
		{
			$data= array('error' => $this->upload->display_errors());
			$this->load->view('home',$data);
		}
		else
		{
			$data['dadosArquivo'] = $this->upload->data();
			$arquivoPath = 'uploads/'.$folder."/".$data['dadosArquivo']['file_name'];
			$data['urlArquivo'] = base_url($arquivoPath);
			$downloadPath = 'download/'.$folder."/".$data['dadosArquivo']['file_name'];
			$data['urlDownload'] = base_url($downloadPath);

			$this->load->view('download',$data);
		}
	}

	public function Download(){
		$arquivo = $this->uri->segment(3);
		$folder = $this->uri->segment(2);
		$arquivoPath = './uploads/'.$folder."/".$arquivo;

		force_download($arquivoPath,null);
	}
}
