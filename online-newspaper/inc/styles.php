<?php
/**
 * Includes the inline css
 * 
 * @package Online Newspaper
 * @since 1.0.0
 */
use OnlineNewspaper\CustomizerDefault as ONP;
if( ! function_exists( 'online_newspaper_assign_variable' ) ) :
   /**
   * Generate css code
   *
   * @package Online Newspaper
   * @since 1.0.0 
   */
   function online_newspaper_assign_variable( $control, $selector, $unit = '' ) {
         $decoded_control =  ONP\online_newspaper_get_customizer_option( $control );
         if( $decoded_control === ONP\online_newspaper_get_customizer_default( $control ) ) return;
         if( ! $decoded_control ) return;
         echo " body.online-newspaper-variables{ ", $selector, ": ", esc_html( $decoded_control ), esc_html( $unit ), ";}\n";
   }
endif;

if( ! function_exists( 'online_newspaper_responsive_range_css' ) ) :
   /**
   * Generate css code for Logo Width
   *
   * @package Online Newspaper
   * @since 1.0.0 
   */
   function online_newspaper_responsive_range_css( $control, $selector, $property = 'width'  ) {
      $decoded_control = ONP\online_newspaper_get_customizer_option( $control );
      if( $decoded_control === ONP\online_newspaper_get_customizer_default( $control ) ) return;
      if( ! $decoded_control ) return;
      $is_variable = ( $selector === 'body.online-newspaper-variables' );
      if( $is_variable ) {
         echo $selector . "{\n";
            if( isset( $decoded_control['desktop'] ) ) echo esc_html( $property ), ": ", esc_html( $decoded_control[ 'desktop' ] ), "px;\n";
            if( isset( $decoded_control['tablet'] ) ) echo esc_html( $property ), "-tablet: ", esc_html( $decoded_control[ 'tablet' ] ), "px;\n";
            if( isset( $decoded_control['smartphone'] ) ) echo esc_html( $property ), "-smartphone: ", esc_html( $decoded_control[ 'smartphone' ] ), "px;\n";
         echo "}";
      } else {
         if( isset( $decoded_control['desktop'] ) ) echo $selector . "{ " . esc_html( $property ). ": ".esc_html( $decoded_control[ 'desktop' ] ).  "px; }\n";
         if( isset( $decoded_control['tablet'] ) ) echo "@media(max-width: 940px) { " .$selector . "{ " . esc_html( $property ). ": ".esc_html( $decoded_control[ 'tablet' ] ).  "px; } }\n";
         if( isset( $decoded_control['smartphone'] ) ) echo "@media(max-width: 610px) { " .$selector . "{ " . esc_html( $property ). ": ".esc_html( $decoded_control[ 'smartphone' ] ).  "px; } }\n";
      }
   }
endif;

if( ! function_exists('online_newspaper_visibility_options') ):
   /**
    * Generate css code for top header color options
    *
    * @package Online Newspaper
    * @since 1.0.0 
    */
   function online_newspaper_visibility_options( $control, $selector ) {
      $decoded_control =  ONP\online_newspaper_get_customizer_option( $control );
      if( $decoded_control === ONP\online_newspaper_get_customizer_default( $control ) ) return;
      if( ! $decoded_control ) return;
      if( isset( $decoded_control['desktop'] ) ) :
         if($decoded_control['desktop'] == false) echo $selector . "{ display : none;}\n";
      endif;

      if( isset( $decoded_control['tablet'] ) ) :
         if($decoded_control['tablet'] == false) echo "@media(max-width: 940px) and (min-width:611px) { " .$selector . "{ display : none;} }\n";
      endif;

      if( isset( $decoded_control['mobile'] ) ) :
         if($decoded_control['mobile'] == false) { 
            echo "@media(max-width: 610px) { " .$selector . "{ display : none;} }\n";
         }
         if($decoded_control['mobile'] == true){
            echo "@media(max-width: 610px) { " .$selector . "{ display : block;} }\n";
         }
      endif;
   }
endif;

