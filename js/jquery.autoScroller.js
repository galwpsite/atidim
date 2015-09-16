function autoScroller(contentDiv, speed)
{
    contentDiv = "#"+contentDiv;
    var scrollSpeed = (speed==null) ? 5 : parseInt(speed);
    
    // double make sure the autoScroller-container has the correct css position and overflow property
    jQuery(contentDiv).parent().css({position:'relative',overflow:'hidden'});
    
    // set contentDiv style
    jQuery(contentDiv).css({position:'absolute',top:0});
    // get contentDiv height
    contentDivHeight = jQuery(contentDiv).height();
    
   // call periodical
   jQuery(contentDiv).everyTime(100, function(i){
        if (parseInt(jQuery(this).css('top'))>(contentDivHeight*(-1)+8))
        {
            // move scroller upwards
            offset = parseInt(jQuery(this).css('top'))-scrollSpeed+"px";
            jQuery(this).css({'top':offset});
        }
        // reset to original position
        else
        {
            // reset to original position
            offset = parseInt(jQuery(this).parent().height())+8+"px";
            jQuery(this).css({'top':offset});
        }
    });
    
    // on mouse over event, pause the scroller
    jQuery(contentDiv).mouseover(function ()
    {
        speed = scrollSpeed;
        scrollSpeed = 0;       
    });
    
    // on mouse out event, start the scroller
    jQuery(contentDiv).mouseout(function ()
    {
        scrollSpeed = speed;
    });
}