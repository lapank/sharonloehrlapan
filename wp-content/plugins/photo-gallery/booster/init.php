<?php
add_action('init', function() {
  add_filter('tenweb_booster_sdk', function($path) {
    $version = '1.0.0';
    if ( !isset($path['version']) || version_compare($path['version'], $version) === -1 ) {
      $path['version'] = $version;
      if ( strpos(str_replace("/", "\\", plugin_dir_path( __FILE__ )), str_replace("/", "\\", WP_PLUGIN_DIR)) > -1 ) {
        $path['path'] = WP_PLUGIN_DIR . "/" . plugin_basename(dirname(__FILE__));
      } else {
        $path['path'] = get_template_directory().'/booster/';
      }
    }

    return $path;
  });
}, 8);
add_action('init', function() {
  if (!class_exists("TenWebBooster")) {
    if ( strpos( str_replace("/", "\\", plugin_dir_path( __FILE__ )), str_replace("/", "\\", WP_PLUGIN_DIR) ) > -1 ) {
      $plugin_dir = apply_filters('tenweb_booster_sdk', array(
        'version' => '1.0.0',
        'path' => WP_PLUGIN_DIR . "/" . plugin_basename(dirname(__FILE__)),
      ));
    } else {
      $plugin_dir = apply_filters('tenweb_booster_sdk', array(
        'version' => '1.0.0',
        'path' => get_template_directory().'/booster/',
      ));
    }
    require_once($plugin_dir['path'] . '/main.php');

    function TWB($params = array()) {
      if ( isset($params['is_plugin']) && !$params['is_plugin'] ) {
        $plugin_dir = get_template_directory().'/booster';
        $plugin_url = get_template_directory_uri() . "/booster";
      } else {
        $plugin_dir = WP_PLUGIN_DIR . "/" . plugin_basename(dirname(__FILE__));
        $plugin_url = plugins_url(plugin_basename(dirname(__FILE__)));
      }
      $params['plugin_dir'] = $plugin_dir;
      $params['plugin_url'] = $plugin_url;
      return new TenWebBooster($params);
    }
  }
}, 10);