<?php


class ReduxFramework_typography extends ReduxFramework {

    private $std_fonts = array(
        "Arial, Helvetica, sans-serif"                          => "Arial, Helvetica, sans-serif",
        "'Arial Black', Gadget, sans-serif"                     => "'Arial Black', Gadget, sans-serif",
        "'Bookman Old Style', serif"                            => "'Bookman Old Style', serif",
        "'Comic Sans MS', cursive"                              => "'Comic Sans MS', cursive",
        "Courier, monospace"                                    => "Courier, monospace",
        "Garamond, serif"                                       => "Garamond, serif",
        "Georgia, serif"                                        => "Georgia, serif",
        "Impact, Charcoal, sans-serif"                          => "Impact, Charcoal, sans-serif",
        "'Lucida Console', Monaco, monospace"                   => "'Lucida Console', Monaco, monospace",
        "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"    => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
        "'MS Sans Serif', Geneva, sans-serif"                   => "'MS Sans Serif', Geneva, sans-serif",
        "'MS Serif', 'New York', sans-serif"                    => "'MS Serif', 'New York', sans-serif",
        "'Palatino Linotype', 'Book Antiqua', Palatino, serif"  => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
        "Tahoma,Geneva, sans-serif"                             => "Tahoma, Geneva, sans-serif",
        "'Times New Roman', Times,serif"                        => "'Times New Roman', Times, serif",
        "'Trebuchet MS', Helvetica, sans-serif"                 => "'Trebuchet MS', Helvetica, sans-serif",
        "Verdana, Geneva, sans-serif"                           => "Verdana, Geneva, sans-serif",    
    );
    
    /**
     * Field Constructor.
     *
     * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
     *
     * @since ReduxFramework 1.0.0
     */
    function __construct( $field = array(), $value ='', $parent ) {
    
        //parent::__construct( $parent->sections, $parent->args );
        $this->parent = $parent;
        $this->field = $field;
        $this->value = $value;

    
    }

