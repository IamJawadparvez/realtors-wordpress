<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post;
$rating = get_comment_meta( $comment->comment_ID, '_rating_avg', true );

?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

	<div id="comment-<?php comment_ID(); ?>" class="the-comment media">
		<div class="avatar">
			<?php echo homeo_get_avatar( $comment->user_id, '70', '' ); ?>
		</div>
		<div class="comment-box">
			
			<div class="clearfix comment-author">
				
				<div class="flex-middle">
					<div class="name-comment">
						<?php comment_author(); ?>
					</div>
					<div class="star-rating" title="<?php echo sprintf( esc_attr__( 'Rated %d out of 5', 'homeo' ), $rating ) ?>">
						<?php echo WP_RealEstate_Review::print_review($rating); ?>
					</div>
				</div>

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<span class="date"><em><?php esc_html_e( 'Your comment is awaiting approval', 'homeo' ); ?></em></span>
				<?php else : ?>
					<span class="date">
						<?php echo get_comment_date( get_option('date_format', 'd M, Y') ); ?>
					</span>
				<?php endif; ?>
			</div>
			<div class="comment-text">
				<?php comment_text(); ?>
			</div>

		</div>
	</div>
</li>