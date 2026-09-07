<?php function sec_post_next_previous(){?>
	<?php
		// -
		global $EXCLUDE_POST;
		// - 
		$previous_post 	= get_previous_post();
		$next_post 		= get_next_post();
		if(!empty($next_post)){$EXCLUDE_POST.= $next_post->id;}
		$EXCLUDE_POST.= $previous_post->id;
	?>
    <div class="next_prev_post post-navigation mb-3">
        <div class="position-relative d-flex justify-content-start align-items-center border-line mb-2">
            <p class="h5 text-left text-first-uppercase fw-bold text-nowrap text-primary py-1">
                Continua la lettura
            </p>
        </div>
        <div class="row">
            <div class="col-sm-6 mb-3">
            <small class="text-muted"><i class="fa-solid fa-arrow-left"></i>&nbsp;Articolo precedente</small><p class="h5 nav-previous"><?php previous_post_link('%link', '%title'); ?></p>
            </div>
            <div class="col-sm-6 text-sm-end">
            <?php if(!empty($next_post)){if(strlen(get_next_post()->post_title) > 0){?>
            <small class="text-muted">Articolo successivo&nbsp;<i class="fa-solid fa-arrow-right"></i></small>
            <p class="h5 nav-next"><?php next_post_link('%link', '%title'); ?></p>
            <?php }}?>
            </div>
        </div>
    </div>
<?php }?>