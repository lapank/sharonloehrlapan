<?php
class Onboarding {

  public $step;

  public function __construct() {

    wp_enqueue_script(BWG()->prefix . '_onboarding', BWG()->plugin_url . '/onboarding/assets/script.js', array('jquery'), BWG()->plugin_version);
    wp_localize_script(BWG()->prefix . '_onboarding', 'onboarding', array(
      'proceed' => __('Proceed', 'photo-gallery'),
      'signup' => __('Signup & install', 'photo-gallery'),
      'something_wrong' => __('Something went wrong, please try again.', 'photo-gallery'),
      'wrong_email' => __('Please enter a valid email address.', 'photo-gallery'),
      'empty_email' => __('Email field should not be empty.', 'photo-gallery'),
      'edit_page' => add_query_arg( array('page' => 'galleries_bwg', 'task' => 'edit'), admin_url( 'admin.php' ) ),
      'gallery_list_page' => add_query_arg( array('page' => 'galleries_bwg'), admin_url( 'admin.php' ) ),
      'onboarding_page' => add_query_arg( array('page' => 'onboarding_bwg'), admin_url( 'admin.php' ) ),
      'required_title_msg' => __('The gallery title is required', 'photo-gallery'),
      'bwg_nonce' => wp_create_nonce('bwg_nonce'),
      'speed_ajax_nonce' => wp_create_nonce('speed_ajax_nonce'),
  ));
    $task = WDWLibrary::get('task');
    if ( method_exists($this, $task) ) {
        $this->$task();
    }
    else {
      $this->display();
    }
  }

  /* Create gallery ajax action */
  public function add_first_gallery() {
    $bwg_nonce = WDWLibrary::get('bwg_nonce');
    if ( ! wp_verify_nonce( $bwg_nonce, 'bwg_nonce' ) ) {
      die;
    }
    $name = WDWLibrary::get('name');
    $slug = WDWLibrary::get_unique_value('bwg_gallery', 'slug', $name, 0);
    global $wpdb;
    $data = array(
      'name' => $name,
      'slug' => $slug,
      'order' => 0,
      'author' => get_current_user_id(),
      'published' => 1,
      'autogallery_image_number' => 12,
      'modified_date' => time(),
    );

    $format = array( '%s', '%s', '%d', '%d', '%d', '%d', '%d' );

    $saved = $wpdb->insert($wpdb->prefix . 'bwg_gallery', $data, $format);
    if ( $saved ) {
      $id = $wpdb->insert_id;
      wp_send_json_success(array('id'=>$id));
    }
    wp_send_json_error();
  }

  /* Change onboarding step ajax action */
  public function onboarding_step_change() {
    $bwg_nonce = WDWLibrary::get('bwg_nonce');
    if ( ! wp_verify_nonce( $bwg_nonce, 'bwg_nonce' ) ) {
      die;
    }
    $onboarding_step = WDWLibrary::get('onboarding_step');
      update_option( 'bwg_onboarding_step', $onboarding_step, 1 );
    $this->display();
    die;
  }

