<!DOCTYPE html>
<html>
<head>
	<title>Edit Product</title>
	<link href="<?php echo base_url().'assets/css/bootstrap.css'?>" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="container">

	  <div class="row justify-content-md-center">
	    <div class="col col-lg-6">
	    	<h3>Edit Product:</h3>
	    	
	      	<form action="<?php echo site_url('product/update_product');?>" method="post">

	      		<div class="form-group">
				    <label>Product Name</label>
				    <input type="text" class="form-control" name="product_name" placeholder="Product Name" required>
				</div>

				<div class="form-group">
				    <label>Category</label>
				    <select class="form-control category" name="category" required>
				    	<option value="">No Selected</option>
				    	<?php foreach($category as $row):?>
				    	<option value="<?php echo $row->category_id;?>"><?php echo $row->category_name;?></option>
				    	<?php endforeach;?>
				    </select>
				</div>

				<div class="form-group">
				    <label>Sub Category</label>
				    <select class="form-control sub_category" name="sub_category" required>
				    	<option value="">No Selected</option>

				    </select>
				</div>

				<div class="form-group">
				    <label>Product Price</label>
				    <input type="number" class="form-control" name="product_price" placeholder="Product Price" required>
				</div>

				<input type="hidden" name="product_id" value="<?php echo $product_id?>" required>
				<button class="btn btn-success" type="submit">Update Product</button>

			</form>
	    </div>
	  </div>

	</div>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			//call function get data edit
			get_data_edit();

			$('.category').change(function(){ 
                var id=$(this).val();
                var subcategory_id = "<?php echo $sub_category_id;?>";
                $.ajax({
                    url : "<?php echo site_url('product/get_sub_category');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){

                        $('select[name="sub_category"]').empty();

                        $.each(data, function(key, value) {
                            if(subcategory_id==value.subcategory_id){
                                $('select[name="sub_category"]').append('<option value="'+ value.subcategory_id +'" selected>'+ value.subcategory_name +'</option>').trigger('change');
                            }else{
                                $('select[name="sub_category"]').append('<option value="'+ value.subcategory_id +'">'+ value.subcategory_name +'</option>');
                            }
                        });

                    }
                });
                return false;
            }); 

			//load data for edit
            function get_data_edit(){
            	var product_id = $('[name="product_id"]').val();
            	$.ajax({
            		url : "<?php echo site_url('product/get_data_edit');?>",
                    method : "POST",
                    data :{product_id :product_id},
                    async : true,
                    dataType : 'json',
                    success : function(data){
                        $.each(data, function(i, item){
                            $('[name="product_name"]').val(data[i].product_name);
                            $('[name="category"]').val(data[i].product_category_id).trigger('change');
                            $('[name="sub_category"]').val(data[i].product_subcategory_id).trigger('change');
                            $('[name="product_price"]').val(data[i].product_price);
                        });
                    }

            	});
            }
            
		});
	</script>
</body>
</html>