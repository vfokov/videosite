<div id="slider" class="flexslider hide_ul">
  <ul class="slides">
      <?php foreach ($items as $img): ?>
      <li><?php print render($img); ?></li>
      <?php endforeach; ?>
  </ul>
</div>
 
 
 <?php 
$counter = count($items);
 
if($counter > 1){ ?>
<div id="carousel" class="flexslider">
  <ul class="slides">
	 <?php foreach ($items as $img): ?>
      <li><?php print render($img); ?></li>
      <?php endforeach; ?>
  </ul>
</div>
<?php  } ?>