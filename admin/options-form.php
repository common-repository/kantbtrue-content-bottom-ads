<?php
/**
 * Admin options page form part
 * 
 * @author Kantbtrue
 * @version 1.1
 * @since 1.0
 */

if ( !function_exists( 'kbtcba_save_opts' ) ) {
    /**
     * Save options in database
     */
    function kbtcba_save_opts () {
        if ( !current_user_can( 'edit_theme_options' ) ) {
            wp_redirect( $_POST['_wp_http_referer'] . '&status=0' );
        }
        check_admin_referer( 'kbtcba_opts_verify' );
        $opts = [
            'title' => sanitize_text_field($_POST['title']),
            'description' => wp_kses_post($_POST['description']),
            'imgID' => absint($_POST['imgID']),
            'link' => sanitize_url($_POST['link']),
            'postType' => [],
            'size' => sanitize_text_field($_POST['size']),
            'sponsored' => rest_sanitize_boolean($_POST['sponsored']),
            'darkMode' => rest_sanitize_boolean($_POST['darkMode'])
        ];
        if ( isset( $_POST['postType'] ) ) {
            foreach ( $_POST['postType'] as $key => $value ) {
                $opts['postType'][$key] = sanitize_text_field( $value );
            }
        }
        update_option( '_kbtcba_opts', $opts );
        wp_redirect( $_POST['_wp_http_referer'] . '&status=1' );
    }
}
if ( !function_exists( 'kbtcba_opts_form' ) ) {
    /**
     * Options form
     */
    function kbtcba_opts_form () {
        $opts = get_option( '_kbtcba_opts' );
        $img_src = wp_get_attachment_image_src( $opts['imgID'], 'full' );
        $have_img = is_array( $img_src );
        $sizes = [ 'sm', 'lg' ];
        ?>
        <div class="wrap kbtcba-opts">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h1 class="display-6">
                            <?php _e( 'Kantbtrue Content Bottom Ads', 'kantbtrue-cba'); ?>
                        </h1>
                    </div>
                    <div class="col-xs-10">
                        <form method="POST" action="admin-post.php" class="mt-3 pt-4 card bg-white rounded rounded-lg border-0 w-100 shadow">
                            <input type="hidden" name="action" value="kbtcba_save_opts">
                            <?php wp_nonce_field( 'kbtcba_opts_verify' ); ?>
                            <input type="hidden" name="imgID" id="media-id" value="<?php echo esc_attr( $opts['imgID'] ); ?>" />
                            <div class="col-auto">
                                <div id="status" class="alert alert-success <?php echo  ( $_GET['status'] === '1' ) ? '' : esc_attr( 'd-none' ); ?>">
                                    <?php _e( 'Successfully added', 'kantbtrue-cba' ); ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <label for="title">
                                    <?php _e( 'Title', 'kantbtrue-cba' ); ?>
                                </label>
                                <input type="text" class="form-control py-1 px-2" id="title" placeholder="" name="title" value="<?php _e( $opts['title'] ); ?>" required>
                            </div>
                            <div class="col-auto mt-3">
                                <label for="description">
                                    <?php _e('Description', 'kantbtrue-cba' ); ?>
                                </label>
                                <textarea class="form-control py-1 px-2" id="description" placeholder="" name="description" rows="5" required><?php _e( $opts['description'] ); ?></textarea>
                                <small class="text-muted">
                                    <?php _e( 'You can use html tags', 'kantbtrue-cba' ); ?>
                                </small>
                            </div>
                            <div class="col-auto mt-3">
                                <label for="link">
                                    <?php _e('Link', 'kantbtrue-cba' ); ?>
                                </label>
                                <input type="url" class="form-control py-1 px-2" id="link" placeholder="" name="link" value="<?php _e( $opts['link'] ); ?>">
                            </div>
                            <div class="col-auto mt-3">
                                <label>
                                    <?php _e('Post Type', 'kantbtrue-cba' ); ?>
                                </label>
                                <div class="w-100 mt-1">
                                <?php
                                $post_types = get_post_types(['public'   => true, '_builtin' => true], 'names', 'and');
                                unset($post_types['attachment']);
                                    foreach ( $post_types  as $post_type ) :
                                    ?>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input mt-2" type="checkbox" id="post-type-<?php echo esc_attr( $post_type ); ?>" name="postType[]" value="<?php echo esc_attr( $post_type ); ?>" <?php echo (in_array( $post_type, $opts['postType'] ) ? 'checked="checked"' : ''); ?>>
                                        <label class="form-check-label" for="post-type-<?php echo esc_attr( $post_type ); ?>"><?php echo esc_attr( $post_type ); ?></label>
                                    </div>
                                    <?php
                                    endforeach;
                                ?>
                                </div>
                            </div>
                            <div class="col-auto mt-3">
                                <label>
                                    <?php _e('Size', 'kantbtrue-cba' ); ?>
                                </label>
                                <div class="w-100 mt-1">
                                <?php
                                foreach ( $sizes  as $size ) :
                                    ?>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input mt-2" type="radio" id="size-<?php echo esc_attr( $size ); ?>" name="size" value="<?php echo esc_attr( $size ); ?>" <?php echo (( $size === $opts['size'] ) ? 'checked="checked"' : ''); ?>>
                                        <label class="form-check-label" for="size-<?php echo esc_attr( $size ); ?>"><?php echo esc_attr( $size ); ?></label>
                                    </div>
                                    <?php
                                endforeach;
                                ?>
                                </div>
                            </div>
                            <div class="col-auto mt-3">                                
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input mt-2" type="checkbox" id="dark-mode" name="darkMode" value="true" <?php echo ($opts['darkMode'] ? 'checked="checked"' : ''); ?>>
                                    <label for="dark-mode">
                                        <?php _e('Enable dark mode', 'kantbtrue-cba' ); ?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-auto mt-3">                                
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input mt-2" type="checkbox" id="sponser-text" name="sponsored" value="true" <?php echo ($opts['sponsored'] ? 'checked="checked"' : ''); ?>>
                                    <label for="sponser-text">
                                        <?php _e('Enable "Sponsored" label', 'kantbtrue-cba' ); ?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-auto mt-3">
								<label class="w-100">
                                    <?php _e( 'Image', 'kantbtrue-cba' ); ?>
                                </label>
                                <button type="button" id="media-add" class="btn w-100 btn-primary <?php if ( $have_img ) { echo esc_attr( 'd-none' ); } ?>">
                                    <?php _e('Upload', 'kantbtrue-cba' ); ?>
                                </button>
                                <img id="media-preview" src="<?php echo esc_url( $img_src[0] ); ?>" alt="preview" class="img-fluid <?php if ( !$have_img ) { echo esc_attr( 'd-none' ); } ?>">
                                <button id="media-del" type="button" class="btn w-100 btn-danger mt-3 <?php if ( !$have_img ) { echo esc_attr( 'd-none' ); } ?>">
                                    <?php _e('Delete', 'kantbtrue-cba' ); ?>
                                </button>
                            </div>
                            <div class="col-auto mt-3">
                                <button id="submit" type="submit" class="btn btn-lg btn-primary" data-loading="false"><?php ( $_GET['status'] === '1' ) ? _e( 'Saved', 'kantbtrue-cba' ) : _e( 'Save', 'kantbtrue-cba' ); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
