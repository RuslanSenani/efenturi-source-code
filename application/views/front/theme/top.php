<nav class="nav-bar  navbar-expand-lg navbar-light my-second-navbar">
	<div class="container-fluid">
		<div class="row">
			<a class="navbar-brand logo" href="<?= base_url(); ?>">
				<img width="100" src="<?= get_img('main-page-img/logo.png'); ?>" alt="logo">
			</a>

			<button class="navbar-toggler m-auto navbar" type="button" data-toggle="collapse" data-target="#open">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse my-list-menu " id="open">
				<ul class="nav justify-content-end ml-auto header-menu">

					<?php
					$menu = $this->home_model->get_header_menu();

					foreach ($menu as $m) :

						$child_menu = $this->home_model->get_header_menu($m['page_id']);

					?>
						<li class="nav-item hover-menu">
							<a href="<?= get_base_url($m['url_tag']); ?>" class="nav-link">
								<?= $m['title']; ?></a>
							<?php if (count($child_menu) > 0) :  ?>
								<ul class="sub_menu">
									<?php foreach ($child_menu as $cm) : ?>
										<li>
											<a href="<?= get_base_url($m['url_tag'] . '/' . $cm['url_tag']); ?>">
												<?= $cm['title']; ?>
											</a>
										</li>
									<?php endforeach; ?>

								</ul>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>

					<div class="form-inline mr-auto" action="">
						<div class="button-header">
							<a href="<?= get_base_url('search_query'); ?>" class="">
								<?= $string['event']; ?></a>
						</div>
					</div>
					<div class="form-inline mr-auto" action="">
						<div class="button-header">
							<a href="<?= get_base_url('blogs'); ?>" class="">
								<?= $string['media']; ?></a>
						</div>
					</div>
					<div class="form-inline mr-auto" action="">
						<div class="button-header">
							<a href="<?= get_base_url('organizer_post'); ?>" class="">
								<?= $string['organizer_job_button']; ?></a>
						</div>
					</div>
					<!--  -->
					<div class="form-inline mr-auto" action="">
						<div class="button-header">
							<a href="<?= get_base_url('organizer'); ?>" class="">
								<?= $string['organizer_button']; ?></a>
						</div>
					</div>
					<div class="form-inline mr-auto" action="">
						<div class="button-header">
							<a href="<?= get_base_url('addevent'); ?>" class="btn">
								<i class="fas fa-plus"></i>
								<?= $string['add_event_button']; ?></a>
						</div>
					</div>





				</ul>
			</div>
		</div>
	</div>
</nav>