    /**
     * Field Render Function.
     *
     * Takes the vars and outputs the HTML for the field in the settings
     *
     * @since ReduxFramework 1.0.0
     */
    function render(){   

        global $wp_filesystem;

        // Initialize the Wordpress filesystem, no more using file_put_contents function
        if (empty($wp_filesystem)) {
            require_once(ABSPATH .'/wp-admin/includes/file.php');
            WP_Filesystem();
        }          

        // No errors please
        $defaults = array(
            'font-family' => true,
            'font-size' => true,
            'subsets' => true,
            'font-weight' => true,
            'font-style' => true,
            'font-backup' => false,
            'color' => true,
            'preview' => true,
            'line-height' => true,
            'word-spacing' => false,
            'letter-spacing' => false,
            'google' => true,
            'update_weekly' => false // Enable to force updates of Google Fonts to be weekly
        );
        $this->field = wp_parse_args( $this->field, $defaults );

        $defaults = array(
            'font-family'=>'',
            'font-options'=>'',
            'font-backup'=>'',
            'line-height'=>'',
            'word-spacing' => '',
            'letter-spacing' => '',
            'subsets'=>'',
            'google'=>false,
            'font-script'=>'',
            'font-weight'=>'',
            'font-style'=>'',
            'color'=>'',
            'font-size'=>'',
        );

        $this->value = wp_parse_args( $this->value, $defaults );

  // Since fonts declared is CSS (@font-face) are not rendered in the preview,
  // they can be declared in a CSS file and passed here so they DO display in
  // font preview.  Do NOT pass style.css in your theme, as that will mess up
  // admin page styling.  It's recommended to pass a CSS file with ONLY font 
  // declarations.
  
  // If field is set and not blank, then enqueue field
        if (isset($this->field['ext-font-css']) && $this->field['ext-font-css'] != ''){
            wp_register_style('redux-external-fonts', $this->field['ext-font-css']);
            wp_enqueue_style('redux-external-fonts');
        }

        if (empty($this->field['units']) && !empty($this->field['default']['units'])) {
            $this->field['units'] = $this->field['default']['units'];
        }          
        if ( empty( $this->field['units'] ) || !in_array( $this->field['units'], array( 'px', 'em', 'rem', '%' ) ) ) {
            $this->field['units'] = 'px';
        }
        $unit = $this->field['units'];

    if ($this->field['font-family'] === true):
        
          echo '<div id="'.$this->field['id'].'" class="redux-typography-container" data-id="'.$this->field['id'].'" data-units="'.$unit.'">';

              /**
              Font Family
               **/
            
              if ( filter_var($this->value['google'], FILTER_VALIDATE_BOOLEAN) ) {
                $fontFamily = explode(', ', $this->value['font-family'],2);
                if (empty($fontFamily[0]) && !empty($fontFamily[1])) {
                  $fontFamily[0] = $fontFamily[1];
                  $fontFamily[1] = "";
                }       
              }

              if (!isset($fontFamily)) {
                $fontFamily = array();
                $fontFamily[0] = $this->value['font-family'];
                $fontFamily[1] = "";
              }

              echo '<input type="hidden" class="redux-typography-font-family '.$this->field['class'].'" name="' . $this->field['name'] . '[font-family]" value="'.$this->value['font-family'].'" data-id="'.$this->field['id'].'"  />';
              echo '<input type="hidden" class="redux-typography-font-options '.$this->field['class'].'" name="' . $this->field['name'] . '[font-options]" value="'.$this->value['font-options'].'" data-id="'.$this->field['id'].'"  />';
              echo '<div class="select_wrapper typography-family" style="width: 220px; margin-right: 5px;">';
              echo '<select data-placeholder="'.__('Font family','redux-framework').'" class="redux-typography redux-typography-family '.$this->field['class'].'" id="'.$this->field['id'].'-family" data-id="'.$this->field['id'].'" data-value="'.$fontFamily[0].'">';
              echo '<option data-google="false" data-details="" value=""></option>';

              if (empty($this->field['fonts'])) {
                  $this->field['fonts'] = $this->std_fonts; 
              }

              // Standard sizes for normal fonts
              $font_sizes = urlencode( json_encode( array( '400'=>'Normal 400', '700'=>'Bold 700', '400italic'=>'Normal 400 Italic', '700italic'=>'Bold 700 Italic' ) ) );
              if ( $this->field['google'] == true && !empty( $this->parent->args['google_api_key'] ) ) {
                echo '<optgroup label="'.__('Standard Fonts', 'redux-framework').'">';  
              }
              foreach ($this->field['fonts'] as $i=>$family) {
                  echo '<option data-google="false" data-details="'.$font_sizes.'" value="'. $i .'"' . selected($this->value['font-family'], $i, false) . '>'. $family .'</option>';
              }
              if ($this->field['google'] == true ) {
                  echo '</optgroup>';

                        if ( !isset( $this->parent->googleFontHTML ) && !empty( $this->parent->googleFontHTML ) ) {
                          echo $this->parent->googleFontHTML;
                        } else {
                          $googleHTML = '<optgroup label="Google Webfonts"><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22600%22%2C%22name%22%3A%22Semi-Bold+600%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22800%22%2C%22name%22%3A%22Extra-Bold+800%22%7D%2C%7B%22id%22%3A%22800italic%22%2C%22name%22%3A%22Extra-Bold+800+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22greek%22%2C%22name%22%3A%22Greek%22%7D%2C%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22cyrillic-ext%22%2C%22name%22%3A%22Cyrillic+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%2C%7B%22id%22%3A%22vietnamese%22%2C%22name%22%3A%22Vietnamese%22%7D%2C%7B%22id%22%3A%22greek-ext%22%2C%22name%22%3A%22Greek+Extended%22%7D%5D%7D" data-google="true" value="Open Sans">Open Sans</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Oswald">Oswald</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22100%22%2C%22name%22%3A%22Ultra-Light+100%22%7D%2C%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22500%22%2C%22name%22%3A%22Medium+500%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22900%22%2C%22name%22%3A%22Ultra-Bold+900%22%7D%2C%7B%22id%22%3A%22900italic%22%2C%22name%22%3A%22Ultra-Bold+900+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22greek%22%2C%22name%22%3A%22Greek%22%7D%2C%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22cyrillic-ext%22%2C%22name%22%3A%22Cyrillic+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%2C%7B%22id%22%3A%22vietnamese%22%2C%22name%22%3A%22Vietnamese%22%7D%2C%7B%22id%22%3A%22greek-ext%22%2C%22name%22%3A%22Greek+Extended%22%7D%5D%7D" data-google="true" value="Roboto">Roboto</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Droid Sans">Droid Sans</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22100%22%2C%22name%22%3A%22Ultra-Light+100%22%7D%2C%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22900%22%2C%22name%22%3A%22Ultra-Bold+900%22%7D%2C%7B%22id%22%3A%22900italic%22%2C%22name%22%3A%22Ultra-Bold+900+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Lato">Lato</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22300italic%22%2C%22name%22%3A%22Book+300+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22greek%22%2C%22name%22%3A%22Greek%22%7D%2C%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22cyrillic-ext%22%2C%22name%22%3A%22Cyrillic+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%2C%7B%22id%22%3A%22vietnamese%22%2C%22name%22%3A%22Vietnamese%22%7D%2C%7B%22id%22%3A%22greek-ext%22%2C%22name%22%3A%22Greek+Extended%22%7D%5D%7D" data-google="true" value="Open Sans Condensed">Open Sans Condensed</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22cyrillic-ext%22%2C%22name%22%3A%22Cyrillic+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%5D%7D" data-google="true" value="PT Sans">PT Sans</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Droid Serif">Droid Serif</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22500%22%2C%22name%22%3A%22Medium+500%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22greek%22%2C%22name%22%3A%22Greek%22%7D%2C%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22cyrillic-ext%22%2C%22name%22%3A%22Cyrillic+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%2C%7B%22id%22%3A%22greek-ext%22%2C%22name%22%3A%22Greek+Extended%22%7D%5D%7D" data-google="true" value="Ubuntu">Ubuntu</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22greek%22%2C%22name%22%3A%22Greek%22%7D%2C%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22cyrillic-ext%22%2C%22name%22%3A%22Cyrillic+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%2C%7B%22id%22%3A%22vietnamese%22%2C%22name%22%3A%22Vietnamese%22%7D%2C%7B%22id%22%3A%22greek-ext%22%2C%22name%22%3A%22Greek+Extended%22%7D%5D%7D" data-google="true" value="Roboto Condensed">Roboto Condensed</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22200%22%2C%22name%22%3A%22Light+200%22%7D%2C%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22600%22%2C%22name%22%3A%22Semi-Bold+600%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22900%22%2C%22name%22%3A%22Ultra-Bold+900%22%7D%2C%7B%22id%22%3A%22900italic%22%2C%22name%22%3A%22Ultra-Bold+900+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22vietnamese%22%2C%22name%22%3A%22Vietnamese%22%7D%5D%7D" data-google="true" value="Source Sans Pro">Source Sans Pro</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22cyrillic-ext%22%2C%22name%22%3A%22Cyrillic+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%5D%7D" data-google="true" value="PT Sans Narrow">PT Sans Narrow</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22100%22%2C%22name%22%3A%22Ultra-Light+100%22%7D%2C%7B%22id%22%3A%22200%22%2C%22name%22%3A%22Light+200%22%7D%2C%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22500%22%2C%22name%22%3A%22Medium+500%22%7D%2C%7B%22id%22%3A%22600%22%2C%22name%22%3A%22Semi-Bold+600%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22800%22%2C%22name%22%3A%22Extra-Bold+800%22%7D%2C%7B%22id%22%3A%22900%22%2C%22name%22%3A%22Ultra-Bold+900%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Raleway">Raleway</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22200%22%2C%22name%22%3A%22Light+200%22%7D%2C%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Yanone Kaffeesatz">Yanone Kaffeesatz</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Lora">Lora</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22cyrillic-ext%22%2C%22name%22%3A%22Cyrillic+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%5D%7D" data-google="true" value="Lobster">Lobster</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Oxygen">Oxygen</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Arvo">Arvo</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Francois One">Francois One</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Montserrat">Montserrat</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22greek%22%2C%22name%22%3A%22Greek%22%7D%2C%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22cyrillic-ext%22%2C%22name%22%3A%22Cyrillic+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%2C%7B%22id%22%3A%22vietnamese%22%2C%22name%22%3A%22Vietnamese%22%7D%2C%7B%22id%22%3A%22greek-ext%22%2C%22name%22%3A%22Greek+Extended%22%7D%5D%7D" data-google="true" value="Arimo">Arimo</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22italic%22%2C%22name%22%3A%22Normal+400+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Bitter">Bitter</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22greek%22%2C%22name%22%3A%22Greek%22%7D%2C%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22cyrillic-ext%22%2C%22name%22%3A%22Cyrillic+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%2C%7B%22id%22%3A%22vietnamese%22%2C%22name%22%3A%22Vietnamese%22%7D%2C%7B%22id%22%3A%22greek-ext%22%2C%22name%22%3A%22Greek+Extended%22%7D%5D%7D" data-google="true" value="Noto Sans">Noto Sans</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Rokkitt">Rokkitt</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22greek%22%2C%22name%22%3A%22Greek%22%7D%2C%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22cyrillic-ext%22%2C%22name%22%3A%22Cyrillic+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%2C%7B%22id%22%3A%22greek-ext%22%2C%22name%22%3A%22Greek+Extended%22%7D%5D%7D" data-google="true" value="Play">Play</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22900%22%2C%22name%22%3A%22Ultra-Bold+900%22%7D%2C%7B%22id%22%3A%22900italic%22%2C%22name%22%3A%22Ultra-Bold+900+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Merriweather">Merriweather</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22cyrillic-ext%22%2C%22name%22%3A%22Cyrillic+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%5D%7D" data-google="true" value="PT Serif">PT Serif</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22200%22%2C%22name%22%3A%22Light+200%22%7D%2C%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22500%22%2C%22name%22%3A%22Medium+500%22%7D%2C%7B%22id%22%3A%22600%22%2C%22name%22%3A%22Semi-Bold+600%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22800%22%2C%22name%22%3A%22Extra-Bold+800%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Dosis">Dosis</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Nunito">Nunito</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22200%22%2C%22name%22%3A%22Light+200%22%7D%2C%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22600%22%2C%22name%22%3A%22Semi-Bold+600%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22900%22%2C%22name%22%3A%22Ultra-Bold+900%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Titillium Web">Titillium Web</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22500%22%2C%22name%22%3A%22Medium+500%22%7D%2C%7B%22id%22%3A%22600%22%2C%22name%22%3A%22Semi-Bold+600%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Cabin">Cabin</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%5D%7D" data-google="true" value="Cuprum">Cuprum</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22italic%22%2C%22name%22%3A%22Normal+400+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Libre Baskerville">Libre Baskerville</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Abel">Abel</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22100%22%2C%22name%22%3A%22Ultra-Light+100%22%7D%2C%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22greek%22%2C%22name%22%3A%22Greek%22%7D%2C%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22cyrillic-ext%22%2C%22name%22%3A%22Cyrillic+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%2C%7B%22id%22%3A%22vietnamese%22%2C%22name%22%3A%22Vietnamese%22%7D%2C%7B%22id%22%3A%22greek-ext%22%2C%22name%22%3A%22Greek+Extended%22%7D%5D%7D" data-google="true" value="Roboto Slab">Roboto Slab</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Shadows Into Light">Shadows Into Light</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22greek%22%2C%22name%22%3A%22Greek%22%7D%2C%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22cyrillic-ext%22%2C%22name%22%3A%22Cyrillic+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%2C%7B%22id%22%3A%22greek-ext%22%2C%22name%22%3A%22Greek+Extended%22%7D%5D%7D" data-google="true" value="Ubuntu Condensed">Ubuntu Condensed</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Anton">Anton</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22800%22%2C%22name%22%3A%22Extra-Bold+800%22%7D%2C%7B%22id%22%3A%22800italic%22%2C%22name%22%3A%22Extra-Bold+800+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Merriweather Sans">Merriweather Sans</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Fjalla One">Fjalla One</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Crafty Girls">Crafty Girls</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22500%22%2C%22name%22%3A%22Medium+500%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22900%22%2C%22name%22%3A%22Ultra-Bold+900%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Maven Pro">Maven Pro</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Archivo Narrow">Archivo Narrow</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22900%22%2C%22name%22%3A%22Ultra-Bold+900%22%7D%2C%7B%22id%22%3A%22900italic%22%2C%22name%22%3A%22Ultra-Bold+900+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Alegreya">Alegreya</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22600%22%2C%22name%22%3A%22Semi-Bold+600%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Signika">Signika</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Asap">Asap</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22100%22%2C%22name%22%3A%22Ultra-Light+100%22%7D%2C%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22600%22%2C%22name%22%3A%22Semi-Bold+600%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Josefin Sans">Josefin Sans</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Pacifico">Pacifico</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Vollkorn">Vollkorn</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Dancing Script">Dancing Script</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Questrial">Questrial</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Indie Flower">Indie Flower</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22100%22%2C%22name%22%3A%22Ultra-Light+100%22%7D%2C%7B%22id%22%3A%22200%22%2C%22name%22%3A%22Light+200%22%7D%2C%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22500%22%2C%22name%22%3A%22Medium+500%22%7D%2C%7B%22id%22%3A%22600%22%2C%22name%22%3A%22Semi-Bold+600%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22800%22%2C%22name%22%3A%22Extra-Bold+800%22%7D%2C%7B%22id%22%3A%22900%22%2C%22name%22%3A%22Ultra-Bold+900%22%7D%2C%7B%22id%22%3A%22900italic%22%2C%22name%22%3A%22Ultra-Bold+900+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Exo">Exo</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22italic%22%2C%22name%22%3A%22Normal+400+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Muli">Muli</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22cyrillic-ext%22%2C%22name%22%3A%22Cyrillic+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%5D%7D" data-google="true" value="Istok Web">Istok Web</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Quicksand">Quicksand</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Coming Soon">Coming Soon</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Armata">Armata</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Kreon">Kreon</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="News Cycle">News Cycle</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22900%22%2C%22name%22%3A%22Ultra-Bold+900%22%7D%2C%7B%22id%22%3A%22900italic%22%2C%22name%22%3A%22Ultra-Bold+900+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%5D%7D" data-google="true" value="Playfair Display">Playfair Display</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Special Elite">Special Elite</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Tangerine">Tangerine</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Economica">Economica</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22500%22%2C%22name%22%3A%22Medium+500%22%7D%2C%7B%22id%22%3A%22600%22%2C%22name%22%3A%22Semi-Bold+600%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Cabin Condensed">Cabin Condensed</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22greek%22%2C%22name%22%3A%22Greek%22%7D%2C%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22cyrillic-ext%22%2C%22name%22%3A%22Cyrillic+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%5D%7D" data-google="true" value="Comfortaa">Comfortaa</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%5D%7D" data-google="true" value="Philosopher">Philosopher</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22cyrillic-ext%22%2C%22name%22%3A%22Cyrillic+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%5D%7D" data-google="true" value="PT Sans Caption">PT Sans Caption</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Marvel">Marvel</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Inconsolata">Inconsolata</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Voltaire">Voltaire</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22vietnamese%22%2C%22name%22%3A%22Vietnamese%22%7D%5D%7D" data-google="true" value="Noticia Text">Noticia Text</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Chewy">Chewy</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Quattrocento">Quattrocento</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Cantarell">Cantarell</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22italic%22%2C%22name%22%3A%22Normal+400+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Changa One">Changa One</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Nobile">Nobile</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Squada One">Squada One</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22italic%22%2C%22name%22%3A%22Normal+400+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Gudea">Gudea</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Luckiest Guy">Luckiest Guy</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Monda">Monda</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22italic%22%2C%22name%22%3A%22Normal+400+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Ropa Sans">Ropa Sans</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Bree Serif">Bree Serif</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Fredoka One">Fredoka One</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Pontano Sans">Pontano Sans</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22100%22%2C%22name%22%3A%22Ultra-Light+100%22%7D%2C%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22600%22%2C%22name%22%3A%22Semi-Bold+600%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Josefin Slab">Josefin Slab</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Varela Round">Varela Round</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Karla">Karla</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Playball">Playball</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Jockey One">Jockey One</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%5D%7D" data-google="true" value="Poiret One">Poiret One</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Cantata One">Cantata One</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Telex">Telex</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Patua One">Patua One</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Calligraffitti">Calligraffitti</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Amatic SC">Amatic SC</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Lobster Two">Lobster Two</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Rock Salt">Rock Salt</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22cyrillic-ext%22%2C%22name%22%3A%22Cyrillic+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%2C%7B%22id%22%3A%22vietnamese%22%2C%22name%22%3A%22Vietnamese%22%7D%5D%7D" data-google="true" value="EB Garamond">EB Garamond</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Allerta">Allerta</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22900%22%2C%22name%22%3A%22Ultra-Bold+900%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Passion One">Passion One</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Shadows Into Light Two">Shadows Into Light Two</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22600%22%2C%22name%22%3A%22Semi-Bold+600%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Crimson Text">Crimson Text</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22600%22%2C%22name%22%3A%22Semi-Bold+600%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Signika Negative">Signika Negative</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Permanent Marker">Permanent Marker</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Handlee">Handlee</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Cherry Cream Soda">Cherry Cream Soda</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Quattrocento Sans">Quattrocento Sans</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Gentium Book Basic">Gentium Book Basic</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Unkempt">Unkempt</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Varela">Varela</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22italic%22%2C%22name%22%3A%22Normal+400+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Old Standard TT">Old Standard TT</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Satisfy">Satisfy</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Molengo">Molengo</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Droid Sans Mono">Droid Sans Mono</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%5D%7D" data-google="true" value="Marck Script">Marck Script</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="BenchNine">BenchNine</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Lusitana">Lusitana</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Black Ops One">Black Ops One</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22greek%22%2C%22name%22%3A%22Greek%22%7D%2C%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22cyrillic-ext%22%2C%22name%22%3A%22Cyrillic+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%2C%7B%22id%22%3A%22vietnamese%22%2C%22name%22%3A%22Vietnamese%22%7D%2C%7B%22id%22%3A%22greek-ext%22%2C%22name%22%3A%22Greek+Extended%22%7D%5D%7D" data-google="true" value="Noto Serif">Noto Serif</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22italic%22%2C%22name%22%3A%22Normal+400+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Crete Round">Crete Round</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Righteous">Righteous</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Waiting for the Sunrise">Waiting for the Sunrise</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Leckerli One">Leckerli One</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22greek%22%2C%22name%22%3A%22Greek%22%7D%2C%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22cyrillic-ext%22%2C%22name%22%3A%22Cyrillic+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%2C%7B%22id%22%3A%22vietnamese%22%2C%22name%22%3A%22Vietnamese%22%7D%2C%7B%22id%22%3A%22greek-ext%22%2C%22name%22%3A%22Greek+Extended%22%7D%5D%7D" data-google="true" value="Tinos">Tinos</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22vietnamese%22%2C%22name%22%3A%22Vietnamese%22%7D%5D%7D" data-google="true" value="Patrick Hand">Patrick Hand</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Bangers">Bangers</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Amaranth">Amaranth</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22500%22%2C%22name%22%3A%22Medium+500%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22900%22%2C%22name%22%3A%22Ultra-Bold+900%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Orbitron">Orbitron</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Bevan">Bevan</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22900%22%2C%22name%22%3A%22Ultra-Bold+900%22%7D%2C%7B%22id%22%3A%22900italic%22%2C%22name%22%3A%22Ultra-Bold+900+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Chivo">Chivo</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Syncopate">Syncopate</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Archivo Black">Archivo Black</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Oleo Script">Oleo Script</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Kameron">Kameron</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Electrolize">Electrolize</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Loved by the King">Loved by the King</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22800%22%2C%22name%22%3A%22Extra-Bold+800%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Coda">Coda</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Walter Turncoat">Walter Turncoat</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Gloria Hallelujah">Gloria Hallelujah</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Covered By Your Grace">Covered By Your Grace</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Kotta One">Kotta One</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Paytone One">Paytone One</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Reenie Beanie">Reenie Beanie</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Share">Share</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Pathway Gothic One">Pathway Gothic One</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Doppio One">Doppio One</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Carme">Carme</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Architects Daughter">Architects Daughter</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Copse">Copse</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22italic%22%2C%22name%22%3A%22Normal+400+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Sanchez">Sanchez</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22200%22%2C%22name%22%3A%22Light+200%22%7D%2C%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22500%22%2C%22name%22%3A%22Medium+500%22%7D%2C%7B%22id%22%3A%22600%22%2C%22name%22%3A%22Semi-Bold+600%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22900%22%2C%22name%22%3A%22Ultra-Bold+900%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Source Code Pro">Source Code Pro</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Just Me Again Down Here">Just Me Again Down Here</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Rancho">Rancho</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22greek%22%2C%22name%22%3A%22Greek%22%7D%2C%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22cyrillic-ext%22%2C%22name%22%3A%22Cyrillic+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%2C%7B%22id%22%3A%22greek-ext%22%2C%22name%22%3A%22Greek+Extended%22%7D%5D%7D" data-google="true" value="Didact Gothic">Didact Gothic</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Domine">Domine</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Happy Monkey">Happy Monkey</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%5D%7D" data-google="true" value="Neucha">Neucha</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Pinyon Script">Pinyon Script</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Goudy Bookletter 1911">Goudy Bookletter 1911</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Enriqueta">Enriqueta</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Just Another Hand">Just Another Hand</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22italic%22%2C%22name%22%3A%22Normal+400+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22greek%22%2C%22name%22%3A%22Greek%22%7D%2C%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22greek-ext%22%2C%22name%22%3A%22Greek+Extended%22%7D%5D%7D" data-google="true" value="Cardo">Cardo</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Viga">Viga</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Antic Slab">Antic Slab</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Schoolbell">Schoolbell</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22900%22%2C%22name%22%3A%22Ultra-Bold+900%22%7D%2C%7B%22id%22%3A%22900italic%22%2C%22name%22%3A%22Ultra-Bold+900+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Overlock">Overlock</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%5D%7D" data-google="true" value="Bad Script">Bad Script</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Actor">Actor</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Spirax">Spirax</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Julius Sans One">Julius Sans One</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Rochester">Rochester</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Nothing You Could Do">Nothing You Could Do</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Rationale">Rationale</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22italic%22%2C%22name%22%3A%22Normal+400+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Sorts Mill Goudy">Sorts Mill Goudy</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Great Vibes">Great Vibes</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%5D%7D" data-google="true" value="Russo One">Russo One</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%5D%7D" data-google="true" value="Marmelad">Marmelad</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Homemade Apple">Homemade Apple</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22italic%22%2C%22name%22%3A%22Normal+400+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Arapey">Arapey</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Kaushan Script">Kaushan Script</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Hammersmith One">Hammersmith One</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%5D%7D" data-google="true" value="Scada">Scada</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Acme">Acme</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Share Tech">Share Tech</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22200%22%2C%22name%22%3A%22Light+200%22%7D%2C%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22800%22%2C%22name%22%3A%22Extra-Bold+800%22%7D%2C%7B%22id%22%3A%22italic%22%2C%22name%22%3A%22Normal+400+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Neuton">Neuton</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22cyrillic-ext%22%2C%22name%22%3A%22Cyrillic+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%5D%7D" data-google="true" value="Andika">Andika</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Petit Formal Script">Petit Formal Script</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Allerta Stencil">Allerta Stencil</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Damion">Damion</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Racing Sans One">Racing Sans One</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22italic%22%2C%22name%22%3A%22Normal+400+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22cyrillic-ext%22%2C%22name%22%3A%22Cyrillic+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%5D%7D" data-google="true" value="PT Serif Caption">PT Serif Caption</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Rambla">Rambla</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22greek%22%2C%22name%22%3A%22Greek%22%7D%2C%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22cyrillic-ext%22%2C%22name%22%3A%22Cyrillic+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%2C%7B%22id%22%3A%22greek-ext%22%2C%22name%22%3A%22Greek+Extended%22%7D%5D%7D" data-google="true" value="Ubuntu Mono">Ubuntu Mono</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Glegoo">Glegoo</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Nixie One">Nixie One</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Rosario">Rosario</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="The Girl Next Door">The Girl Next Door</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Limelight">Limelight</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Six Caps">Six Caps</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Orienta">Orienta</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Wellfleet">Wellfleet</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Aldrich">Aldrich</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22500%22%2C%22name%22%3A%22Medium+500%22%7D%2C%7B%22id%22%3A%22600%22%2C%22name%22%3A%22Semi-Bold+600%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22greek%22%2C%22name%22%3A%22Greek%22%7D%2C%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22cyrillic-ext%22%2C%22name%22%3A%22Cyrillic+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%2C%7B%22id%22%3A%22greek-ext%22%2C%22name%22%3A%22Greek+Extended%22%7D%5D%7D" data-google="true" value="Jura">Jura</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22italic%22%2C%22name%22%3A%22Normal+400+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Judson">Judson</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Sansita One">Sansita One</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Fontdiner Swanky">Fontdiner Swanky</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Sancreek">Sancreek</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Vidaloka">Vidaloka</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Metrophobic">Metrophobic</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Fenix">Fenix</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22900%22%2C%22name%22%3A%22Ultra-Bold+900%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Cinzel">Cinzel</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Metamorphous">Metamorphous</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Love Ya Like A Sister">Love Ya Like A Sister</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Alfa Slab One">Alfa Slab One</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22greek%22%2C%22name%22%3A%22Greek%22%7D%2C%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22cyrillic-ext%22%2C%22name%22%3A%22Cyrillic+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22cyrillic%22%2C%22name%22%3A%22Cyrillic%22%7D%2C%7B%22id%22%3A%22greek-ext%22%2C%22name%22%3A%22Greek+Extended%22%7D%5D%7D" data-google="true" value="Anonymous Pro">Anonymous Pro</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Berkshire Swash">Berkshire Swash</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Michroma">Michroma</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22italic%22%2C%22name%22%3A%22Normal+400+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Radley">Radley</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Gochi Hand">Gochi Hand</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Magra">Magra</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Pompiere">Pompiere</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Boogaloo">Boogaloo</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22italic%22%2C%22name%22%3A%22Normal+400+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="ABeeZee">ABeeZee</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Montserrat Alternates">Montserrat Alternates</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Volkhov">Volkhov</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Crushed">Crushed</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22900%22%2C%22name%22%3A%22Ultra-Bold+900%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Coustard">Coustard</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Puritan">Puritan</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Convergence">Convergence</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Inder">Inder</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Gentium Basic">Gentium Basic</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Carrois Gothic">Carrois Gothic</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Cookie">Cookie</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Slackey">Slackey</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Shanti">Shanti</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Courgette">Courgette</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Sunshiney">Sunshiney</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Lemon">Lemon</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22700italic%22%2C%22name%22%3A%22Bold+700+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22greek%22%2C%22name%22%3A%22Greek%22%7D%2C%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%2C%7B%22id%22%3A%22greek-ext%22%2C%22name%22%3A%22Greek+Extended%22%7D%5D%7D" data-google="true" value="Caudex">Caudex</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Merienda One">Merienda One</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22100%22%2C%22name%22%3A%22Ultra-Light+100%22%7D%2C%7B%22id%22%3A%22200%22%2C%22name%22%3A%22Light+200%22%7D%2C%7B%22id%22%3A%22300%22%2C%22name%22%3A%22Book+300%22%7D%2C%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22500%22%2C%22name%22%3A%22Medium+500%22%7D%2C%7B%22id%22%3A%22600%22%2C%22name%22%3A%22Semi-Bold+600%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22greek%22%2C%22name%22%3A%22Greek%22%7D%2C%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Advent Pro">Advent Pro</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Headland One">Headland One</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%2C%7B%22id%22%3A%22italic%22%2C%22name%22%3A%22Normal+400+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Lekton">Lekton</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Give You Glory">Give You Glory</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Gruppo">Gruppo</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Cabin Sketch">Cabin Sketch</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Days One">Days One</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Cutive">Cutive</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22700%22%2C%22name%22%3A%22Bold+700%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Sintony">Sintony</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Prata">Prata</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Alike">Alike</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Fredericka the Great">Fredericka the Great</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Contrail One">Contrail One</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Arbutus Slab">Arbutus Slab</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%2C%7B%22id%22%3A%22italic%22%2C%22name%22%3A%22Normal+400+Italic%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="IM Fell English">IM Fell English</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Kristi">Kristi</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Mako">Mako</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Abril Fatface">Abril Fatface</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Kranky">Kranky</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Cantora One">Cantora One</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Cedarville Cursive">Cedarville Cursive</option><option data-details="%7B%22variants%22%3A%5B%7B%22id%22%3A%22400%22%2C%22name%22%3A%22Normal+400%22%7D%5D%2C%22subsets%22%3A%5B%7B%22id%22%3A%22latin-ext%22%2C%22name%22%3A%22Latin+Extended%22%7D%2C%7B%22id%22%3A%22latin%22%2C%22name%22%3A%22Latin%22%7D%5D%7D" data-google="true" value="Denk One">Denk One</option></optgroup>';
                          $this->parent->googleFontHTML = $googleHTML;
                          echo $googleHTML;
                        }
              }

              echo '</select></div>';

              if ($this->field['google'] === true) { 
                // Set a flag so we know to set a header style or not
                  echo '<input type="hidden" class="redux-typography-google'.$this->field['class'].'" id="'.$this->field['id'].'-google" name="' . $this->field['name'] . '[google]" type="text" value="'. $this->field['google'] .'" data-id="'.$this->field['id'].'" />';            
              }

            endif;



            /**
            Font Style/Weight
             **/
            if ($this->field['font-style'] === true || $this->field['font-weight'] === true):
                echo '<div class="select_wrapper typography-style" original-title="'.__('Font style','redux-framework').'">';
              $style = $this->value['font-weight'].$this->value['font-style'];
                echo '<input type="hidden" class="typography-font-weight" name="' . $this->field['name'] . '[font-weight]" val="'.$this->value['font-weight'].'" data-id="'.$this->field['id'].'"  /> ';
                echo '<input type="hidden" class="typography-font-style" name="' . $this->field['name'] . '[font-style]" val="'.$this->value['font-style'].'" data-id="'.$this->field['id'].'"  /> ';
                echo '<select data-placeholder="'.__('Style','redux-framework').'" class="redux-typography redux-typography-style select'.$this->field['class'].'" original-title="'.__('Font style','redux-framework').'" id="'. $this->field['id'].'_style" data-id="'.$this->field['id'].'" data-value="'.$style.'">';
                if (empty($this->value['subset'])) {
                    echo '<option value=""></option>';
                }
                $nonGStyles = array('200'=>'Lighter','400'=>'Normal','700'=>'Bold','900'=>'Bolder');
                if (isset($gfonts[$this->value['font-family']])) {
                    foreach ($gfonts[$this->value['font-family']]['variants'] as $v) {
                        echo '<option value="'. $v['id'] .'" ' . selected($this->value['subset'], $v['id'], false) . '>'. $v['name'] .'</option>';
                    }
                } else {
                    foreach ($nonGStyles as $i=>$style){
                        if (!isset($this->value['subset']))
                            $this->value['subset'] = false;
                        echo '<option value="'. $i .'" ' . selected($this->value['subset'], $i, false) . '>'. $style .'</option>';
                    }
                }

                echo '</select></div>';

            endif;


            /**
            Font Script
             **/
            if ($this->field['subsets'] === true && $this->field['google'] === true):
                echo '<div class="select_wrapper typography-script tooltip" original-title="'.__('Font subsets','redux-framework').'">';
                echo '<select data-placeholder="'.__('Subsets','redux-framework').'" class="redux-typography redux-typography-subsets'.$this->field['class'].'" original-title="'.__('Font script','redux-framework').'"  id="'.$this->field['id'].'-subsets" name="' . $this->field['name'] . '[subsets]" data-value="'.$this->value['subsets'].'" data-id="'.$this->field['id'].'" >';
                if (empty($this->value['subsets'])) {
                    echo '<option value=""></option>';
                }
                if (isset($gfonts[$this->value['font-family']])) {
                    foreach ($gfonts[$this->value['font-family']]['subsets'] as $v) {
                        echo '<option value="'. $v['id'] .'" ' . selected($this->value['subset'], $v['id'], false) . '>'. $v['name'] .'</option>';
                    }
                }
                echo '</select></div>';

            endif;


            /**
            Font Size
             **/
            if ($this->field['font-size'] === true):
                echo '<div class="input-append"><input type="text" class="span2 redux-typography-size mini'.$this->field['class'].' tips" title="'.__('Size','redux-framework').'" placeholder="'.__('Size','redux-framework').'" id="'.$this->field['id'].'-size" name="' . $this->field['name'] . '[font-size]" value="'.str_replace($unit, '', $this->value['font-size']).'" data-value="'.str_replace($unit, '', $this->value['font-size']).'"><span class="add-on">'.$unit.'</span></div>';
              echo '<input type="hidden" class="typography-font-size" name="' . $this->field['name'] . '[font-size]" value="'.$this->value['font-size'].'" data-id="'.$this->field['id'].'"  />';
            endif;


            /**
            Line Height
             **/
            if ($this->field['line-height'] === true):
                echo '<div class="input-append"><input type="text" class="span2 redux-typography redux-typography-height mini'.$this->field['class'].' tips" title="'.__('Height','redux-framework').'" placeholder="'.__('Height','redux-framework').'" id="'.$this->field['id'].'-height" value="'.str_replace($unit, '', $this->value['line-height']).'" data-value="'.str_replace($unit, '', $this->value['line-height']).'"><span class="add-on">'.$unit.'</span></div>';
                echo '<input type="hidden" class="typography-line-height" name="' . $this->field['name'] . '[line-height]" value="'.$this->value['line-height'].'" data-id="'.$this->field['id'].'"  />';
            endif;

            /**
            Word Spacing
             **/
            if ($this->field['word-spacing'] === true):
                echo '<div class="input-append"><input type="text" class="span2 redux-typography redux-typography-word mini'.$this->field['class'].'" placeholder="'.__('Word Spacing','redux-framework').'" id="'.$this->field['id'].'-word" value="'.str_replace($unit, '', $this->value['word-spacing']).'" data-value="'.str_replace($unit, '', $this->value['word-spacing']).'"><span class="add-on">'.$unit.'</span></div>';
                echo '<input type="hidden" class="typography-word-spacing" name="' . $this->field['name'] . '[word-spacing]" value="'.$this->value['word-spacing'].'" data-id="'.$this->field['id'].'"  />';
            endif;

            /**
            Letter Spacing
             **/
            if ($this->field['letter-spacing'] === true):
                echo '<div class="input-append"><input type="text" class="span2 redux-typography redux-typography-letter mini'.$this->field['class'].'" placeholder="'.__('Letter Spacing','redux-framework').'" id="'.$this->field['id'].'-letter" value="'.str_replace($unit, '', $this->value['letter-spacing']).'" data-value="'.str_replace($unit, '', $this->value['letter-spacing']).'"><span class="add-on">'.$unit.'</span></div>';
              echo '<input type="hidden" class="typography-letter-spacing" name="' . $this->field['name'] . '[letter-spacing]" value="'.$this->value['letter-spacing'].'" data-id="'.$this->field['id'].'"  />';
            endif;

            
            /**
            Backup Font
             **/
            if ($this->field['font-family'] === true && $this->field['google'] === true) { 
              // Set a flag so we know to set a header style or not
                echo '<input type="hidden" class="redux-typography-google'.$this->field['class'].'" id="'.$this->field['id'].'-google" name="' . $this->field['name'] . '[google]" type="text" value="'. $this->field['google'] .'" data-id="'.$this->field['id'].'" data-id="'.$this->field['id'].'"  />';            
            
                if ($this->field['font-backup'] === true) {
                  echo '<div class="select_wrapper typography-family-backup" style="width: 220px; margin-right: 5px;">';
                  echo '<select data-placeholder="'.__('Backup Font Family','redux-framework').'" name="' . $this->field['name'] . '[font-backup]" class="redux-typography redux-typography-family-backup '.$this->field['class'].'" id="'.$this->field['id'].'-family-backup" data-id="'.$this->field['id'].'" data-value="'.$this->value['font-backup'].'">';
                  echo '<option data-google="false" data-details="" value=""></option>';
                  foreach ($this->field['fonts'] as $i=>$family) {
                      echo '<option data-google="true" data-details="'.$font_sizes.'" value="'. $i .'"' . selected($this->value['font-backup'], $i, false) . '>'. $family .'</option>';
                  }
                  echo '</select></div>';               
                }
            }

            /**
            Font Color
             **/
            if ($this->field['color'] === true):
                $default = "";
                if (empty($this->field['default']['color']) && !empty($this->field['color'])) {
                    $default = $this->value['color'];
                } else if (!empty($this->field['default']['color'])) {
                    $default = $this->field['default']['color'];
                }
                echo '<div id="' . $this->field['id'] . '_color_picker" class="colorSelector typography-color"><div style="background-color: '.$this->value['color'].'"></div></div>';
                echo '<input data-default-color="'.$default.'" class="redux-color redux-typography-color'.$this->field['class'].'" original-title="'.__('Font color','redux-framework').'" id="'.$this->field['id'].'-color" name="' . $this->field['name'] . '[color]" type="text" value="'. $this->value['color'] .'" data-id="'.$this->field['id'].'" />';
            endif;

            /**
            Font Preview
             **/
            if (!isset( $this->field['preview'] ) || $this->field['preview'] !== false):
                if(isset($value['preview']['text'])){
                    $g_text = $value['preview']['text'];
                } else {
                    $g_text = '0123456789 ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmnopqrstuvwxyz';
                }
                if(isset($value['preview']['font-size'])) {
                    $g_size = 'style="font-size: '. $value['preview']['font-size'] .';"';
                } else {
                    $g_size = '';
                }

                echo '<p class="clear '.$this->field['id'].'_previewer typography-preview" '. $g_size .'>'. $g_text .'</p>';
                echo "</div>";
            endif;

    }//function

