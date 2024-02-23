<div class="row justify-content-center">
	<div class="col-md-6 text-center mb-2">
		<h2 class="heading-section text-white-50">HRIS</h2>
	</div>
</div>
<div class="row justify-content-center">
	<div class="col-md-7 col-lg-5">
		<div class="wrap">
			<!-- <div class="img" style="background-image: url('<?= base_url('assets/') ?>');"></div> -->
			<div class="login-wrap p-4 p-md-5">
				<div class="d-flex">
					<div class="w-100">
						<h3 class="mb-2">Please Login!</h3>
						<?= $this->session->flashdata('message'); ?>
					</div>
				</div>
				<?= $this->session->flashdata('message'); ?>
				<form action="<?= base_url('auth'); ?>" method="POST" class="signin-form">
					<div class="form-group mt-2">
						<label for="username">Username</label>
						<input type="text" name="username" id="username" class="form-control" value="<?= set_value('username'); ?>" placeholder="username" autocomplete="off">
						<?= form_error('username', '<small class="text-danger">', '</small>'); ?>
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<div class="input-group">
							<input type="password" name="password" id="password" class="form-control" placeholder="Password">
							<div class="input-group-append">
								<span id="mybutton" onclick="change()" class="input-group-text">
									<i class="fa fa-eye"></i>
								</span>
							</div>
						</div>
						<?= form_error('password', '<small class="text-danger">', '</small>'); ?>
					</div>
					<div class="form-group">
						<button type="submit" class="form-control btn btn-primary rounded submit px-3">Log In</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>