<?php require_once 'includes/S_header.php'; ?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="glyphicon glyphicon-check"></i>	Edit Profile
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">
            <div class="form-group">
	        	<label for="description" class="col-sm-3 control-label">Student Number </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="description" placeholder="" name="description" autocomplete="off" required>
				    </div>
	        </div> <!-- /form-group-->	    

	        <div class="form-group">
	        	<label for="quantity" class="col-sm-3 control-label">Last name </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control" id="quantity" placeholder="" name="quantity" autocomplete="off" required>
				    </div>
	        </div> <!-- /form-group-->	        	 

	        <div class="form-group">
	        	<label for="serialNumber" class="col-sm-3 control-label">First name </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="serialNumber" placeholder="" name="serialNumber" autocomplete="off">
				    </div>
	        </div>
            <div class="form-group">
	        	<label for="propertyNumber" class="col-sm-3 control-label">College </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="propertyNumber" placeholder="" name="propertyNumber" autocomplete="off" >
				    </div>


	        </div>
			<div class="form-group">
	        	<label for="propertyNumber" class="col-sm-3 control-label">Program </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="propertyNumber" placeholder="" name="propertyNumber" autocomplete="off" >
				    </div>
	        </div>
			<div class="form-group">
	        	<label for="remarks" class="col-sm-3 control-label">Year Level  </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="remarks" placeholder="" name="remarks" autocomplete="off" >
				    </div>
	        </div>
    

			</div>
			<!-- /panel-body -->
		</div>
	</div>
	<!-- /col-dm-12 -->
</div>
<!-- /row -->

<script src="custom/js/report.js"></script>

<?php require_once 'includes/footer.php'; ?>