if( ! function_exists( 'online_newspaper_border_option' ) ) :
   /**
   * Generate css code for Top header Text Color
   *
   * @package Online Newspaper
   * @since 1.0.0 
   */
   function online_newspaper_border_option( $control, $selector ) {
      $decoded_control = ONP\online_newspaper_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      if( $decoded_control === ONP\online_newspaper_get_customizer_default( $control ) ) return;
      if( isset( $decoded_control['type'] ) || isset( $decoded_control['width'] ) || isset( $decoded_control['color'] ) ) :
         $width = $decoded_control['width'];
         echo $selector, '{ border-color: ', online_newspaper_get_color_format($decoded_control['color']), '; border-style: ', esc_html( $decoded_control['type'] ), '; border-width: ', $width['top'], 'px ', $width['right'], 'px ', $width['bottom'], 'px ', $width['left'], 'px;', '}';
      endif;
   }
endif;

if( ! function_exists( 'online_newspaper_category_colors_styles' ) ) :
   /**
    * Generates css code for font size
   *
   * @package Blog Postx Pro
   * @since 1.0.0
   */
   function online_newspaper_category_colors_styles() {
      $category_colors = ONP\online_newspaper_get_customizer_option( 'category_colors' );
      $default_category_colors = ONP\online_newspaper_get_customizer_default( 'category_colors' );
      $is_category_archive = is_category();
      if( $category_colors ) :
         foreach( $category_colors as $term_id => $cat_value ) :
            // if( $default_category_colors[ $term_id ] === $cat_value ) continue;
            extract( $cat_value );
            $initial_selector = 'body .post-categories .cat-item.cat-' . $term_id . ' a, .online-newspaper-web-stories .stories-wrap .story[data-id="'. $term_id .'"] .preview .story-count, .online-newspaper-web-stories .inner-stories-wrap.open.cat-' . $term_id . ', .widget_online_newspaper_category_collection_widget .layout-one .category-item.cat-' . $term_id . ' .category-name {';
            $hover_selector = 'body .post-categories .cat-item.cat-' . $term_id . ' a:hover, .online-newspaper-web-stories .stories-wrap .story[data-id="'. $term_id .'"] .preview .story-count:hover, .widget_online_newspaper_category_collection_widget .layout-one .category-item.cat-' . $term_id . ' .category-name:hover {';
            $archive_selector = "body.archive.category.category-" . $term_id;

            if( isset( $color['initial'] ) ):
               if( isset( $color['initial']['type'] ) ) :
                  $type = $color['initial']['type'];
                  if( isset( $color['initial'][$type] ) ) {
                     $initial_selector .= " color : " . online_newspaper_get_color_format( $color['initial'][$type] ) . ";\n";
                     if( $is_category_archive ) echo $archive_selector, " { color : ", online_newspaper_get_color_format( $color['initial'][$type] ), "} \n";
                  }
               endif;
            endif;

            if(isset($color['hover'] )):
               if( isset( $color['hover']['type'] ) ) :
                  $type = $color['hover']['type'];
                  if( isset( $color['hover'][$type] ) ) {
                     $hover_selector .= "color : " . online_newspaper_get_color_format( $color['hover'][$type] ) . ";\n";
                     if( $is_category_archive ) echo $archive_selector, ":hover { color : ", online_newspaper_get_color_format( $color['hover'][$type] ), "} \n";
                  }
               endif;
            endif;

            if(isset($background['initial'] )):
               if( isset( $background['initial']['type'] ) ) :
                  $type = $background['initial']['type'];
                  if( isset( $background['initial'][$type] ) ) {
                     $initial_selector .= "background : " . online_newspaper_get_color_format( $background['initial'][$type] ) . ";\n";
                  }
               endif;
            endif;

            if(isset($background['hover'] )) :
               if( isset( $background['hover']['type'] ) ) :
                  $type = $background['hover']['type'];
                  if( isset( $background['hover'][$type] ) ) $hover_selector .= "background : " . online_newspaper_get_color_format( $background['hover'][$type] ) . ";\n";
               endif;
            endif;
            $initial_selector .=  "}\n";
            $hover_selector .=  "}\n";
            echo $initial_selector, $hover_selector;
         endforeach;
      endif;
   }
endif;

