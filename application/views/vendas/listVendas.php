<?php //$this->load->view('partials/settings');?>

<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
<div class="row margin-top-10 margin-bottom-20" >
      <div class="col-xs-6">
            <h3 class="title">Relatório</h3>
      </div>
      <div class="col-xs-6">
         <div class="form-group">
            <a href="javascript:" onClick="location.reload()" class="btn btn-primary pull-right" data-toggle="tooltip" data-placement="left" title="Atualizar"><i class="glyphicon glyphicon-refresh"></i></a>
         </div>
      </div>
  </div>
<div class="content-box">
<form id="formulario">
  <?php if(!empty($_SESSION['mensagem'])){ ?>
    <div class="alert alert-<?php echo $this->session->flashdata('alert'); ?> alert-dismissible classe_alerta" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong><?php echo $this->session->flashdata('mensagem'); ?></strong>
    </div>
  <?php } ?>
  <div class="row">
      <div class="col-md-2">
          <div class="form-group">
            <label for="Nome">Filial <span style="color:red">*</span></label>
            <select class="form-control" name="filial" id="filial" autofocus required>
              <option value="">Selecione</option>
              <?php foreach($filial as $fil): ?>
              <option value="<?php echo $fil['id'] ?>"><?php echo $fil['nome'] ?></option>
              <?php endforeach; ?> 
            </select>
          </div>
      </div>
      <div class="col-md-2">
          <div class="form-group">
            <label for="Nome">Vendedor <span style="color:red">*</span></label>
            <select class="form-control" name="vendedor" id="vendedor" autofocus required>
              <option value="">Selecione</option>
              <?php foreach($vendedor as $ven): ?>
              <option value="<?php echo $ven['id'] ?>"><?php echo $ven['nome'] ?></option>
              <?php endforeach; ?> 
            </select>
          </div>
      </div>
      <div class="col-md-2">
          <div class="form-group">
            <label for="Nome">Plano <span style="color:red">*</span></label>
            <select class="form-control" name="plano" id="plano" autofocus required>
              <option value="">Selecione</option>
              <?php foreach($produtos as $plano): ?>
              <option value="<?php echo $plano['ID'] ?>"><?php echo $plano['Nome'] ?></option>
              <?php endforeach; ?> 
            </select>
          </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
        <label>&nbsp;</label>
          <a href="javascript:" class="btn btn-primary form-control" onclick="buscaVendas();" id="btnFiltrar">Filtrar</a>
        </div>
      </div>
  </div>
  <div class="row">
      <div class="col-md-12">
      		<div class="table-responsive">
                <table id="listVendas" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Plano</th>
                      <th>Preço</th>
                      <th>Vendedor</th>
                      <th>Filial</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="load">
                  </tbody>
                </table>
            </div>
      </div>
  </div>
</form>
</div>
<!-- Modal Confirm-->
<div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="Confirm">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="Confirm"><i class="glyphicon glyphicon-question-sign" style="color: #f0ad4e"></i> Confirmação?</h3>
      </div>
      <div class="modal-body">
        Tem certeza que deseja excluir esse Vendedor?
      </div>
      <div class="modal-footer">
        <button type="button" id="cancel" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <a href="javascript:" id="confirmExclusao" class="btn btn-primary">Confirm</a>
      </div>
    </div>
  </div>
