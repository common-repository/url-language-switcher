<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://niklas-grieger.de/
 * @since      1.0.0
 *
 * @package    Url_Lang_Switcher
 * @subpackage Url_Lang_Switcher/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Url_Lang_Switcher
 * @subpackage Url_Lang_Switcher/admin
 * @author     Niklas Grieger <developer@niklas-grieger.de>
 */
class Url_Lang_Switcher_Global {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

    public function change_lang( $locale ) {
        $lang = isset($_GET['lang']) ? $_GET['lang'] : null;

        if($lang !== null){
            return $lang;
        }else{
            if($lang = get_user_meta( get_current_user_id(), 'locale', true)){
                return $lang;
            }
        }
        return $locale;

    }
    function custom_pre_determine_locale(){
        $current_user_lang = get_user_meta( get_current_user_id(), 'locale', true);

        $chosen_lang = isset($_GET['lang']) ? $_GET['lang'] : null;

        if($chosen_lang !== null){
            return $chosen_lang;
        }else{
            return $current_user_lang;
        }
    }

    public function custom_admin_toolbar($wp_admin_bar){
        $user_language = get_user_locale( get_current_user_id() );
        $lang          = isset( $_GET['lang'] ) ? $_GET['lang'] : $user_language;

        //Add language switcher
        $args = array(
            'id'     => 'custom-language-switcher',
            'title'  => '<div class="dashicons-before dashicons-translation">'
                .__('Change language', 'url-lang-switcher').'</div>',
            'parent' => 'top-secondary'

        );
        $wp_admin_bar->add_menu($args);

        $user_language = get_user_locale( get_current_user_id() );
        $lang          = isset( $_GET['lang'] ) ? $_GET['lang'] : $user_language;
        $available_languages     = get_available_languages();

        // Use US English if the default isn't available.
        if ( ! in_array( $lang, $available_languages ) ) {
            $lang = '';
        }

        require_once ABSPATH . 'wp-admin/includes/translation-install.php';

        $translations = wp_get_available_translations();
        // Languages packs don't include en_US
        $translations['en_US'] = array(
            'language'     => 'en_US',
            'native_name'     => 'English',
            'iso'      => array(
                1 => 'us'
            )
        );
        array_push($available_languages, 'en_US');
        foreach ($available_languages as $language){
            //$language_obj = unserialize($language->description);
            $region_code = strtolower(substr($language, -2));
            $flag = '<img src="'.plugin_dir_url( __FILE__ ) . '../assets/img/flags/'.$region_code.'.png" style="margin-right:6px !important;"/>';
            $args = array(
                'id'     => 'lang-switcher-'.$region_code,
                'title'  => $flag . $translations[$language]['native_name'],
                'parent' => 'custom-language-switcher',
                'href'   => add_query_arg('lang',$translations[$language]['language']),
                'meta'   => array(
                    'class' => 'custom-language-switcher-link'
                )
            );

            $wp_admin_bar->add_node( $args );
        }
    }
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Url_Lang_Switcher_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Url_Lang_Switcher_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/url-lang-switcher-global.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Url_Lang_Switcher_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Url_Lang_Switcher_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/url-lang-switcher-global.js', array( 'jquery' ), $this->version, false );

	}

}
