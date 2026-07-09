<?php
/**
 * Includes sanitize functions
 * 
 * @package Online Newspaper
 * @since 1.0.0
 */
if( !function_exists( 'online_newspaper_sanitize_toggle_control' )  ) :
    /**
     * Sanitize customizer toggle control value
     * 
     * @package Online Newspaper
     * @since 1.0.0
     */
    function online_newspaper_sanitize_toggle_control($value) {
        return rest_sanitize_boolean( $value );
    }
 endif;

 if( !function_exists( 'online_newspaper_sanitize_url' )  ) :
    /**
     * Sanitize customizer url control value
     * 
     * @package Online Newspaper
     * @since 1.0.0
     */
    function online_newspaper_sanitize_url($value) {
        return esc_url_raw($value);
    }
 endif;

 if( !function_exists( 'online_newspaper_sanitize_select_control' )  ) :
    /**
     * Sanitize customizer select control value
     * 
     * @package Online Newspaper
     * @since 1.0.0
     */
    function online_newspaper_sanitize_select_control( $input, $setting ) {
        // Ensure input is a slug.
        $input = sanitize_key( $input );
        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control( $setting->id )->choices;
        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }
endif;

if( !function_exists( 'online_newspaper_sanitize_responsive_range' )  ) :
    /**
     * Sanitize range slider control value
     * 
     * @package Online Newspaper
     * @since 1.0.0
     */
    function online_newspaper_sanitize_responsive_range($range, $setting) {
        // Ensure input is an absolute integer.
        foreach( $range as $rangKey => $rang ) :
            $range[$rangKey] = is_numeric( $rang ) ? $rang: 0;
        endforeach;
        // Get the input attributes associated with the setting.
        $atts = $setting->manager->get_control($setting->id)->input_attrs;

        // Get minimum number in the range.
        $min = ( isset($atts['min']) ? $atts['min'] : $number );
        // Get maximum number in the range.
        $max = ( isset($atts['max']) ? $atts['max'] : $number );
        // Get step.
        $step = ( isset($atts['step']) ? $atts['step'] : 1 );

        // If the number is within the valid range, return it; otherwise, return the default
        return ( ( $min <= $range['smartphone'] && $range['smartphone'] <= $max && is_numeric($range['smartphone'] / $step) && ( $min <= $range['tablet'] && $range['tablet'] <= $max && is_numeric($range['tablet'] / $step) ? $range : $setting->default ) && ( $min <= $range['desktop'] && $range['desktop'] <= $max && is_numeric($range['desktop'] / $step) ? $range : $setting->default ) ) ? $range : $setting->default );
    }
endif;

