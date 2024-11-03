<?php

function wpkf_loading_url()
{
	return WPKF_LOOKBOOKS_DURL . '/lookbooks/static/icons/looks-loading.svg';
}

function wpkf_get_action_lookbook_html($post_id)
{
	$post = get_post($post_id);
?>
	<div class="look-detail-view popup">
		<div class="look-section look-card">
			<div class="look_card" id="<?php echo $post_id ?>" data-slug="<?php echo $post->post_name ?>" data-title="<?php echo $post->post_title ?>">
				<a class="image-container" rel="<?php echo get_the_permalink($post_id); ?>">
                    <div class="main-carousel">
                        
                        <?php
                        $lookbooks = get_post_meta($post_id, 'wpkf_lookbooks', true);
                        if (!empty($lookbooks['gallery'])) {
                            $gallerys = explode(',', $lookbooks['gallery']);
                           foreach ($gallerys as $attachment_id) {
                                $image_link = wp_get_attachment_url($attachment_id);
								echo '<img class="carousel-cell" data-flickity-lazyload="' . $image_link . '" src="' .  wpkf_loading_url() . '" alt="' . $post->post_title . '" img-background="dark" >';
                            }
                        }
                        ?>
                        
                    </div>                   
				</a>
			</div>
		</div>
		<div class="look-section products">
			<div class="products-look-container">

				<div class="info-container">
					<div class="text" data-href="<?php echo get_the_permalink($post_id); ?>">
						<h4><?php echo $post->post_title ?></h4>
						<p><?php echo $post->post_content ?></p>
					</div>
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

		</div>
	</div>

	<script type="text/javascript">
	
		//const mobile_device = window.innerWidth < 786 ? true : false;
		//const look_slug = 'jeans-chelsea-boots';
		const id_look = '<?php echo $post_id; ?>';

		//miramos si está agregado en bookmarks
		let bookmars_saved = JSON.parse(localStorage.getItem('bookmark'))
		if (bookmars_saved && bookmars_saved.length) {
			if (bookmars_saved.some(bookmark => bookmark.id == id_look)) {
				$('.look-detail-view .add-bookmark[id_look=' + id_look + ']').find('.bookmark-icon.outlined').toggleClass(
					'show')
				$('.look-detail-view .add-bookmark[id_look=' + id_look + ']').find('.bookmark-icon.filled').toggleClass(
					'show')
			}
		}

		const load_flickity = () => {

			$('.main-carousel').each(function() {
				$(this).flickity({
					// options
					cellAlign: 'left',
					contain: true,
					prevNextButtons: mobile_device ? false : true,
					draggable: mobile_device ? true : false,
					lazyLoad: true,
					dragThreshold: 30,
					wrapAround: true,
					adaptiveHeight: true
				});
			})

			$(".popup .carousel-cell").on('load', function() {
				get_height_image()
			})

			$(window).on('resize', function() {
				get_height_image()
			})
			$('.next,.previous').on('click', function() {
				get_height_image()
			});
		}
		const get_height_image = () => {
			let image_height
			if ($(".popup .carousel-cell.is-selected").length > 0) {
				image_height = $(".popup .carousel-cell.is-selected").height();
			} else {
				image_height = $(".popup .carousel-cell").height();
			}
			$("#detail-look-popup-container").css("max-height", image_height);
		}
		
		/*
        const add_to_cart = () => {
            //add to cart
            document.querySelectorAll('.cart-icons').forEach((cartIcons) => {
                let add = cartIcons.querySelector('.add-to-cart')
                let loader = cartIcons.querySelector('.loader')
                let done = cartIcons.querySelector('.added-to-cart')
                const url = cartIcons.closest(".look_product_card").getAttribute('rel')

                cartIcons.addEventListener('click', (e) => {
                    if (done.classList.contains('show')) return false
                    add.classList.remove('show')
                    loader.classList.add('show')

                $.get(url , {ajax: true})
                .done(function(data) {
                    loader.classList.remove('show')
                    done.classList.add('show')
                    setTimeout(function() {
                        add.classList.add('show')
                        done.classList.remove('show')
                    }, 5000);
                });
            })
        })
        }
        */

		load_flickity()
		//add_to_cart()
	</script>
	<?php
}

function wpkf_get_lookbook_products($post_id)
{
	$lookbooks = get_post_meta($post_id, 'wpkf_lookbooks', true);
	if (isset($lookbooks['products'])) {
		$products = $lookbooks['products'];//explode(',', $lookbooks['products']);
		foreach ($products as $pid) {
	?>
			<div class="look_product_card" id="<?php echo $pid; ?>" rel="<?php the_permalink($pid); ?>">
				<a class="main-image-container " href="<?php echo get_the_permalink($pid); ?>">
					<img src="<?php echo get_the_post_thumbnail_url($pid); ?>" alt="<?php echo get_the_title($pid); ?>">
				</a>
				<div class="footer-section">
					<div class="title-section">
						<h4><?php echo get_the_title($pid); ?></h4>
						<p><?php echo dq('site_unit'); ?><?php echo get_post_meta($pid, 'wpkf_price', true) ?: '0.00';?></p>
					</div>
					<div class="icons-section">
						<div class="cart-icons">
							<img class="cart-icon add-to-cart show" src="<?php echo get_template_directory_uri(); ?>/lookbooks/static/icons/shopping_bag_white.svg" alt="add to cart icon">
							<div class="loader"></div>
							<img class="cart-icon added-to-cart" src="<?php echo get_template_directory_uri(); ?>/lookbooks/static/icons/done_white.svg" alt="added to cart icon">
						</div>
					</div>
				</div>
			</div>
        <?php
		}
	}
}
