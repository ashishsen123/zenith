<div class="side-search">
    <form role="search" method="get" class="searchform" action="<?php echo esc_url(home_url('/')); ?>">
        <div>
            <input onfocus="if (this.value == 'Search') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search';}"  value="Search" type="text" value="" name="s" id="s" />
            <input type="submit" value="" name="submit"/>
        </div>
    </form>
</div>
<div class="clear"></div>
