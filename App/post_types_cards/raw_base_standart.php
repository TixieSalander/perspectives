<?php
return '<a class="{{the_class_size}} fpostArticle"
		   href="{{the_permalink}}">
			<div class="fpostArticle__image"
			     style="background-image: url({{the_thumbnail}});"></div>
			<div class="fpostArticle__content">
				<h2 class="fpostArticle__title">{{the_title}}</h2>
				<div class="fpostArticle__cat">
					{{the_type_icon}}
					{{the_type_name}}
				</div>
			</div>
		</a>';