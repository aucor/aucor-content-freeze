<?php
/**
 * Plugin Name: Aucor Content Freeze
 * Plugin URI: https://github.com/aucor/aucor-content-freeze
 * Description: Content freeze plugin for maintenance
 * Version: 1.0
 * Author: Aucor Oy
 * Author URI: https://www.aucor.fi/
 * License: GPL2+
 */
 
class Aucor_Content_Freeze {

  function __construct() {
    define('AUCOR_CONTENT_FREEZE_PLUGIN_PATH', plugin_basename(__FILE__));
    require_once 'features/admin/admin-settings.php';
    require_once 'features/admin/admin-notice.php';
  }

  // @TODO notification
}
/**
 * Init plugin
 */
function aucor_content_freeze_init() {
  $aucor_content_freeze = new Aucor_Content_Freeze();
}
add_action('after_setup_theme', 'aucor_content_freeze_init');

