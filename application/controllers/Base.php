<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Controller {

	// Método construtor da classe
	function __construct(){
		parent::__construct();
	}

  // Método que carregará a home
	public function Index()
	{
		// carrega a view 'home.php'
		$this->load->view('home');
	}

	// Método que processar o upload do arquivo
	public function Upload(){

		// definimos um nome aleatório para o diretório
		$folder = random_string('alpha');
		// definimos o path onde o arquivo será gravado
		$path = "./uploads/".$folder;

		// verificamos se o diretório existe
		// se não existe criamos com permissão de leitura e escrita
		if ( ! is_dir($path)) {
        mkdir($path, 0777, $recursive = true);
    }

		// definimos as configurações para o upload
		// determinamos o path para gravar o arquivo
		$configUpload['upload_path']   = $path;
		// definimos - através da extensão -
		// os tipos de arquivos suportados
		$configUpload['allowed_types'] = 'jpg|png|gif|pdf|zip|rar|doc|xls';
		// definimos que o nome do arquivo
		// será alterado para um nome criptografado
		$configUpload['encrypt_name']  = TRUE;

		// passamos as configurações para a library upload
		$this->upload->initialize($configUpload);

		// verificamos se o upload foi processado com sucesso
		if ( ! $this->upload->do_upload('arquivo'))
		{
			// em caso de erro retornamos os mesmos para uma variável
			// e enviamos para a home
			$data= array('error' => $this->upload->display_errors());
			$this->load->view('home',$data);
		}
		else
		{
			//se correu tudo bem, recuperamos os dados do arquivo
			$data['dadosArquivo'] = $this->upload->data();
			// definimos o path original do arquivo
			$arquivoPath = 'uploads/'.$folder."/".$data['dadosArquivo']['file_name'];
			// passando para o array '$data'
			$data['urlArquivo'] = base_url($arquivoPath);
			// definimos a URL para download
			$downloadPath = 'download/'.$folder."/".$data['dadosArquivo']['file_name'];
			// passando para o array '$data'
			$data['urlDownload'] = base_url($downloadPath);

			// carregamos a view com as informações e link para download
			$this->load->view('download',$data);
		}
	}

	// Método que fará o download do arquivo
	public function Download(){
		// recuperamos o terceiro segmento da url, que é o nome do arquivo
		$arquivo = $this->uri->segment(3);
		// recuperamos o segundo segmento da url, que é o diretório
		$diretorio = $this->uri->segment(2);
		// definimos original path do arquivo
		$arquivoPath = './uploads/'.$diretorio."/".$arquivo;

		// forçamos o download no browser
		// passando como parâmetro o path original do arquivo
		force_download($arquivoPath,null);
	}
}
