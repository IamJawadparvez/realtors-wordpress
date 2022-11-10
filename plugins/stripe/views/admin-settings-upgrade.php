<?php
/**
 * Admin: Product education settings upgrade promo
 *
 * @package SimplePay
 * @subpackage Core
 * @copyright Copyright (c) 2022, Sandhills Development, LLC
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 4.4.0
 *
 * @var string $upgrade_url The upgrade URL.
 * @var string $upgrade_text The upgrade button text.
 * @var string $upgrade_subtext The upgrade subtext (used in the header in this view).
 * @var string $already_purchased_url Already purchased URL.
 */

?>

<div
	class="simpay-settings-upgrade simpay-card simpay-notice"
	data-nonce="<?php echo esc_attr( wp_create_nonce( 'simpay-dismiss-notice-simpay-settings-license-upgrade' ) ); ?>"
	data-id="simpay-settings-license-upgrade"
	data-lifespan="<?php echo esc_attr( DAY_IN_SECONDS * 30 ); // @phpstan-ignore-line ?>"
>
	<div class="simpay-settings-upgrade__inner">
		<h3>
			<?php
			esc_html_e(
				'Upgrade to WP Simple Pay Pro Today and Save',
				'stripe'
			);
			?>
		</h3>

		<ul>
			<li>
				<div class="dashicons dashicons-yes"></div>
				<?php esc_html_e( 'Custom Form Fields', 'stripe' ); ?>
			</li>
			<li>
				<div class="dashicons dashicons-yes"></div>
				<?php esc_html_e( 'Drag & Drop Payment Form Builder', 'stripe' ); ?>
			</li>
			<li>
				<div class="dashicons dashicons-yes"></div>
				<?php esc_html_e( 'Custom Payment Receipt Emails', 'stripe' ); ?>
			</li>
			<li>
				<div class="dashicons dashicons-yes"></div>
				<?php esc_html_e( 'User-Entered Amounts', 'stripe' ); ?>
			</li>
			<li>
				<div class="dashicons dashicons-yes"></div>
				<?php esc_html_e( 'Coupon Code Management', 'stripe' ); ?>
			</li>
			<li>
				<div class="dashicons dashicons-yes"></div>
				<?php esc_html_e( 'Tax Rate Management', 'stripe' ); ?>
			</li>
			<li>
				<div class="dashicons dashicons-yes"></div>
				<?php esc_html_e( 'Apple Pay & Google Pay', 'stripe' ); ?>
			</li>
			<li>
				<div class="dashicons dashicons-yes"></div>
				<?php esc_html_e( 'ACH Debit Payments', 'stripe' ); ?>
			</li>
			<li>
				<div class="dashicons dashicons-yes"></div>
				<?php esc_html_e( 'Accept Recurring Payments', 'stripe' ); ?>
			</li>
			<li>
				<div class="dashicons dashicons-yes"></div>
				<?php esc_html_e( 'Plus much more...', 'stripe' ); ?>
			</li>
		</ul>

		<a href="<?php echo esc_url( $upgrade_url ); ?>" class="button button-primary button-large simpay-upgrade-btn simpay-upgrade-btn-large" target="_blank" rel="noopener noreferrer">
			<?php echo esc_html( $upgrade_text ); ?>
		</a>

		<div style="margin-top: 15px;">
			<a href="<?php echo esc_url( $already_purchased_url ); ?>" target="_blank" rel="noopener noreferrer">
				<?php esc_html_e( 'Already purchased?', 'stripe' ); ?>
			</a>
		</div>

		<?php if ( ! empty( $upgrade_subtext ) ) : ?>
		<div class="simpay-upgrade-btn-subtext">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" role="img" aria-hidden="true" focusable="false">
				<path d="M16.7 7.1l-6.3 8.5-3.3-2.5-.9 1.2 4.5 3.4L17.9 8z"></path>
			</svg>

			<?php echo $upgrade_subtext; ?>
		</div>
		<?php endif; ?>
	</div>

	<button type="button" class="button-link simpay-notice-dismiss">
		&times;
	</button>
</div>
