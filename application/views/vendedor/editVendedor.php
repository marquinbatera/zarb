<?php //$this->load->view('partials/settings');?>

<link rel="stylesheet" href="<?php echo base_url();?>assets/css/intlTelInput.css">

<div class="row margin-top-10 margin-bottom-20">
      <div class="col-md-12">
            <h3 class="title">cadastro de Vendedor</h3>
      </div>
  </div>
<form method="post" action="<?php echo base_url('vendedor/newVendedor')?>" enctype="multipart/form-data">

<div class="content-box">
  <?php if(!empty($_SESSION['mensagem'])){ ?>
  <div class="alert alert-<?php echo $this->session->flashdata('alert'); ?> alert-dismissible classe_alerta" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong><?php echo $this->session->flashdata('mensagem'); ?></strong>
  </div>
  <?php } ?>
  <div class="row">
      <div class="col-md-9 col-lg-10">
      	  <div class="row">
          	  <div class="col-md-6">
                  <div class="form-group">
                    <label for="Nome">Nome <span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" required autofocus>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="Descrição">Filial <span style="color:red">*</span></label>
                    <select class="form-control" name="filial" id="filial" autofocus required>
                      <?php foreach($filiais as $filial): ?>
                      <option value="<?php echo $filial['id'] ?>"><?php echo $filial['nome'] ?></option>
                      <?php endforeach; ?> 
                    </select>
                  </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-4">
                  <div class="form-group">
                    <label for="Preço">Telefone <span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="telefone" id="telefone" placeholder="Telefone" required autofocus>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="row margin-top-20">
  		<div class="col-md-12">
        	 <div class="form-group">
        		<button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Save</button>
                <a href="<?php echo base_url('vendedor/listVendedor') ?>" class="btn btn-default">Cancel</a>
            </div>
        </div>
  </div>
</form>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/inttelinput/intlTelInput.min.js"></script>
<script src="<?php echo base_url();?>assets/js/locationPicker/locationpicker.jquery.min.js"></script>
<script>

// BREADCRUMB //
$("#breadcrumb").append('<i class="icon icon-config"></i><strong><a href="<?php echo base_url('vendedor/listVendedor');?>">Vendedor</a></strong><i class="glyphicon glyphicon-menu-right"></i> Cadastro');

</script>

<?php $this->load->view('partials/footerSettings');?>