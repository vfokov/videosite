<?php 
		$testiomonial_text = $fields['field_testiomonial_text']->content; 
		$person = $fields['field_testimonial_person_name']->content; 
		$job_position = $fields['field_testimonial_job_position']->content;
?>
<li>
<div class="block-testiomonial-text-bg">

<div style="float:left; padding-top:16px; padding-left:10px; overflow:hidden; opacity:0.7;"><i class="icon-quote" style="font-size:40px; -moz-transform: rotate(180deg); -o-transform: rotate(180deg); -webkit-transform: rotate(180deg); -ms-transform: rotate(180deg); transform: rotate(180deg); filter: progid:DXImageTransform.Microsoft.Matrix(M11=-1.000000, M12=0,M21=0.000000, M22=-1.000000, sizingMethod='auto expand'); zoom: 1;"></i></div>
<div class="block-testiomonial-text"><?php print $testiomonial_text;?>
<div class="block-testiomonial-person"><?php print $person;?></div>
<div class="block-testiomonial-position"><?php print $job_position;?></div>
</div>
<div style="float:right; margin-top:-120px; padding-bottom:10px; padding-right:10px; overflow:hidden;opacity:0.7;"><i class="icon-quote" style="font-size:40px;"></i></div>
</div>
</li>



