<div class="author-box single-box">
    <div class="author-box-avtar">
        <?php echo get_avatar( get_the_author_meta('email'), '100' ); ?>
    </div>
    <div class="author-info-container">
        <div class="author-info">
            <div class="author-head">
                <h5><?php esc_attr( the_author_meta('display_name') ); ?></h5>
            </div>
            <p>
                <?php esc_attr( the_author_meta('description') ); ?>
            </p>
        </div><!--.author-info-->
    </div>
</div><!--.author-box-->