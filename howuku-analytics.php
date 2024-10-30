<?php
/*
Plugin Name: Howuku
Description: The easy way to session recording in your Wordpress website!
Version: 1.0.5
Author: Howuku
Author URI: http://www.howuku.com
License: GPL
*/

class Howuku {
  var $longName = 'Howuku for WordPress Options';
  var $shortName = 'Howuku';
  var $uniqueID = 'howuku-session-recording';

  function __construct() {
    register_deactivation_hook(__FILE__, array( $this, 'delete_option' ) );
    add_action( 'wp_head', array( $this, 'add_script' ) );
    if ( is_admin() ) {
      add_action( 'admin_menu', array( $this, 'admin_menu_page' ) );
      add_action( 'admin_init', array( $this, 'register_settings' ) );
      add_filter( 'plugin_action_links_'.plugin_basename( __FILE__ ), array( $this, 'add_settings_link' ) );
      add_action( 'wp_loaded', array( $this, 'migration_check' ) );
    }
  }

  public function delete_option() {
    delete_option('howuku_tracking_script');
  }

  public function add_script() {
    echo get_option('howuku_tracking_script');
  }

  public function admin_menu_page() {
    add_menu_page(
      $this->longName,
      $this->shortName,
      'administrator',
      $this->uniqueID,
      array( $this, 'admin_options'),
      plugins_url('images/icon.png', __FILE__)
    );
  }

  public function register_settings() {
    register_setting( 'howuku-options', 'howuku_tracking_script' );
  }

  public function admin_options() {
    include 'views/options.php';
  }

  public function add_settings_link( $links ) {
    $settings_link = array( '<a href="admin.php?page=howuku-session-recording">Settings'.'</a>' );
    return array_merge( $links, $settings_link );
  }

  public function migration_check() {
      wp_enqueue_script( 'howuku.js', 'https://cdn.howuku.com/js/howu.js');
      add_filter( 'script_loader_tag', 'add_key_to_script', 10, 3 );
      function add_key_to_script( $tag, $handle, $source ) {
          if ( 'howuku.js' === $handle ) {
              $tag = str_replace( ' src', ' key="' . get_option('howuku_tracking_script') . '" src', $tag );
          }
          return $tag;
      }
  }
}

add_action( 'init', 'HowukuForWordPress' );
function HowukuForWordPress() {
  global $HowukuForWordPress;

  $HowukuForWordPress = new Howuku();
}
?>