if( !function_exists( 'online_newspaper_sanitize_array' )  ) :
    /**
     * Sanitize array control value
     * 
     * @package Online Newspaper
     * @since 1.0.0
     */ 
    function online_newspaper_sanitize_array( $value ) {
        return wp_unslash( $value );
    }
 endif;

 if( !function_exists( 'online_newspaper_sanitize_responsive_multiselect_control' )  ) :
    /**
     * Sanitize responsive multiselect control value
     * 
     * @package Online Newspaper
     * @since 1.0.0
     */
    function online_newspaper_sanitize_responsive_multiselect_control( $value ) {
        if( ! is_array( $value ) ) return array("desktop"=> true, "tablet"=> true, "mobile"=> true);
        $value["desktop"] = ! isset( $value["desktop"] ) ? true : rest_sanitize_boolean( $value["desktop"] );
        $value["tablet"] = ! isset( $value["tablet"] ) ? true : rest_sanitize_boolean( $value["tablet"] );
        $value["mobile"] = ! isset( $value["mobile"] ) ? true : rest_sanitize_boolean( $value["mobile"] );
        return $value;
    }
 endif;

 if( !function_exists( 'online_newspaper_sanitize_solid_color' )  ) :
    /**
     * Sanitize color value
     * 
     * @package Online Newspaper
     * @since 1.0.0
     */
    function online_newspaper_sanitize_solid_color( $color ) {
        if( sanitize_hex_color( $color ) ) { // 3 or 6 hex digits, or the empty string.
            return $color;
        } else if ( preg_match( '|^#([A-Fa-f0-9]{8})|', $color ) ) { // 8 hex digits, or the empty string.
            return $color;
        } else if ( strlen( $color ) > 8 && substr( $color, 0, 32 ) === "--online-newspaper-global-preset" ) {
			return $color;
		} else {
            return '#000';
        }
    }
 endif;

 if( !function_exists( 'online_newspaper_sanitize_repeater_control' )  ) :
    /**
     * Sanitize color group image control value
     * 
     * @package Online Newspaper
     * @since 1.0.0
     */
    function online_newspaper_sanitize_repeater_control($value,$setting) {
        return apply_filters( ONLINE_NEWSPAPER_PREFIX . 'repeater_control_value', $value );
    }
 endif;

 if( !function_exists( 'online_newspaper_sanitize_sortable_control' )  ) :
    /**
     * Sanitize sortable control value
     * 
     * @package Online Newspaper
     * @since 1.0.0
     */
    function online_newspaper_sanitize_sortable_control( $box, $setting ) {
        if( ! is_string( $box ) ) return apply_filters( ONLINE_NEWSPAPER_PREFIX . 'sortable_control_value', $setting->default );
        return apply_filters( ONLINE_NEWSPAPER_PREFIX . 'sortable_control_value', $box );
    }
 endif;

 if( !function_exists( 'online_newspaper_sanitize_get_responsive_integer_value' )  ) :
    /**
     * Sanitize number value
     * 
     * @package Online Newspaper
     * @since 1.0.0
     */
    function online_newspaper_sanitize_get_responsive_integer_value($value) {
        $value['desktop'] = isset( $value['desktop'] ) ? $value['desktop'] : 0;
        $value['tablet'] = isset( $value['tablet'] ) ? $value['tablet'] : 0;
        $value['smartphone'] = isset( $value['smartphone'] ) ? $value['smartphone'] : 0;
        return apply_filters( ONLINE_NEWSPAPER_PREFIX . 'custom_responsive_integer_value', $value );
    }
 endif;

 if( !function_exists( 'online_newspaper_sanitize_typo_control' )  ) :
    /**
     * Sanitize typo value
     * 
     * @package Online Newspaper
     * @since 1.0.0
     */
    function online_newspaper_sanitize_typo_control($control,$setting) {
        $control['font_family']['value'] = isset( $control['font_family']['value'] ) ? esc_html($control['font_family']['value']) : $setting->default['font_family']['value'];
        $control['font_weight']['value'] = isset( $control['font_weight']['value'] ) ? esc_html($control['font_weight']['value']) : '400';
        $control['font_size'] = isset( $control['font_size'] ) ? online_newspaper_sanitize_get_responsive_integer_value($control['font_size']) : $setting->default['font_size'];
        $control['line_height'] = isset( $control['line_height'] ) ? online_newspaper_sanitize_get_responsive_integer_value($control['line_height']) : $setting->default['line_height'];
        $control['letter_spacing'] = isset( $control['letter_spacing'] ) ? online_newspaper_sanitize_get_responsive_integer_value($control['letter_spacing']) : $setting->default['letter_spacing'];
        if( isset( $control['text_transform'] ) ) {
            $control['text_transform'] = in_array( $control['text_transform'], ['unset','capitalize','uppercase','lowercase'] ) ? esc_html($control['text_transform']) : 'capitalize';
        } else {
            $control['text_transform'] = $setting->default['text_transform'];
        }
        if( isset( $control['text_decoration'] ) ) {
            $control['text_decoration'] = in_array( $control['text_decoration'], ['none','underline','line-through'] ) ? esc_html($control['text_decoration']) : 'none';
        } else {
            $control['text_decoration'] = $setting->default['text_decoration'];
        }
        return apply_filters( ONLINE_NEWSPAPER_PREFIX . 'typo_control_value', $control );
    }
 endif;

 if( !function_exists( 'online_newspaper_sanitize_box_shadow_control' )  ) :
    /**
     * Sanitize box shadow value
     * 
     * @package Online Newspaper
     * @since 1.0.0
     */
    function online_newspaper_sanitize_box_shadow_control($control,$setting) {
        $control['option'] = isset( $control['option'] ) ? esc_html($control['option']) : $setting->default['option'];
        $control['type'] = isset( $control['type'] ) ? esc_html($control['type']) : $setting->default['type'];
        $control['hoffset'] = isset( $control['hoffset'] ) ? $control['hoffset'] : $setting->default['hoffset'];
        $control['voffset'] = isset( $control['voffset'] ) ? $control['voffset'] : $setting->default['voffset'];
        $control['blur'] = isset( $control['blur'] ) ? $control['blur'] : $setting->default['blur'];
        $control['spread'] = isset( $control['spread'] ) ? $control['spread'] : $setting->default['spread'];
        return apply_filters( ONLINE_NEWSPAPER_PREFIX . 'box_shadow_control_value', $control );
    }
 endif;

 if( ! function_exists( 'online_newspaper_sanitize_icon_picker_control' )  ) :
    /**
     * Sanitize array icon picker control value
     * 
     * @package Online Newspaper
     * @since 1.0.0
     */ 
    function online_newspaper_sanitize_icon_picker_control( $value ) {
        $unslashed_value = wp_unslash( $value );
        if( ! in_array( $unslashed_value['type'], ['icon','svg','none'] ) ) {
            $unslashed_value['type'] = 'none';
            $unslashed_value['value'] = '';
        }
        return $unslashed_value;
    }
 endif;

 /**
 * Function to sanitize responsive spacing control
 * 
 * @package Online Newspaper
 * @since 1.0.0
 */

