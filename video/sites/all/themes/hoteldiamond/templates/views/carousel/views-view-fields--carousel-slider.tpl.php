

 <?php $image = $fields['unit_description_image']->content; $title = $fields['title']->content; $price = $fields['field_starting_price']->content;?>
   <li>
       <div class="accomodation-carousel-item" style="margin-bottom:10px; position:relative;"><?php  print $image;?>
			<div class="title"><?php print $title;?></div>
            <?php if($price){?>
  			<div class="price"><?php print $price . "<div class='starting-from'>". t("Starting from") . "</div>";?></div>
            <?php } ?>
       	    <div class="title_bg"></div>
            
       </div>
       
   </li>
