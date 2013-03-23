<?php

class Styles_Background_Color {
	static $suffix = 'Background Color';
	static $default = '';
	static $group_priority = 1;

	/**
	 * Register item with $wp_customize
	 */
	static public function add_item( $group, $element ) {
		global $wp_customize;

		$label = $selector = $type = $id = $setting = '';
		extract( Styles_Helpers::sanitize_element( $group, $element ), EXTR_IF_EXISTS );
		if ( false === $element ) { return; }

		$wp_customize->add_setting( $setting, array(
			'default'    => self::$default,
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			// 'transport'      => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, Styles_Helpers::get_control_id( $id ), array(
			'label'    => __( $label . ' ' . self::$suffix, 'styles' ),
			'section'  => $group,
			'settings' => $setting,
			'priority' => $priority . self::$group_priority,
		) ) );

	}

	/**
	 * Return CSS based on setting value
	 */
	static public function get_css( $group, $element ){
		$selector = $element['selector'];
		$value = Styles_Helpers::get_element_setting_value( $group, $element );

		$css = '';
		if ( $value ) { $css = "$selector { background: $value }"; }

		return apply_filters( 'styles_css_background_color', $css );
	}

}