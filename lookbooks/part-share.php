<div class="background-share" id="background-share"></div>
<div class="share-this" id="share-this">
	<span class="close-share-this">
	    <img src="<?php echo get_template_directory_uri(); ?>/lookbooks/static/picture/close.svg" width="20">
	</span>
	<div class="line-top"></div>
	<div class="share-this-container">
		<div class="share-title">
			<h4>Share this Outfit</h4>
			<p></p>
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
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	let look_title = 'hockerty';
	let consts3 = 'https://d1fufvy4xao6k9.cloudfront.net/';
	let texto_share = 'Do you like this outfit?';
	let mobile_device_share = false;

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
			img.src = url;//'/looks/fetchImage?url=' + url; // Request image from your server

		}

		$(document).on('click', ".download-image", function(evt) {
			downloadImage(shareImage.src)
		})
		$(document).on('click', ".share-look", function(evt) {

			if (evt.target.closest('.look-detail-view')) { //desde detalle de look
				let watermark_file = evt.target.closest('.look-detail-view').querySelector(
					'.look_card .carousel-cell').src

				shareImage.src = watermark_file;
				
				/*watermark_file.split("/")
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