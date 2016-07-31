<!-- Footer -->
<footer class="footer">
	<!-- Instagram Gallery -->
	<ul class="instaGallery">
		<li class="instaGallery__item">
			<a class="instaGallery__link" href="" title="">
				<img class="instaGallery__image" src="<?= bloginfo("template_directory") ?>/img/demo/instagram_0.jpg" alt="" />
			</a>
		</li>
		<li class="instaGallery__item">
			<a class="instaGallery__link" href="" title="">
				<img class="instaGallery__image" src="<?= bloginfo("template_directory") ?>/img/demo/instagram_1.jpg" alt="" />
			</a>
		</li>
		<li class="instaGallery__item">
			<a class="instaGallery__link" href="" title="">
				<img class="instaGallery__image" src="<?= bloginfo("template_directory") ?>/img/demo/instagram_2.jpg" alt="" />
			</a>
		</li>
		<li class="instaGallery__item">
			<a class="instaGallery__link" href="" title="">
				<img class="instaGallery__image" src="<?= bloginfo("template_directory") ?>/img/demo/instagram_3.jpg" alt="" />
			</a>
		</li>
		<li class="instaGallery__item">
			<a class="instaGallery__link" href="" title="">
				<img class="instaGallery__image" src="<?= bloginfo("template_directory") ?>/img/demo/instagram_4.jpg" alt="" />
			</a>
		</li>
		<li class="instaGallery__item">
			<a class="instaGallery__link" href="" title="">
				<img class="instaGallery__image" src="<?= bloginfo("template_directory") ?>/img/demo/instagram_5.jpg" alt="" />
			</a>
		</li>
		<li class="instaGallery__item">
			<a class="instaGallery__link" href="" title="">
				<img class="instaGallery__image" src="<?= bloginfo("template_directory") ?>/img/demo/instagram_6.jpg" alt="" />
			</a>
		</li>
		<li class="instaGallery__item">
			<a class="instaGallery__link" href="" title="">
				<img class="instaGallery__image" src="<?= bloginfo("template_directory") ?>/img/demo/instagram_7.jpg" alt="" />
			</a>
		</li>
		<li class="instaGallery__item">
			<a class="instaGallery__link" href="" title="">
				<img class="instaGallery__image" src="<?= bloginfo("template_directory") ?>/img/demo/instagram_8.jpg" alt="" />
			</a>
		</li>
	</ul>
	<!-- Footer bottom -->
	<div class="container">
		<div class="footer__bottom grid-2">
			<div class="txtcenter">
				<div class="footer__collectif">
					<a href="" title="Le collectif Perspectives">
						<img src="<?= bloginfo("template_directory") ?>/img/logo-collectif.svg" alt="Le collectif Perspectives" />
					</a>
				</div>
			</div>
			<div class="txtcenter">
				<div class="footerContact">
					<ul>
						<li class="footerSocial">
							Restez en contact<br/>
							<a class="footerSocial__item" href="" title="Profil Twitter">
								<img src="<?= bloginfo("template_directory") ?>/img/ico-twitter.svg" alt="Twitter" />
							</a>
							<a class="footerSocial__item" href="" title="Chaine Youtube">
								<img src="<?= bloginfo("template_directory") ?>/img/ico-youtube.svg" alt="Youtube" />
							</a>
							<a class="footerSocial__item" href="" title="Profil Instagram">
								<img src="<?= bloginfo("template_directory") ?>/img/ico-instagram.svg" alt="Instagram" />
							</a>
							<a class="footerSocial__item" href="" title="Page Facebook">
								<img src="<?= bloginfo("template_directory") ?>/img/ico-facebook.svg" alt="Facebook" />
							</a>
							<a class="footerSocial__item" href="" title="Flux RSS">
								<img src="<?= bloginfo("template_directory") ?>/img/ico-rss.svg" alt="RSS" />
							</a>
						</li>
						<li>
							<a href="" title="">À propos</a>
						</li>
						<li>
							<a href="" title="">Contact</a>
						</li>
						<li>
							<a href="" title="">Mentions Légales</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</footer>

<?php get_search_form() ?>

<?php wp_enqueue_script("script", get_template_directory_uri() . '/js/script.js'); ?>
<?php wp_footer() ?>

</body>
</html>