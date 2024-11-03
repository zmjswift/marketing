<?php
get_header();

if (is_post_type_archive('lookbooks')) {
	$category_post_count = wp_count_posts('lookbooks')->publish;
	$title = dq('archive_lookbooks_title');
	$desc = dq('archive_lookbooks_desc');
} else {
	$cat_id = get_queried_object_id();
	$current_category = get_queried_object();
	$category_post_count = $current_category->count;
	$title = $current_category->name;
	$desc = $current_category->description;
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

<meta name="viewport" content="width=device-width, minimum-scale=1.0, user-scalable=yes">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/lookbooks/static/css/default.css" type="text/css" charset="utf-8" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/lookbooks/static/css/flickity.css" type="text/css" charset="utf-8" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/lookbooks/static/css/wpkf.css?ver=9.0.2" type="text/css" charset="utf-8" />

<div class="man  body_en mac" style="">
	<script type="text/javascript">
		var wpkf_lookbooks = {
			"ajax_url": "<?php echo admin_url('admin-ajax.php'); ?>",
			"ajax_nonce": "<?php echo wp_create_nonce('wpkf_lookbooks'); ?>"
		};
		var cat_id = "<?php echo $cat_id; ?>";

		var region_url = '';
		var cdn_host = '';
		var backoffice_store = 0;
		var currency = 'USD';
		var currency_json = {
			"iso": "USD",
			"symbol": "$"
		};
		var ready_callbacks = [];
		var ga_callbacks = [];
		var scripts_to_load = ["default.js", "blazy.min.js", "flickity.min.js"];
		var mobile_enabled = false;
		var tablet_enabled = false;
		var dataLayer = [{
			"contentGroup2": "STL_root",
			"contentGroup1": "ShopTheLook",
			"region": "en-us",
			"lang": "en",
			"currency": {
				"iso": "USD",
				"symbol": "$"
			},
			"length_units": "in",
			"weigth_units": "lb",
			"gender": "man",
			"menu_item": "look",
			"isAdmin": null,
			"mobile_device": false,
			"blackfriday": false,
			"blackfriday_voucher": false,
			"tablet_device": false,
			"mobile_ready": true,
			"mobile_enabled": false,
			"customer_logged": 0,
			"swiss_site": 0,
			"device_type": "desktop"
		}];
	</script>

	<div id="body_height" class=" ">
		<!-- header -->
		<?php //get_template_part('lookbooks/part-header'); 
		?>

		<div id="body" class="look">
			<div class="body_box ">

				<div class="looks-page">
					<div class="looks_header">
						<div class="header-info">
							<h1><?php echo $title; ?></h1>
							<p><?php echo $desc; ?></p>
						</div>

						<div id="button-filter-container">
							<div class="button-filter-container fixed">
								<div class="filter-content">
									<span class="btn-filter" id="btn-filter"><img src="<?php echo get_template_directory_uri(); ?>/lookbooks/static/picture/filter_list_black.svg" alt="">
										filters</span>
									<span id="total_looks"><?php echo $category_post_count ?> outfit styles</span>
								</div>
							</div>
						</div>

						<div class="grid-container">

							<?php get_template_part('lookbooks/part-filter'); ?>

							<div class="grid-looks" id="grid-looks">


								<?php if (have_posts()) : ?>

									<?php while (have_posts()) : the_post();
										get_template_part('lookbooks/part-card');
									endwhile; ?>

									<?php //get_template_part('parts/wpkf-pagination'); 
									?>
								<?php else : ?>
									<?php //get_template_part('parts/card/none'); 
									?>
								<?php endif; ?>


							</div>
						</div>

						<?php get_template_part('lookbooks/part-share'); ?>

						<div class="popup-detail-look">
							<div class="close-popup">
								<img src="<?php echo get_template_directory_uri(); ?>/lookbooks/static/picture/close.svg" width="20">
							</div>
							<div class="left-arrow">
								<img src="<?php echo get_template_directory_uri(); ?>/lookbooks/static/picture/arrow_left.svg" alt="">
							</div>
							<div id="detail-look-popup-container">

							</div>
							<div class="right-arrow">
								<img src="<?php echo get_template_directory_uri(); ?>/lookbooks/static/picture/arrow_right.svg" alt="">
							</div>
						</div>
						<div id="loading_image">
							<img src="<?php echo get_template_directory_uri(); ?>/lookbooks/static/picture/looks-loading.svg" alt="loading">
						</div>

					</div>

					<script type="text/javascript">
						const mobile_device = window.innerWidth < 786 ? true : false;
						let region = '';
						let popup_look_id = '<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>';
						let looks_base_link = '';

						ready_callbacks.push(function() {
						    
							var bLazy_grid = new Blazy({
								container: '.grid-looks'
							});
							const loadFlickity = (objects) => {
								objects.each(function() {
									$(this).flickity({
										// options
										cellAlign: 'left',
										contain: true,
										prevNextButtons: false,
										draggable: mobile_device ? true : false,
										lazyLoad: true,
										dragThreshold: 30,
										wrapAround: true,
										pageDots: mobile_device ? true : false,
									});
								})
							}

							if (mobile_device) {
								loadFlickity($('.main-carousel'));
							}

							$('.flickity-button.flickity-prev-next-button').click(function(e) {
								e.preventDefault()
							})

							//abrir filtro
							const openFilter = () => {
								document.getElementById('filter').style.display = "block"
								document.getElementById('filter-container').style.left = 0
								document.body.style.overflow = "hidden"
							}
							const closeFilter = () => {
								document.getElementById('filter').style.display = "none"
								document.getElementById('filter-container').style.left = "-100%"
								document.body.style.overflow = "auto"
							}
							document.getElementById('btn-filter').addEventListener('click', () => {
								openFilter()
							})

							//al clicar fuera del filtro, este se cierra
							document.getElementById('filter-container').addEventListener('click', (event) => {
								if (event.target.id == "filter-container") {
									closeFilter()
								}
							})


							let page = 1
							let loading = false
							let finished = false

							$(window).bind('scroll', function() {
								var scrollTop = $(window).scrollTop();
								var elementOffset = $('#button-filter-container').offset().top;
								var currentElementOffset = (elementOffset - scrollTop);
								if (currentElementOffset <= 0) {
									$('.button-filter-container').addClass("fixed");
								} else {
									$('.button-filter-container').removeClass("fixed");
								}
								//infinity loading_image
								if (loading || finished) return


								let px_to_scroll = $("#body").height() - $(window).height() - 300;


								if (scrollTop > px_to_scroll) {
									page++
									loading = true

									//$.get(window.location.href, {
									$.post(wpkf_lookbooks.ajax_url, {
										action: "wpkf_lookbooks_posts",
										nonce: wpkf_lookbooks.ajax_nonce,
										cat_id: cat_id,
										page: page,
										ajax: 1
									}, function(res) {
										if (res.trim() == '') {
											finished = true
											return true
										}
										$('.grid-looks').append(res)
										loading = false;

										if (mobile_device) {
											loadFlickity($('.main-carousel').not('.flickity-enabled'));
										}

									})
								}
							});


							$('#detail-look-popup-container').on('click', '.cart-icons', function() {
								const done = $('.added-to-cart', this)
								if (done.hasClass('show')) return false

								const add = $('.add-to-cart', this).removeClass('show')
								const loader = $('.loader', this).addClass('show')
								const url = this.closest(".look_product_card").getAttribute('rel')
								location.href = url
								/*
								$.get("/" + region + url, {
									ajax: true
								}).done(function(data) {
									loader.removeClass('show')
									done.addClass('show');
									setTimeout(function() {
										add.addClass('show')
										done.removeClass('show')
									}, 5000);
								});
								*/
							})


							const container = document.getElementById('detail-look-popup-container')
							let prev_id, next_id, prev_object, next_object

							const loading_image = (loading_image) => {
								return loading_image ? $('#loading_image').css('display', 'flex') : $('#loading_image').css('display',
									'none');
							}
							const popup_detail = document.getElementsByClassName('popup-detail-look')[0]

							const showPopup = () => {
								popup_detail.style.display = "flex"
								$('body').css('overflow', 'hidden');
							}
							const hidePopup = () => {
								popup_detail.style.display = "none"
								$('body').css('overflow', 'unset');
								let i = 1;
								if (popup_look_id && i == 1) {
									$("link[hreflang]").each(function(e) {
										let path = $(this).attr('href').substring(0, $(this).attr('href').length - 1)
										let url_base = path.substring(0, path.lastIndexOf('/') + 1);
										$(this).attr('href', url_base)

									})
									i--
								}
							}

							const loadLookPopup = (id, look_object = false, special_mode = false) => {
								loading_image(true)

								//$("#detail-look-popup-container").html("");

								var container = $("#detail-look-popup-container").empty();

								let slug = $("#" + id + ".look_card").data('slug')
								let look_title = $("#" + id + ".look_card").data('title')

								//let url = "https://test.wpkf.cn/lookbooks/%E6%B5%8B%E8%AF%951/"; //$("#" + id + ".look_card").data('url');

								//$.post('/' + region + "/" + looks_base_link + "/" + id + "-" + slug, {
								$.post(wpkf_lookbooks.ajax_url, {
									action: "wpkf_lookbooks",
									nonce: wpkf_lookbooks.ajax_nonce,
									post_id: id,
									ajax: "1",
									from_grid: "1"
								}, function(data) {

									//$("#detail-look-popup-container").empty();

									loading_image(false)
									showPopup();
									$(data).appendTo(container);

									//$(container).html(data);

									loadFlickity(container.find('.main-carousel'));

									dataLayer.push({
										event: 'pageview',
										page: {
											path: window.location.href,
											title: look_title
										},
										contentGroup1: 'ShopTheLook',
										contentGroup2: 'STL_ficha',
										contentGroup3: 'STL_ficha_' + id
									});
								})

								//si no hay key ocultamos flechas
								if (special_mode) {
									$('.right-arrow').hide()
									$('.left-arrow').hide()
									return;
								}

								if (look_object) {

									prev_id = $(look_object).prev().attr('id');

									if (prev_id) {
										prev_object = $("#" + prev_id + ".look_card")
										$('.left-arrow').removeClass('disabled')
									} else {
										$('.left-arrow').addClass('disabled')
									}

									next_id = $(look_object).next().attr('id');
									if (next_id) {
										next_object = $("#" + next_id + ".look_card")
										$('.right-arrow').removeClass('disabled')
									} else {
										$('.right-arrow').addClass('disabled')
									}
								}

							}

							if (popup_look_id) {
								loadLookPopup(popup_look_id, false, true)
							}

							if (!mobile_device) {
								document.querySelector('.left-arrow').addEventListener('click', () => {
									if (!prev_id) return false
									if (document.getElementById(prev_id)) {
										let temp_prev_url_look = document.getElementById(prev_id).querySelector(
												'.image-container')
											.getAttribute('href')

										window.history.replaceState({}, '', "" + region + temp_prev_url_look);
									}
									loadLookPopup(prev_id, prev_object)
								})

								document.querySelector('.right-arrow').addEventListener('click', () => {
									if (!next_id) return false
									if (document.getElementById(next_id)) {
										let temp_next_url_look = document.getElementById(next_id).querySelector('.image-container')
											.getAttribute('href')
										window.history.replaceState({}, '', "" + region + temp_next_url_look)
									}
									loadLookPopup(next_id, next_object)
								})

								document.querySelector('.popup-detail-look').addEventListener('click', (e) => {
									if (e.target.classList.contains('popup-detail-look')) {
										window.history.replaceState({}, '', "/lookbooks/");
										//window.history.replaceState({}, '', "/" + region + '/' + looks_base_link + '/');
										hidePopup()
									}
								})

							}

							$(".grid-looks").on('click', ".look_card", function(e) {



								if (!mobile_device) {
									e.preventDefault();
									if ($(e.target).parents('.share-look').length || $(e.target).hasClass('share-look') || $(e.target)
										.hasClass('icon') || $(e.target).hasClass('icons')) {
										return
									}

									if (window.innerWidth > 900) {
										e.preventDefault();
										let href_look = this.getAttribute('id');
										let new_look_url = this.querySelector('.image-container').getAttribute('href');

										window.history.replaceState({}, '', new_look_url);

										loadLookPopup(href_look, this)
									}
								}

							})


							let close_popup_btn = document.getElementsByClassName('close-popup')
							if (close_popup_btn[0]) {
								close_popup_btn[0].addEventListener('click', () => {
									window.history.replaceState({}, '', "/lookbooks/");
									//window.history.replaceState({}, '', "/" + region + '/' + looks_base_link + '/');
									hidePopup()
								})
							}

						})
					</script>
				</div>
			</div>

		</div>

		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/lookbooks/static/js/default.js" charset="utf-8"></script>
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
		<script>
			//Suitopia
			try {
				const url = new URL(document.location.href);
				if (url.searchParams.get("utm_source") == 'suitopia') {
					$.get(window.region_url + 'suitopia/', function(data) {
						$(body).append(data);
					});
				}
			} catch (ex) {}
		</script>
	</div>

</div>

<?php get_footer();
?>