    /**
     * Enqueue Function.
     *
     * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
     *
     * @since ReduxFramework 1.0.0
     */
    function enqueue(){

        wp_enqueue_script(
            'redux-field-color-js', 
            ReduxFramework::$_url . 'inc/fields/color/field_color.js', 
            array( 'jquery', 'wp-color-picker' ),
            time(),
            true
        );

        wp_enqueue_style(
            'redux-field-color-css', 
            ReduxFramework::$_url . 'inc/fields/color/field_color.css', 
            time(),
            true
        );

        wp_enqueue_script(
            'redux-field-typography-js',
            ReduxFramework::$_url.'inc/fields/typography/field_typography.js',
            array('jquery', 'wp-color-picker', 'redux-field-color-js', 'select2-js'),
            time(),
            true
        );

        wp_enqueue_style(
            'redux-field-typography-css',
            ReduxFramework::$_url.'inc/fields/typography/field_typography.css',
            time(),
            true
        );


    }//function

    /**
     * makeGoogleWebfontLink Function.
     *
     * Creates the google fonts link.
     *
     * @since ReduxFramework 3.0.0
     */
    function makeGoogleWebfontLink($fonts) {
      $link = "";
      $subsets = array();
      foreach($fonts as $family=>$font) {
        if (!empty($link)) {
          $link .= "|"; // Append a new font to the string
        }
        $link .= $family;

        if ( !empty( $font['font-style'] ) ) {
            $link .= ':';
            if ( !empty($font['all-styles']) ) {
                $link .= implode(',', $font['all-styles']);
            } else if ( !empty($font['font-style'] ) ) {
                $link .= implode(',', $font['font-style']);
            }
        }
        if ( !empty( $font['subset'] ) ) {
          foreach($font['subset'] as $subset) {
            if ( !in_array( $subset, $subsets) ) {
              array_push($subsets, $subset);
            }  
          }
          
        }
      }
      if (!empty($subsets)) {
        $link .= "&amp;subset=".implode(',', $subsets);
      }

      return '//fonts.googleapis.com/css?family='.$link;

    }

