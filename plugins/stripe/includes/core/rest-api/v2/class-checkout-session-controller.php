<?php
/**
 * REST API: Checkout Session Controller
 *
 * @package SimplePay\Core\REST_API\v2
 * @copyright Copyright (c) 2022, Sandhills Development, LLC
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 3.6.0
 */

namespace SimplePay\Core\REST_API\v2;

use SimplePay\Core\Payments;
use SimplePay\Core\REST_API\Controller;
use SimplePay\Core\Legacy;
use SimplePay\Core\Utils;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Checkout_Session_Controller.
 */
class Checkout_Session_Controller extends Controller {

	/**
	 * Endpoint namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'wpsp/v2';

	/**
	 * Route base.
	 *
	 * @var string
	 */
	protected $rest_base = 'checkout-session';

	/**
	 * Registers the routes for Checkout Session.
	 *
	 * @since 3.6.0
	 */
	public function register_routes() {
		register_rest_route(
			$this->namespace,
			$this->rest_base,
			array(
				array(
					'methods'             => \WP_REST_Server::CREATABLE,
					'callback'            => array( $this, 'create_item' ),
					'permission_callback' => array( $this, 'create_item_permissions_check' ),
					'args'                => $this->get_endpoint_args_for_item_schema( \WP_REST_Server::CREATABLE ),
				),
				'schema' => array( $this, 'get_public_item_schema' ),
			)
		);
	}

	/**
	 * Allows POST requests to this endpoint with a valid nonce.
	 *
	 * @since 3.6.0
	 *
	 * @param \WP_REST_Request $request Incoming REST API request data.
	 * @return \WP_Error|true Error if a permission check fails.
	 */
	public function create_item_permissions_check( $request ) {
		$checks = array(
			'rate_limit',
			'form_nonce',
		);

		return $this->permission_checks( $checks, $request );
	}

	/**
	 * Handles an incoming request to create a Checkout\Session.
	 *
	 * @since 3.6.0
	 *
	 * @param \WP_REST_Request $request {
	 *   Incoming REST API request data.
	 *
	 *   @type int   $customer_id Customer ID previously generated with Payment Source.
	 *   @type int   $form_id Form ID used to generate PaymentIntent data.
	 *   @type array $form_data Client-generated formData information.
	 *   @type array $form_values Values of named fields in the payment form.
	 * }
	 * @throws \Exception When required data is missing or cannot be verified.
	 * @return \WP_REST_Response
	 */
	public function create_item( $request ) {
		try {
			// Gather customer information.
			$customer_id = isset( $request['customer_id'] ) ? $request['customer_id'] : '';

			// Locate form.
			if ( ! isset( $request['form_id'] ) ) {
				throw new \Exception( __( 'Unable to locate payment form.', 'stripe' ) );
			}

			// Gather <form> information.
			$form_id     = $request['form_id'];
			$form_data   = json_decode( $request['form_data'], true );
			$form_values = $request['form_values'];

			$form = simpay_get_form( $form_id );

			if ( false === $form ) {
				throw new \Exception(
					esc_html__( 'Unable to locate payment form.', 'stripe' )
				);
			}

			// Handle legacy form processing.
			Legacy\Hooks\simpay_process_form( $form, $form_data, $form_values, $customer_id );

			$session_args = $this->get_args_from_payment_form_request( $form, $form_data, $form_values, $customer_id );

			/**
			 * Allows processing before a Checkout\Session is created from a payment form request.
			 *
			 * @since 3.6.0
			 *
			 * @param array                         $session_args Arguments used to create a PaymentIntent.
			 * @param SimplePay\Core\Abstracts\Form $form Form instance.
			 * @param array                         $form_data Form data generated by the client.
			 * @param array                         $form_values Values of named fields in the payment form.
			 * @param int|string                    $customer_id Stripe Customer ID, or a blank string if none is needed.
			 */
			do_action(
				'simpay_before_checkout_session_from_payment_form_request',
				$session_args,
				$form,
				$form_data,
				$form_values,
				$customer_id
			);

			$session = Payments\Stripe_Checkout\Session\create(
				$session_args,
				$form->get_api_request_args()
			);

			/**
			 * Allows further processing after a Checkout\Session is created from a payment form request.
			 *
			 * @since 3.6.0
			 *
			 * @param \SimplePay\Vendor\Stripe\Checkout\Sesssion     $session Stripe Checkout Session.
			 * @param SimplePay\Core\Abstracts\Form $form Form instance.
			 * @param array                         $form_data Form data generated by the client.
			 * @param array                         $form_values Values of named fields in the payment form.
			 * @param int                           $customer_id Stripe Customer ID.
			 */
			do_action(
				'simpay_after_checkout_session_from_payment_form_request',
				$session,
				$form,
				$form_data,
				$form_values,
				$customer_id
			);

			return new \WP_REST_Response(
				array(
					'sessionId' => $session->id,
					'session'   => $session,
				)
			);
		} catch ( \Exception $e ) {
			return new \WP_REST_Response(
				array(
					'message' => Utils\handle_exception_message( $e ),
				),
				400
			);
		}
	}

