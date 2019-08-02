<?php
/**
 * Options
 *
 * @package aucor_content_freeze
 */

defined('ABSPATH') or die('No script kiddies please!');

function admin_maintenance_notice() {
  ?>
  <style>
    .maintenance-notice {
      border: none;
      padding: 4.5rem;
      justify-content: center;
      background: repeating-linear-gradient(
        45deg,
        #C82986,
        #C82986 2rem,
        #CB3289 2rem,
        #CB3289 4rem
      );
    }
    .maintenance-notice > span > svg {
      padding-bottom: 2rem;
      margin:auto;
      display: block;
      fill: white;
      width: 5rem;
      height:5rem;
    }
    .maintenance-notice > span {
      color: white;
      font-size: 2rem;
      font-weight: lighter;
      line-height: 2.5rem;
      max-width: 55rem;
      text-align: center;
      margin:auto;
      display: block;
    }
  </style>
  <div class="notice maintenance-notice">

    <span>
      <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
        <title>warning</title>
        <path d="M16 2.899l13.409 26.726h-26.819l13.409-26.726zM16 0c-0.69 0-1.379 0.465-1.903 1.395l-13.659 27.222c-1.046 1.86-0.156 3.383 1.978 3.383h27.166c2.134 0 3.025-1.522 1.978-3.383h0l-13.659-27.222c-0.523-0.93-1.213-1.395-1.903-1.395v0z"></path>
        <path d="M18 26c0 1.105-0.895 2-2 2s-2-0.895-2-2c0-1.105 0.895-2 2-2s2 0.895 2 2z"></path>
        <path d="M16 22c-1.105 0-2-0.895-2-2v-6c0-1.105 0.895-2 2-2s2 0.895 2 2v6c0 1.105-0.895 2-2 2z"></path>
      </svg>
      <?php echo get_option('aucor_content_freeze_notification_text'); ?>
    </span>
  </div>
  <?php
}
if (!empty(get_option('aucor_content_freeze_notification_text'))) {
  add_action( 'admin_notices', 'admin_maintenance_notice' );
}
