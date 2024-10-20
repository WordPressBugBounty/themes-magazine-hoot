<?php
/**
 * Widget Option Parts
 *
 * @package	Hoot
 * @subpackage Magazine Hoot
 */

/**
 * Add input fields
 *
 * @since 1.4.0
 * @access public
 */
if ( !function_exists( 'maghoot_in_widget_form' ) ):
function maghoot_in_widget_form( $widget, $return, $instance ){
	// var_dump($widget);
	if ( !isset($instance['title']) ) return;
	if ( is_object($widget) && isset($widget->id_base) && (
		$widget->id_base == 'newsletterwidget' || $widget->id_base == 'newsletterwidgetminimal' || $widget->id_base == 'mailpoet_form'
		) ) return;

	// if ( !isset($instance['wtitle_bg']) )
	// 	$instance['wtitle_bg'] = ( function_exists( 'maghoot_get_mod' ) ) ? maghoot_get_mod( 'accent_color' ) : '';
	// if ( !isset($instance['wtitle_font']) )
	// 	$instance['wtitle_font'] = ( function_exists( 'maghoot_get_mod' ) ) ? maghoot_get_mod( 'accent_font' ) : '';
	// $default_bg = ( function_exists( 'maghoot_get_mod' ) ) ? 'data-default-color="' . maghoot_get_mod( 'accent_color' ) . '"' : '';
	// $default_font = ( function_exists( 'maghoot_get_mod' ) ) ? 'data-default-color="' . maghoot_get_mod( 'accent_font' ) . '"' : '';
	if ( !isset($instance['wtitle_bg']) )
		$instance['wtitle_bg'] = null;
	if ( !isset($instance['wtitle_font']) )
		$instance['wtitle_font'] = null;
	if ( !isset($instance['wtitle_nostyle']) )
		$instance['wtitle_nostyle'] = null;
	$default_bg = $default_font = '';
	?>
	<div class="hybridext-widget-field hybridext-widget-field-type-parts hybridext-magmaghoot-widget-title">
		<div class="hybridext-widget-field-collapse" data-id="titlestyle">
			<div class="hybridext-collapse-head"><h3>Title Style <i class="fas fa-sort"></i></h3></div>
			<div class="hybridext-collapse-body" style="display: none;">
				<div class="hybridext-widget-field hybridext-widget-field-type-color">
					<label for="<?php echo $widget->get_field_id( 'wtitle_bg' ) ?>"><?php _e( 'Title Background:', 'magazine-hoot'); ?></label>
					<input id="<?php echo $widget->get_field_id( 'wtitle_bg' ) ?>" class="hybrid-ext-color" name="<?php echo $widget->get_field_name( 'wtitle_bg' ) ?>" type="input" value="<?php echo esc_attr( $instance['wtitle_bg'] ) ?>" <?php echo $default_bg ?> />
					<div class="hybridext-widget-field-description"><small><?php _e( 'Leave empty to use default colors.', 'magazine-hoot'); ?></small></div><div class="clear"></div>
				</div>
				<div class="hybridext-widget-field hybridext-widget-field-type-checkbox">
					<label for="<?php echo $widget->get_field_id( 'wtitle_nostyle' ) ?>"><?php _e( 'Transparent Title Background', 'magazine-hoot'); ?>&nbsp;
					<input id="<?php echo $widget->get_field_id( 'wtitle_nostyle' ) ?>" class="hybrid-ext-checkbox" name="<?php echo $widget->get_field_name( 'wtitle_nostyle' ) ?>" type="checkbox" <?php checked( $instance['wtitle_nostyle'] ); ?> />
					</label>
					<div class="hybridext-widget-field-description"><small><?php _e( 'This will entirely remove any title background. (You can still select the Title Font Color below)', 'magazine-hoot'); ?></small></div><div class="clear"></div>
				</div>
				<div class="hybridext-widget-field hybridext-widget-field-type-color">
					<label for="<?php echo $widget->get_field_id( 'wtitle_font' ) ?>"><?php _e( 'Title Font:', 'magazine-hoot'); ?></label>
					<input id="<?php echo $widget->get_field_id( 'wtitle_font' ) ?>" class="hybrid-ext-color" name="<?php echo $widget->get_field_name( 'wtitle_font' ) ?>" type="input" value="<?php echo esc_attr( $instance['wtitle_font'] ) ?>" <?php echo $default_font ?> />
					<div class="hybridext-widget-field-description"><small><?php _e( 'Leave empty to use default colors.', 'magazine-hoot'); ?></small></div><div class="clear"></div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<?php // Inline script stripped in Legacy_Widget_Block_WP5.8 :: Moved to admin-widgets.js
	/*<script type="text/javascript">
		jQuery(document).ready(function($) {
			if (typeof $.fn.wpColorPicker != 'undefined') {
				$('.hybridext-widget-field-type-parts').each(function(){ if( !$(this).data('hoot') ){
					var $self = $(this);
					$self.find('.hybrid-ext-color').wpColorPicker();
					$self.find('.hybridext-collapse-head').on( "click", function() {
						$(this).siblings('.hybridext-collapse-body').toggle();
					});
					$self.data('hoot','setup');
				}});
			}
		});
	</script>*/ ?>
	<?php

}
endif;
add_action('in_widget_form', 'maghoot_in_widget_form',5,3);

