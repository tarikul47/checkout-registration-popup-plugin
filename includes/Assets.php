<?php

namespace Wecoder\Registration;

/**
 * Assets handlers class
 */
class Assets
{

    /**
     * Class constructor
     */
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'register_assets']);
        // add_action('admin_enqueue_scripts', [$this, 'register_assets']);
    }

    /**
     * All available scripts
     *
     * @return array
     */
    public function get_scripts()
    {
        return [
            'registration-popup-validate-script' => [
                'src' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js',
                'version' => '1.0.0',
                'deps' => ['jquery'],
            ],
            'registration-popup-script' => [
                'src' => WC_REGISTRATION_POPUP_ASSET . '/js/script.js',
                'version' => filemtime(WC_REGISTRATION_POPUP_DIR . '/assets/js/script.js'),
                'deps' => ['registration-popup-validate-script'],
            ]
        ];
    }

    /**
     * All available styles
     *
     * @return array
     */
    public function get_styles()
    {
        return [
            'registration-popup-style' => [
                'src' => WC_REGISTRATION_POPUP_ASSET . '/css/style.css',
                'version' => filemtime(WC_REGISTRATION_POPUP_DIR . '/assets/css/style.css'),
            ],
            'registration-popup-fontawesome' => [
                'src' => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
                'version' => null,
            ],
        ];
    }

    /**
     * Register scripts and styles
     *
     * @return void
     */
    public function register_assets()
    {
        $scripts = $this->get_scripts();
        $styles = $this->get_styles();

        foreach ($scripts as $handle => $script) {
            $deps = isset($script['deps']) ? $script['deps'] : false;

            //wp_register_script($handle, $script['src'], $deps, $script['version'], true);
            wp_enqueue_script($handle, $script['src'], $deps, $script['version'], true);
        }

        foreach ($styles as $handle => $style) {
            $deps = isset($style['deps']) ? $style['deps'] : false;

            //wp_register_style($handle, $style['src'], $deps, $style['version']);
            wp_enqueue_style($handle, $style['src'], $deps, $style['version']);
        }

        wp_localize_script('registration-popup-script', 'wc_registration_popup', [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'error' => __('Something went wrong', 'wc_crp'),
        ]);

        /*
         * Enqueue custom variable JS
         */
        $js_variables = array(
            'validatorMessages' => [
                'required' => esc_html__('This field is required', 'edumall'),
                'remote' => esc_html__('Please fix this field', 'edumall'),
                'email' => esc_html__('A valid email address is required', 'edumall'),
                'url' => esc_html__('Please enter a valid URL', 'edumall'),
                'date' => esc_html__('Please enter a valid date', 'edumall'),
                'dateISO' => esc_html__('Please enter a valid date (ISO)', 'edumall'),
                'number' => esc_html__('Please enter a valid number.', 'edumall'),
                'digits' => esc_html__('Please enter only digits.', 'edumall'),
                'creditcard' => esc_html__('Please enter a valid credit card number', 'edumall'),
                'equalTo' => esc_html__('Please enter the same value again', 'edumall'),
                'accept' => esc_html__('Please enter a value with a valid extension', 'edumall'),
                'maxlength' => esc_html__('Please enter no more than {0} characters', 'edumall'),
                'minlength' => esc_html__('Please enter at least {0} characters', 'edumall'),
                'rangelength' => esc_html__('Please enter a value between {0} and {1} characters long', 'edumall'),
                'range' => esc_html__('Please enter a value between {0} and {1}', 'edumall'),
                'max' => esc_html__('Please enter a value less than or equal to {0}', 'edumall'),
                'min' => esc_html__('Please enter a value greater than or equal to {0}', 'edumall'),
            ],
        );
        wp_localize_script('registration-popup-script', '$edumallLogin', $js_variables);

        // wp_localize_script( 'academy-admin-script', 'weDevsAcademy', [
        //     'nonce' => wp_create_nonce( 'wd-ac-admin-nonce' ),
        //     'confirm' => __( 'Are you sure?', 'wedevs-academy' ),
        //     'error' => __( 'Something went wrong', 'wedevs-academy' ),
        // ] );
    }
}
