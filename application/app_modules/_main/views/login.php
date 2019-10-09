<div class="login-page container-fluid" style="height:100%;">
	<div class="login-box panel" style="padding:10px;">
  	<div class="login-logo">
    	<a href="#"><b>KLIP PLASTIK</b></a>
			<img src="<?php echo base_url(); ?>assets/images/logo_plastik.png" width="60px" height="60px">
  	</div>
  	<!-- /.login-logo -->
  	<div class="login-box-body">
    	<h3 class="login-box-msg">Silahkan Login</h3>
    	<?php echo form_open(base_url().'_main/main/login'); ?>
      	<div class="form-group has-feedback">
        	<input type="text" name="txt_username" class="form-control" placeholder="Nama Pengguna" title="Masukan Nama Pengguna" required oninvalid="this.setCustomValidity('Username Tidak Boleh Kosong!');">
        	<span class="glyphicon glyphicon-user form-control-feedback"></span>
      	</div>
      	<div class="form-group has-feedback">
        	<input type="password" name="txt_password" class="form-control" placeholder="Kata Sandi" title="Masukan Password" required oninvalid="this.setCustomValidity('Password Tidak Boleh Kosong!');">
        	<span class="glyphicon glyphicon-lock form-control-feedback"></span>
      	</div>
	      <div class="row">
					<div class="col-xs-2"></div>
	        <div class="col-xs-8">
	          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
	        </div>
	      </div>
    	<?php echo form_close(); ?>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
</div>
