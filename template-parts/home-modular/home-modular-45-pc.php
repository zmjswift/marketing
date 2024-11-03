<?php
$modular_title = $id['modular_title'] ?: '';
$modular_describe = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';
?>

<section class="home-modular-42 modular_display_<?php echo $id['modular_display']; ?> <?php if ($id['modular_bg_f9']) {
    echo 'bg-f9';
} ?>">
    <div class="container">
        <?php if ($modular_title || $modular_describe) { ?>
            <div class="elementor-divider">
                <span class="elementor-divider-separator" style="background-color: <?php echo $id['modular_45_licolor'] ?>;"></span>
            </div>
            <div class="section-title">
                <?php if ($modular_title) {
                    echo '<h2>' . $modular_title . '</h2>';
                } ?>
                <p style="color: <?php echo $mmodular_describe_color; ?>;margin-bottom: 1rem; text-transform: none!important;"><?php echo $modular_describe ?></p>
            </div>
        <?php } ?>

        <div class="row">
            <table>
                <?php
                $count = 0;
                if (!empty($id['add_modular_45'])) {
                    foreach ($id['add_modular_45'] as $value):
                        if ($count % 4 === 0) {
                            echo "<tr>";
                        }
                        ?>
                        <td>
                            <div class="col-lg-12">
                                <div class="customized-modular-42<?php if ($value['modular_45_url']) {
                                    echo ' cursor_pointer';
                                } ?>">
                                    <div class="modular-45-icon">
                                        <?php
                                        $modular_45_title = $value['modular_45_title'];
                                        $modular_45_color = $value['modular_45_color'];
                                        $modular_45_link = $value['modular_45_link'];
                                        $modular_45_img = $value['modular_45_img']['url'];
                                        ?>
                                        <?php if (!empty($modular_45_img)): ?>
                                            <a href="<?php echo $modular_45_link; ?>"><img
                                                        src="<?php echo $modular_45_img; ?>"
                                                        alt="<?php echo $value['modular_45_title']; ?>"/>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="modular-45-content">
                                        <a href="<?php echo $modular_45_link; ?>">
                                            <p style="color: <?php echo $modular_45_color; ?>;"><?php echo $value['modular_45_title']; ?></p>
                                        </a>
                                    </div>
                                    <?php if ($value['modular_45_url']): ?>
                                        <a class="modular-45-url" href="<?php echo $value['modular_45_url']; ?>"
                                           target="_blank" rel="nofollow"></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <?php
                        $count++;
                        if ($count % 4 === 0) {
                            echo "</tr>";
                        }
                    endforeach;
                }
                ?>
            </table>
            <?php
            if (!empty($id['module_45_button'])) {
                foreach ($id['module_45_button'] as $value):
                    ?>
                    <a class="button-45" href="<?php echo $value['link_45']; ?>">
                        <span style="display: flex;align-items: center;color: #ffffff;">
                            <p style="color: <?php echo $value['color_45']; ?>;font-size: 1rem;"><?php echo $value['title_45']; ?></p>
                            <i class="fa fa-arrow-right" style="color: <?php echo $value['color_45']; ?>;"></i>
                        </span>
                    </a>
                <?php
                endforeach;
            }
            ?>
        </div>
    </div>
</section>

<style>
    .button-45 {
        margin-left: auto;
        margin-right: auto;
        font-weight: 600;
        margin-top: 3rem;
    }

    .elementor-divider {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 30px;
    }

    .elementor-divider-separator {
        width: 100px;
        height: 3px;
        background-color: #F21089;
    }

    .modular-45-content {
        display: flex;
        justify-content: center;
        margin-top: 1rem;
    }

    table {
        border-collapse: collapse;
        border: none;
    }

    table td {
        border: 1px solid #e5eafe;
        padding: 5px;
        border-bottom: none;
        border-right: none;
    }

    table tr:first-child td {
        border-top: none;
    }

    table tr td:first-child {
        border-left: none;
    }

    @media only screen and (max-width: 600px) {
        table {
            width: 100%;
        }

        table td {
            display: block;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #e5eafe;
            padding: 5px;
            border-bottom: none;
            border-right: none;
        }

        table td:last-child {
            border-right: 1px solid #e5eafe;
        }

        table tr:first-child td {
            border-top: none;
        }

        table tr td:first-child {
            border-left: none;
        }
    }
</style>