    function output() {

      global $wp_styles;

      $font = $this->value;

        // Check for font-backup.  If it's set, stick it on a variabhle for 
        // later use.
        if (!empty($font['font-family']) && !empty($font['font-backup'])) {
            $font['font-family'] = str_replace(', ' . $font['font-backup'], '', $font['font-family']);
            $fontBackup = ',' . $font['font-backup'];
        }

        $style = '';
        if (!empty($font)) {
            foreach( $font as $key=>$value) {
                if ($key == 'font-options') {
                    continue;
                }


                // Check for font-family key
                if ('font-family' == $key){
                        
                    // Ensure fontBackup isn't empty (we already option
                    // checked this earlier.  No need to do it again.
                    if ( !empty( $fontBackup ) ) {
                            
                        // Apply the backup font to the font-family element
                        // via the saved variable.  We do this here so it 
                        // doesn't get appended to the Google stuff below.
                        $value .= $fontBackup; 
                    }
                }
                
                if (empty($value) && in_array($key, array('font-weight', 'font-style'))) {
                    $value = "normal";
                }
                
                if ( $key == "google" || $key == "subsets" || $key == "font-backup" || empty( $value ) ) {
                    continue;
                }
                $style .= $key.':'.$value.';';
            }                    
        }
        
        if ( !empty( $style ) ) {
          if ( !empty( $this->field['output'] ) && is_array( $this->field['output'] ) ) {
              $keys = implode(",", $this->field['output']);
              $this->parent->outputCSS .= $keys . "{" . $style . '}';
          }

          if ( !empty( $this->field['compiler'] ) && is_array( $this->field['compiler'] ) ) {
              $keys = implode(",", $this->field['compiler']);
              $this->parent->compilerCSS .= $keys . "{" . $style . '}';  
          }
        }
      

      // Google only stuff!
      if ( !empty( $this->parent->args['google_api_key'] ) && !empty($font['font-family']) && !empty( $this->field['google'] ) && filter_var( $this->field['google'], FILTER_VALIDATE_BOOLEAN ) ) {
        
  // Added standard font matching check to avoid output to Google fonts call - kp

        // If no custom font array was supplied, the load it with default
        // standard fonts.
        if (empty($this->field['fonts'])) {
            $this->field['fonts'] = $this->std_fonts;
        }
  
        // Ensure the fonts array is NOT empty
        if (!empty($this->field['fonts'])){
            //Make the font keys in the array lowercase, for case-insensitive matching
            $lcFonts = array_change_key_case($this->field['fonts']);

            // Rebuild font array with all keys stripped of spaces
            $arr = array();
            foreach ($lcFonts as $key => $value){
                $key = str_replace(', ', ',', $key);
                $arr[$key] = $value;
            }
            $lcFonts = $arr;
            unset ($arr);

            // lowercase chosen font for matching purposes
            $lcFont = strtolower($font['font-family']);
                
            // Remove spaces after commas in chosen font for mathcing purposes.
            $lcFont = str_replace(', ', ',', $lcFont);
                
            // If the lower cased passed font-family is NOT found in the standard font array
            // Then it's a Google font, so process it for output.
            if ( !array_key_exists( $lcFont, $lcFonts ) ) {
          $family = $font['font-family'];
          
          // Strip out spaces in font names and replace with with plus signs
          // TODO?: This method doesn't respect spaces after commas, hence the reason
          // for the std_font array keys having no spaces after commas.  This could be
          // fixed with RegEx in the future.
          $font['font-family'] = str_replace( ' ', '+', $font['font-family'] );
          
          // Push data to parent typography variable.
          if ( empty( $this->parent->typography[$font['font-family']] ) ) {
            $this->parent->typography[$font['font-family']] = array();  
          }
          
          if (isset($this->field['all_styles'])) {
              if ( !isset( $font['font-options'] ) ) {
                  $this->getGoogleArray();
                  if ( isset( $this->parent->googleArray ) && !empty( $this->parent->googleArray ) && isset( $this->parent->googleArray[$family] ) ) {
                      $font['font-options'] = $this->parent->googleArray[$family];
                  }
              } else {
                  $font['font-options'] = json_decode($font['font-options'], true);
              }
          }
          
          if ( isset( $font['font-options'] ) && !empty( $font['font-options'] ) && isset( $this->field['all_styles'] ) && filter_var( $this->field['all_styles'], FILTER_VALIDATE_BOOLEAN ) ) {
              if ( isset( $font['font-options'] ) && !empty( $font['font-options']['variants'] ) ) {
                if ( !isset( $this->parent->typography[$font['font-family']]['all-styles'] ) || empty( $this->parent->typography[$font['font-family']]['all-styles'] ) ) {
                    $this->parent->typography[$font['font-family']]['all-styles'] = array();
                    foreach($font['font-options']['variants'] as $variant) {
                      $this->parent->typography[$font['font-family']]['all-styles'][] = $variant['id'];
                    }                        
                }
              }                    
          } 
          if ( !empty( $font['font-weight'] ) ) {
            if ( empty( $this->parent->typography[$font['font-family']]['font-weight'] ) || !in_array( $font['font-weight'], $this->parent->typography[$font['font-family']]['font-weight'] ) ) {
              $style = $font['font-weight'];
            }
            if ( !empty( $font['font-style'] ) ) {
                $style .= $font['font-style'];
            }           

            if ( empty( $this->parent->typography[$font['font-family']]['font-style'] ) || !in_array( $style, $this->parent->typography[$font['font-family']]['font-style'] ) ) {
              $this->parent->typography[$font['font-family']]['font-style'][] = $style;
            }                      
          }
      
          if ( !empty( $font['subsets'] ) ) {
            if ( empty( $this->parent->typography[$font['font-family']]['subset'] ) || !in_array( $font['subsets'], $this->parent->typography[$font['font-family']]['subset'] ) ) {
              $this->parent->typography[$font['font-family']]['subset'][] = $font['subsets'];
            }                      
          }   
            } // !array_key_exists    
        } //!empty fonts array
      } // Typography not set
      //print_r($this->parent->typography);
    }


