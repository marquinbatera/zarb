// JavaScript Document
$(document).ready(function() {

 
    var toggle = document.querySelector(".navbar-toggle");
	var menu = document.querySelector(".menu");
	var mask = document.querySelector(".mask");
	var area = document.getElementsByTagName("html")[0];
	
	// TOOLTIP //
	$('[data-toggle="dropdown"][title]').tooltip();
	$('[data-toggle="modal"][title]').tooltip();
	$('[data-toggle="tap"][title]').tooltip();
	$('[data-toggle="tooltip"]').tooltip();
	
	
	// BUTTON REASSIGN DRIVER //
	$(document).on('change', '#driver', function(){
        $('#savedriver').show();
    });

	function activeMenu(){
		
		if(toggle.classList.contains("active") === true) {
			toggle.classList.remove("active");
			menu.classList.remove("active");
			mask.classList.remove("active");
			area.removeAttribute("style");
			mask.removeEventListener("click", activeMenu);
		} else {
			toggle.classList.add("active");
			menu.classList.add("active");
			mask.classList.add("active");
			area.style.overflow = "hidden";
			
		}

	}
	
	function bodyHandler(mask) {
      mask.addEventListener( "click", activeMenu);
    }
		
	toggle.addEventListener( "click", function() {
		activeMenu();
		bodyHandler(mask);
		
	});
	
	$('#functionSelect').change(function (event) {
		 
		target = $( event.target );
		
		if((target[0].value == 2) || (target[0].value == 3)){
			$('#driverAdd').collapse("show");
			$('#password').attr('minlength', "8");
		}else{
			$('#driverAdd').collapse("hide");
			$('#password').removeAttr("minlength");
		}
		
	 });

	$(document).on('change', '#customer', function(){
		var customer = $(this).val();
		if(customer == "newOne")
			location.href="../customer/newCustomer/order";
		if(customer !=''){
			// alert(customer);
			$.ajax({
				type:'POST',
				url:'../dispatch/buscaCustomer',
				data: {
					customer:customer
				},
				success: function(data){
					var conteudo = JSON.parse(data);
					$.each(conteudo, function(index, value){
						$('#email').val(value.customer_email);
						$('#phone').val(value.customer_phone);
						$('#address').val('');
						$('#address').val(value.customer_address);
						$('#complement').val(value.customer_addresscomp);
						$('#latitude').val(value.customer_lat);
						$('#longitude').val(value.customer_lng);
						$('#mapAdress').remove();
						$('.map').append('<div id="mapAdress" style="width: 100%; height: 370px"></div>');

						$('#mapAdress').locationpicker({
					    	location: {latitude: value.customer_lat, longitude: value.customer_lng},
					    	enableAutocomplete: true,
					    	radius:0,
					    	zoom:15,
					    	scrollwheel:0,
					    	inputBinding: {
					    		locationNameInput: $('#address')
					    	},
					    	enableAutocomplete: true,
					    onchanged: function(currentLocation, radius, isMarkerDropped) {
					      
					    	  $('#longitude').val(currentLocation.longitude);
					    	  $('#latitude').val(currentLocation.latitude);
					    	  // alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
					    	} 
					    });
					});
				}
			});
		}
	});
	 
	 //Search Open
	$( "#btnSearch" ).click(function() {
		
		dt = $( "#searchOp" ).hasClass('open');
		
		if(dt){
			$( "#searchOp" ).removeClass('open');
		}else{
			$( "#searchOp" ).addClass('open');
			setTimeout(function(){focusInput($( "#autocomplete" )); }, 100);
		}
		
	});
	
	function focusInput(obj){
		obj.focus();
	}

	var $counter = $("#notifications-count");
	var $list = $("#notifications-list");	
	var loopNotifications = null;

	// Inicializa o módulo de notificações	
	function initializeNotifications(){
		$counter.hide();
		
		// Evento de click no menu	de notificações
		$("#menu-messages-order").on("click", function(e){
			$list.html('<p class="text-center" style="padding: 10px 0 5px 0">Loading messages...</p>');
			// Atualiza o contador de novas mensagens ao clicar no menu de mensagens
			refreshNotificationCount();
			// Busca as mensagens
			loadNewNotifications();
		});	
		// executa quando o sistema abre a página
		refreshNotificationCount();
	}

	// Busca a lista de novas mensagens
	function loadNewNotifications(){
		$.ajax({
			type: 'GET',
			url: BASE_URL + ['dispatch','getUnreadMessages'].join('/'),
			success: function(response){
				$list.html( response );
			}
		});
	}

	// Atualiza o contador de mensagens do dispatch
	function refreshNotificationCount(){
		if (loopNotifications) {
			window.clearTimeout( loopNotifications );
		}
		// Busca a quantidade de novas notificações
		$.ajax({
			type: 'GET',
			dataType : 'json',
			url: BASE_URL + ['dispatch','countUnreadMessages'].join('/'),
			success: function(response){
				if (!!response.count && response.count > 0){
					$counter.show();
					$counter.html( response.count );
				} else {
					$counter.hide();
				}
				loopNotifications = window.setTimeout(function(){
					refreshNotificationCount();
				}, 5000);
			},
			error: function(){
				if (loopNotifications) window.clearTimeout( loopNotifications );
			}
		});	
	}

	// Inicializa o módulo de notificações
	initializeNotifications();
});

