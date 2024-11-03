<div class="mb-4 mt-5">
	<h4 class="comments-title"><?php echo dqtheme('contact_title') ?: '在线留言';?></h4>
	<div class="border-style-2"></div>
</div>
<form id="ajax-contact" method="POST" action="" class="style-2">
	<div class="form-row">
    	<div class="form-group col-md-6">
			<input type="text" name="name" id="name" class="form-control" placeholder="姓名 *" required="" />
    	</div>
		<div class="form-group col-md-6">
			<input type="email" name="mail" id="mail" class="form-control" placeholder="Email" />
		</div>
		<div class="form-group col-md-12">
			<input type="text" name="phone" id="phone" class="form-control" placeholder="电话 *" required="" />
		</div>
		<div class="form-group col-md-12">
			<div class="contact-textarea">
				<textarea class="form-control" rows="6" placeholder="<?php echo dqtheme('contact_textarea') ?: '请输入留言内容...';?>" id="message" name="message" required></textarea>
				<input type="hidden" name="current_url" id="current_url" value="<?php echo home_url(add_query_arg(array()));?>">
				<input type="hidden" name="action" value="dq_contact_ajax">
				<div id="form-messages"></div>
				<button id="submit_message" class="btn btn-theme mt-4 mb-4" type="submit"><?php echo dqtheme('contact_button') ?: '提交留言';?></button>
			</div>
		</div>
	</div>
</form>
