<?php
/**
 * Pro customizer section.
 *
 * @credit() Justin Tadlock https://github.com/justintadlock/trt-customizer-pro
 *
 * @since  1.0
 * @access public
 */
class Maghoot_Premium_Customize_Section_Pro extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0
	 * @access public
	 * @var    string
	 */
	public $type = 'maghoot-premium';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0
	 * @access public
	 * @var    string
	 */
	public $pro_text = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0
	 * @access public
	 * @var    string
	 */
	public $pro_url = '';

	/**
	 * Custom content
	 *
	 * @since  1.0
	 * @access public
	 * @var    string
	 */
	public $demo = '';

	/**
	 * Custom content
	 *
	 * @since  1.0
	 * @access public
	 * @var    string
	 */
	public $docs = '';

	/**
	 * Custom content
	 *
	 * @since  1.0
	 * @access public
	 * @var    string
	 */
	public $rating = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0
	 * @access public
	 * @return void
	 */
	public function json() {
		$json = parent::json();

		$json['pro_text'] = $this->pro_text;
		$json['pro_url']  = esc_url( $this->pro_url );

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0
	 * @access public
	 * @return void
	 */
	protected function render_template() { ?>

		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

			<h3 class="accordion-section-title">
				<?php echo apply_filters( 'maghoot_premium_customize_section_pro_template', '
				{{ data.title }}

				<# if ( data.pro_text && data.pro_url ) { #>
					<a href="{{ data.pro_url }}" class="button button-primary alignright" target="_blank"><i class="fas fa-rocket"></i> {{ data.pro_text }}</a>
				<# } #>
				<span class="maghoot-premium-conten">
					<# if ( data.demo_text && data.demo ) { #>
						<a href="{{ data.demo }}" class="buttonsecondary" target="_blank"><i class="fas fa-eye"></i> {{ data.demo_text }}</a>
					<# } #>
					<# if ( data.docs_text && data.docs ) { #>
						<a href="{{ data.docs }}" class="buttonsecondary" target="_blank"><i class="far fa-life-ring"></i> {{ data.docs_text }}</a>
					<# } #>
					<# if ( data.rating_text && data.rating ) { #>
						<a href="{{ data.rating }}" class="buttonsecondary" target="_blank"><i class="fas fa-star"></i> {{ data.rating_text }}</a>
					<# } #>
				</span>
				' ); ?>
			</h3>
		</li>
	<?php }
}
