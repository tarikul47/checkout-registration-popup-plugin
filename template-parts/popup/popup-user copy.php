<?php

/**
 * Template part for display account popups.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Edumall
 * @since   1.0.0
 * @version 1.3.1
 */

defined('ABSPATH') || exit;
?>
<!-- popup box overlay -->
<section class="wecoder-popup popup-user-login popup-loaded" data-template="popup/popup-content-login">
    <div class="popup-overlay"></div>
    <!-- popup container  -->
    <div class="popup-container">
        <div class="button-close-popup">
            <svg fill="#ffffff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24px" height="24px">
                <path
                    d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z" />
            </svg>
        </div>
        <div class="popup-content-wrap">
            <div class="popup-content-header">
                <h3 class="popup-title"><?php esc_html_e('Login', 'edumall');?></h3>
                <p class="popup-description">
                    <?php printf(esc_html__('Don\'t have an account yet? %sSign up for free%s', 'edumall'), '<a href="#" class="open-popup-register link-transition-02">', '</a>');?>
                </p>
            </div>
            <div class="popup-content-body">
                <?php do_action('edumall_before_popup_login_form');?>

                <form id="edumall-login-form" class="edumall-login-form" method="post">

                    <?php do_action('edumall_before_popup_login_form_fields');?>

                    <div class="form-group">
                        <label for="ip_user_login"
                            class="form-label"><?php esc_html_e('Username or email', 'edumall');?></label>
                        <input type="text" id="ip_user_login" class="form-control form-input" name="user_login"
                            placeholder="<?php esc_attr_e('Your username or email', 'edumall');?>">
                    </div>

                    <div class="form-group">
                        <label for="ip_password" class="form-label"><?php esc_html_e('Password', 'edumall');?></label>
                        <div class="form-input-group form-input-password">
                            <input type="password" id="ip_password" class="form-control form-input" name="password"
                                placeholder="<?php esc_attr_e('Password', 'edumall');?>">

                        </div>
                    </div>

                    <div class="form-group row-flex row-middle">
                        <div class="col-grow">
                            <label class="form-label form-label-checkbox" for="ip_rememberme">
                                <input class="form-checkbox" name="rememberme" type="checkbox" id="ip_rememberme"
                                    value="forever" />
                                <span><?php esc_html_e('Remember me', 'edumall');?></span>
                            </label>
                        </div>
                        <div class="col-shrink">
                            <div class="forgot-password">
                                <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"
                                    class="open-popup-lost-password forgot-password-link link-transition-02"><?php esc_html_e('Forgot your password?', 'edumall');?></a>
                            </div>
                        </div>
                    </div>

                    <?php do_action('edumall_after_popup_login_form_fields');?>

                    <div class="form-response-messages"></div>

                    <div class="form-group">
                        <?php wp_nonce_field('user_login', 'user_login_nonce');?>
                        <input type="hidden" name="action" value="edumall_user_login">
                        <button type="submit"
                            class="button form-submit"><?php esc_html_e('Log In', 'edumall');?></button>
                    </div>
                </form>

                <?php do_action('edumall_after_popup_login_form');?>
            </div>
        </div>
    </div>
</section>

<!-- popup login end -->

<!-- popup box overlay -->
<div class="wecoder-popup popup-user-register" id="popup-user-register" data-template="popup/popup-content-register">
    <div class="popup-overlay"></div>
    <!-- popup container  -->
    <div class="popup-container">
        <div class="button-close-popup">
            <svg fill="#ffffff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24px" height="24px">
                <path
                    d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z" />
            </svg>
        </div>
        <div class="popup-content-wrap">
            <div class="popup-content-header">
                <h3 class="popup-title"><?php esc_html_e('Sign Up', 'edumall');?></h3>
                <p class="popup-description">
                    <?php printf(esc_html__('Already have an account? %sLog in%s', 'edumall'), '<a href="#" class="open-popup-login link-transition-02">', '</a>');?>
                </p>
            </div>

            <div class="popup-content-body">
                <form id="wecoder-register-form" class="wecoder-register-form" method="post">

                    <?php do_action('edumall_popup_register_before_form_fields');?>

                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="ip_reg_firstname"
                                    class="form-label"><?php esc_html_e('First Name', 'edumall');?></label>
                                <input type="text" id="ip_reg_firstname" class="form-control form-input"
                                    name="firstname" placeholder="<?php esc_attr_e('First Name', 'edumall');?>">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="ip_reg_lastname"
                                    class="form-label"><?php esc_html_e('Last Name', 'edumall');?></label>
                                <input type="text" id="ip_reg_lastname" class="form-control form-input" name="lastname"
                                    placeholder="<?php esc_attr_e('Last Name', 'edumall');?>">
                            </div>
                        </div>
                    </div>

                    <?php
/**
 * @since 2.8.4
 */
