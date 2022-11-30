<?php

/**
 * Class TWBElementor
 */
class TWBElementor {
  private $booster;

  function __construct( $booster ) {
    $this->booster = $booster;
    add_action('elementor/editor/after_enqueue_scripts', array( $this, 'scripts_styles' ));
    add_action('elementor/documents/register_controls', array( $this,'register_document_controls' ));
  }

  /**
   * Enqueue scripts.
   *
   * @return void
   */
  public function scripts_styles() {
    wp_enqueue_style('twb-open-sans', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700,800&display=swap');
    wp_enqueue_style(TenWebBooster::PREFIX . '-global', $this->booster->plugin_url . '/assets/css/global.css', array( 'twb-open-sans' ), TenWebBooster::VERSION);
    if ( $this->booster->cta_button['button_color'] || $this->booster->cta_button['text_color'] ) {
      wp_add_inline_style(TenWebBooster::PREFIX . '-global', '.twb-custom-button, .twb-custom-button:hover {background-color: ' . $this->booster->cta_button['button_color'] . ' !important; color: ' . $this->booster->cta_button['text_color'] . ' !important;}');
    }

    wp_enqueue_script(TenWebBooster::PREFIX . '-elementor', $this->booster->plugin_url . '/assets/js/elementor.js', array('jquery'), TenWebBooster::VERSION);
    wp_localize_script(TenWebBooster::PREFIX . '-elementor', 'twb', array(
      'title' => $this->booster->cta_button['section_label'],
    ));
  }

  /**
   * Register additional document controls.
   *
   * @param \Elementor\Core\DocumentTypes\PageBase $document The PageBase document instance.
   */
  public function register_document_controls( $document ) {
    if ( ! $document instanceof \Elementor\Core\DocumentTypes\PageBase || ! $document::get_property( 'has_elements' ) || !empty($document->get_section_controls('twb_optimize_section')) ) {
      return;
    }

    $section_label = isset($this->booster->cta_button['section_label']) ? $this->booster->cta_button['section_label'] : '';

    \Elementor\Controls_Manager::add_tab('twb_optimize', $section_label);

    $document->start_controls_section(
      'twb_optimize_section',
      [
        'tab' => 'twb_optimize',
      ]
    );

    $content = TWBLibrary::twb_button_template( $this->booster );
    $content .=  TWBLibrary::dismiss_info_content( $this->booster );
    $classname = 'twb_elementor_settings_content twb_optimized';
    $label_html = '';
    if ( $section_label != '' ) {
      $label_html = '<p class="twb_elementor_control_title">' . esc_html($section_label) . '</p>';
    }

    $document->add_control(
      'twb_raw_html',
      [
        'label' => $label_html,
        'type' => \Elementor\Controls_Manager::RAW_HTML,
        'raw' => $content,
        'content_classes' => $classname,
      ]
    );

    $document->end_controls_section();
  }
}
