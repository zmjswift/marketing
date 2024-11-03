<div class="wrap dq-blocks-settings-page">
	<div class="intro-wrap">
		<div class="intro">
			<h1 class="grow">授权码请登录 DQTheme 官网，到「用户中心-订单详情」中查看！</h1>
			<a class="components-button review-button hide-mobile" href="https://www.dqtheme.com" target="_blank" rel="noopener noreferrer">
				访问「DQ主题」官方网站
			</a>
		</div>
		<ul class="inline-list">
			<li class="current">
				<a id="theme-license" href="#">
					<?php dq_admin_svg( 'theme-license' ); ?>
					<span>主题授权</span>
				</a>
			</li>
		</ul>
	</div>

	<div class="dq-blocks-settings-sections">
		<div class="components-tab-panel__tab-content">
			<div id="theme-license" class="panel-left visible" style="height:60vh;">
				<?php echo dqtheme_theme_license_page();?>
			</div>
		</div>
	</div>
</div>
