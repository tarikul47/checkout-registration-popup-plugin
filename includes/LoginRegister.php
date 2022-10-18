<?php
namespace Wecoder\Registration;

/**
 * Login and Registeration class
 */

class LoginRegister
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        add_action('wp_ajax_nopriv_edumall_user_register', [$this, 'user_register']);
        add_action('wp_ajax_nopriv_wecoder-crp_user_login', [$this, 'user_login']);
        add_action('wp_ajax_edumall_user_reset_password', [$this, 'reset_password']);
        add_action('wp_ajax_nopriv_edumall_user_reset_password', [$this, 'reset_password']);
    }

    public function user_register()
    {
        if (!check_ajax_referer('user_register', 'user_register_nonce')) {
            wp_die();
        }

        /**
         * Return array to prevent user register.
         * For eg: array = [
         *   'success'  => false,
         *   'messages' => 'Some messages',
         * ]
         */
        // $result = apply_filters('edumall_pre_user_register', null);

        // if (null !== $result) {
        //     echo json_encode($result);
        //     wp_die();
        // }

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user_login = $_POST['username'];
        $userdata = [
            'first_name' => $firstname,
            'last_name' => $lastname,
            'user_login' => $user_login,
            'user_email' => $email,
            'user_pass' => $password,
        ];

        // Remove all illegal characters from email.
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        $success = false;
        $msg = esc_html__('Username/Email address is existing', 'edumall');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $success = false;
            $msg = esc_html__('A valid email address is required', 'edumall');
        } else {
            $user_id = wp_insert_user($userdata);

            if (!is_wp_error($user_id)) {
                $creds = array();
                $creds['user_login'] = $user_login;
                $creds['user_email'] = $email;
                $creds['user_password'] = $password;
                $creds['remember'] = true;
                $user = wp_signon($creds, false);

                $msg = esc_html__('Congratulations, register successful, Redirecting...', 'edumall');
                $success = true;

                do_action('edumall_user_register_after', $user_id);
            }

            echo json_encode([
                'success' => $success,
                'messages' => $msg,
            ]);
        }

        wp_die();
    }

    public function user_login()
    {
        if (!check_ajax_referer('user_login', 'user_login_nonce')) {
            wp_die();
        }

        /**
         * Return array to prevent user login.
         * For eg: array = [
         *   'success'  => false,
         *   'messages' => 'Some messages',
         * ]
         *
         * @since 2.5.0
         */
        // $result = apply_filters('edumall_pre_user_login', null);

        // if (null !== $result) {
        //     echo json_encode($result);
        //     wp_die();
        // }

        $user_login = $_POST['user_login'];
        $password = $_POST['password'];
        $remember = isset($_POST['rememberme']) && 'forever' === $_POST['rememberme'] ? true : false;

        if (filter_var($user_login, FILTER_VALIDATE_EMAIL)) {
            $user = get_user_by('email', $user_login);
        } else {
            $user = get_user_by('login', $user_login);
        }

        $success = false;
        $msg = esc_html__('Username or password is wrong. Please try again!', 'edumall');

        if ($user && wp_check_password($password, $user->data->user_pass, $user->ID)) {
            $credentials = [
                'user_login' => $user->data->user_login,
                'user_password' => $password,
                'remember' => $remember,
            ];

            $user = wp_signon($credentials);

            if (!is_wp_error($user)) {
                $success = true;
                $msg = esc_html__('Login successful, Redirecting...', 'edumall');
            }
        }

        // $redirect_type = Edumall::setting('login_redirect');
        // $redirect_url = '/';

        // switch ($redirect_type) {
        //     case 'home':
        //         $redirect_url = home_url();
        //         break;
        //     case 'dashboard':
        //         if (Edumall_Tutor::instance()->is_activated()) {
        //             $redirect_url = tutor_utils()->get_tutor_dashboard_page_permalink();
        //         }
        //         break;
        //     case 'custom':
        //         $redirect_url = Edumall::setting('custom_login_redirect');
        //         break;
        // }

        // $redirect_url = apply_filters('edumall_login_redirect', $redirect_url);

        echo json_encode([
            'success' => $success,
            'messages' => $msg,
            //  'redirect_url' => esc_url($redirect_url),
        ]);
        wp_die();
    }

    public function reset_password()
    {
        if (!check_ajax_referer('user_reset_password', 'user_reset_password_nonce')) {
            wp_die();
        }

        /**
         * Return array to prevent user reset password.
         * For eg: array = [
         *   'success'  => false,
         *   'messages' => 'Some messages',
         * ]
         *
         * @since 2.5.0
         */
        // $result = apply_filters('edumall_pre_user_reset_password', null);

        // if (null !== $result) {
        //     echo json_encode($result);
        //     wp_die();
        // }

        $allowed_html = array();
        $user_login = wp_kses($_POST['user_login'], $allowed_html);

        if (empty($user_login)) {
            echo json_encode(array(
                'success' => false,
                'messages' => esc_html__('Enter a username or email address.', 'edumall'),
            ));
            wp_die();
        }

        if (filter_var($user_login, FILTER_VALIDATE_EMAIL)) {
            $user_data = get_user_by('email', trim($user_login));
            if (empty($user_data)) {
                echo json_encode(array(
                    'success' => false,
                    'messages' => esc_html__('There is no user registered with that email address.', 'edumall'),
                ));
                wp_die();
            }
        } else {
            $login = trim($user_login);
            $user_data = get_user_by('login', $login);

            if (!$user_data) {
                echo json_encode(array(
                    'success' => false,
                    'messages' => esc_html__('Invalid username', 'edumall'),
                ));
                wp_die();
            }
        }

        $user_login = $user_data->user_login;
        $user_email = $user_data->user_email;
        $key = get_password_reset_key($user_data);

        if (is_wp_error($key)) {
            echo json_encode(array('success' => false, 'messages' => $key));
            wp_die();
        }

        $message = esc_html__('Someone has requested a password reset for the following account:', 'edumall') . "\r\n\r\n";
        $message .= network_home_url('/') . "\r\n\r\n";
        $message .= sprintf(esc_html__('Username: %s', 'edumall'), $user_login) . "\r\n\r\n";
        $message .= esc_html__('If this was a mistake, just ignore this email and nothing will happen.', 'edumall') . "\r\n\r\n";
        $message .= esc_html__('To reset your password, visit the following address:', 'edumall') . "\r\n\r\n";
        $message .= '<' . network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . ">\r\n";

        if (is_multisite()) {
            $blogname = $GLOBALS['current_site']->site_name;
        } else {
            $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
        }

        $title = sprintf(esc_html__('[%s] Password Reset', 'edumall'), $blogname);
        $title = apply_filters('retrieve_password_title', $title, $user_login, $user_data);
        $message = apply_filters('retrieve_password_message', $message, $key, $user_login, $user_data);
        if ($message && !wp_mail($user_email, wp_specialchars_decode($title), $message)) {
            echo json_encode(array(
                'success' => false,
                'messages' => esc_html__('The email could not be sent.', 'edumall') . "<br />\n" . esc_html__('Possible reason: your host may have disabled the mail function.', 'edumall'),
            ));
            wp_die();
        } else {
            echo json_encode(array(
                'success' => true,
                'messages' => esc_html__('Please, Check your email to get new password', 'edumall'),
            ));
            wp_die();
        }
    }
}
