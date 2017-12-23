<!-- navibar -->
<div class="navibar bar_style" <?php tfuse_navibar_color();?>>
	<div class="sortby">
            <?php tfuse_navibar();?>
        </div>
    
    <div class="postlist-view">
        <?php tfuse_postlist_view();?>
    </div>
	
    <div class="topsearch">
    	<form id="searchForm" action="<?php echo home_url( '/' ) ?>" method="get">			
            <input type="text" name="s" id="s" value="" class="stext">
            <input type="submit" id="searchSubmit" value="Search" class="btn-search">                    
        </form>
    </div>
	
    <div class="clear"></div>
</div>
<!--/ navibar -->