<?php

get_header();

use App\PostTypesCardFactory;

$cardFactory = PostTypesCardFactory::getInstance();

?>

	<!-- Home timeline -->
	<section class="home">
		<div class="container">
			
			<?= $cardFactory->printHomeModule(2, 1); ?>
			<?= $cardFactory->printHomeModule(1, 2); ?>
			<?= $cardFactory->printHomeModule(2, 1); ?>

			<?= include 'pagination.php'; ?>

		</div>
	</section>

	<!--<script src="/js/script.js"></script>-->

<?php get_footer() ?>