if( ! function_exists( 'online_newspaper_sanitize_spacing_control' ) ) :
    function online_newspaper_sanitize_spacing_control( $value, $setting ) {
        if( ! is_array( $value ) ) return $settings->default;
        // for desktop
        $value['desktop']['top'] = isset( $value['desktop']['top'] ) && is_int( $value['desktop']['top'] ) ? $value['desktop']['top'] : $setting->default['desktop']['top'];
        $value['desktop']['right'] = isset( $value['desktop']['right'] ) && is_int( $value['desktop']['right'] ) ? $value['desktop']['right'] : $setting->default['desktop']['right'];
        $value['desktop']['bottom'] = isset( $value['desktop']['bottom'] ) && is_int( $value['desktop']['bottom'] ) ? $value['desktop']['bottom'] : $setting->default['desktop']['bottom'];
        $value['desktop']['left'] = isset( $value['desktop']['left'] ) && is_int( $value['desktop']['left'] ) ? $value['desktop']['left'] : $setting->default['desktop']['left'];
        $value['desktop']['link'] = isset( $value['desktop']['link'] ) && is_bool( $value['desktop']['link'] ) ? $value['desktop']['link'] : $setting->default['desktop']['link'];
        // for tablet
        $value['tablet']['top'] = isset( $value['tablet']['top'] ) && is_int( $value['tablet']['top'] ) ? $value['tablet']['top'] : $setting->default['tablet']['top'];
        $value['tablet']['right'] = isset( $value['tablet']['right'] ) && is_int( $value['tablet']['right'] ) ? $value['tablet']['right'] : $setting->default['tablet']['right'];
        $value['tablet']['bottom'] = isset( $value['tablet']['bottom'] ) && is_int( $value['tablet']['bottom'] ) ? $value['tablet']['bottom'] : $setting->default['tablet']['bottom'];
        $value['tablet']['left'] = isset( $value['tablet']['left'] ) && is_int( $value['tablet']['left'] ) ? $value['tablet']['left'] : $setting->default['tablet']['left'];
        $value['tablet']['link'] = isset( $value['tablet']['link'] ) && is_bool( $value['tablet']['link'] ) ? $value['tablet']['link'] : $setting->default['tablet']['link'];
        // for smartphone
        $value['smartphone']['top'] = isset( $value['smartphone']['top'] ) && is_int( $value['smartphone']['top'] ) ? $value['smartphone']['top'] : $setting->default['smartphone']['top'];
        $value['smartphone']['right'] = isset( $value['smartphone']['right'] ) && is_int( $value['smartphone']['right'] ) ? $value['smartphone']['right'] : $setting->default['smartphone']['right'];
        $value['smartphone']['bottom'] = isset( $value['smartphone']['bottom'] ) && is_int( $value['smartphone']['bottom'] ) ? $value['smartphone']['bottom'] : $setting->default['smartphone']['bottom'];
        $value['smartphone']['left'] = isset( $value['smartphone']['left'] ) && is_int( $value['smartphone']['left'] ) ? $value['smartphone']['left'] : $setting->default['smartphone']['left'];
        $value['smartphone']['link'] = isset( $value['smartphone']['link'] ) && is_bool( $value['smartphone']['link'] ) ? $value['smartphone']['link'] : $setting->default['smartphone']['link'];

        return $value;
    }
 endif;

 if( ! function_exists( 'online_newspaper_sanitize_color_control' ) ) :
    /**
     * Sanitization function for color control
     * 
     * @since 1.0.0
     */
    function online_newspaper_sanitize_color_control( $values, $setting ) {
        $default = $setting->default;
        if( empty( $values ) || ! is_array( $values ) ) return $default;   /* Return Default if $values is ( empty || not array ) */

        if( array_key_exists( 'initial', $values ) ) :
            $initial = online_newspaper_sanitize_color_value( $values[ 'initial' ] );
            $hover = online_newspaper_sanitize_color_value( $values[ 'hover' ] );
            return [
                'initial'   =>  $initial,
                'hover'   =>  $hover
            ];
        else:
            return online_newspaper_sanitize_color_value( $values );
        endif;
    }
 endif;

 if( ! function_exists( 'online_newspaper_sanitize_color_value' ) ) :
    /**
     * Sanitize value of color control
     * 
     * @since 1.0.0
     */
    function online_newspaper_sanitize_color_value( $values ) {
        $expected_color_types = [ 'solid', 'gradient', 'image' ];
        $sanitized_values = [];
        $type = $values['type'];
        $sanitized_values['type'] = sanitize_text_field( $type );
        switch( $type ) :
            case 'solid':
                    $sanitized_values[ 'solid' ] = online_newspaper_sanitize_solid_color( $values[ 'solid' ] );
                break;
            case 'gradient':
                    $sanitized_values[ 'gradient' ] = sanitize_text_field( $values[ 'gradient' ] );
                break;
            case 'image':
                    $image = $values[ 'image' ];
                    if( ! array_key_exists( 'id', $image ) || ! array_key_exists( 'url', $image ) ) return false;
                    if( ! is_int( $image[ 'id' ] ) ) return false;

                    $sanitized_values[ 'image' ][ 'id' ] = absint( $image[ 'id' ] );
                    $sanitized_values[ 'image' ][ 'url' ] = esc_url( $image[ 'url' ] );
                    $sanitized_values[ 'position' ] = ( array_key_exists( 'position', $values ) ) ? sanitize_text_field( $values[ 'position' ] ) : 'left top';
                    $sanitized_values[ 'repeat' ] = ( array_key_exists( 'repeat', $values ) ) ? sanitize_text_field( $values[ 'repeat' ] ) : 'no-repeat';
                    $sanitized_values[ 'attachment' ] = ( array_key_exists( 'attachment', $values ) ) ? sanitize_text_field( $values[ 'attachment' ] ) : 'fixed';
                    $sanitized_values[ 'size' ] = ( array_key_exists( 'size', $values ) ) ? sanitize_text_field( $values[ 'size' ] ) : 'auto';
                break;
        endswitch;
        return $sanitized_values;
    }
 endif;

 if( ! function_exists( 'online_newspaper_sanitize_builder_control' ) ) :
    /**
     * Sanitize Builder Control
     * @var $value holds the current value of the control
     * @var $setting holds the instance of WP_Customize_Setting class
     * 
     * @since 1.0.0
     */
    function online_newspaper_sanitize_builder_control( $values, $setting ) {
        $default = $setting->default;
        if( empty( $values ) || ! is_array( $values ) ) return $default;   /* Return Default if $values is ( empty || not array ) */
        $control_widgets = $setting->manager->get_control( $setting->id )->widgets;
        $all_widgets = array_keys( $control_widgets );
        $sanitized_value = [];
        foreach( $values as $container_id => $widgets ) :
            if( empty( $widgets ) ) :
                $sanitized_value[ $container_id ] = $widgets;
            else: 
                $filtered_widgets = [];
                foreach( $widgets as $widget ):
                    if( in_array( $widget, $all_widgets ) ) :
                        $filtered_widgets[] = sanitize_text_field( $widget );
                    else:
                        return $default;
                    endif;
                endforeach;
                $sanitized_value[ $container_id ] = $filtered_widgets;
            endif;
        endforeach;
        return $sanitized_value;
    }
