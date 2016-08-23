<link rel="stylesheet" href="<?php echo base_url();?>assets/css/intlTelInput.css">
<div class="content-body">
    	<div class="container">
            <form method="post" action="<?php echo base_url('user/editMyProfile')?>" enctype="multipart/form-data">
            <input type="hidden" id="idUser" name="idUser" value="<?php echo $user[0]['user_id'] ?>">
            <div class="row margin-top-10 margin-bottom-20">
                  <div class="col-xs-12">
                        <h3 class="title">Edit My Profile</h3>
                  </div>
            </div>
            <div class="content-box">
              <?php if(!empty($_SESSION['mensagem'])){ ?>
              <div class="alert alert-<?php echo $this->session->flashdata('alert'); ?> alert-dismissible classe_alerta" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong><?php echo $this->session->flashdata('mensagem'); ?></strong>
              </div>
              <?php } ?>
              <div class="row">
                  <div class="col-md-3 col-lg-2">
                        <div class="form-group text-center">
                    <label for="Photo"></label>
                    <div class="thumb-user">
                        <div class="overImg">
                        	<span>
                            <a class="btn-icon btn-over add-photo" data-toggle="tooltip" data-placement="bottom" data-original-title="Add new photo"><i class="glyphicon glyphicon-upload"></i></a>
                            
                            <a class="btn-icon btn-over delete-photo"  data-toggle="tooltip" data-placement="bottom" data-original-title="Remove this photo" ><i class="glyphicon glyphicon-trash"></i></a>
                            </span>
                        	<img id="blah" src="<?php echo (!empty($user[0]['user_imagepath']) ? $user[0]['user_imagepath']: base_url().'assets/img/icon-profile.png');?>" >
                        </div>
                        <div style="height: 0px; width: 0px; overflow: hidden;">
                        	<input type="file" id="imgInp" name="imgInp" onchange="readURL(this)">
                        </div>
                    </div>
                    
            </div>
        
                    
                  </div>
                  <div class="col-md-9 col-lg-10">
                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">
                                <label for="Name">Name <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="nome" id="nome" placeholder="Name" value="<?php echo $user[0]['user_name'] ?>" required autofocus>
                                
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                <label for="Username">Short Name <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $user[0]['user_nick'] ?>" required autofocus>
                                
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                <label for="Password">Password <span style="color:red">*</span></label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                
                              </div>
                          </div>
                          
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="Email">Email <span style="color:red">*</span></label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $user[0]['user_email'] ?>" required autofocus>
                        
                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="form-group">
                        <label for="Cell">Mobile Phone #<span style="color:red">*</span></label>
                        <input type="tel" class="form-control" name="cell" id="cell" value="<?php echo $user[0]['user_cel'] ?>" required autofocus>
                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="form-group">
                        <label for="Phone">Phone #</label>
                        <input type="tel" class="form-control" name="phone" id="phone" value="<?php echo $user[0]['user_phone'] ?>">
                      </div>
                  </div>
              </div>
              <div class="row">
                 <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                              <div class="form-group">
                                <label for="Address">Address <span style="color:red">*</span></label>
                               <input type="text" id="inputAddress" class="form-control" name="inputAddress" placeholder="Enter a address" value="<?php echo $user[0]['user_address'] ?>" autocomplete="off" required autofocus/>
                              </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-md-12">
                              <div class="form-group">
                                <label for="Complement address">Complement</label>
                                <input type="text" class="form-control" name="complement" id="complement" value="<?php echo $user[0]['user_addresscomp'] ?>"  placeholder="Enter a complement address">
                                
                              </div>
                         </div>
                    </div>
                 </div>
                 <div class="col-md-6">
                      <div id="mapAdress" style="width: 100%; height: 200px"></div>
                      <input type="hidden" id="longitude" name="longitude" value="<?php echo $user[0]['user_lng'] ?>">
                      <input type="hidden" id="latitude" name="latitude" value="<?php echo $user[0]['user_lat'] ?>">
                 </div>
                 
              </div>
              
            
              <div class="row margin-top-20">
                    <div class="col-md-12">
                         <div class="form-group">
                            <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Save</button>
                            <a href="<?php echo base_url('user/listUser') ?>" class="btn btn-default">Cancel</a>
                        </div>
                    </div>
              </div>
            </div>
            </form>
   		</div>
</div>

<!-- Modal Confirm-->
<div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="Confirm">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="Confirm"><i class="glyphicon glyphicon-question-sign" style="color: #f0ad4e"></i> Confirmation</h3>
      </div>
      <div class="modal-body" id="dynamicMessage">
        <!-- MENSAGEM DINAMICA -->
      </div>
      <div class="modal-footer">
        <a href="javascript:" id="cancel_btn"  class="btn btn-default" data-dismiss="modal">Cancel</a>
        <a href="javascript:" id="confirm_btn" class="btn btn-primary" data-dismiss="modal">Confirm</a>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/inttelinput/intlTelInput.min.js"></script>
