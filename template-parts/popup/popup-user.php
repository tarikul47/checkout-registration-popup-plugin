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

<div class="wecoder-popup popup-user-login" id="popup-user-login" data-template="popup/popup-content-login">
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
            <!-- login content here  -->
        </div>
    </div>
</div>
<!-- popup login end -->

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
            <!-- Popup register content -->
        </div>
    </div>
</div>
<!-- popup register signup end -->

<div class="wecoder-popup popup-lost-password" id="popup-user-lost-password"
    data-template="popup/popup-content-lost-password">
    <div class="popup-overlay"></div>
    <div class="popup-container">
        <div class="button-close-popup">
            <svg fill="#ffffff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24px" height="24px">
                <path
                    d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z" />
            </svg>
        </div>
        <div class="popup-content-wrap">
            <!-- popup password reset here -->
        </div>
    </div>
</div>

<!-- popup password reset end -->