endif;

if( !function_exists( 'online_newspaper_sanitize_checkbox' )  ) :
    /**
     * Sanitize checkbox value
     * 
     * @package Online Newspaper
     * @since 1.0.0
     */
    function online_newspaper_sanitize_checkbox( $value ) {
        return (  ( isset( $value ) && true === $value ) ? true : false );
    }
endif;

if( ! function_exists( 'online_newspaper_sanitize_preset_colors' ) ) :
    /**
     * Sanitize preset colors
     * 
     * @since 1.0.0
     */
    function online_newspaper_sanitize_preset_colors( $control, $setting ) {
        if( empty( $control ) || ! is_array( $control ) ) return $setting->default;   /* Return Default if $values is ( empty || not array ) */
        if( ! array_key_exists( 'color_palettes', $control ) && ! array_key_exists( 'active_palette', $control ) ) return $setting->default;
        $color_palettes = $control['color_palettes'];
        $active_palette = $control['active_palette'];
        $sanitized_value = [];
        if( count( $color_palettes ) > 0 ) :
            foreach( $color_palettes as $index => $palette ) :
                foreach( $palette as $color ) :
                    $sanitized_value['color_palettes'][$index][] = sanitize_text_field( $color );
                endforeach;
            endforeach;
        endif;
        $sanitized_value['active_palette'] = sanitize_text_field( $active_palette );
        return $sanitized_value;
    }
