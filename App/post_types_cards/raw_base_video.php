<?php

return '<a class="{{the_class_size}} fpostVideo"
			   href="{{the_permalink}}"
			   style="background-image: url({{the_thumbnail}})">
				<div class="fpostVideo__content">
					<h2 class="fpostVideo__title">{{the_title}}</h2>
					<div class="fpostVideo__play">
						<svg xmlns="http://www.w3.org/2000/svg" width="70" viewBox="-1 -1 62 62">
							<path class="fpostVideo__playTriangle" fill="transparent" fill-rule="evenodd" stroke="#FFF"
							      stroke-width="2"
							      d="M30 60c16.57 0 30-13.43 30-30S46.57 0 30 0 0 13.43 0 30s13.43 30 30 30zm-8-41.01c0-1.65 1.136-2.274 2.545-1.387l16.91 10.646c1.405.884 1.41 2.317 0 3.204L24.545 42.1c-1.405.886-2.545.267-2.545-1.387V18.99z"/>
						</svg>
					</div>
					<div class="fpostVideo__cat">
						{{the_type_icon}}
						{{the_categories}}
					</div>
				</div>
			</a>';