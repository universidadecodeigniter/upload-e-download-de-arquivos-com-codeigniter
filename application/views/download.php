<?php $this->load->view('commons/cabecalho'); ?>

<div class="container">
	<div class="page-header">
		<h1 class="text-center">Upload e Download de arquivo com CodeIgniter</h1>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
			<h3>Informações do arquivo</h3>
            <?php
            foreach($dadosArquivo as $key => $value):
              if($value): ?>
              <p><strong><?=$key?></strong>: <?=$value?></p>
            <?php
              endif;
            endforeach;
            ?>
            <hr />
				<p><a href="<?=base_url()?>" class="btn btn-success pull-left">Novo arquivo</a><a href="<?=$urlDownload?>" class="btn btn-default pull-right">Download</a></p>
		</div>
	</div>
</div>

<?php $this->load->view('commons/rodape'); ?>
