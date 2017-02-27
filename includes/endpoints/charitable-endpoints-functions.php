<?php
/**
 * Charitable Endpoint Functions.
 *
 * @package     Charitable/Functions/Endpoints
 * @version     1.5.0
 * @author      Eric Daams
 * @copyright   Copyright (c) 2017, Studio 164a
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

/**
 * Get the endpoint API object.
 *
 * @return  Charitable_Endpoints
 * @since   1.5.0
 */
function charitable_get_endpoints_api() {
	return charitable()->get_endpoints();
}

/**
 * Register a new endpoint.
 *
 * @param   Charitable_Endpoint $endpoint
 * @return  void
 * @since   1.5.0
 */
function charitable_register_endpoint( Charitable_Endpoint $endpoint ) {
	return charitable()->get_endpoints()->register( $endpoint );
}

/**
 * Return the URL for a given page.
 *
 * Example usage:
 *
 * - charitable_get_permalink( 'campaign_donation_page' );
 * - charitable_get_permalink( 'login_page' );
 * - charitable_get_permalink( 'registration_page' );
 * - charitable_get_permalink( 'profile_page' );
 * - charitable_get_permalink( 'donation_receipt_page' );
 * - charitable_get_permalink( 'donation_cancel_page' );
 *
 * @param   string  $page
 * @param   array   $args       Optional array of arguments.
 * @return  string|false        String if page is found. False if none found.
 * @since   1.0.0
 */
function charitable_get_permalink( $page, $args = array() ) {
	return charitable()->get_endpoints()->get_page_url( $page, $args );
}

/**
 * Checks whether we are currently looking at the given page.
 *
 * Example usage:
 *
 * - charitable_is_page( 'campaign_donation_page' );
 * - charitable_is_page( 'login_page' );
 * - charitable_is_page( 'registration_page' );
 * - charitable_is_page( 'profile_page' );
 * - charitable_is_page( 'donation_receipt_page' );
 * - charitable_is_page( 'donation_cancel_page' );
 *
 * @param   string  $page
 * @param   array   $args       Optional array of arguments.
 * @return  boolean
 * @since   1.0.0
 */
function charitable_is_page( $page, $args = array() ) {
	return charitable()->get_endpoints()->is_page( $page, $args );
}

/**
 * Returns the URL for the campaign donation page.
 *
 * This is functionally equivalent to use charitable_get_permalink( 'campaign_donation' ).
 * It will produce the same results.
 *
 * We keep both for backwards compatibility (pre 1.5).
 *
 * @uses 	Charitable_Endpoints::get_page_url()
 * @param 	string $url Deprecated argument.
 * @param 	array  $args
 * @return 	string
 * @since 	1.0.0
 */
function charitable_get_campaign_donation_page_permalink( $url = null, $args = array() ) {
	return charitable()->get_endpoints()->get_page_url( 'campaign_donation', $args );
}

/**
 * Checks whether the current request is for a campaign donation page.
 *
 * This is functionally equivalent to use charitable_is_page( 'campaign_donation' ).
 * It will produce the same results. We keep both for backwards compatibility (pre 1.5).
 *
 * By default, this will return true when viewing a campaign with the `donate`
 * query var set, or when the donation form is shown on the campaign page or
 * in a modal.
 *
 * Pass `'strict' => true` in `$args` to only return true when the `donate`
 * query var is set.
 *
 * @uses 	Charitable_Endpoints::is_page()
 * @param 	boolean $ret Unused argument.
 * @param 	array   $args
 * @return 	boolean
 * @since 	1.0.0
 */
function charitable_is_campaign_donation_page( $ret = null, $args = array() ) {
	return charitable()->get_endpoints()->is_page( 'campaign_donation', $args );
}

/**
 * Returns the URL for the campaign donation page.
 *
 * This is functionally equivalent to use charitable_get_permalink( 'donation_receipt' ).
 * It will produce the same results. We keep both for backwards compatibility (pre 1.5).
 *
 * @global  WP_Rewrite $wp_rewrite
 * @param   string     $url
 * @param   array      $args
 * @return  string
 * @since   1.0.0
 */
function charitable_get_donation_receipt_page_permalink( $url, $args = array() ) {
	return charitable()->get_endpoints()->get_page_url( 'donation_receipt', $args );
}

/**
 * Checks whether the current request is for the donation receipt page.
 *
 * This is used when you call charitable_is_page( 'donation_receipt_page' ).
 * In general, you should use charitable_is_page() instead since it will
 * take into account any filtering by plugins/themes.
 *
 * @global 	WP_Query $wp_query
 * @return 	boolean
 * @since 	1.0.0
 */
function charitable_is_donation_receipt_page() {
	return charitable()->get_endpoints()->get_page_url( 'donation_receipt' );
}

/**
 * Returns the URL for the campaign donation page.
 *
 * This is functionally equivalent to use charitable_get_permalink( 'donation_processing' ).
 * It will produce the same results. We keep both for backwards compatibility (pre 1.5).
 *
 * @global  WP_Rewrite $wp_rewrite
 * @param   string $url
 * @param   array $args
 * @return  string
 * @since   1.2.0
 */
function charitable_get_donation_processing_page_permalink( $url, $args = array() ) {
	return charitable()->get_endpoints()->get_page_url( 'donation_processing', $args );
}

/**
 * Checks whether the current request is for the donation receipt page.
 *
 * This is functionally equivalent to use charitable_is_page( 'donation_processing' ).
 * It will produce the same results. We keep both for backwards compatibility (pre 1.5).
 *
 * @global 	WP_Query $wp_query
 * @return 	boolean
 * @since 	1.0.0
 */
function charitable_is_donation_processing_page() {
	return charitable()->get_endpoints()->get_page_url( 'donation_processing' );
}

/**
 * Returns the URL for the campaign donation page.
 *
 * This is functionally equivalent to use charitable_get_permalink( 'campaign_widget' ).
 * It will produce the same results. We keep both for backwards compatibility (pre 1.5).
 *
 * @global  WP_Rewrite $wp_rewrite
 * @param   string $url
 * @param   array $args
 * @return  string
 * @since   1.2.0
 */
function charitable_get_campaign_widget_page_permalink( $url, $args = array() ) {
	return charitable()->get_endpoints()->get_page_url( 'campaign_widget', $args );
}

/**
 * Checks whether the current request is for the donation receipt page.
 *
 * This is functionally equivalent to use charitable_is_page( 'campaign_widget' ).
 * It will produce the same results. We keep both for backwards compatibility (pre 1.5).
 *
 * @global 	WP_Query $wp_query
 * @return 	boolean
 * @since 	1.0.0
 */
function charitable_is_campaign_widget_page() {
	return charitable()->get_endpoints()->get_page_url( 'campaign_widget' );
}