// Image ratio change
if( ! function_exists( 'online_newspaper_image_ratio' ) ) :
   /**
   * Generate css code for variable change with responsive
   *
   * @package Online Newspaper
   * @since 1.0.0 
   */
   function online_newspaper_image_ratio( $control, $selector ) {
      $decoded_control = ONP\online_newspaper_get_customizer_option( $control );
      if( $decoded_control === ONP\online_newspaper_get_customizer_default( $control ) ) return;
      $value = '100%';
      if( ! $decoded_control ) return;
      if( isset( $decoded_control['desktop'] ) && $decoded_control['desktop'] > 0 ) :
         $desktop = $decoded_control['desktop'];
         echo $selector . "{ padding-bottom : calc(".esc_html( $desktop ).  " * ". esc_html( $value ) ."); }";
      endif;
      if( isset( $decoded_control['tablet'] ) && $decoded_control['tablet'] > 0 ) :
         $tablet = $decoded_control['tablet'];
         echo "@media(max-width: 940px) { " .$selector . "{ padding-bottom : calc(".esc_html( $tablet ).  "* ". esc_html( $value ) ."); } }\n";
      endif;
      if( isset( $decoded_control['smartphone'] ) && $decoded_control['smartphone'] > 0 ) :
         $smartphone = $decoded_control['smartphone'];
         echo "@media(max-width: 610px) { " .$selector . "{ padding-bottom : calc(".esc_html($smartphone).  " * ". esc_html( $value ) ."); } }\n";
      endif;
   }
endif;

if( ! function_exists( 'online_newspaper_image_ratio_variable' ) ) :
   /**
    * Generate css code for variable change with responsive
    *
    * @package Online Newspaper
    * @since 1.0.0
    */
   function online_newspaper_image_ratio_variable( $control, $selector ) {
      $decoded_control = ONP\online_newspaper_get_customizer_option( $control );
      if( $decoded_control === ONP\online_newspaper_get_customizer_default( $control ) ) return;
      if( ! $decoded_control ) return;
      echo "body.online-newspaper-variables {\n";
         if( isset( $decoded_control['desktop'] ) && $decoded_control['desktop'] > 0 ) echo $selector, " : ", $decoded_control['desktop'], ";\n";
         if( isset( $decoded_control['tablet'] ) && $decoded_control['tablet'] > 0 ) echo $selector, "-tab : ", $decoded_control['tablet'], ";\n";
         if( isset( $decoded_control['smartphone'] ) && $decoded_control['smartphone'] > 0 ) echo $selector, "-mobile : ", $decoded_control['smartphone'], ";\n";
      echo '}';
   }
endif;

// box shadow
if( ! function_exists( 'online_newspaper_box_shadow_styles' ) ) :
   /**
    * Generates css code for box shadow
    *
    * @package Online Newspaper
    * @since 1.0.0
    */
   function online_newspaper_box_shadow_styles( $control, $selector ) {
      $online_newspaper_box_shadow = ONP\online_newspaper_get_customizer_option( $control );
      if( $online_newspaper_box_shadow === ONP\online_newspaper_get_customizer_default( $control ) ) return;
      if( ! $online_newspaper_box_shadow['option'] ) {
         echo $selector."{ box-shadow: 0px 0px 0px 0px;
         }\n";
      } else {
         if( $online_newspaper_box_shadow['type'] == 'outset') $online_newspaper_box_shadow['type'] = '';
         $box_shadow_value = esc_html( $online_newspaper_box_shadow['type'] ) ." ".esc_html( $online_newspaper_box_shadow['hoffset'] ).  "px ". esc_html( $online_newspaper_box_shadow['voffset'] ). "px ".esc_html( $online_newspaper_box_shadow['blur'] ).  "px ".esc_html( $online_newspaper_box_shadow['spread'] ).  "px ".online_newspaper_get_color_format( $online_newspaper_box_shadow['color'] );
         echo $selector."{ box-shadow : " . $box_shadow_value . "; -webkit-box-shadow: ". $box_shadow_value ."; -moz-box-shadow: " . $box_shadow_value . " }\n";
      }
   }
endif;

