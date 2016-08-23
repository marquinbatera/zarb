<?php //$this->load->view('partials/settings');?>

<link rel="stylesheet" href="<?php echo base_url();?>assets/css/intlTelInput.css">

<div class="row margin-top-10 margin-bottom-20">
      <div class="col-md-12">
            <h3 class="title">cadastro de Vendas</h3>
      </div>
  </div>
<form method="post" action="<?php echo base_url('vendas/newVenda')?>" enctype="multipart/form-data">

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
                    <label for="Nome">Vendedor <span style="color:red">*</span></label>
                    <select class="form-control" name="vendedor" id="vendedor" autofocus required>
                      <?php foreach($vendedor as $ven): ?>
                      <option value="<?php echo $ven['id'] ?>"><?php echo $ven['nome'] ?></option>
                      <?php endforeach; ?> 
                    </select>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="Plano">Plano <span style="color:red">*</span></label>
                    <select class="form-control" name="plano" id="plano" autofocus required>
                      <?php foreach($planos as $plano): ?>
                      <option value="<?php echo $plano['ID'] ?>"><?php echo $plano['Nome'] ?></option>
                      <?php endforeach; ?> 
                    </select>
                  </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-4">
                  <div class="form-group">
                    <label for="Preço">Data <span style="color:red">*</span></label>
                    <input id="dateTimeInput" type="date" class="form-control" name="dataTime" id="dataTime" placeholder="insira a data" required autofocus>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="row margin-top-20">
  		<div class="col-md-12">
        	 <div class="form-group">
        		<button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Save</button>
                <a href="<?php echo base_url('vendas/listVendas') ?>" class="btn btn-default">Cancel</a>
            </div>
        </div>
  </div>
</form>

<script src="<?php echo base_url();?>assets/js/locationPicker/locationpicker.jquery.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/inttelinput/intlTelInput.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/dateTimePicker/moment-with-locales.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/dateTimePicker/bootstrap-datetimepicker.min.js"></script>
<link href="<?php echo base_url();?>assets/js/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="<?php echo base_url();?>assets/js/select2/dist/js/select2.min.js"></script>
<script src="<?php echo base_url();?>assets/js/kendo.all.min.js"></script>
<script>

// BREADCRUMB //
$("#breadcrumb").append('<i class="icon icon-config"></i><strong><a href="<?php echo base_url('vendas/listVenda');?>">Venda</a></strong><i class="glyphicon glyphicon-menu-right"></i> Cadastro');

</script>

<?php $this->load->view('partials/footerSettings');?>