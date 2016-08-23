angular.module("rcsprev", []);
angular.module("rcsprev").controller("gridController", function ($scope, $http)
{
	var base_url_js = $('#base_url_js').val();
	$scope.produtos = '';
	$scope.id_categoria = '';
	$scope.paginas = Array();
	$scope.btnClass = false;
	$scope.gridProdutosPag = function(pagina, inicio){
		
		if($scope.id_categoria!= ''){
			$scope.BuscaClickGridProdutosPag($scope.id_categoria);
		}else{

			if(!inicio){
				$('html, body').animate({scrollTop: '700px'}, 800);
			}
			$('.DvProdutos').show(300);
			$('.DvProdutos').html('Carregando...');
			$http({
				url: base_url_js+"produto/getProdutosPagination", 
				method: "POST",
				type:'JSON',
				params: {pagina: pagina}
			}).success(function(data){
				if(data.dados.length>0){
					$('.DvProdutos').hide(300);
					$('.DvProdutos').html('');
				}else{
					$('.DvProdutos').show(300);
					$('.DvProdutos').html('Nenhum produto encontrado!');
				}
				$scope.produtos = data.dados;

				for(i=0; i<data.paginas; i++){
					$scope.paginas[i] = i+1;
				}
			});

		}
	}

	$scope.BuscaGridProdutosPag = function(){
		$('html, body').animate({scrollTop: '700px'}, 800);
		$scope.id_categoria = '';
		// var listCategorias = $scope.listCategorias;
		var listProduto = $scope.listProduto;

		$('.DvProdutos').html('Carregando...');
		$('.DvProdutos').show(300);
		$http({
			url: base_url_js+"produto/getProdutosPagination", 
			method: "POST",
			type:'JSON',
			params: {pagina: 1, listProduto:listProduto}
		}).success(function(data){
			if(data.dados.length>0){
				$('.DvProdutos').hide(300);
				$('.DvProdutos').html('');
			}else{
				$('.DvProdutos').show(300);
				$('.DvProdutos').html('Nenhum produto encontrado!');
			}
			$scope.produtos = data.dados;

			for(i=0; i<data.paginas; i++){
				$scope.paginas[i] = i+1;
			}
		});
	}

	$scope.BuscaClickGridProdutosPag = function(id_categoria){
		$('html, body').animate({scrollTop: '700px'}, 800);
		
		$scope.id_categoria = id_categoria;
		var listCategorias = $scope.listCategorias;
		var listProduto = $scope.listProduto;

		$('.DvProdutos').show(300);
		$('.DvProdutos').html('Carregando...');
		$http({
			url: base_url_js+"produto/getProdutosPagination", 
			method: "POST",
			type:'JSON',
			params: {pagina: 1, id_categoria:id_categoria}
		}).success(function(data){
			// console.log(data.dados);
			if(data.dados.length>0){
				$('.DvProdutos').hide(300);
				$('.DvProdutos').html('');
			}else{
				$('.DvProdutos').show(300);
				$('.DvProdutos').html('Nenhum produto encontrado!');
			}
			$scope.produtos = data.dados;

			$scope.paginas = Array();
			for(i=0; i<data.paginas; i++){
				$scope.paginas.push(i+1);
			}
		});

	}
});