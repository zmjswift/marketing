<?php
if (is_post_type_archive('lookbooks')) {
    $category_post_count = wp_count_posts('lookbooks')->publish;
}else {
    $cat_id = get_queried_object_id();
    $current_category = get_queried_object();
    $category_post_count = $current_category->count;
}
?>

<div class="filter-desktop-container">
	<span id="total_looks" class="number-outfits-desktop"><?php echo $category_post_count ?>
		outfit styles</span>
	<div id="filter" class="filter-background"></div>
	<form id="filter-container" method="get" enctype="multipart/form-data">
		<div class="filter-list">
			<div class="look_filter">
				<div>
					<div class="filter-header">
						<h4 class="uppercase">filters</h4>
					</div>
					<div class="filters-by">
						<h5>By Situation</h5>
						<div class="grid-elements-filter">
						    
						    <?php
						    $situation = get_terms(['taxonomy' => 'lookbooks_cat','hide_empty' => false]);
						    if (!empty($situation)) {
						        foreach ($situation as $term) {
						            $active = $_GET['by_situation'] == $term->term_id ? 'checked="checked"' : '';
						            echo '<div class="element-filter">
						            <input class="filter-situation" type="checkbox" id="' . $term->term_id . '" value="' . $term->term_id . '" name="by_situation" ' . $active . '>
						            <label for="' . $term->term_id . '">' . $term->name . '</label>
						            </div>';
						        }
						    }
						    ?>
							
						</div>
					</div>
					<div class="filters-by">
						<h5>By Product</h5>
						<div class="grid-elements-filter">
						    
							<?php
						    $product = get_terms(['taxonomy' => 'lookbooks_tag','hide_empty' => false]);
						    if (!empty($product)) {
						        foreach ($product as $term) {
						            $active2 = $_GET['by_product'] == $term->term_id ? 'checked="checked"' : '';
						            echo '<div class="element-filter">
						            <input class="filter-product" type="checkbox" id="' . $term->term_id . '" value="' . $term->term_id . '" name="by_product" ' . $active2 . '>
						            <label for="' . $term->term_id . '">' . $term->name . '</label>
						            </div>';
						        }
						    }
						    ?>
						    
						</div>
					</div>
				</div>
				<div class="send-filters" id="apply-filter">
					<span class="text uppercase">APPLY</span>
					<div class="loader"></div>
				</div>
			</div>
		</div>
	</form>

	<script type="text/javascript">
		var region_url = '';
		const look_base_link = '?filter=yes';


		ready_callbacks.push(function() {
            
			let url_situation, url_product
			window.addEventListener("load", () => {
				let by_situation_checked = document.querySelectorAll(
					'input[name="by_situation"]:checked');
				if (by_situation_checked.length) url_situation = "" + by_situation_checked[0].value

				let by_product_checked = document.querySelectorAll(
					'input[name="by_product"]:checked');

				if (by_product_checked.length) url_product = "" + by_product_checked[0].value
				getUrl()
			});

			let inputsSituations = document.querySelectorAll('.filter-situation')
			inputsSituations.forEach((input) => {
				input.addEventListener('click', () => {
					if (input.checked) {
						url_situation = "" + input.value
					} else {
						url_situation = ""
					}
					let checkboxes = document.querySelectorAll(
						'input[name="by_situation"]:checked');
					checkboxes.forEach((inputchecked) => {
						if (input.value != inputchecked.value) inputchecked.checked = false
					})

					if (window.innerWidth > 800) location.href = getUrl()

				})

			})
			let inputsProducts = document.querySelectorAll('.filter-product')
			inputsProducts.forEach((inputProduct) => {
				inputProduct.addEventListener('click', () => {
					if (inputProduct.checked) {
						url_product = "" + inputProduct.value
					} else {
						url_product = ""
					}
					let checkboxes = document.querySelectorAll('input[name="by_product"]:checked');
					checkboxes.forEach((inputchecked) => {
						if (inputProduct.value != inputchecked.value) inputchecked.checked =
							false
					})

					if (window.innerWidth > 800) location.href = getUrl()

				})

			})
            
			document.getElementById('apply-filter').addEventListener('click', (e) => {
				document.getElementById('apply-filter').classList.add('loading')
				location.href = getUrl()
			})
            
            
			const getUrl = () => {
				if (url_situation) {
					url_situation = '' + url_situation.normalize('NFD').replace(/[\u0300-\u036f]/g, "")
				}
				if (url_product) {
					url_product = '' + url_product.normalize('NFD').replace(/[\u0300-\u036f]/g, "")
				}
                
				if (url_situation && url_product) {
					url = region_url + look_base_link + "&by_situation=" + url_situation + "&by_product=" + url_product
				} else if (url_situation && !url_product) {
					url = region_url + look_base_link + "&by_situation=" + url_situation
				} else if (!url_situation && url_product) {
					url = region_url + look_base_link + "&by_product=" + url_product
				} else {
					url = region_url + look_base_link
				}

				return url
			}
            
		})
	</script>
</div>