// Value change with responsive
if( ! function_exists( 'online_newspaper_value_change_responsive' ) ) :
   /**
   * Generate css code for variable change with responsive
   *
   * @package Online Newspaper
   * @since 1.0.0 
   */
   function online_newspaper_value_change_responsive ( $control, $selector, $property, $is_negative = false ) {
      $decoded_control = ONP\online_newspaper_get_customizer_option( $control );
      if( $decoded_control === ONP\online_newspaper_get_customizer_default( $control ) ) return;
      if( ! $decoded_control ) return;
      $minus = ( $is_negative ? '-' : '' );
      if( isset( $decoded_control['desktop'] ) ) :
         $desktop = $decoded_control['desktop'];
         echo $selector . "{ " . esc_html( $property ). ": ".esc_html( $minus . $desktop ).  "px; }";
      endif;

      if( isset( $decoded_control['tablet'] ) ) :
         $tablet = $decoded_control['tablet'];
         echo "@media(max-width: 940px) { " .$selector . "{ " . esc_html( $minus . $property ). ": ".esc_html( $tablet ).  "px; } }\n";
      endif;
      
      if( isset( $decoded_control['smartphone'] ) ) :
         $smartphone = $decoded_control['smartphone'];
         echo "@media(max-width: 610px) { " .$selector . "{ " . esc_html( $minus . $property ). ": ".esc_html($smartphone).  "px; } }\n";
   endif;
   }
endif;

// spacing control
if( ! function_exists( 'online_newspaper_spacing_control' ) ) :
   /**
    * Generate css code for variable change with responsive for spacing controls
    *
    * @package Online Newspaper
    * @since 1.0.0
    */
    function online_newspaper_spacing_control( $control, $selector, $property = 'padding' ) {
      $decoded_control = ONP\online_newspaper_get_customizer_option( $control );
      if( $decoded_control === ONP\online_newspaper_get_customizer_default( $control ) ) return;
      if( ! $decoded_control ) return;
      if( isset( $decoded_control['desktop'] ) ) :
         $desktop = $decoded_control['desktop'];
         echo $selector . '{ '. esc_html( $property ) .' : '. esc_html( $desktop['top'] ) .'px '. esc_html( $desktop['right'] ) .'px '. esc_html( $desktop['bottom'] ) .'px '. esc_html( $desktop['left'] ) .'px }';
      endif;

      if( isset( $decoded_control['tablet'] ) ) :
         $tablet = $decoded_control['tablet'];
         echo '@media(max-width: 940px) {' .$selector . '{ '. esc_html( $property ) .' : '. esc_html( $tablet['top'] ) .'px '. esc_html( $tablet['right'] ) .'px '. esc_html( $tablet['bottom'] ) .'px '. esc_html( $tablet['left'] ) .'px } }';
      endif;

      if( isset( $decoded_control['smartphone'] ) ) :
         $smartphone = $decoded_control['smartphone'];
         echo '@media(max-width: 610px) { ' . $selector . '{ '. esc_html( $property ) .' : '. esc_html( $smartphone['top'] ) .'px '. esc_html( $smartphone['right'] ) .'px '. esc_html( $smartphone['bottom'] ) .'px '. esc_html( $smartphone['left'] ) .'px } }';
      endif;
    }
endif;

// preset colors
if( ! function_exists( 'online_newspaper_preset_color_css' ) ) :
   /**
    * Generate css code for preset colors
    *
    * @since 1.0.0
    */
    function online_newspaper_preset_color_css( $control, $variable ) {
      $decoded_control = ONP\online_newspaper_get_customizer_option( $control );
      if( $decoded_control === ONP\online_newspaper_get_customizer_default( $control ) ) return;
      if( is_array( $decoded_control ) && ! empty( $decoded_control ) && array_key_exists( 'color_palettes', $decoded_control ) && array_key_exists( 'active_palette', $decoded_control ) ) :
         extract( $decoded_control );
         $colors = $color_palettes[ $active_palette ];
         if( ! empty( $colors ) && is_array( $colors ) ) :
            echo "body.online-newspaper-variables {\n";
            foreach( $colors as $index => $color ) :
               $count = $index + 1;
               echo $variable, $count, ": ", esc_html( $color ), ";\n";
            endforeach;
            echo "}\n";
         endif;
      endif;
    }
endif;

