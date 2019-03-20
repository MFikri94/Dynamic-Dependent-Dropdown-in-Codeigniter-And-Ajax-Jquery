<!DOCTYPE html>
<html>
<head>
	<title>Product List</title>
	<link href="<?php echo base_url().'assets/css/bootstrap.css'?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url().'assets/css/datatables.css'?>" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="container">

	  <div class="row justify-content-md-center">
	    <div class="col col-lg-8">
	    	<h3>Product List</h3>
	    	<?php echo $this->session->flashdata('msg');?>
	    	<a href="<?php echo site_url('product/add_new');?>" class="btn btn-success btn-sm">Add New Product</a><hr/>
	      	<table class="table table-striped" id="mytable" style="font-size: 14px;">
	      		<thead>
	      			<tr>
	      				<th>No</th>
	      				<th>Product Name</th>
	      				<th>Category</th>
	      				<th>Sub Category</th>
	      				<th>Price</th>
	      				<th>Action</th>
	      			</tr>
	      		</thead>
	      		<tbody>
	      			<?php
	      				$no = 0;
	      				foreach ($products->result() as $row):
	      					$no++;
	      			?>
	      			<tr>
	      				<td><?php echo $no;?></td>
	      				<td><?php echo $row->product_name;?></td>
	      				<td><?php echo $row->category_name;?></td>
	      				<td><?php echo $row->subcategory_name;?></td>
	      				<td><?php echo number_format($row->product_price);?></td>
	      				<td>
	      					<a href="<?php echo site_url('product/get_edit/'.$row->product_id);?>" class="btn btn-sm btn-info">Edit</a>
	      					<a href="<?php echo site_url('product/delete/'.$row->product_id);?>" class="btn btn-sm btn-danger">Delete</a>
	      				</td>
	      			</tr>
	      			<?php endforeach;?>
	      		</tbody>
	      	</table>
	    </div>
	  </div>

	</div>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/datatables.js'?>"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#mytable').DataTable();
		});
	</script>
</body>
</html>