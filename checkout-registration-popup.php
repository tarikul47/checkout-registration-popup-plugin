<?php

/**
 * Plugin Name: Checkout Registration Popup
 * Description: The login popup shows on wocommerce checkout page
 * Plugin URI: https://onlytarikul.info
 * Author: Tarikul Islam
 * Author URI: https://onlytarikul.info
 * Version: 1.0
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wecoder-crp
 * Domain Path: /languages
 */
if (!defined('ABSPATH')) {
    exit;
}


// autoloader include
require_once __DIR__ . "/vendor/autoload.php";
/**
 * Our Main Class
 */
final class Wecoder_Registration_Popup
{
    /**
     * Plugin version
     * @var string
     */
    const version = '1.0.0';
    /**
     * class constructor
     */
    private function __construct()
    {
        $this->define_constants();
        register_activation_hook(__FILE__, [$this, 'activate']);
        add_action('plugin_loaded', [$this, 'init_plugin']);
    }

    /**
     * Define the required plugin constants
     * @return void
     */
    public function define_constants()
    {
        define('WC_REGISTRATION_POPUP_VERSION', self::version);
        define('WC_REGISTRATION_POPUP_FILE', __FILE__);
        define('WC_REGISTRATION_POPUP_DIR', plugin_dir_path(WC_REGISTRATION_POPUP_FILE));
        define('WC_REGISTRATION_POPUP_URL', plugins_url('', WC_REGISTRATION_POPUP_FILE));
        define('WC_REGISTRATION_POPUP_ASSET', WC_REGISTRATION_POPUP_URL . '/assets');
    }
    /**
     * Initialize the plugin
     * @return void
     */
    public function init_plugin()
    {
        // Assets include
        new \Wecoder\Registration\Assets();

        // wocommerce template override
        $template_loader = new \Wecoder\Registration\Template();

        // Popup include
        new \Wecoder\Registration\Popup($template_loader);

        // Registration functionality include 
        new \Wecoder\Registration\LoginRegister();
    }
    /**
     * Initializes a singletone instance
     * @return Wecoder\Wecoder_Registration_Popup
     */
    public static function init()
    {
        static $instance = false;
        if (!$instance) {
            $instance = new self();
        }
        return $instance;
    }
    /**
     * Do staf upon plugin activation
     */
    public function activate()
    {

        $installed = get_option('wc_plugin_installed');
        if (!$installed) {
            update_option('wc_plugin_installed', time());
        }
        update_option('wc_plugin_version', WC_REGISTRATION_POPUP_VERSION);
    }
}
/**
 * Initializes the main plugin
 */
function wecoder_registration_popup()
{
    return Wecoder_Registration_Popup::init();
}
// kick of the plugin
wecoder_registration_popup();
