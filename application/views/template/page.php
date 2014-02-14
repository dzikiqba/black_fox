<?php echo $page_links; ?>
<div class="photo">
<ul id="photos">
    <?php
foreach($data as $r)
{

?>
			<li class="mosaic_item jquery-shadow">
				<div class="image">
					<a href="<? echo $r->data->images->standard_resolution->url;?>" title="<?php echo (isset($r->data->caption->text) ? $r->data->caption->text : ' '); ?>"><img src="<? echo $r->data->images->thumbnail->url;?>" ></a>
				</div>
		        <div class="title" ><?php echo (isset($r->data->caption->from->username) ? $r->data->caption->from->username : ' '); ?></div>
        		<div class="inform">
        		
            	<div class="save_prof"></div>
         		</div>
			</li>
<?php 
}
?>
</ul>
</div>



<?php echo $page_links; ?>