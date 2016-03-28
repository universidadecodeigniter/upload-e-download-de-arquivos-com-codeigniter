<?php $this->load->view('commons/cabecalho'); ?>

<div class="container">
	<div class="page-header">
		<h1 class="text-center">Upload e Download de arquivo com CodeIgniter</h1>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 col-lg-6 col-md-offset-3">
			<?php if(isset($error)):?>
				<div class="alert alert-error"><?=$error?></div>
			<?php endif; ?>
			<form action="<?=base_url('upload')?>" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label>Selecione um arquivo (zip, rar, pdf, doc, xls, jpg, png, gif)</label>
					<input type="file" name="arquivo"/>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-success" value="Processar" />
				</div>
		</div>
	</div>
</div>

<?php $this->load->view('commons/rodape'); ?>
