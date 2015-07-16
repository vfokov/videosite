<style>
<?php if(theme_get_setting('gallery-columns', 'hoteldiamond') == 5){?>
	.gallery-image, .gallery-image-overlay {width: 20.000%;}
<?php } ?>
<?php if(theme_get_setting('gallery-columns', 'hoteldiamond') == 4){?>
	.gallery-image, .gallery-image-overlay {width: 24.999%;}
<?php } ?>
<?php if(theme_get_setting('gallery-columns', 'hoteldiamond') == 3){?>
	.gallery-image, .gallery-image-overlay  {width: 33.333%;}
<?php } ?>
<?php if(theme_get_setting('gallery-columns', 'hoteldiamond') == 2){?>
	.gallery-image, .gallery-image-overlay  {width: 49.999%;}
<?php } ?>	
</style>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <?php
    hide($content['comments']);
    hide($content['links']);
	hide($content['field_gallery_images']);
	
	$field_project_images = field_get_items('node', $node, 'field_gallery_images');
	
?>
  <div class="row">
    <?php if (!empty($content['field_gallery_images'])): ?>

        <?php foreach ($field_project_images as $img): ?>
        
          <div class="gallery-image gallery-image-overlay">
          
          <?php $img_view = file_create_url($img['uri']); ?>
          <a rel="gallery-node-<?php $node->nid; ?>" class="group1 colorbox init-colorbox-processed cboxElement" title="<?php print $img['title'];?>" href="<?php print $img_view; ?>"> <?php print theme('image_style', array('style_name' => 'gallery-4-columns', 'path' => $img['uri'])); ?> </a>
          
          </div>
        <?php endforeach; ?>
        

    <?php endif;?>
  </div>
  

</div>
<br />
<script>
			jQuery(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				jQuery(".group1").colorbox({rel:'group1'});
			});
</script>
