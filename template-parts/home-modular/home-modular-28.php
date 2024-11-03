<?php
$modular_title = $id['modular_title'] ?: '';
$modular_describe = $id['modular_describe'] ?: '';
$bg_color = $id['modular_28_bg_color'] ?: '';
?>

<style>
    .home-modular-28 h2,
    .home-modular-28 h3,
    .home-modular-28 h4,
    .home-modular-28 h5 {
        color: #fff;
    }

    .home-modular-28 .swp-form label {
        display: none;
    }

    .home-modular-28 .swp-form .field-email {
        background: #fff;
        border-radius: 8px;
        width: 100%;
        border: unset;
        padding-left: 10px;
    }

    .home-modular-28 .swp-form .field-submit {
        background: transparent;
        border-radius: 8px;
        width: 100%;
        border: 1px solid #fff;
        color: #fff;
        cursor: pointer;
    }

    .home-modular-28 .swp-form .swp-col-1 {
        float: left !important;
        width: 60% !important;
        margin-right: 5% !important;
    }

    .home-modular-28 .swp-form .swp-col-2 {
        float: right !important;
        width: 35% !important;
    }

    .home-modular-28 .swp-form .swp-col-2 .swp-field-wrap {
        text-align: right;
    }

    @media (max-width:768px) {
        .home-modular-28 .swp-form {
            margin-top: 20px;
        }
    }

    ::-webkit-input-placeholder {
        color: #000;
        font-weight: 500;
    }

    :-ms-input-placeholder {
        color: #000;
        font-weight: 500;
    }
</style>

<section class="home-modular-28 modular_display_<?php echo $id['modular_display']; ?>" style="background:<?php echo $bg_color; ?>">
    <div class="container">

        <div class="row">
            <div class="col-12 col-lg-6 text-white">
                <?php echo $id['modular_28_content']; ?>
            </div>
            <div class="col-12 col-lg-6">
                <?php echo do_shortcode($id['add_modular_28']); ?>
            </div>
        </div>
    </div>
</section>