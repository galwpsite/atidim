<?php
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action('genesis_loop','do_letters_link');
add_action('genesis_loop','do_client_loop');
add_action("genesis_after_loop",'do_clients_script');
function do_letters_link(){
    if (ICL_LANGUAGE_CODE=='he') {
?>
        <!--HTML START HERE-->
            <ul class="heb letters">
                <li><a onclick="doClient('aleph')" class="active">א</a></li>
                <li><a onclick="doClient('bet')">ב</a></li>
                <li><a onclick="doClient('gimel')">ג</a></li>
                <li><a onclick="doClient('dalet')">ד</a></li>
                <li><a onclick="doClient('hey')">ה</a></li>
                <li><a onclick="doClient('vav')">ה</a></li>
                <li><a onclick="doClient('zain')">ז</a></li>
                <li><a onclick="doClient('het')">ח</a></li>
                <li><a onclick="doClient('tet')">ט</a></li>
                <li><a onclick="doClient('yud')">י</a></li>
                <li><a onclick="doClient('kaf')">כ</a></li>
                <li><a onclick="doClient('lamed')">ל</a></li>
                <li><a onclick="doClient('mem')">מ</a></li>
                <li><a onclick="doClient('nun')">נ</a></li>
                <li><a onclick="doClient('samekh')">ס</a></li>
                <li><a onclick="doClient('ayin')">ע</a></li>
                <li><a onclick="doClient('pei')">פ</a></li>
                <li><a onclick="doClient('zadik')">צ</a></li>
                <li><a onclick="doClient('kuf')">ק</a></li>
                <li><a onclick="doClient('reish')">ר</a></li>
                <li><a onclick="doClient('shein')">ש</a></li>
                <li><a onclick="doClient('tav')">ת</a></li>
            </ul>
        <div class="letter aleph"></div>
        <div class="letter bet hide"></div>
        <div class="letter gimel hide"></div>
        <div class="letter hey hide"></div>
        <div class="letter vav hide"></div>
        <div class="letter zain hide"></div>
        <div class="letter het hide"></div>
        <div class="letter dalet hide"></div>
        <div class="letter tet hide"></div>
        <div class="letter yud hide"></div>
        <div class="letter kaf hide"></div>
        <div class="letter lamed hide"></div>
        <div class="letter mem hide"></div>
        <div class="letter nun hide"></div>
        <div class="letter samekh hide"></div>
        <div class="letter ayin hide"></div>
        <div class="letter pei hide"></div>
        <div class="letter zadik hide"></div>
        <div class="letter kuf hide"></div>
        <div class="letter reish hide"></div>
        <div class="letter shien hide"></div>
        <div class="letter tav hide"></div>
        <!--HTML ENDS HERE -->
<?php
    }
}

function do_client_loop(){
    if(have_posts()) : while(have_posts()) : the_post();
        $image = get_field('client_logo');
        $size = 'client-thumb'; // (thumbnail, medium, large, full or custom size)
        echo '<div class="client row">';
        echo  '<div class="client_logo columns two">' .wp_get_attachment_image( $image, $size ). '</div>';
        if (get_field('website_url')!="")
            echo "<div class='columns ten'><a href='http://".get_field('website_url')."' target='_blank'>".get_the_title()." </a> , ".get_field('description')."</div>";
        else
            echo "<div class='columns ten'><span class='title'>".get_the_title()."</span>  , ".get_field('description')."</div>";
        echo '</div>';
    endwhile; endif;
}

function do_clients_script() {
?>
<!--HTML START HERE-->
<script>
    jQuery(document).on('click', 'ul.letters a', function(e) {
        jQuery("ul.letters a").removeClass("active");
        jQuery(this).addClass("active");
    });
    function doClient(arg) {
        jQuery("div.letter").hide('slow','swing');
        jQuery("div.letter."+arg).show('slow','swing');
    }
    jQuery( "div.client.row" ).each(function( index ) {
        if (jQuery(this).text().charAt(0)=='א')
        {
            jQuery("div.letter.aleph").append(jQuery(this))
        }
        else
            if (jQuery(this).text().charAt(0)=='ב'){
                jQuery("div.letter.bet").append(jQuery(this))
            }
        else
            if (jQuery(this).text().charAt(0)=='ג'){
            jQuery("div.letter.gimel").append(jQuery(this))
        }
        else
            if (jQuery(this).text().charAt(0)=='ד'){
            jQuery("div.letter.dalet").append(jQuery(this))
        }
        else
            if (jQuery(this).text().charAt(0)=='ה'){
            jQuery("div.letter.hey").append(jQuery(this))
        }
            else
            if (jQuery(this).text().charAt(0)=='ו'){
                jQuery("div.letter.vav").append(jQuery(this))
            }
            else
            if (jQuery(this).text().charAt(0)=='ז'){
                jQuery("div.letter.zain").append(jQuery(this))
            }
            else
            if (jQuery(this).text().charAt(0)=='ח'){
                jQuery("div.letter.het").append(jQuery(this))
            }
            else
            if (jQuery(this).text().charAt(0)=='ט'){
                jQuery("div.letter.tet").append(jQuery(this))
            }
            else
            if (jQuery(this).text().charAt(0)=='י'){
                jQuery("div.letter.yud").append(jQuery(this))
            }
            else
            if (jQuery(this).text().charAt(0)=='כ'){
                jQuery("div.letter.kaf").append(jQuery(this))
            }
            else
            if (jQuery(this).text().charAt(0)=='ל'){
                jQuery("div.letter.lamed").append(jQuery(this))
            }
            else
            if (jQuery(this).text().charAt(0)=='מ'){
                jQuery("div.letter.mem").append(jQuery(this))
            }
        if (jQuery(this).text().charAt(0)=='נ'){
            jQuery("div.letter.nun").append(jQuery(this))
        }
        else
        if (jQuery(this).text().charAt(0)=='ס'){
            jQuery("div.letter.samekh").append(jQuery(this))
        }
        else
        if (jQuery(this).text().charAt(0)=='ע'){
            jQuery("div.letter.ayin").append(jQuery(this))
        }
        else
        if (jQuery(this).text().charAt(0)=='פ'){
            jQuery("div.letter.pei").append(jQuery(this))
        }
        else
        if (jQuery(this).text().charAt(0)=='צ'){
            jQuery("div.letter.zadik").append(jQuery(this))
        }
        else
        if (jQuery(this).text().charAt(0)=='ק'){
            jQuery("div.letter.kuf").append(jQuery(this))
        }
        else
        if (jQuery(this).text().charAt(0)=='ר'){
            jQuery("div.letter.reish").append(jQuery(this))
        }
        else
        if (jQuery(this).text().charAt(0)=='ש'){
            jQuery("div.letter.shien").append(jQuery(this))
        }
        else
        if (jQuery(this).text().charAt(0)=='ת'){
            jQuery("div.letter.tav").append(jQuery(this))
        }
    });
</script>
<!--HTML ENDS HERE-->
<?php
}
genesis();