endif;

if( ! function_exists( 'online_newspaper_sanitize_async_multiselect_control' ) ) :
    /**
     * Sanitize async multiselect controls
     * 
     * @since 1.0.0
     */
    function online_newspaper_sanitize_async_multiselect_control( $values, $setting ) {
        if( empty( $values ) || ! is_array( $values ) ) return [];
        $sanitized_value = [];
        
        foreach( $values as $index => $value ) :
            $label = '';
            $id = '';
            if( array_key_exists( 'value', $value ) ) $id = $value['value'];
            if( array_key_exists( 'label', $value ) ) $label = $value['label'];
            if( is_string( $label ) ):
                $sanitized_value[ $index ]['label'] = sanitize_text_field( $label );
            else:
                return [];
            endif;

            if( is_int( $id ) ):
                $sanitized_value[ $index ]['value'] = absint( $id );
            else:
                return [];
            endif;
        endforeach;
        return $sanitized_value;
    }
endif;

if( ! function_exists( 'online_newspaper_sanitize_normal_multiselect_control' ) ) :
    /**
     * Sanitize normal multiselect controls
     * 
     * @since 1.0.0
     */
    function online_newspaper_sanitize_normal_multiselect_control( $values, $setting ) {
        if( empty( $values ) || ! is_array( $values ) ) return $setting->default;   /* Return Default if $values is ( empty || not array ) */
        $choices = $setting->manager->get_control( $setting->id )->choices;
        if( empty( $choices ) || ! is_array( $choices ) ) return $setting->default; /* Return Default if $choice is ( empty || not array ) */
        $sanitized_value = [];
        $choices_value_array = array_column( $choices, 'value' );
        $choices_label_array = array_column( $choices, 'label' );
        foreach( $values as $index => $value ) :
            $label = '';
            $id = '';
            if( array_key_exists( 'value', $value ) ) $id = $value['value'];
            if( array_key_exists( 'label', $value ) ) $label = $value['label'];
            if( in_array( $label, $choices_label_array ) ):
                $sanitized_value[ $index ]['label'] = sanitize_text_field( $label );
            else:
                return $setting->default;   /* Return Default */
            endif;

            if( in_array( $id, $choices_value_array ) ):
                $sanitized_value[ $index ]['value'] = sanitize_text_field( $id );
            else:
                return $setting->default;   /* Return Default */
            endif;
        endforeach;
        return $sanitized_value;
    }
endif;

if( ! function_exists( 'online_newspaper_sanitize_typography_preset_control' ) ) :
    /**
     * Sanitize typography presets controls
     * 
     * @since 1.0.0
     */
    function online_newspaper_sanitize_typography_preset_control( $control, $setting ) {
        $default = $setting->default;
        if( empty( $control ) || ! is_array( $control ) ) return $setting->default;   /* Return Default if $values is ( empty || not array ) */

        $sanitized_value = [];
        $typographies = array_key_exists( 'typographies', $control ) ? $control['typographies'] : [];
        $labels = array_key_exists( 'labels', $control ) ? $control['labels'] : [];
        if( empty( $typographies ) || ! is_array( $typographies ) ) return $default;   /* Return Default if $values is ( empty || not array ) */
        if( empty( $labels ) || ! is_array( $labels ) ) return $default;   /* Return Default if $values is ( empty || not array ) */
        foreach( $typographies as $index => $typography ) :
            $sanitized_value['typographies'][] = online_newspaper_sanitize_typography_values( $typography, $default['typographies'][ $index ] );
        endforeach;
        foreach( $labels as $label ) :
            $sanitized_value['labels'][] = sanitize_text_field( $label );
        endforeach;
        return $sanitized_value;
    }
endif;

