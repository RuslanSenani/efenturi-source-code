	<!------------footer-start------------>
	<footer>
		<div class="col-lg-12 footer-section">
			<div class="container-fluid">
				<div class="col-lg-12 col-xs-12">
					<div class="row bottom-border  justify-content-center">
						<div class="col-lg-2 footer-logo">
							<img src="<?= get_img('main-page-img/logo.png'); ?>" alt="logo">
						</div>
						<div class="col-lg-10 footer-menu">
							<?php
							if (!empty($this->home_model->get_footer_menu())) { ?>
								<ul>

									<?php foreach ($this->home_model->get_footer_menu() as $fm) : ?>

										<li>

											<a href="<?= get_base_url($fm[1]); ?>">
												<?= $fm[0]; ?>
											</a>
										</li>
									<?php endforeach; ?>

								</ul>
							<?php } ?>
						</div>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 justify-content-center d-flex social-ft">
						<ul>
							<?php if (!empty($contact['facebook'])) : ?>
								<li>
									<a title="Facebook" href="<?= $contact['facebook']; ?>"><i class="fab fa-facebook"></i></a>
								</li>
							<?php endif; ?>
							<?php if (!empty($contact['linked'])) : ?>
								<li>
									<a title="Linked" href="<?= $contact['linked']; ?>"><i class="fab fa-linkedin"></i></a>
								</li>
							<?php endif; ?>
							<?php if (!empty($contact['twitter'])) : ?>
								<li>
									<a title="Twitter" href="<?= $contact['twitter']; ?>"><i class="fab fa-twitter"></i></a>
								</li>
							<?php endif; ?>
							<?php if (!empty($contact['instagram'])) : ?>
								<li>
									<a title="Instagram" href="<?= $contact['instagram']; ?>"><i class="fab fa-instagram"></i></a>
								</li>
							<?php endif; ?>
							<?php if (!empty($contact['youtube'])) : ?>
								<li>
									<a title="Youtube" href="<?= $contact['youtube']; ?>"><i class="fab fa-youtube"></i></a>
								</li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-------------footer-end------------->
	<!-------------go-top-start----------->
	<div class="button-go-top">
		<a href="#" title="" class="go-top">
			<i class="fas fa-chevron-up"></i>
		</a>
	</div>

	<?php if (!$this->home_model->get_user() and false) : ?>
		<div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">

					<div class="modal-body">
						<form method="post" action="<?= get_base_url('login/submit'); ?>">
							<div class="form-group single">
								<label for=""><?= $string['email']; ?></label>
								<input type="email" name="email" id="" class="form-control">
								<div data-error="email"></div>
							</div>
							<div class="form-group single">
								<label for=""><?= $string['password']; ?>*</label>
								<input type="password" name="password" id="" class="form-control">
								<div data-error="password"></div>
							</div>
							<div class="text-center">
								<button class="btn btn-info" data-send-form="true" class="btn"><?= $string['login_button']; ?></button>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>

	<?php endif; ?>
	<!-------------go-top-end------------->