if( ! function_exists( 'online_newspaper_color_css' ) ) :
   /**
    * Generate Css for color controls
    * 
    * @since 1.0.0
    */
    function online_newspaper_color_css( $control, $selector = 'body.online-newspaper-variables', $property = 'background' ){
      $decoded_control = ONP\online_newspaper_get_customizer_option( $control );
      if( $decoded_control === ONP\online_newspaper_get_customizer_default( $control ) ) return;
      $is_variable = str_contains( $selector, 'body.online-newspaper-variables' );
      if( array_key_exists( 'initial', $decoded_control ) ) :
         $initial = $decoded_control[ 'initial' ]; $initial_color = online_newspaper_get_color_format( $initial[ $initial[ 'type' ] ] );
         $hover = $decoded_control[ 'hover' ]; $hover_color = online_newspaper_get_color_format( $hover[ $hover[ 'type' ] ] );
         if( $is_variable ) :
            echo "$selector {\n $property: $initial_color;\n $property-hover: $hover_color;\n}";
         else:
            echo "$selector {\n $property: $initial_color;\n}";
            echo "$selector:hover {\n $property: $hover_color;\n}";
         endif;
         return;
      endif;

      $type_key_exists = array_key_exists( 'type', $decoded_control );
      if( $type_key_exists && $decoded_control[ 'type' ] !== 'image' ):
         $color = $decoded_control[ $decoded_control[ 'type' ] ];
         $new_color = online_newspaper_get_color_format( $color );
         echo "$selector {\n $property: $new_color;\n }";
         return;
      endif;

      if( $type_key_exists && $decoded_control[ 'type' ] === 'image' ):
         $image = $decoded_control[ 'image' ];
         echo $selector, " { \n";
         if( isset( $image[ 'url' ] ) ) echo "background-image: url(", esc_url( $image[ 'url' ] ), ");\n";
         if( isset( $decoded_control['repeat'] ) ) echo "background-repeat: ", esc_html( $decoded_control['repeat'] ), ";\n";
         if( isset( $decoded_control['position'] ) ) echo "background-position:", esc_html( $decoded_control['position'] ), ";\n";
         if( isset( $decoded_control['attachment'] ) ) echo "background-attachment: ", esc_html( $decoded_control['attachment'] ), ";\n";
         if( isset( $decoded_control['size'] ) ) echo "background-size: ", esc_html( $decoded_control['size'] ), ";\n";
         echo '}';
         return;
      endif;
    }
endif;

if( ! function_exists( 'online_newspaper_typography_preset' ) ) :
   /**
    * Generate css variable
    * 
    * @since 1.0.0
    */
    function online_newspaper_typography_preset() {
      $decoded_control = ONP\online_newspaper_get_customizer_option( 'typography_presets' );
      if( count( $decoded_control ) > 0 ) :
         $typographies = $decoded_control['typographies'];
         $labels = $decoded_control['labels'];
         if( count( $typographies ) > 0 ) :
            foreach( $typographies as $index => $typography ) :
               $variable = '--online-newspaper-global-preset-typography-';
               $count = $index + 1;
               $variable .= $count . '-font';
               online_newspaper_typography_control( $typography, $variable, true );
            endforeach;
         endif;
      endif;
    }
endif;

