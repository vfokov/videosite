

  <?php
    hide($content['comments']);
	hide($content['unit_description_image']);
	hide($content['field_show_on_frontpage']);
    hide($content['links']);
	
		$field_project_images = field_get_items('node', $node, 'unit_description_image');
?>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
    
    <?php print render($content['unit_description_image']); ?>
        <div class="row" id="accomodation-room">  
          <?php if(!empty($field_room_source)){ ?>
           <div class="seven columns" style="padding-right:10px;">         
          <?php }else{?>
           <div class="twelve columns"> 
          <?php }?>
       
         <h3><?php print $title; ?> </h3>  
         <div style="border-top:1px solid #EAEAEA; padding-bottom:7px; margin-top:10px;"></div>
         <?php print render($content['field_unit_description']); ?> 
        </div>
    </div>
    <?php print render($content['comments']);?>

</div>

<br />

