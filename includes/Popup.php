<?php

namespace Wecoder\Registration;

/**
 * Popup Class
 */

class Popup
{
    public $template_loader;
    public function __construct($template_loader)
    {
        $this->template_loader = $template_loader;
        add_action('wp_footer', [$this, 'add_popup_pre_loader']);
        add_action('wp_footer', [$this, 'popup_login']);

        add_action('wp_ajax_edumall_lazy_load_template', [$this, 'ajax_load_template_part']);
        add_action('wp_ajax_nopriv_edumall_lazy_load_template', [$this, 'ajax_load_template_part']);
    }

    public function add_popup_pre_loader()
    {
        ?>
         <section class="popup-pre-loader-box" id="popup-pre-loader-box">
            <div class="popup-pre-loader-inner">
                <div class="loader"></div>
            </div>
        </section>
<?php
}

    public function popup_login()
    {
        if (!is_user_logged_in()) {
            $this->template_loader->get_template_part('popup/popup-user');
        }
    }

    public function ajax_load_template_part()
    {
        $template = $_REQUEST['template'];

        if (!isset($template) || '' === $template) {
            wp_die();
        }

        ob_start();

        $this->template_loader->get_template_part($template);

        $html = ob_get_contents();
        ob_clean();

        if ($html) {
            echo '' . $html;
        } else {
            echo 0;
        }
        wp_die();
    }
}