if( ! function_exists( 'online_newspaper_typography_control' ) ) :
   /**
   * Generate css code for typography control.
   *
   * @package Online Newspaper
   * @since 1.0.0 
   */
   function online_newspaper_typography_control( $control, $selector, $is_variable = true ) {
      $property = $selector;
      if( $is_variable ) $selector = 'body.online-newspaper-variables';
      if( ! empty( $control ) && is_array( $control ) ) :
         $value = $control;
      else:
         $value = ONP\online_newspaper_get_customizer_option( $control );
         if( $value === ONP\online_newspaper_get_customizer_default( $control ) ) return;
      endif;
      if( ! $value ) return;
      $is_preset = false;
      if( array_key_exists( 'preset', $value ) && $value['preset'] !== '-1' ) :
         $variable = '--online-newspaper-global-preset-typography-'. absint( (int) $value['preset'] + 1 ) .'-font';
         $is_preset = true;
      endif;
      echo $selector, "{\n";
      if( isset( $value['font_family'] ) ) echo ( $is_variable ? $property . '-family' : 'font-family' ), ": ", ( $is_preset ? ( 'var(' . $variable . '-family)' ) : esc_html( $value['font_family']['value'] ) ), ";\n";
      if( isset( $value['font_weight'] ) ) echo ( $is_variable ? $property . '-weight': 'font-weight' ), ": ", ( $is_preset ? ( 'var(' . $variable . '-weight)' ) : esc_html( $value['font_weight']['value'] ) ), ";\n", ( $is_variable ? $property . '-style' : 'font-style' ), ": ", ( $is_preset ? ( 'var(' . $variable . '-style)' ) : esc_html( $value['font_weight']['variant'] ) ), ";\n";
      if( isset( $value['text_transform'] ) ) echo ( $is_variable ? $property . '-texttransform' : 'text-transform' ), ": ", ( $is_preset ? ( 'var(' . $variable . '-texttransform)' ) : esc_html( $value['text_transform'] ) ), ";\n";
      if( isset( $value['text_decoration'] ) ) echo ( $is_variable ? $property . '-textdecoration' : 'text-decoration' ), " : ", ( $is_preset ? ( 'var(' . $variable . '-textdecoration)' ) : esc_html( $value['text_decoration'] ) ), ";\n";
      if( isset( $value['font_size'] ) && isset( $value['font_size']['desktop'] ) ) echo ( $is_variable ? $property . '-size' : 'font-size' ), ": ", ( $is_preset ? ( 'var(' . $variable . '-size)' ) : esc_html( $value['font_size']['desktop'] ) . 'px' ), ";\n";
      if( isset( $value['line_height'] ) && isset( $value['line_height']['desktop'] ) ) echo ( $is_variable ? $property . '-lineheight' : 'line-height' ), ": ", ( $is_preset ? ( 'var(' . $variable . '-lineheight)' ) : esc_html( $value['line_height']['desktop'] ) . 'px' ), ";\n";
      if( isset( $value['letter_spacing'] ) && isset( $value['letter_spacing']['desktop'] ) ) echo ( $is_variable ? $property . '-letterspacing' : 'letter-spacing' ), ": ", ( $is_preset ? ( 'var(' . $variable . '-letterspacing)' ) : esc_html( $value['letter_spacing']['desktop'] ) . 'px' ), ";\n";
      if( ! $is_variable ) echo "}\n";
   
      // tablet responsive
      if( ! $is_variable ) echo "@media(max-width: 940px) {", $selector, "{\n"; 
      if( isset( $value['font_size'] ) && isset( $value['font_size']['tablet'] ) ) echo ( $is_variable ? $property . '-size-tab' : 'font-size' ) ,": ", ( $is_preset ? ( 'var(' . $variable . '-size-tab)' ) : esc_html( $value['font_size']['tablet'] ) . 'px' ), ";\n";
      if( isset( $value['line_height'] ) && isset( $value['line_height']['tablet'] ) ) echo ( $is_variable ? $property . '-lineheight-tab' : 'line-height' ), ": ", ( $is_preset ? ( 'var(' . $variable . '-lineheight-tab)' ) : esc_html( $value['line_height']['tablet'] ) . 'px' ), ";\n";
      if( isset( $value['letter_spacing'] ) && isset( $value['letter_spacing']['tablet'] ) ) echo ( $is_variable ? $property . '-letterspacing-tab' : 'letter-spacing' ), ": ", ( $is_preset ? ( 'var(' . $variable . '-letterspacing-tab)' ) : esc_html( $value['letter_spacing']['tablet'] ) . 'px' ), ";\n";
      if( ! $is_variable ) echo "}}\n"; 
      // mobile responsive
      if( ! $is_variable ) echo "@media(max-width: 610px) {", $selector, "{\n"; 
      if( isset( $value['font_size'] ) && isset( $value['font_size']['smartphone'] ) ) echo ( $is_variable ? $property . '-size-mobile' : 'font-size' ) ,": ", ( $is_preset ? ( 'var(' . $variable . '-size-mobile)' ) : esc_html( $value['font_size']['smartphone'] ) . 'px' ), ";\n";
      if( isset( $value['line_height'] ) && isset( $value['line_height']['smartphone'] ) ) echo ( $is_variable ? $property . '-lineheight-mobile' : 'line-height' ), ": ", ( $is_preset ? ( 'var(' . $variable . '-lineheight-mobile)' ) : esc_html( $value['line_height']['smartphone'] ) . 'px' ), ";\n";
      if( isset( $value['letter_spacing'] ) && isset( $value['letter_spacing']['smartphone'] ) ) echo ( $is_variable ? $property . '-letterspacing-mobile' : 'letter-spacing' ), ": ", ( $is_preset ? ( 'var(' . $variable . '-letterspacing-mobile)' ) : esc_html( $value['letter_spacing']['smartphone'] ) . 'px' ), ";\n";
      if( ! $is_variable ) echo "}}\n";
      if( $is_variable ) echo "}\n";
   }