<script src="<?php echo base_url();?>assets/js/locationPicker/locationpicker.jquery.min.js"></script>
<script>

var fileInput = $(':file');
var userId = <?php echo $user[0]['user_id'] ?>;

$('.add-photo').click(function(){
    fileInput.click();
}).show();

$('.delete-photo').click(function(){
    removePhoto(1);
})

var user_imagepath = '<?php echo (!empty($user[0]['user_imagepath']) ? $user[0]['user_imagepath']: 'assets/img/icon-profile.png');?>';

showRemovePhotoBtn(user_imagepath);

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah')
                .attr('src', e.target.result)
                .width(120)
                .height(120);
        };

        reader.readAsDataURL(input.files[0]);
		showRemovePhotoBtn(input.files);
    }
}

function showRemovePhotoBtn(file){	
	console.log(file);
	if(file.length > 0 && file != "assets/img/icon-profile.png"){
		$('.delete-photo').css('display', 'block');
		$('.btn-over').css('float', 'left');
	}else{
		$('.delete-photo').css('display', 'none');
		$('.btn-over').css('float', 'none');
	}
}

function removePhoto(edicao){
    if (edicao) {
        confirmModalRemovePhoto();
    } else {
      $('#blah').attr('src', '<?php echo base_url()?>assets/img/icon-profile.png');
      $('.delete-photo').css('display', 'none');
	  $('.btn-over').css('float', 'none');
      $('#imgInp').val('');
    }
}

function confirmModalRemovePhoto() {
    $('#dynamicMessage').text('Are you sure you want to remove this photo?');
    $('#confirm_btn').attr('onclick','deletePhoto()');
    $('#confirm').modal(); 
}

function deletePhoto() {
    $('#blah').attr('src', '<?php echo base_url()?>assets/img/icon-profile.png');
    $('.delete-photo').css('display', 'none');
	$('.btn-over').css('float', 'none');
    $('#imgInp').val('');
	
	console.log($('#userId').val());
	
    $.ajax({
      type:'POST',
      url:'../../user/setDefaultPhoto',
      data: {
        user_id: userId
      },
      // dataType:'json',
      success: function(data){
		  
        location.reload();
      }
    })
}

$('#mapAdress').locationpicker({
	location: {latitude: $('#latitude').val(), longitude: $('#longitude').val()},
	enableAutocomplete: true,
	radius:0,
	zoom:15,
	scrollwheel:0,
	inputBinding: {
		locationNameInput: $('#inputAddress')
	},
	enableAutocomplete: true,
onchanged: function(currentLocation, radius, isMarkerDropped) {
  
	  $('#longitude').val(currentLocation.longitude);
	  $('#latitude').val(currentLocation.latitude);
	  // alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
	} 
});

//COMPONENT INTERNACIONAL TEL INPUT//
  $("#phone").intlTelInput({
    // allowExtensions: true,
    // autoFormat: true,
    // autoHideDialCode: false,
    // autoPlaceholder: false,
    // dropdownContainer: $("body"),
    // excludeCountries: ["us"],
    // geoIpLookup: function(callback) {
    //   $.get('http://ipinfo.io', function() {}, "jsonp").always(function(resp) {
    //     var countryCode = (resp && resp.country) ? resp.country : "";
    //     callback(countryCode);
    //   });
    // },
    // initialCountry: "auto",
    // nationalMode: false,
    // numberType: "MOBILE",
    // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
    preferredCountries: ['gb'],
    utilsScript: "<?php echo base_url();?>assets/js/inttelinput/lib/libphonenumber/build/utils.js"
  });

  //COMPONENT INTERNACIONAL TEL INPUT//
  $("#cell").intlTelInput({
    // allowExtensions: true,
    // autoFormat: true,
    // autoHideDialCode: false,
    // autoPlaceholder: false,
    // dropdownContainer: $("body"),
    // excludeCountries: ["us"],
    // geoIpLookup: function(callback) {
    //   $.get('http://ipinfo.io', function() {}, "jsonp").always(function(resp) {
    //     var countryCode = (resp && resp.country) ? resp.country : "";
    //     callback(countryCode);
    //   });
    // },
    // initialCountry: "auto",
    // nationalMode: false,
    // numberType: "MOBILE",
    // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
    preferredCountries: ['gb'],
    utilsScript: "<?php echo base_url();?>assets/js/inttelinput/lib/libphonenumber/build/utils.js"
  });

// BREADCRUMB //
$("#breadcrumb").append('<i class="icon icon-config"></i>Edit My Profile');

</script>

<?php $this->load->view('partials/footerSettings');?>