/**
 * Callback function for options update
 *
 * @since 1.4.0
 * @access public
 */
if ( !function_exists( 'maghoot_in_widget_form_update' ) ):
function maghoot_in_widget_form_update( $instance, $new_instance, $old_instance ){
	$instance['wtitle_nostyle'] = ( empty( $new_instance['wtitle_nostyle'] ) ) ? 0 : 1;
	$instance['wtitle_bg'] = isset( $instance['wtitle_bg'] ) ? sanitize_hex_color( $new_instance['wtitle_bg'] ) : '';
	$instance['wtitle_font'] = isset( $instance['wtitle_font'] ) ? sanitize_hex_color( $new_instance['wtitle_font'] ) : '';
	return $instance;
}
endif;
add_filter('widget_update_callback', 'maghoot_in_widget_form_update',5,3);

/**
 * Apply Options
 *
 * @since 1.4.0
 * @access public
 */
if ( !function_exists( 'maghoot_parts_dynamic_sidebar_params' ) ):
function maghoot_parts_dynamic_sidebar_params( $params ){
	static $options = array();
	if ( !empty( $params[0]['widget_id'] ) ) {
		$id = $params[0]['widget_id'];
		$idnoarr = array();
		if ( preg_match( '#(\d+)$#', $id, $idnoarr ) ) {
			$idno = $idnoarr[0];
			$id = rtrim( $id, '-' . $idno );
			$options[$id] = ( empty( $options[$id] ) ) ? get_option( 'widget_' . $id ) : $options[$id];
			if ( !empty( $options[$id][$idno] ) && isset( $options[$id][$idno]['title'] ) ) {
				if ( !isset($options[$id][$idno]['wtitle_bg']) )
					$options[$id][$idno]['wtitle_bg'] = null;
				if ( !isset($options[$id][$idno]['wtitle_font']) )
					$options[$id][$idno]['wtitle_font'] = null;
				if ( !isset($options[$id][$idno]['wtitle_nostyle']) )
					$options[$id][$idno]['wtitle_nostyle'] = null;
				if ( $options[$id][$idno]['wtitle_nostyle'] || $options[$id][$idno]['wtitle_bg'] || $options[$id][$idno]['wtitle_font'] ) {
					$inlinestyle = ' style="';
					if ( $options[$id][$idno]['wtitle_nostyle'] )
						$inlinestyle .= 'background:none;';
					elseif ( $options[$id][$idno]['wtitle_bg'] )
						$inlinestyle .= 'background:' . sanitize_hex_color( $options[$id][$idno]['wtitle_bg'] ).';border-color:' . sanitize_hex_color( $options[$id][$idno]['wtitle_bg'] ).';';
					if ( $options[$id][$idno]['wtitle_nostyle'] && !$options[$id][$idno]['wtitle_font'] )
						$inlinestyle .= 'color:inherit';
					elseif ( $options[$id][$idno]['wtitle_font'] )
						$inlinestyle .= 'color:' . sanitize_hex_color( $options[$id][$idno]['wtitle_font'] ).';';
					$inlinestyle .= '" ';
					$class = ( $options[$id][$idno]['wtitle_nostyle'] ) ? 'remove-style' : 'has-custom-style';
					$spanclass = ( !empty( $options[$id][$idno]['category'] ) ) ? 'cat-typo cat-typo-' . intval( $options[$id][$idno]['category'] ) : 'accent-typo';
					$params[0]['before_title'] = apply_filters( 'maghoot_parts_dynamic_sidebar_params_before_title', '<h3 class="widget-title title-customstyle ' . $class . '"><span class="' . $spanclass . '"' . $inlinestyle . '>', $params[0], $id, $idno, $options[$id] );
				}
			}
		}
	}
	return $params;
}
endif;
add_filter( 'dynamic_sidebar_params', 'maghoot_parts_dynamic_sidebar_params', 5, 3 );