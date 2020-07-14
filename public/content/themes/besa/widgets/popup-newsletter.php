<div class="popupnewsletter">
    <!-- Modal -->
    <div class="modal fade" id="popupNewsletterModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="popup-newsletter-widget widget-newletter">
                        <?php 
                            $bg = !empty($image) ? 'style="background-image: url( '. $image .')"' : '';
                        ?>
                        <div class="popup-content" <?php echo trim($bg); ?>>
                            <a href="javascript:void(0);" data-dismiss="modal"><i class="tb-icon tb-icon-cross"></i></a>
                            <?php if(!empty($title)){ ?>
                                <h3>
                                    <span><?php echo trim( $title ); ?></span>
                                </h3>
                            <?php } ?>  
                            <?php if(!empty($description)){ ?>
                                <p class="description">
                                    <?php echo trim( $description ); ?>
                                </p>
                            <?php } ?> 
                            <?php
                                mc4wp_show_form('');
                            ?>
                            <?php if ( isset($socials) && is_array( $socials)) { ?>


                            <?php if(!empty($message)){ ?>
                                <span data-dismiss="modal"><?php echo trim($message); ?></span>
                            <?php } ?>   
                            
                              
                            <?php if( count(array_column($socials, 'status')) > 0 ) : ?> 
                                <ul class="social list-inline style2">
                                    <?php foreach( $socials as $key=>$social):
                                            if( isset($social['status']) && !empty($social['page_url']) ): ?>
                                                <li>
                                                    <a href="<?php echo esc_url($social['page_url']);?>" class="<?php echo esc_attr($key); ?>">
                                                        <i class="zmdi zmdi-<?php echo esc_attr($key); ?>"></i><span class="hidden"><?php echo esc_html($social['name']); ?></span>
                                                    </a>
                                                </li>
                                    <?php
                                            endif;
                                        endforeach;
                                    ?>
                                </ul>
                            <?php endif; ?>

                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>