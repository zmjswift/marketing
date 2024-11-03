<?php
$modular_title = $id['modular_title'] ?: exit('标题为空');
$moduler_desc = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';
?>

<section>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-title wow" style="margin-bottom: unset;">
          <h2><?php echo $modular_title; ?></h2>
          <p style="color: <?php echo $mmodular_describe_color; ?>;margin-bottom: 1rem;"><?php echo $moduler_desc; ?></p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="section-title wow" style="margin-bottom: unset;">
          <?php
          if (!empty($id['modular_47_video'])) {
          ?>
            <video src="<?php echo $id['modular_47_video']; ?>" width="100%" height="auto" poster="<?php echo $id['modular_47_video_img']['url']; ?>" controls></video>
          <?php } elseif (!empty($id['modular_47_video_ytb'])) { ?>
            <div style="position: relative; padding-bottom: 56.25%; height: 0;">
              <iframe src="https://www.youtube.com/embed/<?php echo $id['modular_47_video_ytb']; ?>" frameborder="0" allowfullscreen style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>