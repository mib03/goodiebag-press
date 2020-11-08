<div class="container">

	<!-- Outer Row -->
	<div class="row justify-content-center">

		<div class="col-lg-6">

			<div class="card o-hidden border-0 shadow-lg my-5">
				<div class="card-body p-0">
					<!-- Nested Row within Card Body -->
					<div class="row">
						<div class="col-lg">
							<div class="p-5">
								<div class="text-center">
									<h1 class="h4 text-gray-900 mb-4">Halaman Login</h1>
								</div>

								<?php if ($this->session->flashdata('flashWrong')) { ?>
									<div class="alert alert-danger" role="alert"> <?= $this->session->flashdata('flashWrong') ?> </div>
								<?php } else if ($this->session->flashdata('flashActivate')) { ?>
									<div class="alert alert-danger" role="alert"> <?= $this->session->flashdata('flashActivate') ?> </div>
								<?php } else if ($this->session->flashdata('flashRegister')) { ?>
									<div class="alert alert-danger" role="alert"> <?= $this->session->flashdata('flashRegister') ?> </div>
								<?php } else if ($this->session->flashdata('flashLogout')) { ?>
									<div class="alert alert-success" role="alert"> <?= $this->session->flashdata('flashLogout') ?> </div>
								<?php } ?>

								<form class="user" method="post" action="<?= base_url('auth'); ?>">
									<div class="form-group">
										<input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukkan username anda" value="<?= set_value('username') ?>">
										<?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>
									<div class="form-group">
										<input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
										<?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>
									<button type="submit" class="btn btn-primary btn-user btn-block">
										Login
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>

</div>
