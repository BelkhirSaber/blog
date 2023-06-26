<main class="d-flex w-100">
		<div class="container">
      <!-- show error -->
      <?php if (isset($flash['errors'])) :?>
        <div class="row justify-content-center mt-5">
          <div class="col-sm-10 col-md-8 col-lg-6">
              <?php foreach($flash['errors'] as $error) :?>
                <p class="alert alert-danger p-3"><?= $error ?></p>
              <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
      <!-- end show error -->
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Welcome back, Admin</h1>
							<p class="lead">
								Sign in to your account to continue
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<div class="text-center">
										<img src="<?= $config->get('app.url') ?>blog/assets/images/avatars/avatar.jpg" alt="Charles Hall" class="img-fluid rounded-circle" width="132" height="132" />
									</div>
									<form action="/blog/admin/login" method ="POST">
										<div class="mb-3">
											<label class="form-label">Username</label>
											<input class="form-control form-control-lg" type="text" name="username" placeholder="Enter username" required/>
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" />
											<small>
                        <a href="pages-reset-password.html">Forgot password?</a>
                      </small>
										</div>
                    <input type="hidden" name="<?= $csrf['key']?>" value="<?= $csrf['value']?>">
										<div class="text-center mt-3">
											<button type="submit" class="btn btn-lg btn-primary">Sign in</button>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>