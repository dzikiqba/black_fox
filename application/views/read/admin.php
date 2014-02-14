<div id="pagin"><div class="next"><?php echo html::anchor('read/?max_id='.$pagination->next_max_tag_id,'next', array('class'=>'pag_button')); ?></div></div>
<ul id="photos">
    <?php

foreach($data as $r)
{
?>
			<li class="mosaic_item jquery-shadow">
				<div class="image">
					<a href="<? echo $r->images->standard_resolution->url;?>" title="<?php echo (isset($r->caption->text) ? $r->caption->text : ' '); ?>"><img src="<? echo $r->images->thumbnail->url;?>" title="<?php echo (isset($r->caption->text) ? $r->caption->text : ' '); ?>"></a>
				</div>
		        <div class="title" ><?php echo (isset($r->caption->from->username) ? $r->caption->from->username : ' '); ?></div>
        		<div class="inform">
        		<div class="v_fav_unch flt"><div id="<?php echo $r->id; ?>">
                <?php
                if(isset($exist[$r->id]))
					echo "added: ".$exist[$r->id];
				else {?>
                
				<div class="tosave" onclick="savein('<?php echo $r->id ?>')">save</div>
				<?php } ?>
                </div></div>
            	<div class="save_prof"></div>
         		</div>
			</li>
<?php 
}
?>
</ul>
