<?php
get_header();
$post_id = get_the_ID();

if (!wp_is_mobile()) {
	wp_redirect(home_url('lookbooks?id=' . $post_id));
}
?>

<style>
	.header-style-2 .container {
		max-width: 100% !important;
		width: 100% !important;
	}
	.share-this .buttons-container img {
        width: 20px !important;
    }
    .look_product_card .main-image-container img {
        width: auto !important;
    }
    .send-filters {
        padding: 0.75rem 0;
    }
</style>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/lookbooks/static/css/mobile.css?ver=7.0.0" type="text/css" charset="utf-8">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/lookbooks/static/css/flickity.css?ver=7.0.0" type="text/css" charset="utf-8" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/lookbooks/static/css/wpkf-single.css?ver=7.0.1" type="text/css" charset="utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, user-scalable=yes">


<div class="man  mobile   body_en">
	<script type="text/javascript">
		var region_url = '/en-us/';
		var cdn_host = '';
		var backoffice_store = 0;
		var currency = 'USD';
		var currency_json = {
			"iso": "USD",
			"symbol": "$"
		};
		var ready_callbacks = [];
		var ga_callbacks = [];
		var scripts_to_load = ["mobile.js", "blazy.min.js", "flickity.min.js"];
		var mobile_enabled = 1;
		var tablet_enabled = false;
		var dataLayer = [{
			"contentGroup1": "ShopTheLook",
			"contentGroup2": "STL_ficha",
			"contentGroup3": "STL_ficha_854",
			"region": "en-us",
			"lang": "en",
			"currency": {
				"iso": "USD",
				"symbol": "$"
			},
			"length_units": "in",
			"weigth_units": "lb",
			"gender": "man",
			"menu_item": "blue-blazer-with-jeans",
			"isAdmin": null,
			"mobile_device": true,
			"blackfriday": false,
			"blackfriday_voucher": false,
			"tablet_device": false,
			"mobile_ready": true,
			"mobile_enabled": true,
			"customer_logged": 0,
			"swiss_site": 0,
			"device_type": "mobile"
		}];
	</script>

	<div id="body_height" class=" ">

		<?php //get_template_part('lookbooks/part-header'); 
		?>

		<div id="body" class="blue-blazer-with-jeans">
			<div class="body_box ">

				<div class="look-detail-view">
					<div class="look_card" id="<?php the_ID(); ?>" data-slug="" data-title="<?php the_title(); ?>">
						<a class="image-container" rel="<?php the_permalink(); ?>">
							<div class="main-carousel">
								<?php
								$lookbooks = get_post_meta($post_id, 'wpkf_lookbooks', true);
								if (!empty($lookbooks['gallery'])) {
									$gallerys = explode(',', $lookbooks['gallery']);
									foreach ($gallerys as $attachment_id) {
										$image_link = wp_get_attachment_url($attachment_id);
										echo '<img class="carousel-cell" data-flickity-lazyload="' . $image_link . '" src="' .  $image_link . '" alt="' . $post->post_title . '" img-background="dark" >';
									}
								}
								?>
							</div>
						</a>
						<div class="info-container">
							<a class="text" href="<?php the_permalink(); ?>">
								<h4><?php the_title(); ?></h4>
								<p><?php the_content(); ?></p>
							</a>
							<div class="icons">
								<div class="icon">
									<div class="share-look">
										<img src="<?php echo get_template_directory_uri(); ?>/lookbooks/static/icons/share_black.svg" alt="share">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="products-look-container">
						<h3 class="look-products-title">Products in the outfit</h3>
						<div class="grid-products">

							<?php echo wpkf_get_lookbook_products($post_id); ?>

						</div>
					</div>
					<div class="blogger-look-container">
					</div>
					<div class="button-container">
						<a href="<?php echo home_url('lookbooks') ?>" class="back-to-looks">Back to Outfit Ideas</a>
						<span><?php echo wp_count_posts('lookbooks')->publish ?> looks available</span>
					</div>
				</div>


				<div class="background-share" id="background-share"></div>
				<div class="share-this" id="share-this">
					<span class="close-share-this">x</span>
					<div class="line-top"></div>
					<div class="share-this-container">
						<div class="share-title">
							<h4>Share this Outfit</h4>
							<p><?php the_title(); ?></p>
						</div>
						<div class="share-content-desktop">
							<div class="image-container">
								<picture>
									<source id="share-image-webp" srcset="" type="image/webp">
									<img id="share-image" src="" alt="">
								</picture>
							</div>
							<div class="buttons-container">
								<div class="share-btn share-link" id="share-link" rel="">
									<p>Copy link</p>
									<span class="share-icon">
										<img alt="copy link" src="<?php echo get_template_directory_uri(); ?>/lookbooks/static/picture/copy_link.svg" class="copy_link" width="20">
									</span>
								</div>

								<div class="share-btn download-image" id="download-image">
									<p>Save image</p>
									<span class="share-icon">
										<img alt="save image" src="<?php echo get_template_directory_uri(); ?>/lookbooks/static/picture/save_image.svg" class="save_link" width="20">
									</span>
								</div>

								<div class="share-btn share-other" id="share-social" rel="">
									<p>Share</p>
									<span class="share-icon">
										<img alt="more" src="<?php echo get_template_directory_uri(); ?>/lookbooks/static/picture/more_share.svg" class="more_share" width="20">
									</span>
								</div>

							</div>
						</div>
					</div>
				</div>

				<script type="text/javascript">
					let look_title = 'Blue Blazer with Jeans';
					let consts3 = 'https://d1fufvy4xao6k9.cloudfront.net/';
					let texto_share = 'Do you like this outfit?';
					let mobile_device_share = true;

					ready_callbacks.push(function() {
						const shareComponent = document.getElementById('share-this')
						const backgroundShare = document.getElementById('background-share')
						let shareButtons = document.querySelectorAll('.share-look')
						let shareParent = document.querySelector('.share')
						const shareImage = document.getElementById('share-image')
						const shareImageWebp = document.getElementById('share-image-webp')
						const saveImage = document.getElementById('save-image')
						const btn = document.getElementById('downloadImage');
						let shareLinkBtn = document.getElementById('share-link')

						function downloadImage(source) {

							const url = source;
							const downloadName = "look_image.jpg" // Anchor download name
							const img = document.createElement("img"); // Create in-memory image
							img.addEventListener("load", () => {
								const a = document.createElement("a"); // Create in-memory anchor
								a.href = img.src; // href toward your server-image
								a.download = downloadName; // :)
								a.click(); // Trigger click (download)
							});
							//img.src = '/looks/fetchImage?url=' + url; // Request image from your server
							img.src = url;

						}

						$(document).on('click', ".download-image", function(evt) {
							downloadImage(shareImage.src)
						})
						$(document).on('click', ".share-look", function(evt) {

							if (evt.target.closest('.look-detail-view')) { //desde detalle de look
								let watermark_file = evt.target.closest('.look-detail-view').querySelector(
									'.look_card .carousel-cell').src

								shareImage.src = watermark_file;
								/*
								let filename = watermark_file.split("/")
								shareImage.src = consts3 + "looks/" + filename[filename.length - 2] + "/watermark_" +
									filename[filename.length - 1]
                                    */
								/*var webp_image=filename[filename.length - 1].replace(".jpg", ".webp")
								shareImageWebp.srcset=consts3 + "looks/" + filename[filename.length - 2] + "/watermark_" +webp_image;*/

								document.getElementById('share-link').setAttribute('rel', evt.target.closest(
									'.look-detail-view').querySelector('.image-container').rel)

								if (mobile_device_share) {
									document.getElementById('share-social').setAttribute('rel', window.location.pathname)
								}

							} else if (evt.target.closest('.look_card')) { //desde looks

								let watermark_file = evt.target.closest('.look_card').querySelector(
									'.carousel-cell').src

								shareImage.src = watermark_file;
								/*
								let filename = watermark_file.split("/")
								shareImage.src = consts3 + "looks/" + filename[filename.length - 2] + "/watermark_" +
									filename[filename.length - 1]
									*/

								/*var webp_image=filename[filename.length - 1].replace(".jpg", ".webp")
								shareImageWebp.srcset=consts3 + "looks/" + filename[filename.length - 2] + "/watermark_" +webp_image;*/

								document.getElementById('share-link').setAttribute('rel', evt.target.closest(
									'.look_card').querySelector('.image-container').rel)

								if (mobile_device_share) {
									let url_look = window.location.pathname + evt.target.closest('.look_card').id + "-" + evt.target.closest('.look_card').getAttribute('data-slug')
									document.getElementById('share-social').setAttribute('rel', url_look)
								}

							}

							toggleShareComponent()

						})

						backgroundShare.addEventListener('click', () => {
							toggleShareComponent()
						})

						$('.close-share-this').click(function() {
							toggleShareComponent()
						})

						const toggleShareComponent = () => {
							if (shareComponent.classList.contains('show')) {
								backgroundShare.classList.remove('show')
								shareComponent.classList.remove('show')
								document.body.style.overflow = "auto"
							} else {
								backgroundShare.classList.add('show')
								shareComponent.classList.add('show')
								document.body.style.overflow = "hidden"
							}

						}
						shareLinkBtn.addEventListener('click', (e) => {

							shareLinkBtn.classList.add('copied')
							let text = shareLinkBtn.getElementsByTagName('p')[0]
							text.innerHTML = "Copied"

							let $temp = $("<input>");
							let $url = document.querySelector('.share-link').attributes.rel.value
							$("body").append($temp);
							$temp.val($url).select();
							document.execCommand("copy");
							$temp.remove();
							setTimeout(function() {
								text.innerHTML = "Copy link"
								shareLinkBtn.classList.remove('copied')
							}, 5000);

						})

						$('#share-social').click(function(event) {

							const shareData = {
								url: $(this).attr('rel'),
								text: texto_share
							}
							if (navigator.canShare && navigator.canShare(shareData)) {
								navigator.share(shareData).then(
									function() {
										dataLayer.push({
											'event': 'share_product',
											'eventCategory': 'share_product',
											'eventAction': 'native',
											'eventLabel': 'mobile'
										});
									}
								).catch(
									function(error) {
										console.log('Error sharing', error);
									}
								);
							}


						});

					})
				</script>

				<script type="text/javascript">
					const mobile_device = true


					ready_callbacks.push(function() {
						//carousel
						$('.main-carousel').each(function() {
							$(this).flickity({
								// options
								cellAlign: 'left',
								contain: true,
								prevNextButtons: mobile_device ? false : true,
								draggable: mobile_device ? true : false,
								lazyLoad: true,
								dragThreshold: 30,
								wrapAround: true
							});
							change_headerLogo();
						})

						//Canvi logo al canviar d'imatge
						$('.main-carousel').on('change.flickity', function(event, index) {
							change_headerLogo();
						});

						//add to cart
						document.querySelectorAll('.cart-icons').forEach((cartIcons) => {
							let add = cartIcons.querySelector('.add-to-cart')
							let loader = cartIcons.querySelector('.loader')
							let done = cartIcons.querySelector('.added-to-cart')
							const url = cartIcons.closest(".look_product_card").getAttribute('rel')


							cartIcons.addEventListener('click', () => {
								location.href = url
								/*
								if (done.classList.contains('show')) return false
								add.classList.remove('show')
								loader.classList.add('show')

								$.get(url, {
										ajax: true
									})
									.done(function(data) {
										loader.classList.remove('show')
										done.classList.add('show')
										setTimeout(function() {
											add.classList.add('show')
											done.classList.remove('show')
										}, 5000);
									});
									*/
							})

						})

					})

					//Canvi de color header
					function change_headerLogo() {
						var img_background = $('.flickity-slider .is-selected').attr('img-background');
						if (img_background == 'bright') {
							$('.logo_toolbar').addClass('invert_logo');
						} else if (img_background == 'dark') {
							$('.logo_toolbar').removeClass('invert_logo');
						} else {
							img_background = $('.carousel-cell').attr('img-background');
							if (img_background == 'bright') {
								$('.logo_toolbar').addClass('invert_logo');
							} else if (img_background == 'dark') {
								$('.logo_toolbar').removeClass('invert_logo');
							}
						}
					}

					//Executa la funció directament, és per quan només hi ha una imatge i no hi ha flickity
					document.addEventListener("DOMContentLoaded", function(event) {
						change_headerLogo();
					});
				</script>
			</div>
		</div>

	</div>

	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/lookbooks/static/js/mobile.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/lookbooks/static/js/blazy.min.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/lookbooks/static/js/flickity.min.js" charset="utf-8"></script>

	<script type="text/javascript">
		$(function() {
			for (var i = 0; i < ready_callbacks.length; i++) {
				try {
					ready_callbacks[i]();
				} catch (ex) {
					console.log(ex);
				}
			}
			if (typeof(afterJquery) == 'function') afterJquery();
		});
	</script>

</div>

<?php get_footer();
?>