if( ! function_exists( 'online_newspaper_sanitize_responsive_radio_tab' ) ) :
    /**
     * Sanitize preset colors
     * @var $value holds the current value of the control
     * @var $setting holds the instance of WP_Customize_Setting class
     * 
     * @since 1.0.0
     */
    function online_newspaper_sanitize_responsive_radio_tab( $value, $setting ) {
        $default = $setting->default;
        if( empty( $value ) || ! is_array( $value ) ) return $default;   /* Return Default if $values is ( empty || not array ) */
        $choices = $setting->manager->get_control( $setting->id )->choices;
        $choice_keys = [];
        foreach( $choices as $choice ):
            $choice_keys[] = $choice['value'];
        endforeach;
        if( array_key_exists( 'desktop', $value ) && array_key_exists( 'tablet', $value ) && array_key_exists( 'smartphone', $value ) ) :
            $sanitized_value['desktop'] = in_array( $value['desktop'], $choice_keys ) ? sanitize_text_field( $value['desktop'] ) : $default['desktop'];
            $sanitized_value['tablet'] = in_array( $value['tablet'], $choice_keys ) ? sanitize_text_field( $value['tablet'] ) : $default['tablet'];
            $sanitized_value['smartphone'] = in_array( $value['smartphone'], $choice_keys ) ? sanitize_text_field( $value['smartphone'] ) : $default['smartphone'];
            return $sanitized_value;
        else:
            return $default;
        endif;
    }
endif;

if( ! function_exists( 'online_newspaper_sanitize_typography_values' ) ) :
    /**
     * Sanitize typography values
     * 
     * @param value
     * @param default
     * @since 1.0.0
     */
    function online_newspaper_sanitize_typography_values( $value, $default ) {
        $value['font_family']['value'] = isset( $value['font_family']['value'] ) ? esc_html( $value['font_family']['value'] ) : $default['font_family']['value'];
        $value['font_weight']['value'] = isset( $value['font_weight']['value'] ) ? esc_html( $value['font_weight']['value'] ) : '400';
        $value['font_weight']['variant'] = isset( $value['font_weight']['variant'] ) ? esc_html( $value['font_weight']['variant'] ) : 'normal';
        $value['font_size'] = isset( $value['font_size'] ) ? online_newspaper_sanitize_get_responsive_integer_value( $value['font_size'] ) : $default['font_size'];
        $value['line_height'] = isset( $value['line_height'] ) ? online_newspaper_sanitize_get_responsive_integer_value( $value['line_height'] ) : $default['line_height'];
        $value['letter_spacing'] = isset( $value['letter_spacing'] ) ? online_newspaper_sanitize_get_responsive_integer_value( $value['letter_spacing'] ) : $default['letter_spacing'];
        if( isset( $value['text_transform'] ) ) {
            $value['text_transform'] = in_array( $value['text_transform'], ['unset','capitalize','uppercase','lowercase'] ) ? esc_html( $value['text_transform'] ) : 'capitalize';
        } else {
            $value['text_transform'] = $default['text_transform'];
        }
        if( isset( $value['text_decoration'] ) ) {
            $value['text_decoration'] = in_array( $value['text_decoration'], ['none','underline','line-through'] ) ? esc_html( $value['text_decoration'] ) : 'none';
        } else {
            $value['text_decoration'] = $default['text_decoration'];
        }
        return apply_filters( ONLINE_NEWSPAPER_PREFIX . 'typo_control_value', $value );
    }
endif;

if( ! function_exists( 'online_newspaper_sanitize_responsive_radio_image' ) ) :
    /**
     * Sanitize preset colors
     * @var $value holds the current value of the control
     * @var $setting holds the instance of WP_Customize_Setting class
     * 
     * @since 1.0.0
     */
    function online_newspaper_sanitize_responsive_radio_image( $value, $setting ) {
        $default = $setting->default;
        if( empty( $value ) || ! is_array( $value ) ) return $default;   /* Return Default if $values is ( empty || not array ) */
        if( array_key_exists( 'desktop', $value ) && array_key_exists( 'tablet', $value ) && array_key_exists( 'smartphone', $value ) ) :
            $sanitized_value['desktop'] = sanitize_text_field( $value['desktop'] );
            $sanitized_value['tablet'] = sanitize_text_field( $value['tablet'] );
            $sanitized_value['smartphone'] = sanitize_text_field( $value['smartphone'] );
            return $sanitized_value;
        else:
            return $default;
        endif;
    }
endif;