</div>
<!-- Modal Confirm-->
<div class="modal fade" id="confirm1" tabindex="-1" role="dialog" aria-labelledby="Confirm">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="Confirm"><i class="glyphicon glyphicon-question-sign" style="color: #f0ad4e"></i> Descrição</h3>
      </div>
      <div class="modal-body" id="descProduto">
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('partials/footerSettings');?>

  <!-- Data Tables -->
  
  <link href="<?php echo base_url();?>assets/js/dataTables1/media/css/dataTables.bootstrap.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/dataTables/dataTables.responsive.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

  <link href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<!-- Data Tables -->
  <script src="<?php echo base_url();?>assets/js/dataTables1/media/js/jquery.dataTables.js"></script>
  <script src="<?php echo base_url();?>assets/js/dataTables1/media/js/dataTables.bootstrap.js"></script>
  <script src="<?php echo base_url();?>assets/js/dataTables/dataTables.responsive.js"></script>
  <script src="<?php echo base_url();?>assets/js/dataTables/dataTables.tableTools.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/jquery.easy-overlay.js"></script>
  <script>
  $(function(){

    var baseUrl = $('#base_url').val();
    $('#listVendas').dataTable({
      "oLanguage": {
          "sProcessing": "Aguarde enquanto os dados são carregados ...",
          "sLengthMenu": "Mostrar _MENU_ registros por pagina",
          "sZeroRecords": "Nenhum registro correspondente ao criterio encontrado",
          "sInfoEmtpy": "Exibindo 0 a 0 de 0 registros",
          "sInfo": "Exibindo de _START_ a _END_ de _TOTAL_ registros",
          "sInfoFiltered": "",
          "sSearch": "Procurar",
          "oPaginate": {
             "sFirst":    "Primeiro",
             "sPrevious": "Anterior",
             "sNext":     "Próximo",
             "sLast":     "Último"
          }
      },   
      "columns": [
            
          {"data": "id"},
          {"data": "plano"},
          {
              "render": function(data, type, row) {
                  var btn = 'R$ '+row.Preco;
                  return btn;
              }

          },
          {"data": "vendedor"},
          {"data": "filial"},
          {
              "render": function(data, type, row) {
                  var btn = '<button type="button" onclick="confirmModal('+row.id+')" class="btn-icon btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Exclude"><i class="glyphicon glyphicon-trash"></i></button>';
                  return btn;
              }, "width": "50px"

          }
      ],
      "order": [[0, 'desc']],
   });

    $('#load').overlay();
    buscaVendas();
    window.setTimeout( function(){
      $('#load').overlayout();
    }, 3000);
  });

  function confirmModal(id)
  {
      $('#confirmExclusao').attr('onclick','excluirVenda('+id+')');
      $('#confirm').modal(); 
  }

  // function exibeDescricao(id)
  // {
  //   $.ajax({
  //       url: '../produtos/descricao',
  //       type: 'POST',
  //       data:{
  //         id:id
  //       },
  //       success: function(data){
  //         var conteudo = JSON.parse(data);
  //         var mensagem = conteudo[0].Descricao;
  //         $('#descProduto').html(mensagem);
  //         $('#confirm1').modal();
  //       }
  //   })
  // }

  function excluirVenda(id)
  {
    $('#confirm').modal('hide');
    $('#load').overlay();
    $.ajax({
        url: '../vendas/removeVenda',
        type: 'POST',
        data:{
          id:id
        },
        success: function(data){
          var conteudo = JSON.parse(data);
          var mensagem = '<div class="alert alert-'+conteudo.alert+' alert-dismissible classe_alerta" role="alert">'+conteudo.mensagem+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong></strong></div>';

          buscaVendas();
          window.setTimeout( function(){
            $('#load').overlayout();
            $('#formulario').prepend(mensagem);
            $('.classe_alerta').delay(5000).fadeOut(5000);
          }, 3000);
        }
    })
  }

  // função AJAX para trazer dados do DataTable By. Marcos Meira 14/01/2015
  function buscaVendas()
  {
    $.ajax({
        type:'POST',
        url:'../vendas/buscaListaVendas',
        data: {
          filial : $('#filial').val(),
          vendedor: $('#vendedor').val(),
          plano: $('#plano').val()
        },
        dataType: "json",
        success: function(data){
            $('#listVendas').dataTable().fnClearTable();
            if (data.aaData.length)
                $('#listVendas').dataTable().fnAddData(data.aaData);
            $('#listVendas').dataTable().fnDraw();
        }
    })
  }
  
  // BREADCRUMB //
  $("#breadcrumb").append('<i class="icon icon-config"></i><strong>Vendedor <i class="glyphicon glyphicon-menu-right"></i>Lista</strong>');

  </script>
