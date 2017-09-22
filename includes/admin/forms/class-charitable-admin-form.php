<?php
/**
 * Admin form model class.
 *
 * @version   1.5.0
 * @package   Charitable/Classes/Charitable_Admin_Form
 * @author    Eric Daams
 * @copyright Copyright (c) 2017, Studio 164a
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Charitable_Admin_Form' ) ) :

    /**
     * Charitable_Admin_Form
     *
     * @since  1.5.0
     */
    class Charitable_Admin_Form extends Charitable_Form {

        /**
         * Fields in the form.
         *
         * @since 1.5.0
         *
         * @var   array
         */
        protected $fields = array();

        /**
         * Return the Form_View object for this form.
         *
         * @since  1.5.0
         *
         * @return Charitable_Form_View_Interface
         */
        public function view() {
            if ( ! isset( $this->view ) ) {
                $this->view = new Charitable_Admin_Form_View( $this );
            }

            return $this->view;
        }

        /**
         * Set the form fields.
         *
         * @since  1.5.0
         *
         * @param  array $fields An array of fields to be displayed.
         * @return void
         */
        public function set_fields( array $fields ) {
            usort( $fields, 'charitable_priority_sort' );
            $this->fields = $fields;
        }

        /**
         * Return the fields.
         *
         * @since  1.5.0
         *
         * @return array
         */
        public function get_fields() {
            return $this->fields;
        }
    }

endif;