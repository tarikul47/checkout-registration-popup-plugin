<?php

/**
 * Template part for display login form on popup.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wecoder-crp
 * @since   1.0
 */

defined('ABSPATH') || exit;
?>
<div class="popup-content-header">
    <h3 class="popup-title"><?php esc_html_e('Login', 'wecoder-crp'); ?></h3>
    <p class="popup-description">
        <?php printf(esc_html__('Don\'t have an account yet? %sSign up for free%s', 'wecoder-crp'), '<a href="#" class="open-popup-register link-transition-02">', '</a>'); ?>
    </p>
</div>
<div class="popup-content-body">
    <?php do_action('wecoder-crp_before_popup_login_form'); ?>

    <form id="wecoder-login-form" class="wecoder-login-form" method="post">

        <?php do_action('wecoder_before_popup_login_form_fields'); ?>

        <div class="form-group">
            <label for="ip_user_login" class="form-label"><?php esc_html_e('Username or email', 'wecoder-crp'); ?></label>
            <input type="text" id="ip_user_login" class="form-control form-input" name="user_login" placeholder="<?php esc_attr_e('Your username or email', 'wecoder-crp'); ?>">
        </div>

        <div class="form-group">
            <label for="ip_password" class="form-label"><?php esc_html_e('Password', 'wecoder-crp'); ?></label>
            <div class="form-input-group form-input-password">
                <input type="password" id="ip_password" class="form-control form-input" name="password" placeholder="<?php esc_attr_e('Password', 'wecoder-crp'); ?>">
                <img id="eye-icon" class="eye-icons btn-pw-toggle" src="<?php echo WC_REGISTRATION_POPUP_ASSET . "/images/eye.png" ?>" />
                <img style="display: none" id="eye-off-icon" class="eye-icons" src="<?php echo WC_REGISTRATION_POPUP_ASSET . "/images/eye-off.png" ?>" />
            </div>
        </div>

        <div class="form-group row-flex row-middle">
            <div class="col-grow">
                <label class="form-label form-label-checkbox" for="ip_rememberme">
                    <input class="form-checkbox" name="rememberme" type="checkbox" id="ip_rememberme" value="forever" />
                    <span><?php esc_html_e('Remember me', 'wecoder-crp'); ?></span>
                </label>
            </div>
            <div class="col-shrink">
                <div class="forgot-password">
                    <a href="<?php echo esc_url(wp_lostpassword_url()); ?>" class="open-popup-lost-password forgot-password-link link-transition-02"><?php esc_html_e('Forgot your password?', 'wecoder-crp'); ?></a>
                </div>
            </div>
        </div>

        <?php do_action('wecoder_after_popup_login_form_fields'); ?>

        <div class="form-response-messages"></div>

        <div class="form-group">
            <?php wp_nonce_field('user_login', 'user_login_nonce'); ?>
            <input type="hidden" name="action" value="wecoder-crp_user_login">
            <button type="submit" class="button form-submit"><?php esc_html_e('Log In', 'wecoder-crp'); ?></button>
        </div>
    </form>

    <?php do_action('wecoder_after_popup_login_form'); ?>
</div>