do_action('edumall_popup_register_after_form_field_name');
?>

                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="ip_reg_username"
                                    class="form-label"><?php esc_html_e('Username', 'edumall');?></label>
                                <input type="text" id="ip_reg_username" class="form-control form-input" name="username"
                                    placeholder="<?php esc_attr_e('Username', 'edumall');?>" />
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="ip_reg_email"
                                    class="form-label"><?php esc_html_e('Email', 'edumall');?></label>
                                <input type="email" id="ip_reg_email" class="form-control form-input" name="email"
                                    placeholder="<?php esc_attr_e('Your Email', 'edumall');?>" />
                            </div>
                        </div>
                    </div>

                    <?php
/**
 * @since 2.8.4
 */
do_action('edumall_popup_register_after_form_field_login');
?>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="ip_reg_password"
                                    class="form-label"><?php esc_html_e('Password', 'edumall');?></label>
                                <div class="form-input-group form-input-password">
                                    <input type="password" id="ip_reg_password" class="form-control form-input"
                                        name="password" placeholder="<?php esc_attr_e('Password', 'edumall');?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="ip_reg_password2"
                                    class="form-label"><?php esc_html_e('Re-Enter Password', 'edumall');?></label>
                                <div class="form-input-group form-input-password">
                                    <input type="password" id="ip_reg_password2" class="form-control form-input"
                                        name="password2"
                                        placeholder="<?php esc_attr_e('Re-Enter Password', 'edumall');?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
/**
 * @since 2.8.4
 */
do_action('edumall_popup_register_after_form_field_password');
?>

                    <?php
/**
 * @since 2.8.1
 */
$privacy_page_id = get_option('wp_page_for_privacy_policy', 0);
$privacy_link_html = esc_html__('Privacy Policy', 'edumall');
if ($privacy_page_id) {
    $privacy_link_html = sprintf(
        '<a href="%1$s" class="edumall-privacy-policy-link" target="_blank">%2$s</a>',
        esc_url(get_permalink($privacy_page_id)),
        $privacy_link_html
    );
}

// $terms_conditions_page_id   = Edumall::setting('page_for_terms_and_conditions', 0);
$terms_conditions_link_html = esc_html__('Terms', 'edumall');
if ($terms_conditions_page_id = '') {
    $terms_conditions_link_html = sprintf(
        '<a href="%1$s" class="edumall-terms-conditions-link" target="_blank">%2$s</a>',
        esc_url(get_permalink($terms_conditions_page_id)),
        $terms_conditions_link_html
    );
}
?>
                    <div class="form-group accept-account">
                        <label class="form-label form-label-checkbox" for="ip_accept_account">
                            <input type="checkbox" id="ip_accept_account" class="form-control" name="accept_account"
                                required value="1">
                            <?php printf(esc_html__('Accept the %1$s and %2$s', 'edumall'), $terms_conditions_link_html, $privacy_link_html);?>
                        </label>
                    </div>
                    <?php
/**
 * @since 2.8.4
 */
do_action('edumall_popup_register_after_form_field_accept');
?>
                    <?php do_action('edumall_popup_register_after_form_fields');?>
                    <div class="form-response-messages"></div>
                    <div class="form-group">
                        <?php wp_nonce_field('user_register', 'user_register_nonce');?>
                        <input type="hidden" name="action" value="edumall_user_register">
                        <button type="submit"
                            class="button form-submit"><?php esc_html_e('Register', 'edumall');?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- popup register signup end -->

<div class="wecoder-popup popup-lost-password open" id="popup-user-lost-password"
    data-template="template-parts/popup/popup-content-lost-password">
    <div class="popup-overlay"></div>
    <div class="popup-container">
        <div class="button-close-popup">
            <svg fill="#ffffff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24px" height="24px">
                <path
                    d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z" />
            </svg>
        </div>
        <div class="popup-content-wrap">
            <div class="popup-content-header">
                <h3 class="popup-title"><?php esc_html_e('Lost your password?', 'edumall');?></h3>
                <p class="popup-description">
                    <?php esc_html_e('Please enter your username or email address. You will receive a link to create a new password via email.', 'edumall');?>
                    <?php printf(esc_html__('Remember now? %1$sBack to login%2$s', 'edumall'), '<a href="#" class="open-popup-login link-transition-02">', '</a>');?>
                </p>
            </div>

            <div class="popup-content-body">
                <form id="edumall-lost-password-form" class="edumall-lost-password-form" method="post">

                    <?php do_action('edumall_popup_lost_password_before_form_fields');?>

                    <div class="form-group">
                        <label for="lost_password_user_login"
                            class="form-label"><?php esc_html_e('Username or email', 'edumall');?></label>
                        <input type="text" id="lost_password_user_login" class="form-control form-input"
                            name="user_login" placeholder="<?php esc_attr_e('Your username or email', 'edumall');?>">
                    </div>

                    <?php do_action('edumall_popup_lost_password_after_form_fields');?>

                    <div class="form-response-messages"></div>

                    <div class="form-group">
                        <?php wp_nonce_field('user_reset_password', 'user_reset_password_nonce');?>
                        <input type="hidden" name="action" value="edumall_user_reset_password">
                        <button type="submit"
                            class="button form-submit"><?php esc_html_e('Reset password', 'edumall');?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- popup password reset end -->