	/**
	 * Uses the current payment form request to generate arguments for a Checkout Session.
	 *
	 * @param SimplePay\Core\Abstracts\Form $form Form instance.
	 * @param array                         $form_data Form data generated by the client.
	 * @param array                         $form_values Values of named fields in the payment form.
	 * @param int                           $customer_id Stripe Customer ID.
	 * @return array
	 */
	function get_args_from_payment_form_request(
		$form,
		$form_data,
		$form_values,
		$customer_id
	) {
		// Retrieve price option.
		$price = simpay_payment_form_prices_get_price_by_id(
			$form,
			$form_data['price']['id']
		);

		if ( false === $price ) {
			throw new \Exception(
				__( 'Unable to locate payment form price.', 'stripe' )
			);
		}

		$session_args = array(
			'locale'               => $form->locale,
			'metadata'             => array(
				'simpay_form_id' => $form->id,
			),
			'payment_method_types' => array(
				'card',
			),
			'mode'                 => 'payment',
		);

		// Collect Billing Address.
		if ( true === $form->enable_billing_address ) {
			$session_args['billing_address_collection'] = 'required';
		} else {
			$session_args['billing_address_collection'] = 'auto';
		}

		// Collect Shipping Address.
		if ( true === $form->enable_shipping_address ) {
			$session_args['shipping_address_collection'] = array(
				'allowed_countries' => Payments\Stripe_Checkout\get_available_shipping_address_countries(),
			);
		}

		// Attach a Customer.
		if ( ! empty( $customer_id ) ) {
			$session_args['customer'] = $customer_id;
		}

		// Success URL.

		// Escape base URL.
		$session_args['success_url'] = esc_url_raw( $form->payment_success_page );

		// Ensure a valid base URL exists.
		if ( empty( $session_args['success_url'] ) ) {
			$session_args['success_url'] = esc_url_raw( home_url() );
		}

		// Avoid escaping the {CHECKOUT_SESSION_ID} tag.
		$session_args['success_url'] = add_query_arg( 'session_id', '{CHECKOUT_SESSION_ID}', $session_args['success_url'] );

		// Cancel URL.

		// Escape base URL.
		$session_args['cancel_url'] = esc_url_raw( $form->payment_cancelled_page );

		// Ensure a valid base URL exists.
		if ( empty( $session_args['cancel_url'] ) || false === $session_args['cancel_url'] ) {
			$session_args['cancel_url'] = esc_url_raw( home_url() );
		}

		// Submit type.
		if ( isset( $form->checkout_submit_type ) ) {
			$session_args['submit_type'] = $form->checkout_submit_type;
		}

		// Discounts.
		if ( isset( $form_data['coupon'] ) && false !== $form_data['coupon'] ) {
			$session_args['discounts'] = array(
				array(
					'coupon' => sanitize_text_field( $form_data['coupon'] ),
				),
			);
		}

		// Add a line item.
		$items = array();

		// Custom amount. Generate a new Price object inline.
		if ( false === simpay_payment_form_prices_is_defined_price( $price->id ) ) {
			// Ensure custom amount meets minimum requirement.
			$unit_amount = $form_data['customAmount'];

			if ( $unit_amount < $price->unit_amount_min ) {
				$unit_amount = $price->unit_amount_min;
			}

			// Backwards compatibility amount filter.
			if ( has_filter( 'simpay_form_' . $form->id . '_amount' ) ) {
				$unit_amount = simpay_get_filtered(
					'amount',
					simpay_convert_amount_to_dollars( $unit_amount ),
					$form->id
				);

				$unit_amount = simpay_convert_amount_to_cents( $unit_amount );
			}

			$currency = $price->currency;

			// Backwards compatibility currency filter.
			if ( has_filter( 'simpay_form_' . $form->id . '_currency' ) ) {
				$currency = simpay_get_filtered(
					'currency',
					strtolower( $currency ),
					$form->id
				);
			}

			$price_data = array(
				'currency'    => $currency,
				'unit_amount' => $unit_amount,
				'product'     => $price->product_id,
			);

			$item['price_data'] = $price_data;

			// Defined Price.
		} else {
			$item['price'] = $price->id;
		}

		$item['quantity'] = isset( $form_values['simpay_quantity'] )
			? intval( $form_values['simpay_quantity'] )
			: 1;

		// Use price option label if one is set.
		if ( null !== $price->label ) {
			$item['description'] = $price->get_display_label();

			// Fall back to Payment Form title if set.
			// This is a change in behavior in 4.1, but matches the Stripe Checkout
			// usage that falls back to the Product title (Payment Form title).
		} else {
			if ( ! empty( $form->company_name ) ) {
				$item['description'] = $form->company_name;
			}
		}

		$session_args['line_items'] = array( $item );

		// Phone number.
		$enable_phone = 'yes' === simpay_get_saved_meta(
			$form->id,
			'_enable_phone',
			'no'
		);

		if ( true === $enable_phone ) {
			$session_args['phone_number_collection'] = array(
				'enabled' => true,
			);
		}

		// Add PaymentIntent data.
		$payment_intent_data = Payments\PaymentIntent\get_args_from_payment_form_request(
			$form,
			$form_data,
			$form_values,
			$customer_id
		);

		// Remove unsupported parameters for Checkout.
		unset( $payment_intent_data['currency'] );
		unset( $payment_intent_data['amount'] );

		$session_args['payment_intent_data'] = $payment_intent_data;

		/**
		 * Filters arguments used to create a Checkout Session from a payment form request.
		 *
		 * @since 3.6.0
		 *
		 * @param array                         $session_args Checkout Session args.
		 * @param SimplePay\Core\Abstracts\Form $form Form instance.
		 * @param array                         $form_data Form data generated by the client.
		 * @param array                         $form_values Values of named fields in the payment form.
		 * @param int                           $customer_id Stripe Customer ID.
		 */
		return apply_filters(
			'simpay_get_session_args_from_payment_form_request',
			$session_args,
			$form,
			$form_data,
			$form_values,
			$customer_id
		);
	}
}
