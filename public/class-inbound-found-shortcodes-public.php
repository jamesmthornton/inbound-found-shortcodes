<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://morphatic.com
 * @since      1.0.0
 *
 * @package    Inbound_Found_Shortcodes
 * @subpackage Inbound_Found_Shortcodes/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Inbound_Found_Shortcodes
 * @subpackage Inbound_Found_Shortcodes/public
 * @author     Morgan Benton <morgan.benton@gmail.com>
 */
class Inbound_Found_Shortcodes_Public {

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
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( 'if_fonts', 'https://fonts.googleapis.com/css?family=Mukta:300,600|Open+Sans:300' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/inbound-found-shortcodes-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Inbound_Found_Shortcodes_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Inbound_Found_Shortcodes_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/inbound-found-shortcodes-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Initialize the shortcodes
	 *
	 * @since 1.0.0
	 */
	public function shortcodes_init() {
		add_shortcode( 'if_bubbles', array( &$this, 'if_bubbles_shortcode' ) );
		add_shortcode( 'if_img_quote', array( &$this, 'if_img_quote_shortcode' ) );
		add_shortcode( 'if_fifty_fifty', array( &$this, 'if_fifty_fifty_shortcode' ) );
		add_shortcode( 'if_bgimg_cta', array( &$this, 'if_bgimg_cta_shortcode' ) );
		add_shortcode( 'if_double_cta', array( &$this, 'if_double_cta_shortcode' ) );
	}

	/**
	 * Defines a section with a title, 3 number bubbles with text under each.
	 *
	 * @since 1.0.0
	 */
	public function if_bubbles_shortcode( $atts = array() ) {
		// normalize attribute keys
		$atts = array_change_key_case( (array) $atts, CASE_LOWER );

		// merge passed in $atts with default values
		$atts = shortcode_atts(
			array(
				'title' => '',
				'num1' => '',
				'text1' => '',
				'num2' => '',
				'text2' => '',
				'num3' => '',
				'text3' => '',
			),
			$atts,
			'if_bubbles'
		);

		// convert the attributes into variables
		extract( $atts );

		// replace pipes with <br> in the title
		$title = str_replace( '|', '<br>', $title );

		// wrap a <span> around the non-numeric part of the nums
		// replace pipes with <br>
		for ( $i = 1; $i <= 3; $i++ ) {
			if ( preg_match( '/\D/', ${"num$i"}, $match ) ) {
				${"num$i"} = str_replace( $match[0], '<span>' . $match[0] . '</span>', ${"num$i"} );
			}
			${"text$i"} = str_replace( '|', '<br>', ${"text$i"} );
		}

		// output the content
		return <<<TAG
			<section class="if-bubbles">
				<h1>$title</h1>
				<div>
					<h2>$num1</h2>
					<p>$text1</p>
				</div>
				<div>
					<h2>$num2</h2>
					<p>$text2</p>
				</div>
				<div>
					<h2>$num3</h2>
					<p>$text3</p>
				</div>
			</section>	
TAG;
	}

	/**
	 * Defines a section with an image, a large quote or text, with background image.
	 *
	 * @since 1.0.0
	 */
	public function if_img_quote_shortcode( $atts = array() ) {
		// normalize attribute keys
		$atts = array_change_key_case( (array) $atts, CASE_LOWER );

		// merge passed in $atts with default values
		$atts = shortcode_atts(
			array(
				'text' => '',
				'img' => '',
				'bgimg' => '',
			),
			$atts,
			'if_img_quote'
		);

		// convert the attributes into variables
		extract( $atts );

		// replace pipes with <br> in the text
		$text = str_replace( '|', '<br>', $text );

		// output the content
		return <<<TAG
			<section class="if-img-quote" style="background-image: url($bgimg);">
				<img src="$img">
				<p>$text</p>
			</section>
TAG;
	}

	/**
	 * Defines a section with an image, a large quote or text, with background image.
	 *
	 * @since 1.0.0
	 */
	public function if_fifty_fifty_shortcode( $atts = array() ) {
		// normalize attribute keys
		$atts = array_change_key_case( (array) $atts, CASE_LOWER );

		// merge passed in $atts with default values
		$atts = shortcode_atts(
			array(
				'title' => '',
				'text' => '',
				'img' => '',
				'ctatext' => '',
				'ctalink' => '',
				'ctacolor' => '#2374c5', // blue
				'ctaside' => 'right',
			),
			$atts,
			'if_fifty_fifty'
		);

		// convert the attributes into variables
		extract( $atts );

		// replace pipes with <br> in the text and title
		$text = str_replace( '|', '<br>', $text );
		$title = str_replace( '|', '<br>', $title );

		$side = 'right' == $ctaside ? 'ctaright' : 'ctaleft';

		// output the content
		return <<<TAG
			<section class="if-fifty-fifty $side">
				<img src="$img">
				<div>
					<div>
						<h1>$title</h1>
						<p>$text</p>
					</div>
					<a href="$ctalink" class="button ctabutton" style="background-color: $ctacolor;">$ctatext</a>
				</div>
			</section>
TAG;
	}

	/**
	 * Defines a section with a background image, large quote or text, and CTA button.
	 *
	 * @since 1.0.0
	 */
	public function if_bgimg_cta_shortcode( $atts = array() ) {
		// normalize attribute keys
		$atts = array_change_key_case( (array) $atts, CASE_LOWER );

		// merge passed in $atts with default values
		$atts = shortcode_atts(
			array(
				'text' => '',
				'bgimg' => '',
				'ctatext' => '',
				'ctalink' => '',
				'ctacolor' => '#2374c5', // blue
			),
			$atts,
			'if_bgimg_cta'
		);

		// convert the attributes into variables
		extract( $atts );

		// replace pipes with <br> in the text and title
		$text = str_replace( '|', '<br>', $text );

		// output the content
		return <<<TAG
			<section class="if-bgimg-cta" style="background-image: url($bgimg);">
				<p>$text</p>
				<a href="$ctalink" class="button ctabutton" style="background-color: $ctacolor;">$ctatext</a>
			</section>
TAG;
	}
	
	/**
	 * Defines a section with side by side calls to action.
	 *
	 * @since 1.0.0
	 */
	public function if_double_cta_shortcode( $atts = array() ) {
		// normalize attribute keys
		$atts = array_change_key_case( (array) $atts, CASE_LOWER );

		// merge passed in $atts with default values
		$atts = shortcode_atts(
			array(
				'title1' => '',
				'text1' => '',
				'img1' => '',
				'ctatext1' => '',
				'ctalink1' => '',
				'ctacolor1' => '#2374c5', // blue
				'title2' => '',
				'text2' => '',
				'img2' => '',
				'ctatext2' => '',
				'ctalink2' => '',
				'ctacolor2' => '#2374c5', // blue
			),
			$atts,
			'if_double_cta'
		);

		// convert the attributes into variables
		extract( $atts );

		// replace pipes with <br> in the text and title
		$text = str_replace( '|', '<br>', $text );
		$title = str_replace( '|', '<br>', $title );

		// output the content
		return <<<TAG
			<section class="if-fifty-fifty if-double-cta">
				<div class="one-half first" style="text-align: center">
					<img class="aligncenter" src="$img1" />
					<h3>$title1</h3>
					<p>$text1</p>
					<a href="$ctalink1" class="button ctabutton" style="background-color: $ctacolor1;">$ctatext</a>
				</div>
				<div class="one-half first" style="text-align: center">
					<img class="aligncenter" src="$img2" />
					<h3>$title2</h3>
					<p>$text2</p>
					<a href="$ctalink2" class="button ctabutton" style="background-color: $ctacolor;">$ctatext2</a>
				</div>
			</section>

TAG;
	}
}
