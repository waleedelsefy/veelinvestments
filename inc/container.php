<?php
/**
 * Container
 *
 * @package Didos
 * @version 0.0.1
 */
defined( 'ABSPATH' ) || exit;
/**
 * Allow modifying the default bootstrap container class
 * @return string
 */
if (!function_exists('veelinvestments_container_class')) {
  function veelinvestments_container_class() {
    return "container";
  }
}
