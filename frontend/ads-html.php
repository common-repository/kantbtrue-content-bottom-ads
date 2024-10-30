<?php
/**
 * Frontend HTML code
 * 
 * @author Kantbtrue
 * @version 1.1
 * @since 1.0
 */

if ( !function_exists( 'kbtcba_ads_html' ) ) {
    function kbtcba_ads_html( $content ) {
        $opts = get_option( '_kbtcba_opts' );
        if ( isset( $opts ) ) {
            $link = $opts['link'];
            $img = wp_get_attachment_image_src( $opts['imgID'], 'full' );
            $img_src = $img[0];
            $img_alt = '';
            $title = $opts['title'];
            $description = $opts['description'];
            $sponsored = $opts['sponsored'];
            $en_dark_mode = $opts['darkMode'] ? ' kbtcba-footer-ad--dark' : '';
            $post_types = $opts['postType'];
            $size = $opts['size'] ? ' kbtcba-footer-ad--' . $opts['size'] : '';
            foreach ( $post_types as $post_type ) {
                if ( $post_type === get_post_type() ) {
                    $content .= '<div class="kbtcba-footer-ad' . $en_dark_mode . $size .  '">';
                    $content .= '<div class="kbtcba-header">
                            <a href="' . $link . '"><img src="' . $img_src . '" alt="' . $img_alt . '"></a>
                        </div>
                        <div class="kbtcba-message">
                            <h4><a href="' . $link . '">' . $title . '</a></h4><p>'
                            . $description .
                        '</p></div>';
                    $sponsored &&
                        $content .= '<div class="kbtcba-sponsored">Sponsored</div>';
                    $content .= '</div>';
                }
            }
        }
        return $content;
    }
}
