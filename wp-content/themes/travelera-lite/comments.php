<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage travelera
 * @since travelera 1.0
 */
 
// Do not delete these lines
if ( post_password_required() ) {
    return;
}

if ( have_comments() ) : ?>
    <div id="comments" class="comments-area single-box shadow-box clearfix">
        <h3 class="comments-count section-heading uppercase"><span>
            <?php
                $comments_number = get_comments_number();
                if ( '1' === $comments_number ) {
                  /* translators: %s: post title */
                  printf( _x( '1 Comment', 'comments title', 'travelera-lite' ) );
                } else {
                  printf(
                    /* translators: 1: number of comments, 2: post title */
                    _nx(
                      '%1$s Comment',
                      '%1$s Comments',
                      $comments_number,
                      'comments title',
                      'travelera-lite'
                    ),
                    number_format_i18n( $comments_number )
                  );
                }
            ?>
        </span></h3>
        <?php	
            if (get_option('page_comments')) {
                $comment_pages = paginate_comments_links('echo=0');
                if($comment_pages){
                 echo '<div class="commentnavi commentnavi-1 pagination">'.$comment_pages.'</div>';
                }
            }
        ?>
        <ol class="commentlist clearfix">
            <?php
                wp_list_comments( array(
                    'callback'    => 'travelera_comment',
                    'type'        => 'comment',
                    'short_ping'  => true,
                    'avatar_size' => 60,
                ) );
            ?>
            <?php
                wp_list_comments( array(
                    'type'        => 'pingback',
                    'short_ping'  => true,
                    'avatar_size' => 60,
                ) );
            ?>
        </ol>
        <?php	
            if (get_option('page_comments')) {
                $comment_pages = paginate_comments_links('echo=0');
                if($comment_pages){
                 echo '<div class="commentnavi pagination">'.$comment_pages.'</div>';
                }
            }
        ?>
    </div><!-- #comments -->

<?php else : // this is displayed if there are no comments so far

if ('open' == $post->comment_status) :
    // If comments are open, but there are no comments.

else : // comments are closed
    // If comments are closed.

endif;
endif;
global $aria_req; $comments_args = array(
    // remove "Text or HTML to be displayed after the set of comment fields"
    'title_reply'=>'<h4 class="section-heading uppercase"><span>' . esc_html__('Leave a Reply','travelera-lite').'</span></h4>',
    'comment_notes_before' => '',
    'comment_notes_after' => '',
    'fields' => $fields =  array(
          'author' =>
            '<p class="comment-form-author"><label for="author">' . esc_html__( 'Name ', 'travelera-lite' ) .
            ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
            '<input id="author" name="author" type="text" placeholder="' . esc_html__( 'Name ', 'travelera-lite' ) .
            ( $req ? '('. esc_html__( 'Required', 'travelera-lite' ) .')' : '' ) . '" value="' . esc_attr( $commenter['comment_author'] ) .
            '" size="19"' . $aria_req . ' /></p>',

          'email' =>
            '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email ', 'travelera-lite' ) . 
            ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
            '<input id="email" name="email" type="text" placeholder="' . esc_html__( 'Email ', 'travelera-lite' ) .
            ( $req ? '('. esc_html__( 'Required', 'travelera-lite' ) .')' : '' ) . '" value="' . esc_attr(  $commenter['comment_author_email'] ) .
            '" size="19"' . $aria_req . ' /></p>',

          'url' =>
            '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'travelera-lite' ) . '</label>' .
            '<input id="url" name="url" type="text" placeholder="' . esc_html__( 'Website ', 'travelera-lite' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) .
            '" size="19" /></p>',
        ),
    'comment_field' => '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Comments ', 'travelera-lite' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_html__( 'Comment ', 'travelera-lite' ) .
            ( $req ? '('. esc_html__( 'Required', 'travelera-lite' ) .')' : '' ) . '" cols="45" rows="8" aria-required="true"></textarea></p>',
    'label_submit' => esc_html__( 'Submit ', 'travelera-lite' ),
);

comment_form($comments_args);
?>