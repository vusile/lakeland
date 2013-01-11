
<div class="right">
	<h1 class="sitetitle"><?php echo $title; ?></h1>
	
<div class="content">
	<div style="margin-top: 40px;"></div>
<?php 
$count = 0;
foreach($trips->result() as $trip): 
?>
<?php if ($count == 1):
	$count = 0; 
?>
  <div class="content2">
 <?php else: ?>
  <div class="content1">
 <?php endif; ?>
  	<div class="resizer">
  	<h1><a href="<?php echo $detail_url ?>/<?php echo $trip->url; ?>"><?php echo $trip->title; ?></a></h1>
       <a href="<?php echo $detail_url ?>/<?php echo $trip->url; ?>"><?php echo $trip->thumb_nail; ?></a>
   			<div class="teaser">
   				<p><?php echo substr(strip_tags($trip->introductory_text),0,160); ?></p>
   			<a href="<?php echo $detail_url ?>/<?php echo $trip->url; ?>">Read More</a>
   			</div>
   		</div>
	</div>
<?php 
$count++;
endforeach; ?>	
</div></div></div>
