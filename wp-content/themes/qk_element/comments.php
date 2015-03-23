<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
    return;
?>
<div class="comment-section">
	<h2><?php _e('Comments','element'); ?></h2>
	<ul class="comment-tree">
		<?php wp_list_comments('callback=element_theme_comment'); ?>
	</ul>
	<?php
	// Are there comments to navigate through?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<footer class="navigation comment-navigation" role="navigation">
			<!--<h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'element' ); ?></h1>-->
			<div class="previous"><?php previous_comments_link( __( '&larr; Older Comments', 'element' ) ); ?></div>
			<div class="next right"><?php next_comments_link( __( 'Newer Comments &rarr;', 'element' ) ); ?></div>
		</footer><!-- .comment-navigation -->
	<?php endif; // Check for comment navigation ?>

	<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.' , 'element' ); ?></p>
	<?php endif; ?>
</div>
<?php
$aria_req = ( $req ? " aria-required='true'" : '' );
$comment_args = array(
	'title_reply'=> 'Post Comment',
	'fields' => apply_filters( 'comment_form_default_fields', array(
		'author' => '
			<div class="row">
			<div class="col-md-6">
				<input type="text" name="author"  class="form-control" placeholder="Name (required)" id="name" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' />
			</div>
		',
		'email' => '
			<div class="col-md-6">
				<input id="mail" name="email" class="form-control"  placeholder="Email (required)" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' />
			</div>
			</div>
		',
		'url' => '
			<input id="website" name="url" class="form-control" placeholder="Website" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '"  />
		
		'
	)),
	'comment_field' => '<textarea cols="45" class="form-control" rows="5" id="comment" placeholder="Your Message (required)"  name="comment"'.$aria_req.'></textarea>',
	'label_submit' => 'Send Message',
	'comment_notes_after' => '',
);
?>
<?php global $post; ?>
<?php if('open' == $post->comment_status){ ?>

	<?php comment_form($comment_args); ?>

<?php } ?>
