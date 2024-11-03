<?php
$modular_title = $id['modular_title'] ?: '';
$modular_comparision_table_check_icon_color = $id['modular_comparision_table_check_icon_color'] ?: '#00ff00';
$modular_comparision_table_brand_name = $id['modular_comparision_table_brand_name'] ?: '';
$modular_comparision_table_other_brand_name = $id['modular_comparision_table_other_brand_name'] ?: '';
?>

<section class="home-modular-55 contact-details modular_display_<?php echo $id['modular_display']; ?>
 <?php if ($id['modular_bg_f9']) {
    echo 'bg-f9';
  } ?>">
  <div class="container">
    <?php if ($modular_title) { ?>
      <div class="section-title">
        <?php if ($modular_title) {
          echo '<h2>' . $modular_title . '</h2>';
        } ?>
      </div>
    <?php } ?>
    <div class="row">
      <div class="col-lg-8" style=" margin: auto; ">
        <table style="width: 100%; border-collapse: collapse; table-layout: fixed; border: 1px none #99acc2;">
          <tbody>
            <tr>
              <td style="width: 60%; padding: 4px; text-align: center; height: 28.1406px; border: 1px solid #cccccc;">&nbsp;</td>
              <td style="width: 20%; padding: 4px; height: 28.1406px; border: 1px solid #cccccc;">
                <h4 style="margin-bottom: 0px; text-align: center;">
                  <?php if ($modular_comparision_table_brand_name) {
                    echo $modular_comparision_table_brand_name;
                  } ?>
                </h4>
              </td>
              <td style="width: 20%; padding: 4px; height: 28.1406px; border: 1px solid #cccccc;">
                <h4 style="margin-bottom: 0px; text-align: center;">
                  <?php if ($modular_comparision_table_other_brand_name) {
                    echo $modular_comparision_table_other_brand_name;
                  } ?>
                </h4>
              </td>
            </tr>
            <?php
            if (! empty($id['add_modular_55'])) {
              foreach ($id['add_modular_55'] as $index => $value):
                $modular_55_we_check = $value['modular_55_we_check'] ?: '';
                $modular_55_other_check = $value['modular_55_other_check'] ?: '';
                $we_check_icon_color = $modular_55_we_check ? $modular_comparision_table_check_icon_color : '#999999';
                $other_check_icon_color = $modular_55_other_check ? $modular_comparision_table_check_icon_color : '#999999';
            ?>
                <tr style="<?php echo $index % 2 == 0 ? 'background-color: #f9f9f9;' : ''; ?>">
                  <td style="width: 60%; padding-top: 4px; padding-right: 4px; padding-bottom: 4px; text-align: center; border: 1px solid #cccccc;">
                    <p style="font-weight: bold; font-size: 20px;"><?php echo $value['modular_55_item_title']; ?></p>
                    <p style="font-size: 14px;"><span style="color: #4d4d4d;">&nbsp;<?php echo $value['modular_55_item_desc']; ?></span></p>
                  </td>
                  <td style="width: 20%; padding-top: 4px; padding-right: 4px; padding-bottom: 4px; text-align: center;border: 1px solid #cccccc;"><span style="display: inline-block; fill: <?php echo $we_check_icon_color; ?>">
                        <?php
                        if ($modular_55_we_check) {
                            include get_template_directory() . '/assets/images/check.svg';
                        } else {
                            include get_template_directory() . '/assets/images/cross.svg';
                        }
                        ?></span></td>
                  <td style="width: 20%; padding-top: 4px; padding-right: 4px; padding-bottom: 4px; text-align: center;border: 1px solid #cccccc;"><span style="display: inline-block; fill: <?php echo $other_check_icon_color; ?>">
                        <?php
                        if ($modular_55_other_check) {
                            include get_template_directory() . '/assets/images/check.svg';
                        } else {
                            include get_template_directory() . '/assets/images/cross.svg';
                        }
                        ?>
                  </span></td>
                </tr>
            <?php endforeach;
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  </div>
</section>
<style>
  .cleaning-service-item {
    box-shadow: initial;
    background-color: initial;
    margin-bottom: initial;
  }
</style>