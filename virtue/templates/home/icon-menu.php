 <?php global $virtue; $icons = $virtue['icon_menu']; 
                if(!empty($virtue['home_icon_menu_column'])) {$columnsize = $virtue['home_icon_menu_column'];} else {$columnsize = 3;}
                        if ($columnsize == '2') {$itemsize = 'tcol-lg-6 tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12';} 
                        else if ($columnsize == '3'){ $itemsize = 'tcol-lg-4 tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12'; } 
                        else if ($columnsize == '6'){ $itemsize = 'tcol-lg-2 tcol-md-2 tcol-sm-3 tcol-xs-4 tcol-ss-6';} 
                        else if ($columnsize == '5'){ $itemsize = 'tcol-lg-25 tcol-md-25 tcol-sm-3 tcol-xs-4 tcol-ss-6';} 
                        else {$itemsize = 'tcol-lg-3 tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12';}             
                    ?>
                <div class="home-margin home-padding">
                    <div class="rowtight homepromo">
                    <?php $counter = 1;?>
                        <?php foreach ($icons as $icon) : ?>
                            <div class="<?php echo $itemsize;?> home-iconmenu <?php echo 'homeitemcount'.$counter;?>">
                                <a href="<?php echo $icon['link'] ?>" title="<?php echo $icon['title'] ?>">
                                <?php if(!empty($icon['url'])) echo '<img src="'.$icon['url'].'"/>' ; else echo '<i class="'.$icon['icon_o'].'"></i>'; ?>
                                <?php if ($icon['title'] != '') echo '<h4>'.$icon['title'].'</h4>'; ?>
                                <?php if ($icon['description'] != '') echo '<p>'.$icon['description'].'</p>'; ?>
                                </a>
                            </div>
                             <?php $counter ++ ?>
                        <?php endforeach; ?>

                    </div> <!--homepromo -->
                </div>