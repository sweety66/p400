<div class="login">
<div class="dialog loginform">
	<?php
	$msg = $this->session->flashdata('msg');
	if (isset($msg)) {
		echo $msg;
	}
	?>
	<div class="panel panel-default">
		<p class="panel-heading no-collapse">Log In</p>
		<div class="panel-body signin logf">
			<form action="<?php echo base_url("user/loginForm"); ?>" method="post">
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username" class="form-control span12" required />
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" class="form-control span12 form-control" required />
				</div>
				<div class="form-group text-center">
					<input type="submit" value="Login" class="btn btn-lg btn-primary">
				</div>
				<div class="clearfix"></div>
			</form>
		</div>
	</div>
</div>
</div>