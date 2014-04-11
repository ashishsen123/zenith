<?php

/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 * @author      Dovy Paukstys (dovy)
 * @version     3.0.0
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

// Don't duplicate me!
if( !class_exists( 'ReduxFramework_extension_edd' ) ) {


    /**
     * Main ReduxFramework customizer extension class
     *
     * @since       1.0.0
     */
    class ReduxFramework_extension_edd extends ReduxFramework {

      // Protected vars
      protected $parent;
      public $extension_url;
      public $extension_dir;
      public static $theInstance;

      /**
       * Class Constructor. Defines the args for the extions class
       *
       * @since       1.0.0
       * @access      public
       * @param       array $sections Panel sections.
       * @param       array $args Class constructor arguments.
       * @param       array $extra_tabs Extra panel tabs.
       * @return      void
       */
      public function __construct( $parent ) {
        $this->parent = $parent;
        if ( empty( $this->extension_dir ) ) {
          $this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
          $this->extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->extension_dir ) );
        }

        self::$theInstance = $this;

        //add_filter( 'redux/'.$this->parent->args['opt_name'].'/field/class/edd_license', array( &$this, 'overload_edd_license_field_path' ) ); // Adds the local field
        add_filter( 'redux/'.$this->parent->args['opt_name'].'/field/class/kad_slides', array( &$this, 'overload_kad_slides_field_path' ) ); // Adds the local field
        add_filter( 'redux/'.$this->parent->args['opt_name'].'/field/class/kad_icons', array( &$this, 'overload_kad_icons_field_path' ) ); // Adds the local field
        //add_action( 'redux/options/'.$this->parent->args['opt_name'].'/field/edd_license/register', array( &$this, 'register' ) );
        //add_action( 'wp_ajax_redux_edd_'.$parent->args['opt_name'].'_license', array( &$this, 'license_call' ) );

      }

      public function getInstance() {
        return self::$theInstance;
      }

      // Forces the use of the embeded field path vs what the core typically would use    
      public function overload_kad_slides_field_path($field) {
        return dirname(__FILE__).'/kad_slides/field_kad_slides.php';
      }
      public function overload_kad_icons_field_path($field) {
        return dirname(__FILE__).'/kad_icons/field_kad_icons.php';
      }


    } // class
} // if
