<?php
/**
 * Options
 *
 * @package aucor_content_freeze
 */

defined('ABSPATH') or die('No script kiddies please!');

/**
 * Register and render options
 */
class Aucor_Content_Freeze_Options {

  public function __construct() {

    add_filter('plugin_action_links', array($this, 'action_links'), 10, 2);
    add_action('admin_menu',          array($this, 'register_settings_page'));
    add_action('admin_init',          array($this, 'register_settings'));

  }

  /**
   * Is administrator
   *
   * @return bool
   */
  private function is_administrator() {

    $user = wp_get_current_user();
    if ($user instanceof WP_User && array_intersect(array('administrator'), $user->roles)) {
      return true;
    }
    return false;

  }

  /**
   * Add action link to options
   *
   * @param array $links
   * @param string $file
   */
  public function action_links($links, $file) {

    if (defined('AUCOR_CONTENT_FREEZE_PLUGIN_PATH') && $file === AUCOR_CONTENT_FREEZE_PLUGIN_PATH && $this->is_administrator()) {
      array_unshift($links, '<a href="' . admin_url('options-general.php?page=aucor_content_freeze') . '">'
        . __('Settings') . '</a>');
    }
    return $links;

  }
  /**
   * Register the settings page
   *
   * @wp-action admin_menu
   */
  public function register_settings_page() {

    if ($this->is_administrator()) {
      add_submenu_page(
        null,
        __('Aucor Content Freeze', 'aucor_content_freeze'),
        __('Aucor Content Freeze', 'aucor_content_freeze'),
        'manage_options',
        'aucor_content_freeze',
        array($this, 'ui')
      );
    }

  }
  /**
   * Register settings in admin
   */

  public function register_settings() {

    // section for aucor content freeze settings
    add_settings_section('aucor_content_freeze_section', null, null, 'aucor_content_freeze');

    // Notification text
    add_settings_field(
      'aucor_content_freeze_notification_text',
      'Notification',
      array($this, 'aucor_content_freeze_text_element'),
      'aucor_content_freeze',
      'aucor_content_freeze_section',
      array(
        'id' => 'aucor_content_freeze_notification_text',
        'size' => 120
      )
    );
    register_setting('aucor_content_freeze_settings', 'aucor_content_freeze_notification_text');

  }

  public function aucor_content_freeze_text_element($args) {
    $key = apply_filters($args['id'], get_option($args['id']));
    echo '<input type="text" id="' . $args['id'] . '" name="' . $args['id'] . '" value="' . $key . '" size="' . $args['size'] . '" />';
  }
  /**
   * Render UI
   */
  public function ui() {

    if (!$this->is_administrator()) {
      return;
    }

    ?>
    <div class="wrap">
      <h2><?php _e('Aucor Content Freeze', 'aucor_content_freeze'); ?></h2>
      <form action="options.php" method="POST">
        <?php
          do_settings_sections('aucor_content_freeze');
          settings_fields('aucor_content_freeze_settings');
          submit_button();
        ?>
      </form>
    </div>
    <?php
  }
}

/**
 * Init optins
 */
function aucor_content_freeze_options_init() {

  new Aucor_Content_Freeze_Options();

}
add_action('init', 'aucor_content_freeze_options_init');

