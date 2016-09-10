<?php

use App\PostTypesCardFactory;

$cardFactory = PostTypesCardFactory::getInstance();

?>
<div class="articleList__grid-list articleList__grid-list-m articleList__grid-list-s">
	<?php
	if (have_posts()) {
		while ($post = $cardFactory->getCard()) {
			echo $post;
		}
	}
	?>
</div>
