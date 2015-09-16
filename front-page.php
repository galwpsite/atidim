<?php
/**
 * Created by PhpStorm.
 * User: galwp
 * Date: 12-Sep-15
 * Time: 07:35 PM
 */
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action('genesis_loop','do_content_home');
function do_content_home(){
/*Stop Using PHP */
?>
    <div class="first row">
        <div class="columns five">
            <div class="box gd-green park-atidim">
                <h2> <?php echo get_the_title( 6 ); ?> </h2>
                <?php $field = get_field('page_excerpt', 6);
                        echo $field;
                        $permalink = get_permalink(6)
                ?>
                <a href="<?php echo $permalink?>" class="readmore">קרא עוד</a>
            </div>
        </div>
        <div class ="columns four">
            <div class="box yarok">
                <a class="bg-gray" href="#">עותפים אתכם בירוק</a>
            </div>
        </div>
        <div class="columns three custom-sidebar">
            <div clas="custom-sidebar-inner">
                <div class="land-rental box">
                    <h3>שטחים להשכרה</h3>
                </div>
            </div>
        </div>
    </div>
<!--    End of first row -->
    <div class="second row">
            <div class="columns three">
                <div class="box news gd-green" >
                  <img class="news-logo" src="<?php echo get_stylesheet_directory_uri()?>/images/news-logo.png"/>  <h3>חדשות הקהילה</h3>
                    <img src="<?php echo get_stylesheet_directory_uri()?>/images/arrow-up.png" class="arrow"/>
                    <div id="scrollbox" class="scroll-text autoScroller-container">
                        <div id="vmarquee">
                            <?php
                            // WP_Query arguments
                            $args = array (
                                'post_type'              => array( 'news_item' ),
                                'post_status'            => array( 'publish' ),
                            );

                            // The Query
                            global $wp_query;
                            $old_query = $wp_query;
                            $new_query = new WP_Query( $args );
                            ?>
                            <?php while ( $new_query->have_posts() ) : $new_query->the_post(); ?>
                                <p><?php the_content() ?></p>
                            <?php endwhile; ?>
                        </div>
                    </div>
                    <img class="arrow" src="<?php echo get_stylesheet_directory_uri()?>/images/arrow-down.png" />
                </div>
            </div>
        <div class="columns six">
            <div class="box gd-green images">
               <img src="<?php echo get_stylesheet_directory_uri()?>/images/fronpage-images.png" />
            </div>
        </div>
        <div class="columns three">
            <div class="box">
                <img src="<?php echo get_stylesheet_directory_uri()?>/images/forum.png" />
            </div>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(window).load(function(){autoScroller('vmarquee', 2)});
    </script>

<!--Start using php again -->
<?php

}

genesis();
