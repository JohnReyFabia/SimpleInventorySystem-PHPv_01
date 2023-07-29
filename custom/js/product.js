var manageProductTable;

$(document).ready(function() {
	// top nav bar 
	$('#navProduct').addClass('active');
	// manage product data table
	manageProductTable = $('#manageProductTable').DataTable({
		'ajax': 'php_action/fetchProduct.php',
		'order': []
	});

	// add product modal btn clicked
	$("#addProductModalBtn").unbind('click').bind('click', function() {
		// // product form reset
		$("#submitProductForm")[0].reset();		

		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');

		$("#productImage").fileinput({
	      overwriteInitial: true,
		    maxFileSize: 2500,
		    showClose: false,
		    showCaption: false,
		    browseLabel: '',
		    removeLabel: '',
		    browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
		    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
		    removeTitle: 'Cancel or reset changes',
		    elErrorContainer: '#kv-avatar-errors-1',
		    msgErrorClass: 'alert alert-block alert-danger',
		    defaultPreviewContent: '<img src="assests/images/photo_default.png" alt="Profile Image" style="width:100%;">',
		    layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
	  		allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"]
			});   
		//submit product form
			$("submitProductForm").unbind('submit').bind('submit',function(){
				
				var productImage 	= $("#productImage").val();
				var description  	= $("#description").val();
				var quantity	 	= $("#quantity").val();
				var serialNumber	= $("#serialNumber	").val();
				var propertyNumber 	= $("#propertyNumber").val();
				var sizeName	 	= $("#sizeName	").val();
				var categoryName 	= $("#categoryName").val();
				var locationName 	= $("#locationName").val();
				var productStatus	= $("#productStatus").val();
				var remarks			= $("#remarks").val();


				if(productImage == ""){
					$("#productImage").closest('.center-block').after('<p class="text-danger"> The image field is required.</p>');
					$("#productImage").closest('.form-group').addclass('has-error');
				}else{
				$("#productImage").find('.text-danger').remove();
				$("#productImage").closest('.form-group').addClass('has-success');
				}//else
				
				if(description == ""){
					$("#description").after('.center-block').after('<p class="text-danger"> Description field is required.</p>');
					$("#description").closest('.form-group').addclass('has-error');
				}else{
				$("#description").find('.text-danger').remove();
				$("#description").closest('.form-group').addClass('has-success');
				}//else
				
				if(quantity == ""){
					$("#quantity").after('.center-block').after('<p class="text-danger"> Quantity field is required.</p>');
					$("#quantity").closest('.form-group').addclass('has-error');
				}else{
				$("#quantity").find('.text-danger').remove();
				$("#quantity").closest('.form-group').addClass('has-success');
				}//else

				if(serialNumber == ""){
					$("#serialNumber").after('.center-block').after('<p class="text-danger"> The image field is required.</p>');
					$("#serialNumber").closest('.form-group').addclass('has-error');
				}else{
				$("#serialNumber").find('.text-danger').remove();
				$("#serialNumber").closest('.form-group').addClass('has-success');
				}//else

				if(propertyNumber == ""){
					$("#propertyNumber").after('.center-block').after('<p class="text-danger"> The image field is required.</p>');
					$("#propertyNumber").closest('.form-group').addclass('has-error');
				}else{
				$("#propertyNumber").find('.text-danger').remove();
				$("#propertyNumber").closest('.form-group').addClass('has-success');
				}//else

				if(sizeName == ""){
					$("#sizeName").after('.center-block').after('<p class="text-danger"> The image field is required.</p>');
					$("#sizeName").closest('.form-group').addclass('has-error');
				}else{
				$("#sizeName").find('.text-danger').remove();
				$("#sizeName").closest('.form-group').addClass('has-success');
				}//else

				if(categoryName == ""){
					$("#categoryName").after('.center-block').after('<p class="text-danger"> The image field is required.</p>');
					$("#categoryName").closest('.form-group').addclass('has-error');
				}else{
				$("#categoryName").find('.text-danger').remove();
				$("#categoryName").closest('.form-group').addClass('has-success');
				}//else

				if(locationName == ""){
					$("#locationName").after('.center-block').after('<p class="text-danger"> The image field is required.</p>');
					$("#locationName").closest('.form-group').addclass('has-error');
				}else{
				$("#locationName").find('.text-danger').remove();
				$("#locationName").closest('.form-group').addClass('has-success');
				}//else

				if(productStatus == ""){
					$("#productStatus").after('.center-block').after('<p class="text-danger"> The image field is required.</p>');
					$("#productStatus").closest('.form-group').addclass('has-error');
				}else{
				$("#productStatus").find('.text-danger').remove();
				$("#productStatus").closest('.form-group').addClass('has-success');
				}//else
				
				if(remarks == ""){
					$("#remarks").after('.center-block').after('<p class="text-danger"> The image field is required.</p>');
					$("#remarks").closest('.form-group').addclass('has-error');
				}else{
				$("#remarks").find('.text-danger').remove();
				$("#remarks").closest('.form-group').addClass('has-success');
				}//else
				

				if(productImage && description && quantity && serialNumber && propertyNumber && sizeName && categoryName &&locationName && productStatus && remarks){
	// submit loading button
	$("#createProductBtn").button('loading');

	var form = $(this);
	var formData = new FormData(this);

	$.ajax({
		url : form.attr('action'),
		type: form.attr('method'),
		data: formData,
		dataType: 'json',
		cache: false,
		contentType: false,
		processData: false,
		success:function(response) {

			if(response.success == true) {
				// submit loading button
				$("#createProductBtn").button('reset');
				
				$("#submitProductForm")[0].reset();

				$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
														
				// shows a successful message after operation
				$('#add-product-messages').html('<div class="alert alert-success">'+
		'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	  '</div>');

				// remove the mesages
	  $(".alert-success").delay(500).show(10, function() {
					$(this).delay(3000).hide(10, function() {
						$(this).remove();
					});
				}); // /.alert

	  // reload the manage student table
				manageProductTable.ajax.reload(null, true);

				// remove text-error 
				$(".text-danger").remove();
				// remove from-group error
				$(".form-group").removeClass('has-error').removeClass('has-success');

			} // /if response.success
		}
		})
	 } // /success function
	})

				})
				return false;
			})	

			function editProduct(productId = null) {

				if(productId) {
					$("#productId").remove();		
					// remove text-error 
					$(".text-danger").remove();
					// remove from-group error
					$(".form-group").removeClass('has-error').removeClass('has-success');
					// modal spinner
					$('.div-loading').removeClass('div-hide');
					// modal div
					$('.div-result').addClass('div-hide');
			
					$.ajax({
						url: 'php_action/fetchSelectedProduct.php',
						type: 'post',
						data: {productId: productId},
						dataType: 'json',
						success:function(response) {		
						// alert(response.product_image);
							// modal spinner
							$('.div-loading').addClass('div-hide');
							// modal div
							$('.div-result').removeClass('div-hide');				
			
							$("#getProductImage").attr('src', 'stock/'+response.product_image);
			
							$("#editProductImage").fileinput({		      
							});  
			
							$("#editProductImage").fileinput({
					      overwriteInitial: true,
						    maxFileSize: 2500,
						    showClose: false,
						    showCaption: false,
						    browseLabel: '',
						    removeLabel: '',
						    browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
						    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
						    removeTitle: 'Cancel or reset changes',
						    elErrorContainer: '#kv-avatar-errors-1',
						    msgErrorClass: 'alert alert-block alert-danger',
						    defaultPreviewContent: '<img src="stock/'+response.product_image+'" alt="Profile Image" style="width:100%;">',
						    layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
					  		allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"]
							});  
			
							// product id 
							$(".editProductFooter").append('<input type="hidden" name="productId" id="productId" value="'+response.product_id+'" />');				
							$(".editProductPhotoFooter").append('<input type="hidden" name="productId" id="productId" value="'+response.product_id+'" />');				
							
							// product name
							$("#editDescription").val(response.product_name);
							// quantity
							$("#editQuantity").val(response.quantity);
							// serialNumber
							$("#editSerialNumber").val(response.SerialNumber);
							// propertyNumber
							$("#editPropertyNumber").val(response.PropertyNumber);
							// Size name
							$("#editSizeName").val(response.brand_id);
							// category name
							$("#editCategoryName").val(response.categories_id);
							// category name
							$("#editLocationName").val(response.location_id);
							// status
							$("#editProductStatus").val(response.active);
							// remarks
							$("#editRemarks").val(response.active);
			
							// update the product data function
							$("#editProductForm").unbind('submit').bind('submit', function() {
			
							// 	// product name
							// $("#editDescription").val(response.product_name);
							// // quantity
							// $("#editQuantity").val(response.quantity);
							// // serialNumber
							// $("#editSerialNumber").val(response.SerialNumber);
							// // propertyNumber
							// $("#editPropertyNumber").val(response.PropertyNumber);
							// // Size name
							// $("#editSizeName").val(response.brand_id);
							// // category name
							// $("#editCategoryName").val(response.categories_id);
							// // category name
							// $("#editLocationName").val(response.location_id);
							// // status
							// $("#editProductStatus").val(response.active);
											
			
							if(description == "") {
								$("#editDescription").after('<p class="text-danger">Description field is required</p>');
								$('#editDescription').closest('.form-group').addClass('has-error');
							}	else {
								// remov error text field
								$("#editDescription").find('.text-danger').remove();
								// success out for form 
								$("#editDescription").closest('.form-group').addClass('has-success');	  	
							}	// /else
		
							if(quantity == "") {
								$("#editQuantity").after('<p class="text-danger">Quantity field is required</p>');
								$('#editQuantity').closest('.form-group').addClass('has-error');
							}	else {
								// remov error text field
								$("#editQuantity").find('.text-danger').remove();
								// success out for form 
								$("#editQuantity").closest('.form-group').addClass('has-success');	  	
							}	// /else
		
							if(serialNumber == "") {
								$("#editPropertyNumber").after('<p class="text-danger">Property Number field is required</p>');
								$('#editPropertyNumber').closest('.form-group').addClass('has-error');
							}	else {
								// remov error text field
								$("#editPropertyNumber").find('.text-danger').remove();
								// success out for form 
								$("#editPropertyNumber").closest('.form-group').addClass('has-success');	  	
							}	// /else
							if(propertyNumber == "") {
								$("#editSerialNumber").after('<p class="text-danger">Serial Number field is required</p>');
								$('#editSerialNumber').closest('.form-group').addClass('has-error');
							}	else {
								// remov error text field
								$("#editSerialNumber").find('.text-danger').remove();
								// success out for form 
								$("#editSerialNumber").closest('.form-group').addClass('has-success');	  	
							}	// /else
		
							if(sizeName == "") {
								$("#editSizeName").after('<p class="text-danger">Size field is required</p>');
								$('#editSizeName').closest('.form-group').addClass('has-error');
							}	else {
								// remov error text field
								$("#editSizeName").find('.text-danger').remove();
								// success out for form 
								$("#editSizeName").closest('.form-group').addClass('has-success');	  	
							}	// /else
		
							if(categoryName == "") {
								$("#editCategoryName").after('<p class="text-danger">Category field is required</p>');
								$('#editCategoryName').closest('.form-group').addClass('has-error');
							}	else {
								// remov error text field
								$("#editCategoryName").find('.text-danger').remove();
								// success out for form 
								$("#editCategoryName").closest('.form-group').addClass('has-success');	  	
							}	// /else
							if(locationName == "") {
								$("#editLocationName").after('<p class="text-danger">Location field is required</p>');
								$('#editLocationName').closest('.form-group').addClass('has-error');
							}	else {
								// remov error text field
								$("#editLocationName").find('.text-danger').remove();
								// success out for form 
								$("#editLocationName").closest('.form-group').addClass('has-success');	  	
							}	// /else
		
							if(productStatus == "") {
								$("#editProductStatus").after('<p class="text-danger">Product Status field is required</p>');
								$('#editProductStatus').closest('.form-group').addClass('has-error');
							}	else {
								// remov error text field
								$("#editProductStatus").find('.text-danger').remove();
								// success out for form 
								$("#editProductStatus").closest('.form-group').addClass('has-success');	  	
							}	// /else
							
							if(remarks == "") {
								$("#editRemarks").after('<p class="text-danger">Remarks field is required</p>');
								$('#editRemarks').closest('.form-group').addClass('has-error');
							}	else {
								// remov error text field
								$("#editRemarks").find('.text-danger').remove();
								// success out for form 
								$("#editRemarks").closest('.form-group').addClass('has-success');	  	
							}	// /else
			
							if(productImage && description && quantity && serialNumber && propertyNumber && sizeName && categoryName &&locationName && productStatus && remarks){
								// submit loading button
									$("#editProductBtn").button('loading');
			
									var form = $(this);
									var formData = new FormData(this);
			
									$.ajax({
										url : form.attr('action'),
										type: form.attr('method'),
										data: formData,
										dataType: 'json',
										cache: false,
										contentType: false,
										processData: false,
										success:function(response) {
											console.log(response);
											if(response.success == true) {
												// submit loading button
												$("#editProductBtn").button('reset');																		
			
												$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																						
												// shows a successful message after operation
												$('#edit-product-messages').html('<div class="alert alert-success">'+
										'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
										'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
									  '</div>');
			
												// remove the mesages
									  $(".alert-success").delay(500).show(10, function() {
													$(this).delay(3000).hide(10, function() {
														$(this).remove();
													});
												}); // /.alert
			
									  // reload the manage student table
												manageProductTable.ajax.reload(null, true);
			
												// remove text-error 
												$(".text-danger").remove();
												// remove from-group error
												$(".form-group").removeClass('has-error').removeClass('has-success');
			
											} // /if response.success
											
										} // /success function
									}); // /ajax function
								}	 // /if validation is ok 					
			
								return false;
							}); // update the product data function
			
							// update the product image				
							$("#updateProductImageForm").unbind('submit').bind('submit', function() {					
								// form validation
								var productImage = $("#editProductImage").val();					
								
								if(productImage == "") {
									$("#editProductImage").closest('.center-block').after('<p class="text-danger">Product Image field is required</p>');
									$('#editProductImage').closest('.form-group').addClass('has-error');
								}	else {
									// remov error text field
									$("#editProductImage").find('.text-danger').remove();
									// success out for form 
									$("#editProductImage").closest('.form-group').addClass('has-success');	  	
								}	// /else
			
								if(productImage) {
									// submit loading button
									$("#editProductImageBtn").button('loading');
			
									var form = $(this);
									var formData = new FormData(this);
			
									$.ajax({
										url : form.attr('action'),
										type: form.attr('method'),
										data: formData,
										dataType: 'json',
										cache: false,
										contentType: false,
										processData: false,
										success:function(response) {
											
											if(response.success == true) {
												// submit loading button
												$("#editProductImageBtn").button('reset');																		
			
												$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																						
												// shows a successful message after operation
												$('#edit-productPhoto-messages').html('<div class="alert alert-success">'+
										'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
										'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
									  '</div>');
			
												// remove the mesages
									  $(".alert-success").delay(500).show(10, function() {
													$(this).delay(3000).hide(10, function() {
														$(this).remove();
													});
												}); // /.alert
			
									  // reload the manage student table
												manageProductTable.ajax.reload(null, true);
			
												$(".fileinput-remove-button").click();
			
												$.ajax({
													url: 'php_action/fetchProductImageUrl.php?i='+productId,
													type: 'post',
													success:function(response) {
													$("#getProductImage").attr('src', response);		
													}
												});																		
			
												// remove text-error 
												$(".text-danger").remove();
												// remove from-group error
												$(".form-group").removeClass('has-error').removeClass('has-success');
			
											} // /if response.success
											
										} // /success function
									}); // /ajax function
								}	 // /if validation is ok 					
			
								return false;
							}); // /update the product image
			
						} // /success function
					}); // /ajax to fetch product image
			
							
				} else {
					alert('error please refresh the page');
				}
			} // /edit product function
			
// remove product 
function removeProduct(productId = null) {
	if(productId) {
		// remove product button clicked
		$("#removeProductBtn").unbind('click').bind('click', function() {
			// loading remove button
			$("#removeProductBtn").button('loading');
			$.ajax({
				url: 'php_action/removeProduct.php',
				type: 'post',
				data: {productId: productId},
				dataType: 'json',
				success:function(response) {
					// loading remove button
					$("#removeProductBtn").button('reset');
					if(response.success == true) {
						// remove product modal
						$("#removeProductModal").modal('hide');

						// update the product table
						manageProductTable.ajax.reload(null, false);

						// remove success messages
						$(".remove-messages").html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					} else {

						// remove success messages
						$(".removeProductMessages").html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert

					} // /error
				} // /success function
			}); // /ajax fucntion to remove the product
			return false;
		}); // /remove product btn clicked
	} // /if productid
} // /remove product function
			
			function clearForm(oForm) {
				// var frm_elements = oForm.elements;									
				// console.log(frm_elements);
				// 	for(i=0;i<frm_elements.length;i++) {
				// 		field_type = frm_elements[i].type.toLowerCase();									
				// 		switch (field_type) {
				// 	    case "text":
				// 	    case "password":
				// 	    case "textarea":
				// 	    case "hidden":
				// 	    case "select-one":	    
				// 	      frm_elements[i].value = "";
				// 	      break;
				// 	    case "radio":
				// 	    case "checkbox":	    
				// 	      if (frm_elements[i].checked)
				// 	      {
				// 	          frm_elements[i].checked = false;
				// 	      }
				// 	      break;
				// 	    case "file": 
				// 	    	if(frm_elements[i].options) {
				// 	    		frm_elements[i].options= false;
				// 	    	}
				// 	    default:
				// 	        break;
				//     } // /switch
				// 	} // for
			}
		//add items modal btn click
// /documents
