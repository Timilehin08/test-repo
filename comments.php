<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bigwigs
 */


if ( post_password_required() ) {
	/*
	 * If the current post is protected by a password and
	 * the visitor has not yet entered the password we will
	 * return early without loading the comments.
	 */
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<h2 class="comments-title">
			<?php
			$bigwigs_comment_count = get_comments_number();
			if ( '1' === $bigwigs_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'bigwigs' ),
					'<span>' . get_the_title() . '</span>' // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				);
			} else {
				printf( 
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $bigwigs_comment_count, 'comments title', 'bigwigs' ) ),
					number_format_i18n( $bigwigs_comment_count ),
					'<span>' . get_the_title() . '</span>' // phpcs:ignore WordPress.Security.EscapeOutput.DeprecatedWhitelistCommentFound
				);
			}
			?>
		</h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ul class="comment-list">
			<?php
			wp_list_comments( 
				array( 
					'callback' => 'bigwigs_comment', 
					'avatar_size' => 55
				)
			);
			?>
		</ul>

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'bigwigs' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	comment_form(
		$args = array(
				'class_form'    => 'comment-form',
				'class_submit' => 'btn btn-dark',
				'comment_field' =>  '<div class="form-group"><textarea id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>',
				)
		);
	?>

</div><!-- #comments -->