    /**
    *
    *   Construct the google array from the stored JSON/HTML
    * 
    */
    function getGoogleArray() {

        global $wp_filesystem;

        // Initialize the Wordpress filesystem, no more using file_put_contents function
        if (empty($wp_filesystem)) {
            require_once(ABSPATH .'/wp-admin/includes/file.php');
            WP_Filesystem();
        }          


        if ( isset( $this->parent->googleArray ) && !empty( $this->parent->googleArray ) ) {
            return;
        }          

        if( !file_exists( ReduxFramework::$_dir.'inc/fields/typography/googlefonts.json' ) ) {
         
          $result = wp_remote_get( 'https://www.googleapis.com/webfonts/v1/webfonts?key='.$this->parent->args['google_api_key'] ); 

          if ($result['response']['code'] == 200) {
              $result = json_decode($result['body']);
              foreach ($result->items as $font) {
                  $this->parent->googleArray[$font->family] = array(
                      'variants' => $this->getVariants($font->variants),
                      'subsets' => $this->getSubsets($font->subsets)
                  );
              }

              if ( !empty( $this->parent->googleArray ) ) {
                  $wp_filesystem->put_contents(
                      ReduxFramework::$_dir.'inc/fields/typography/googlefonts.json',
                      json_encode($this->parent->googleArray),
                      FS_CHMOD_FILE // predefined mode settings for WP files
                  );
              }

          }//if
          
        }//if
        
      if ( !isset( $this->parent->googleArray ) || empty( $this->parent->googleArray ) ) {
          $this->parent->googleArray = json_decode($wp_filesystem->get_contents(ReduxFramework::$_dir.'inc/fields/typography/googlefonts.json' ), true );
      }

    }