  /* Display steps views */
  public function display() {
    $bwg_onboarding_step = get_option( 'bwg_onboarding_step', false );
    if ( $bwg_onboarding_step ) {
      $this->step = $bwg_onboarding_step;
    } else {
      $this->step = "welcome";
    }
    wp_enqueue_style('twb-open-sans', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700,800&display=swap');
    wp_enqueue_style(BWG()->prefix . '_onboarding', BWG()->plugin_url . '/onboarding/assets/style.css', array('twb-open-sans'), BWG()->plugin_version);
    ?>
    <div class="bwg_onboarding_container">
    <?php
      $this->bwg_onboarding_header(); ?>
      <div class="bwg_onboarding_content">
        <?php
          if ( $this->step == "first_gallery" ) {
              echo $this->first_gallery_view();
          } elseif ( $this->step == "signup" ) {
              echo $this->signup_view();
          } elseif ( $this->step == "signup_done" ) {
              echo $this->signup_done_view();
          } else{
              echo $this->welcome_view();
          }

/*        echo $this->signup_view();*/
        ?>
      </div>
    </div>
    <?php
  }

  /* Create first gallery view */
  public function first_gallery_view() {
    ob_start();
    ?>
    <div class="bwg_onboarding_first_gallery_left">
      <h2><?php _e('Now let’s create your very first gallery', 'photo-gallery'); ?></h2>
      <p class="bwg_onboarding_first_gallery_descr">
        <?php _e('Create head-turning galleries, albums, or portfolio pages.', 'photo-gallery'); ?><br>
        <?php _e('Easily integrate them into your website, and optimize their', 'photo-gallery'); ?><br>
        <?php _e('speed for better performance.', 'photo-gallery'); ?>
      </p>
      <p><?php _e('Here’s how to do it:', 'photo-gallery'); ?></p>
      <div class="bwg_onboarding_first_gallery_steps">
        <span><?php _e('Create a gallery', 'photo-gallery'); ?></span>
        <span><?php _e('Insert it into your preferred page', 'photo-gallery'); ?></span>
        <span><?php _e('Choose the most suitable view', 'photo-gallery'); ?></span>
      </div>
        <input id="bwg_nonce" type="hidden" value="<?php echo wp_create_nonce( 'bwg_nonce' ) ?>">
        <input id="name" type="text" name="name" placeholder="<?php _e('Gallery title', 'photo-gallery'); ?>">
        <p class="bwg_error bwg_hidden"></p>
        <button id="bwg_add_first_gallery" class="bwg_onboarding_button">
          <?php _e("Proceed", "photo-gallery"); ?>
        </button>
    </div>
    <div class="bwg_onboarding_first_gallery_right"></div>
    <?php
    return ob_get_clean();
  }

  /* Welcome view */
  public function welcome_view() {
    ob_start();
    ?>
    <div class="bwg_onboarding_welcome_left">
      <h2><?php _e('Welcome to 10Web!', 'photo-gallery'); ?></h2>
      <p class="bwg_onboarding_welcome_descr"><?php _e('Before you get to gallery creation, we wanted to properly introduce you to 10Web.', 'photo-gallery'); ?></p>
      <p><?php _e('Photo gallery is only a small part of our platform.', 'photo-gallery'); ?></p>
      <p><?php _e('With 10Web, you can do much more for your entire website:', 'photo-gallery'); ?></p>
      <div class="bwg_onboarding_welcome_steps">
        <span><?php _e('Create stunning galleries and optimize them for better performance.', 'photo-gallery'); ?></span>
        <span><?php _e('Optimize your images and get a 90+ Page Speed Score.', 'photo-gallery'); ?></span>
        <span><?php _e('Enable CDN to get an incredibly fast and secure website for higher rankings and conversions.', 'photo-gallery'); ?></span>
      </div>
      <a class="bwg_onboarding_button bwg_onboarding_step_change" data-onboarding_step="signup"><?php _e('Got it', 'photo-gallery'); ?></a>
    </div>
    <div class="bwg_onboarding_welcome_right"></div>
    <?php
    return ob_get_clean();
  }

  /* Sign up view */
  public function signup_view() {
    ob_start();
    ?>
    <div class="bwg_onboarding_signup_left">
      <h2><?php _e('Optimize all images and galleries', 'photo-gallery'); ?></h2>
      <p class="bwg_onboarding_signup_descr"><?php _e('Make all the images of your website, not just your galleries, load faster by getting started with 10Web Booster for free.', 'photo-gallery'); ?></p>
      <div class="bwg_onboarding_signup_steps">
        <span><?php _e('Optimize all the images of your website, including ones that are not part of your galleries, so they load faster for visitors.', 'photo-gallery'); ?></span>
        <span><?php _e('Speed up your entire website and get a 90+ PageSpeed score to improve Google rankings and conversions.', 'photo-gallery'); ?></span>
      </div>
      <input type="text" placeholder="<?php _e('Email address', 'photo-gallery'); ?>" id="bwg_signup_email">
      <p class="bwg_error bwg_hidden"><?php _e('This is not a valid email address.', 'photo-gallery'); ?></p>
      <a class="bwg_onboarding_button bwg_onboarding_signup_button" data-onboarding_step="signup_done"><?php _e('Signup & install', 'photo-gallery'); ?></a>
      <div class="bwg_onboarding_signup_footer_info">
        <p><?php _e('We will install the 10Web Booster plugin during signup from the WordPress.org repository.', 'photo-gallery'); ?></p>
        <p>
          <?php echo sprintf(__('By signing up, you agree to 10Web’s %s and %s.', 'photo-gallery'),
                        "<a href='https://10web.io/terms-of-service/' target='_blank'>".__('Terms of Service', 'photo-gallery')."</a>",
                        "<a href='https://10web.io/privacy-policy/' target='_blank'>".__('Privacy Policy', 'photo-gallery')."</a>"); ?>
        </p>
      </div>
    </div>
    <div class="bwg_onboarding_signup_right">
      <span class="skip_to_PG bwg_onboarding_step_change" data-onboarding_step="first_gallery"><?php _e('Skip to Photo Gallery', 'photo-gallery'); ?></span>
    </div>
    <?php
    return ob_get_clean();
  }
  public function signup_done_view() {
      $email = WDWLibrary::get('email');
    ob_start();
    ?>
    <div class="bwg_onboarding_signup_left bwg_onboarding_signup_done_left">
      <h2><?php _e('Optimize all images and galleries', 'photo-gallery'); ?></h2>
      <p class="bwg_onboarding_signup_descr"><?php _e('Make all the images of your website, not just your galleries, load faster by getting started with 10Web Booster for free.', 'photo-gallery'); ?></p>
      <div class="bwg_onboarding_signup_steps">
        <span><?php _e('Optimize all the images of your website, including ones that are not part of your galleries, so they load faster for visitors.', 'photo-gallery'); ?></span>
        <span><?php _e('Speed up your entire website and get a 90+ PageSpeed score to improve Google rankings and conversions.', 'photo-gallery'); ?></span>
      </div>
      <div class="bwg_onboarding_signup_done_message">
          <img src="<?php echo BWG()->plugin_url ?>/onboarding/assets/images/green_tick.png">
          <span><?php _e('Congrats, you just signed up for 10Web. All you need to do to optimize <br> your website for free is activate the plugin.', 'photo-gallery'); ?></span>
      </div>
      <input type="text" disabled value="<?php echo esc_html($email); ?>" placeholder="<?php _e('Email address', 'photo-gallery'); ?>" id="bwg_signup_email">
      <a class="bwg_onboarding_button bwg_onboarding_step_change" data-onboarding_step="first_gallery"><?php _e('Done', 'photo-gallery'); ?></a>
    </div>
    <div class="bwg_onboarding_signup_right">
    </div>
    <?php
    return ob_get_clean();
  }

  /* Header part of onboarding */
  public function bwg_onboarding_header() {
  ?>
    <div class="bwg_onboarding_header">
      <div class="bwg_onboarding_header_logo_cont"><img src="<?php echo BWG()->plugin_url ?>/onboarding/assets/images/logo.svg"></div>
      <a href="<?php echo admin_url( 'admin.php?page=galleries_' . BWG()->prefix ); ?>" class="bwg_onboarding_close"></a>
    </div>
  <?php
  }
}
?>