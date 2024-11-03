<?php
/**
 * 为布局块注册布局模块
 */

namespace DqBlocks\Layouts;

add_action( 'init', __NAMESPACE__ . '\register_components', 11 );
//add_action( 'plugins_loaded', __NAMESPACE__ . '\register_components', 11 );

/**
 * 注册节点模块和布局组件
 */

function register_components() {
	dq_blocks_register_layout_component(
		[
			'type'     => 'section',
			'key'      => 'db_section_service_1',
			'content'  => "

<!-- wp:dq-blocks/db-container {\"containerPaddingTop\":5,\"containerPaddingRight\":5,\"containerPaddingBottom\":3,\"containerPaddingLeft\":5,\"containerMarginTop\":0,\"containerMarginBottom\":0,\"containerWidth\":\"full\",\"containerMaxWidth\":1140,\"containerBackgroundColor\":\"#ffffff\",\"containerImgID\":3854,\"className\":\"contact-details\"} -->
<div style=\"background-color:#ffffff;padding-left:5%;padding-right:5%;padding-bottom:3%;padding-top:5%\" class=\"wp-block-dq-blocks-db-container contact-details db-block-container alignfull\"><div class=\"db-container-content\" style=\"max-width:1140px\"><!-- wp:heading {\"textAlign\":\"center\",\"level\":3} -->
<h3 class=\"has-text-align-center\"><span class=\"has-inline-color has-luminous-vivid-amber-color\">演示</span>模块</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\"} -->
<p class=\"has-text-align-center\">无需编码技能，您也可以创建出一个独特的网站（DQTheme）</p>
<!-- /wp:paragraph -->

<!-- wp:dq-blocks/db-columns {\"columns\":3,\"layout\":\"db-3-col-equal\",\"paddingTop\":50} -->
<div class=\"wp-block-dq-blocks-db-columns db-layout-columns-3 db-3-col-equal\" style=\"padding-top:50px\"><div class=\"db-layout-column-wrap db-block-layout-column-gap-2 db-is-responsive-column\"><!-- wp:dq-blocks/db-column -->
<div class=\"wp-block-dq-blocks-db-column db-block-layout-column\"><div class=\"db-block-layout-column-inner\"><!-- wp:dq-blocks/db-service {\"serviceImgID\":979,\"serviceIcoID\":982} -->
<div style=\"background-color:#ffffff\" class=\"wp-block-dq-blocks-db-service center-aligned icon-box-open db-block-service\"><div class=\"thumb\"><img class=\"db-service-img\" src=\"https://dq-me.oss-cn-beijing.aliyuncs.com/wp-content/uploads/2020/12/2020121315204193.png\" alt=\"\"/><div class=\"img-carv\"></div><div class=\"icon-box\"><img class=\"db-service-ico\" src=\"https://dq-me.oss-cn-beijing.aliyuncs.com/wp-content/uploads/2020/12/2020121315213150.png\" alt=\"\"/></div></div><div class=\"content\"><h4 class=\"db-service-title-font-size-18 db-service-title\">一键导入演示数据</h4><p class=\"db-service-describe-font-size-14 db-service-describe\">只需点击几下鼠标，即可导入主题演示内容并获得与我们的主题演示非常相似的网站。</p><p class=\"db-service-more\"><a href=\"https://www.dqtheme.com/\" target=\"_blank\" rel=\"nofollow noreferrer noopener\">查看更多</a></p></div></div>
<!-- /wp:dq-blocks/db-service --></div></div>
<!-- /wp:dq-blocks/db-column -->

<!-- wp:dq-blocks/db-column -->
<div class=\"wp-block-dq-blocks-db-column db-block-layout-column\"><div class=\"db-block-layout-column-inner\"><!-- wp:dq-blocks/db-service {\"serviceImgID\":980,\"serviceIcoID\":981} -->
<div style=\"background-color:#ffffff\" class=\"wp-block-dq-blocks-db-service center-aligned icon-box-open db-block-service\"><div class=\"thumb\"><img class=\"db-service-img\" src=\"https://dq-me.oss-cn-beijing.aliyuncs.com/wp-content/uploads/2020/12/2020121315205731.png\" alt=\"\"/><div class=\"img-carv\"></div><div class=\"icon-box\"><img class=\"db-service-ico\" src=\"https://dq-me.oss-cn-beijing.aliyuncs.com/wp-content/uploads/2020/12/2020121315210984.png\" alt=\"\"/></div></div><div class=\"content\"><h4 class=\"db-service-title-font-size-18 db-service-title\">快速和友好的技术支持</h4><p class=\"db-service-describe-font-size-14 db-service-describe\">您有问题，有疑问还是需要意见？没问题，如果您遇到困难，我们随时为你服务！</p><p class=\"db-service-more\"><a href=\"https://www.dqtheme.com/\" target=\"_blank\" rel=\"nofollow noreferrer noopener\">查看更多</a></p></div></div>
<!-- /wp:dq-blocks/db-service --></div></div>
<!-- /wp:dq-blocks/db-column -->

<!-- wp:dq-blocks/db-column -->
<div class=\"wp-block-dq-blocks-db-column db-block-layout-column\"><div class=\"db-block-layout-column-inner\"><!-- wp:dq-blocks/db-service {\"serviceImgID\":943,\"serviceIcoID\":945} -->
<div style=\"background-color:#ffffff\" class=\"wp-block-dq-blocks-db-service center-aligned icon-box-open db-block-service\"><div class=\"thumb\"><img class=\"db-service-img\" src=\"https://dq-me.oss-cn-beijing.aliyuncs.com/wp-content/uploads/2020/12/2020121211334237.png\" alt=\"\"/><div class=\"img-carv\"></div><div class=\"icon-box\"><img class=\"db-service-ico\" src=\"https://dq-me.oss-cn-beijing.aliyuncs.com/wp-content/uploads/2020/12/2020121216285953.png\" alt=\"\"/></div></div><div class=\"content\"><h4 class=\"db-service-title-font-size-18 db-service-title\">深度SEO优化</h4><p class=\"db-service-describe-font-size-14 db-service-describe\">开发过程中非常注重搜索引擎的优化，不需要任何插件即可自定义每个页面的SEO信息。</p><p class=\"db-service-more\"><a href=\"https://www.dqtheme.com/\" target=\"_blank\" rel=\"nofollow noreferrer noopener\">查看更多</a></p></div></div>
<!-- /wp:dq-blocks/db-service --></div></div>
<!-- /wp:dq-blocks/db-column --></div></div>
<!-- /wp:dq-blocks/db-columns --></div></div>
<!-- /wp:dq-blocks/db-container -->


			",
			'name'     => esc_html__( '服务项目', 'dq-blocks' ),
			'category' => [ esc_html__( '服务项目', 'dq-blocks' ) ],
			'keywords' => [
				esc_html__( 'service', 'dq-blocks' ),
				esc_html__( '服务项目', 'dq-blocks' ),
				esc_html__( '服务', 'dq-blocks' ),
				esc_html__( 'dq', 'dq-blocks' ),
			],
			'image'    => 'https://dahuzi-me.oss-cn-beijing.aliyuncs.com/wp-content/uploads/2020/12/20201210155508100.png',
		]
	);

	dq_blocks_register_layout_component(
		[
			'type'     => 'section',
			'key'      => 'db_section_service_2',
			'content'  => "

<!-- wp:dq-blocks/db-container {\"containerPaddingTop\":5,\"containerPaddingRight\":5,\"containerPaddingBottom\":3,\"containerPaddingLeft\":5,\"containerMarginTop\":0,\"containerMarginBottom\":0,\"containerWidth\":\"full\",\"containerMaxWidth\":1140,\"containerBackgroundColor\":\"#ffffff\",\"containerImgID\":3854,\"className\":\"contact-details\"} -->
<div style=\"background-color:#ffffff;padding-left:5%;padding-right:5%;padding-bottom:3%;padding-top:5%\" class=\"wp-block-dq-blocks-db-container contact-details db-block-container alignfull\"><div class=\"db-container-content\" style=\"max-width:1140px\"><!-- wp:heading {\"textAlign\":\"center\",\"level\":3} -->
<h3 class=\"has-text-align-center\"><span class=\"has-inline-color has-luminous-vivid-amber-color\">演示</span>模块</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\"} -->
<p class=\"has-text-align-center\">无需编码技能，您也可以创建出一个独特的网站（DQTheme）</p>
<!-- /wp:paragraph -->

<!-- wp:dq-blocks/db-columns {\"columns\":3,\"layout\":\"db-3-col-equal\",\"paddingTop\":50} -->
<div class=\"wp-block-dq-blocks-db-columns db-layout-columns-3 db-3-col-equal\" style=\"padding-top:50px\"><div class=\"db-layout-column-wrap db-block-layout-column-gap-2 db-is-responsive-column\"><!-- wp:dq-blocks/db-column -->
<div class=\"wp-block-dq-blocks-db-column db-block-layout-column\"><div class=\"db-block-layout-column-inner\"><!-- wp:dq-blocks/db-pricing {\"columns\":1} -->
<div class=\"wp-block-dq-blocks-db-pricing db-pricing-columns-1\"><div class=\"db-pricing-table-wrap db-block-pricing-table-gap-2\"><!-- wp:dq-blocks/db-pricing-table {\"button_url\":\"\u003ca href=\u0022https://www.dqtheme.com/\u0022 target=\u0022_blank\u0022 rel=\u0022noreferrer noopener\u0022\u003e立即咨询\u003c/a\u003e\"} -->
<div class=\"wp-block-dq-blocks-db-pricing-table db-block-pricing-table-center dq-block-pricing-item\"><!-- wp:dq-blocks/db-pricing-table-price {\"price\":\"188\",\"currency\":\"¥\",\"term\":\"/月\",\"pricing_table_title\":\"基础版\"} -->
<div class=\"wp-block-dq-blocks-db-pricing-table-price pricing-deco db-pricing-has-currency\"><svg class=\"pricing-deco-img\" version=\"1.1\" preserveaspectratio=\"none\" x=\"0px\" y=\"0px\" width=\"300px\" height=\"100px\" viewbox=\"0 0 300 100\" enable-background=\"new 0 0 300 100\" xmlspace=\"preserve\"><path class=\"deco-layer deco-layer--2\" opacity=\"0.6\" fill=\"#FFFFFF\" d=\"M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z\"></path><path class=\"deco-layer deco-layer--3\" opacity=\"0.7\" fill=\"#FFFFFF\" d=\"M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716H42.401L43.415,98.342z\"></path><path class=\"deco-layer deco-layer--4\" fill=\"#FFFFFF\" d=\"M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z\"></path></svg><div class=\"pricing-price\"><span class=\"pricing-currency\">¥</span><div class=\"db-pricing-table-price\">188</div><span class=\"pricing-period\">/月</span></div><div class=\"db-pricing-table-title\">基础版</div></div>
<!-- /wp:dq-blocks/db-pricing-table-price -->

<!-- wp:dq-blocks/db-pricing-table-features -->
<ul class=\"wp-block-dq-blocks-db-pricing-table-features db-pricing-table-features pricing-list db-list-border-none db-list-border-width-1\"><li>产品特色介绍一</li><li>产品特色介绍二</li><li>产品特色介绍三</li><li>产品特色介绍四</li><li>产品特色介绍五</li></ul>
<!-- /wp:dq-blocks/db-pricing-table-features --><div class=\"common-btn center-block\"><a href=\"https://www.dqtheme.com/\" target=\"_blank\" rel=\"noreferrer noopener\">立即咨询</a></div></div>
<!-- /wp:dq-blocks/db-pricing-table --></div></div>
<!-- /wp:dq-blocks/db-pricing --></div></div>
<!-- /wp:dq-blocks/db-column -->

<!-- wp:dq-blocks/db-column -->
<div class=\"wp-block-dq-blocks-db-column db-block-layout-column\"><div class=\"db-block-layout-column-inner\"><!-- wp:dq-blocks/db-pricing {\"columns\":1} -->
<div class=\"wp-block-dq-blocks-db-pricing db-pricing-columns-1\"><div class=\"db-pricing-table-wrap db-block-pricing-table-gap-2\"><!-- wp:dq-blocks/db-pricing-table {\"button_url\":\"\u003ca href=\u0022https://www.dqtheme.com/\u0022 target=\u0022_blank\u0022 rel=\u0022noreferrer noopener\u0022\u003e立即咨询\u003c/a\u003e\"} -->
<div class=\"wp-block-dq-blocks-db-pricing-table db-block-pricing-table-center dq-block-pricing-item\"><!-- wp:dq-blocks/db-pricing-table-price {\"price\":\"368\",\"currency\":\"¥\",\"term\":\"/年\",\"pricing_table_title\":\"高级版\"} -->
<div class=\"wp-block-dq-blocks-db-pricing-table-price pricing-deco db-pricing-has-currency\"><svg class=\"pricing-deco-img\" version=\"1.1\" preserveaspectratio=\"none\" x=\"0px\" y=\"0px\" width=\"300px\" height=\"100px\" viewbox=\"0 0 300 100\" enable-background=\"new 0 0 300 100\" xmlspace=\"preserve\"><path class=\"deco-layer deco-layer--2\" opacity=\"0.6\" fill=\"#FFFFFF\" d=\"M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z\"></path><path class=\"deco-layer deco-layer--3\" opacity=\"0.7\" fill=\"#FFFFFF\" d=\"M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716H42.401L43.415,98.342z\"></path><path class=\"deco-layer deco-layer--4\" fill=\"#FFFFFF\" d=\"M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z\"></path></svg><div class=\"pricing-price\"><span class=\"pricing-currency\">¥</span><div class=\"db-pricing-table-price\">368</div><span class=\"pricing-period\">/年</span></div><div class=\"db-pricing-table-title\">高级版</div></div>
<!-- /wp:dq-blocks/db-pricing-table-price -->

<!-- wp:dq-blocks/db-pricing-table-features -->
<ul class=\"wp-block-dq-blocks-db-pricing-table-features db-pricing-table-features pricing-list db-list-border-none db-list-border-width-1\"><li>产品特色介绍一</li><li>产品特色介绍二</li><li>产品特色介绍三</li><li>产品特色介绍四</li><li>产品特色介绍五</li></ul>
<!-- /wp:dq-blocks/db-pricing-table-features --><div class=\"common-btn center-block\"><a href=\"https://www.dqtheme.com/\" target=\"_blank\" rel=\"noreferrer noopener\">立即咨询</a></div></div>
<!-- /wp:dq-blocks/db-pricing-table --></div></div>
<!-- /wp:dq-blocks/db-pricing --></div></div>
<!-- /wp:dq-blocks/db-column -->

<!-- wp:dq-blocks/db-column -->
<div class=\"wp-block-dq-blocks-db-column db-block-layout-column\"><div class=\"db-block-layout-column-inner\"><!-- wp:dq-blocks/db-pricing {\"columns\":1} -->
<div class=\"wp-block-dq-blocks-db-pricing db-pricing-columns-1\"><div class=\"db-pricing-table-wrap db-block-pricing-table-gap-2\"><!-- wp:dq-blocks/db-pricing-table {\"backgroundColor\":\"#cf2e2e\",\"button_url\":\"\u003ca href=\u0022https://www.dqtheme.com/\u0022 target=\u0022_blank\u0022 rel=\u0022noreferrer noopener\u0022\u003e立即咨询\u003c/a\u003e\"} -->
<div class=\"wp-block-dq-blocks-db-pricing-table db-block-pricing-table-center dq-block-pricing-item\"><!-- wp:dq-blocks/db-pricing-table-price {\"price\":\"666\",\"currency\":\"¥\",\"backgroundColor\":\"#cf2e2e\",\"term\":\"/年\",\"pricing_table_title\":\"企业版\"} -->
<div class=\"wp-block-dq-blocks-db-pricing-table-price pricing-deco db-pricing-has-currency\" style=\"background:#cf2e2e\"><svg class=\"pricing-deco-img\" version=\"1.1\" preserveaspectratio=\"none\" x=\"0px\" y=\"0px\" width=\"300px\" height=\"100px\" viewbox=\"0 0 300 100\" enable-background=\"new 0 0 300 100\" xmlspace=\"preserve\"><path class=\"deco-layer deco-layer--2\" opacity=\"0.6\" fill=\"#FFFFFF\" d=\"M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z\"></path><path class=\"deco-layer deco-layer--3\" opacity=\"0.7\" fill=\"#FFFFFF\" d=\"M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716H42.401L43.415,98.342z\"></path><path class=\"deco-layer deco-layer--4\" fill=\"#FFFFFF\" d=\"M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z\"></path></svg><div class=\"pricing-price\"><span class=\"pricing-currency\">¥</span><div class=\"db-pricing-table-price\">666</div><span class=\"pricing-period\">/年</span></div><div class=\"db-pricing-table-title\">企业版</div></div>
<!-- /wp:dq-blocks/db-pricing-table-price -->

<!-- wp:dq-blocks/db-pricing-table-features -->
<ul class=\"wp-block-dq-blocks-db-pricing-table-features db-pricing-table-features pricing-list db-list-border-none db-list-border-width-1\"><li>产品特色介绍一</li><li>产品特色介绍二</li><li>产品特色介绍三</li><li>产品特色介绍四</li><li>产品特色介绍五</li></ul>
<!-- /wp:dq-blocks/db-pricing-table-features --><div class=\"common-btn center-block\" style=\"background:#cf2e2e\"><a href=\"https://www.dqtheme.com/\" target=\"_blank\" rel=\"noreferrer noopener\">立即咨询</a></div></div>
<!-- /wp:dq-blocks/db-pricing-table --></div></div>
<!-- /wp:dq-blocks/db-pricing --></div></div>
<!-- /wp:dq-blocks/db-column --></div></div>
<!-- /wp:dq-blocks/db-columns --></div></div>
<!-- /wp:dq-blocks/db-container -->


			",
			'name'     => esc_html__( '价格表', 'dq-blocks' ),
			'category' => [ esc_html__( '价格表', 'dq-blocks' ) ],
			'keywords' => [
				esc_html__( '价格表', 'dq-blocks' ),
				esc_html__( '价格', 'dq-blocks' ),
				esc_html__( 'price', 'dq-blocks' ),
				esc_html__( 'dq', 'dq-blocks' ),
			],
			'image'    => 'https://dahuzi-me.oss-cn-beijing.aliyuncs.com/wp-content/uploads/2020/12/2020122506080559.png',
		]
	);

	dq_blocks_register_layout_component(
		[
			'type'     => 'section',
			'key'      => 'db_section_contact_1',
			'content'  => "

<!-- wp:dq-blocks/db-container {\"containerPaddingTop\":5,\"containerPaddingBottom\":5,\"containerMaxWidth\":1140,\"containerBackgroundColor\":\"#f9f9f9\",\"align\":\"full\"} -->
<div style=\"background-color:#f9f9f9;padding-bottom:5%;padding-top:5%\" class=\"wp-block-dq-blocks-db-container alignfull db-block-container\"><div class=\"db-container-content\" style=\"max-width:1140px\"><!-- wp:dq-blocks/db-contact {\"contactTitle\":\"\u003cspan class=\u0022has-inline-color has-luminous-vivid-amber-color\u0022\u003e联系\u003c/span\u003e我们\",\"contactDesc\":\"我们是专业的WordPress网站建设团队，提供高品质的WordPress主题。DQ主题微信公众号：www-dqtheme-com，欢迎热爱WordPress的每一位朋友关注！\",\"contactText1\":\"中国，河南，洛阳\",\"contactText2\":\"138-8888-8888\",\"contactText3\":\"670088886\",\"contactText4\":\"www.dqtheme.com\",\"contactName\":\"姓名 *\",\"contactPhone\":\"电话 *\",\"contactMail\":\"Email\",\"contactMessage\":\"请输入留言内容......\",\"contactSubmit\":\"提交留言\",\"contactIcoID\":981,\"contactIcoID_2\":1238,\"contactIcoID_3\":1236,\"contactIcoID_4\":1237,\"align\":\"wide\"} -->
<div style=\"border-color:#091426\" class=\"wp-block-dq-blocks-db-contact row contact-bg dq-blocka-contact\"><div class=\"col-md-12 col-lg-4\"><div class=\"contact-text\" style=\"background-color:#091426\"><h2><span class=\"has-inline-color has-luminous-vivid-amber-color\">联系</span>我们</h2><p>我们是专业的WordPress网站建设团队，提供高品质的WordPress主题。DQ主题微信公众号：www-dqtheme-com，欢迎热爱WordPress的每一位朋友关注！</p><div class=\"contact-info\"><div class=\"icon-box\"><img class=\"db-contact-img db-contact-ico\" src=\"https://dq-me.oss-cn-beijing.aliyuncs.com/wp-content/uploads/2020/12/2020121315210984.png\" alt=\"<span class=&quot;has-inline-color has-luminous-vivid-amber-color&quot;&gt;联系</span&gt;我们\"/></div><h6>中国，河南，洛阳</h6></div><div class=\"contact-info\"><div class=\"icon-box\"><img class=\"db-contact-img db-contact-ico-2\" src=\"https://dq-me.oss-cn-beijing.aliyuncs.com/wp-content/uploads/2021/03/2021031414334680.png\" alt=\"<span class=&quot;has-inline-color has-luminous-vivid-amber-color&quot;&gt;联系</span&gt;我们\"/></div><h6>138-8888-8888</h6></div><div class=\"contact-info\"><div class=\"icon-box\"><img class=\"db-contact-img db-contact-ico-3\" src=\"https://dq-me.oss-cn-beijing.aliyuncs.com/wp-content/uploads/2021/03/2021031414334593.png\" alt=\"<span class=&quot;has-inline-color has-luminous-vivid-amber-color&quot;&gt;联系</span&gt;我们\"/></div><h6>670088886</h6></div><div class=\"contact-info\"><div class=\"icon-box\"><img class=\"db-contact-img db-contact-ico-4\" src=\"https://dq-me.oss-cn-beijing.aliyuncs.com/wp-content/uploads/2021/03/2021031414334650.png\" alt=\"<span class=&quot;has-inline-color has-luminous-vivid-amber-color&quot;&gt;联系</span&gt;我们\"/></div><h6>www.dqtheme.com</h6></div></div></div><div class=\"col-md-12 col-lg-8 style-2\"><form id=\"ajax-contact\" method=\"POST\" action=\"\"><div class=\"form-row\"><div class=\"form-group col-md-12\"><input type=\"text\" name=\"name\" id=\"name\" class=\"form-control\" required placeholder=\"姓名 *\"/></div><div class=\"form-group col-md-12\"><input type=\"text\" name=\"phone\" id=\"phone\" class=\"form-control\" required placeholder=\"电话 *\"/></div><div class=\"form-group col-md-12\"><input type=\"email\" name=\"mail\" id=\"mail\" class=\"form-control\" placeholder=\"Email\"/></div><div class=\"form-group col-md-12\"><div class=\"contact-textarea\"><textarea class=\"form-control\" rows=\"6\" name=\"message\" id=\"message\" required placeholder=\"请输入留言内容......\"></textarea><input type=\"hidden\" name=\"action\" value=\"dq_contact_ajax\"/><div id=\"form-messages\"></div><button id=\"submit_message\" class=\"btn btn-theme mt-4\" type=\"submit\" style=\"background-color:#fcab03;color:#ffffff\">提交留言</button></div></div></div></form></div></div>
<!-- /wp:dq-blocks/db-contact --></div></div>
<!-- /wp:dq-blocks/db-container -->


			",
			'name'     => esc_html__( '留言表单', 'dq-blocks' ),
			'category' => [ esc_html__( '留言表单', 'dq-blocks' ) ],
			'keywords' => [
				esc_html__( '留言表单', 'dq-blocks' ),
				esc_html__( '留言', 'dq-blocks' ),
				esc_html__( 'contact', 'dq-blocks' ),
				esc_html__( 'dq', 'dq-blocks' ),
			],
			'image'    => 'https://dahuzi-me.oss-cn-beijing.aliyuncs.com/wp-content/uploads/2021/03/2021031415165341.png',
		]
	);

}
