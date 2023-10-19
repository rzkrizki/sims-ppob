<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>

<div class="container">
	<div class="inline">
		<?php foreach($services->data as $row){ ?>
			<a href="<?= base_url('payment/'.strtolower($row->service_code)) ?>"><img src="<?= $row->service_icon ?>" alt="<?= $row->service_name ?> Logo"></a>
		<?php } ?>
	</div>
	<div class="mt-3 mx-3">
		<h6 class="text-grey"><strong>Temukan promo yang menarik</strong></h6>
		<div class="inline_banner">
			<?php foreach($banner->data as $row){ ?>
				<img src="<?= $row->banner_image ?>" alt="<?= $row->banner_name ?> 1">
			<?php } ?>
		</div>
	</div>
</div>

<?= $this->endSection() ?>