<?php
$modular_title = $id['modular_title'] ?: '';
$modular_describe = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: ''; ?>
<section class="company-section modular_display_<?php echo $id['modular_display']; ?> <?php if ($id['modular_bg_f9']) {
																							echo 'bg-f9';
																						} ?>">
	<div class="container">
		<div class="row about-features">
			<?php if ($id['modular_3']['modular_3_img_left']) { ?>
				<div class="col-md-4">
					<div class="thumb">
						<img loading="lazy" src="<?php echo $id['modular_3']['modular_3_img']['url']; ?>" alt="<?php echo get_post_meta($id['modular_3']['modular_3_img']['id'], '_wp_attachment_image_alt', true); ?>">
						<?php if ($id['modular_3']['modular_3_video'] || $id['modular_3']['modular_3_video2']) { ?>
							<div class="about-video">
								<h4><?php echo $id['modular_3']['modular_3_video_text'] ?: '观看视频'; ?></h4>
								<span class="about-video-btn"><i class="fa fa-play"></i></span>
							</div>

							<?php if ($id['modular_3']['modular_3_video']) { ?>
								<a class="u-permalink" data-fancybox href="#Dq-Video"></a>
								<video loading="lazy" controls id="Dq-Video" style="display:none;">
									<source src="<?php echo $id['modular_3']['modular_3_video']; ?>" type="video/mp4">
								</video>
							<?php } else { ?>
								<a class="u-permalink" data-fancybox data-type="iframe" href="<?php echo $id['modular_3']['modular_3_video2']; ?>"></a>
							<?php } ?>

						<?php } ?>
					</div>
				</div>
			<?php } ?>
			<div class="col-md-8">
				<div class="content">
					<h2><?php echo $modular_title; ?></h2>
					<?php echo '<p style="color: '.$mmodular_describe_color.'">'.$modular_describe .'</p>'; ?>
					<?php if (!empty($id['modular_3']['add_special'])) { ?>
						<ul class="company-list">
							<?php foreach ($id['modular_3']['add_special'] as $value) : ?>
								<li><i class="fa fa-angle-right"></i><?php echo $value['special_text']; ?></li>
							<?php endforeach; ?>
						</ul>
					<?php } ?>
					<?php if (!empty($id['modular_3']['add_number'])) { ?>
						<div class="company-funfact">
							<?php foreach ($id['modular_3']['add_number'] as $value) : ?>
								<div class="funfact-item">
									<span style="font-size: 42px; font-weight: 600; margin-bottom: 6px; color: #fcab03;" class="timer count-title" id="count-number" data-to="<?php echo $value['modular3_number']; ?>" data-speed="1500"><?php echo $value['modular3_number']; ?></span>
									<span style="color: #091426; font-size: 24px; letter-spacing: 1px; font-weight: 500;"><?php echo $value['modular3_number_text']; ?></span>
								</div>
							<?php endforeach; ?>
						</div>
					<?php } ?>
				</div>
			</div>
			<?php if (!$id['modular_3']['modular_3_img_left']) { ?>
				<div class="col-md-4">
					<div class="thumb">
						<img loading="lazy" src="<?php echo $id['modular_3']['modular_3_img']['url']; ?>" alt="<?php echo get_post_meta($id['modular_3']['modular_3_img']['id'], '_wp_attachment_image_alt', true); ?>">
						<?php if ($id['modular_3']['modular_3_video'] || $id['modular_3']['modular_3_video2']) { ?>
							<div class="about-video">
								<h4><?php echo $id['modular_3']['modular_3_video_text'] ?: '观看视频'; ?></h4>
								<span class="about-video-btn"><i class="fa fa-play"></i></span>
							</div>

							<?php if ($id['modular_3']['modular_3_video']) { ?>
								<a class="u-permalink" data-fancybox href="#Dq-Video"></a>
								<video loading="lazy" controls id="Dq-Video" style="display:none;">
									<source src="<?php echo $id['modular_3']['modular_3_video']; ?>" type="video/mp4">
								</video>
							<?php } else { ?>
								<a class="u-permalink" data-fancybox data-type="iframe" href="<?php echo $id['modular_3']['modular_3_video2']; ?>"></a>
							<?php } ?>

						<?php } ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</section>


<script type="text/javascript">
	//窗口显示才加载
	var wrapTop = $(".digital").offset().top;
	var istrue = true;
	$(window).on("scroll",
		function() {
			var s = $(window).scrollTop();
			if (s > wrapTop - 500 && istrue) {
				$(".timer").each(count);

				function count(a) {
					var b = $(this);
					a = $.extend({},
						a || {},
						b.data("countToOptions") || {});
					b.countTo(a)
				};
				istrue = false;
			};
		})
	//设置计数
	$.fn.countTo = function(options) {
		options = options || {};
		return $(this).each(function() {
			//当前元素的选项
			var settings = $.extend({}, $.fn.countTo.defaults, {
				from: $(this).data('from'),
				to: $(this).data('to'),
				speed: $(this).data('speed'),
				refreshInterval: $(this).data('refresh-interval'),
				decimals: $(this).data('decimals')
			}, options);
			//更新值
			var loops = Math.ceil(settings.speed / settings.refreshInterval),
				increment = (settings.to - settings.from) / loops;
			//更改应用和变量
			var self = this,
				$self = $(this),
				loopCount = 0,
				value = settings.from,
				data = $self.data('countTo') || {};
			$self.data('countTo', data);
			//如果有间断，找到并清除
			if (data.interval) {
				clearInterval(data.interval);
			};
			data.interval = setInterval(updateTimer, settings.refreshInterval);
			//初始化起始值
			render(value);

			function updateTimer() {
				value += increment;
				loopCount++;
				render(value);
				if (typeof(settings.onUpdate) == 'function') {
					settings.onUpdate.call(self, value);
				}
				if (loopCount >= loops) {
					//移出间隔
					$self.removeData('countTo');
					clearInterval(data.interval);
					value = settings.to;
					if (typeof(settings.onComplete) == 'function') {
						settings.onComplete.call(self, value);
					}
				}
			}

			function render(value) {
				var formattedValue = settings.formatter.call(self, value, settings);
				$self.html(formattedValue);
			}
		});
	};
	$.fn.countTo.defaults = {
		from: 0, //数字开始的值
		to: 0, //数字结束的值
		speed: 1000, //设置步长的时间
		refreshInterval: 100, //隔间值
		decimals: 0, //显示小位数
		formatter: formatter, //渲染之前格式化
		onUpdate: null, //每次更新前的回调方法
		onComplete: null //完成更新的回调方法
	};

	function formatter(value, settings) {
		return value.toFixed(settings.decimals);
	}
	//自定义格式
	$('#count-number').data('countToOptions', {
		formmatter: function(value, options) {
			return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
		}
	});
	//定时器
	$('.timer').each(count);

	function count(options) {
		var $this = $(this);
		options = $.extend({}, options || {}, $this.data('countToOptions') || {});
		$this.countTo(options);
	}
</script>