    /**
     * getGoogleFonts Function.
     *
     * Used to retrieve Google Web Fonts from their API
     *
     * @since ReduxFramework 0.2.0
     */
    function getGoogleFonts() {
        
        global $wp_filesystem;

        $this->getGoogleArray();
        
        if ( !isset( $this->parent->googleArray ) || empty( $this->parent->googleArray ) ) {
            return;
        }

        $gfonts = '<optgroup label="'.__('Google Webfonts', 'redux-framework').'">';
        foreach ($this->parent->googleArray as $i => $face) {
            $gfonts .= '<option data-details="'.urlencode(json_encode($face)).'" data-google="true" value="'.$i.'">'. $i .'</option>';
        }
        $gfonts .= '</optgroup>';
        //endif;
        if (empty($this->parent->googleArray)) {
            $gfonts = "";
        }

        $wp_filesystem->put_contents(
            ReduxFramework::$_dir.'inc/fields/typography/googlefonts.html',
            $gfonts,
            FS_CHMOD_FILE // predefined mode settings for WP files
        );
    }//function

    /**
     * getGoogleFonts Function.
     *
     * Clean up the Google Webfonts subsets to be human readable
     *
     * @since ReduxFramework 0.2.0
     */
    function getSubsets($var) {
        $result = array();
        foreach ($var as $v) {
            if (strpos($v,"-ext")) {
                $name = ucfirst(str_replace("-ext"," Extended",$v));
            } else {
                $name = ucfirst($v);
            }
            array_push($result, array('id'=>$v, 'name'=>$name));
        }
        return array_filter($result);
    }//function