endif;

if( ! function_exists( 'online_newspaper_number_control' ) ) :
   /**
   * Generate css code for typography control.
   *
   * @package Online Newspaper
   * @since 1.0.0 
   */
   function online_newspaper_number_control( $control, $selector = 'body.online-newspaper-variables', $property = 'border-radius', $unit = 'px' ) {
      $value = ONP\online_newspaper_get_customizer_option( $control );
      if( $value === ONP\online_newspaper_get_customizer_default( $control ) ) return;
      $is_variable = ( $selector === 'body.online-newspaper-variables' );
      $css = "$selector { $property: $value$unit; }";
      echo $css;
   }
endif;

if( ! function_exists( 'online_newspaper_get_pagination_text_color' ) ) :
   /**
    * Generate text color css for pagination button
    * 
    * @since 1.0.0
    */
   function online_newspaper_get_pagination_text_color() {
      $decoded_control = ONP\online_newspaper_get_customizer_option( 'pagination_button_text_color' );
      $decoded_background = ONP\online_newspaper_get_customizer_option( 'pagination_button_background_color' );
      extract( $decoded_control );
      $bk_initial = $decoded_background[ 'initial' ];
      $bk_hover = $decoded_background[ 'hover' ];

      $initial_color_css = 'body.online-newspaper-light-mode .navigation.posts-navigation a, body.online-newspaper-light-mode .navigation.posts-navigation .nav-previous a:before, body.online-newspaper-light-mode .navigation.posts-navigation .nav-next a:after, body.online-newspaper-light-mode .pagination .ajax-load-more, body.online-newspaper-light-mode .pagination .page-numbers li a';
      $hover_color_css = 'body.online-newspaper-light-mode .navigation.posts-navigation a:hover, body.online-newspaper-light-mode .navigation.posts-navigation .nav-previous a:hover:before, body.online-newspaper-light-mode .navigation.posts-navigation .nav-next a:hover:after, body.online-newspaper-light-mode .pagination .page-numbers li a:hover, body.online-newspaper-light-mode .pagination .ajax-load-more:hover';
      $initial_bk_css = 'body.online-newspaper-light-mode .pagination .page-numbers li a, body.online-newspaper-light-mode .pagination .ajax-load-more';
      $hover_bk_css = 'body.online-newspaper-light-mode .pagination .page-numbers li a:hover, body.online-newspaper-light-mode .pagination .ajax-load-more:hover';

      $initial_color = online_newspaper_get_color_format( $initial[ $initial[ 'type' ] ] );
      $hover_color = online_newspaper_get_color_format( $hover[ $hover[ 'type' ] ] );
      $initial_bk_color = online_newspaper_get_color_format( $bk_initial[ $bk_initial[ 'type' ] ] );
      $hover_bk_color = online_newspaper_get_color_format( $bk_hover[ $bk_hover[ 'type' ] ] );
      echo "$initial_color_css {\n color: $initial_color;\n}";
      echo "$hover_color_css {\n color: $hover_color;\n}";
      echo "body.online-newspaper-light-mode .navigation.posts-navigation a {\n border-color: $initial_color;\n}";
      echo "body.online-newspaper-light-mode .navigation.posts-navigation a:hover {\n border-color: $hover_color;\n}";

      echo "$initial_bk_css {\n background: $initial_bk_color;\n}";
      echo "$hover_bk_css {\n background: $hover_bk_color;\n}";
   }
endif;