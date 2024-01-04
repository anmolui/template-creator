<?php

/**
 * Template Name: Order Bump
 * Text Domain: template-creator
 */
function get_plugin_root_url()
{
    // Get the root URL of the plugin
    return plugin_dir_url(dirname(dirname(__FILE__)));
}

$image_url = get_plugin_root_url() . 'assets/images/test-1.jpg';

?>
<style>
    .wps-ob-st {
        padding: 15px;
        border: 1px solid #dcdcdc;
        margin: 20px 0;
    }

    .wps-ob-st__m-in {
        display: flex;
        align-items: flex-start;
        gap: 20px;
    }

    #wps-ob-st .wps-ob-st__m-in img {
        max-width: 140px;
        width: 100%;
        aspect-ratio: 1;
        object-fit: cover;
        border-radius: 5px;
    }

    .wps-ob-st__m-title {
        font-size: 24px;
        font-weight: 700;
        margin: 0 0 15px;
        line-height: 1.25;
    }

    .wps-ob-st__m-c-p {
        font-size: 14px;
        line-height: 1.5;
        margin: 0 0 10px;
    }

    .wps-ob-st__head {
        padding: 10px;
        background: #f5f5f5;
        border-radius: 5px;
        margin: 0 0 15px;
    }

    .wps-ob-st__m-c-price {
        font-weight: 700;
        line-height: 1.25;
    }

    .wps-ob-st__m-c-price del {
        font-weight: 400;
        color: #dcdcdc;
    }

    .wps-ob-st__head label {
        display: block;
        line-height: 1.25;
        cursor: pointer;
        margin: 0;
    }

    .wps-ob-st__head input[type=checkbox] {
        margin: 0 5px 0 0;
    }

    @media screen and (max-width: 520px) {
        #wps-ob-st .wps-ob-st__m-in img {
            max-width: 80px;
        }
    }

    @media screen and (max-width: 380px) {
        #wps-ob-st .wps-ob-st__m-in img {
            max-width: 380px;
        }

        .wps-ob-st__m-in {
            flex-direction: column;
        }
    }
</style>
<div id="wps-ob-st" class="wps-ob-st">
    <div class="wps-ob-st__head">
        <label for="wps-ob-st__head-check">
            <input id="wps-ob-st__head-check" type="checkbox" />
            <?php echo esc_html__('Yes! I want it.', 'template-creator') ?>
        </label>
    </div>
    <div class="wps-ob-st__main">
        <div class="wps-ob-st__m-title"><?php echo esc_html__('One Time Offer', 'template-creator') ?></div>
        <div class="wps-ob-st__m-in">
            <img src="<?php echo esc_url($image_url); ?>" alt="test">
            <div class="wps-ob-st__m-c">
                <div class="wps-ob-st__m-c-p">
                    <?php echo esc_html__('After adding this code, your shortcode content will be displayed after the payment ID in the WooCommerce checkout page. Adjust the shortcode name and content as needed for your specific implementation.', 'template-creator') ?>
                </div>
                <div class="wps-ob-st__m-c-price">
                    <del><?php echo esc_html__('$200', 'template-creator') ?></del>
                    <?php echo esc_html__('$190', 'template-creator') ?>
                </div>
            </div>
        </div>
    </div>
</div>