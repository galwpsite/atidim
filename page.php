<?php
/**
 * Created by PhpStorm.
 * User: galwp
 * Date: 16-Sep-15
 * Time: 11:18 AM
 */
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action('genesis_loop','do_content_page');
function do_content_page(){
    ?>
    <div class="row">
        <div class="columns twelve">
            <h2><?php echo get_the_title()?></h2>
            <?php echo the_content()?>
        </div>
    </div>

    <?php
}
genesis();