    /**
     * getGoogleFonts Function.
     *
     * Clean up the Google Webfonts variants to be human readable
     *
     * @since ReduxFramework 0.2.0
     */
    function getVariants($var) {
        $result = array();
        $italic = array();
        foreach ($var as $v) {
            $name = "";
            if ($v[0] == 1) {
                $name = 'Ultra-Light 100';
            } else if ($v[0] == 2) {
                $name = 'Light 200';
            } else if ($v[0] == 3) {
                $name = 'Book 300';
            } else if ($v[0] == 4 || $v[0] == "r" || $v[0] == "i") {
                $name = 'Normal 400';
            } else if ($v[0] == 5) {
                $name = 'Medium 500';
            } else if ($v[0] == 6) {
                $name = 'Semi-Bold 600';
            } else if ($v[0] == 7) {
                $name = 'Bold 700';
            } else if ($v[0] == 8) {
                $name = 'Extra-Bold 800';
            } else if ($v[0] == 9) {
                $name = 'Ultra-Bold 900';
            }
            if ($v == "regular") {
                $v = "400";
            }
            if (strpos($v,"italic") || $v == "italic") {
                $name .= " Italic";
                $name = trim($name);
                $italic[] = array('id'=>$v, 'name'=>$name);
            } else {
                $result[] = array('id'=>$v, 'name'=>$name);
            }
        }

        array_push($result, array_pop($italic));

        return array_filter($result);
    }//function


}//class
