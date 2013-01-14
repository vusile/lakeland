  <div class="first_part">
   
	<h1 class="sitetitle"><?php echo $title ?></h1>
	<?php if(isset($inquiry)): ?>
    <div class="inquiry">
      <a href="contact/<?php echo $safari->url ?>" class="inquiry-button">Inquire About <?php echo $title ?></a>
    </div>
	<?php endif; ?>
    <p>  
		<?php echo $safari->introductory_text; ?>
	</p>
    <?php if(isset($safari->price)): ?><h2>Price: $<?php echo number_format($safari->price); ?></h2><br><?php endif; ?>
	
    <?php if(isset($safari->includes) and $safari->includes != ''):?>
	<h3> Includes:  </h3>

	<?php echo $safari->includes; ?>
	<?php endif; ?>
    <?php if(isset($safari->excludes) and $safari->excludes != ''):?>
    <h3> Excludes  </h3>
    <?php echo $safari->excludes; ?>
	<?php endif; ?>
    <?php if( isset($itinerary) and  $itinerary->num_rows() > 0):?>
    <h3> Itinerary </h3>
	<?php foreach($itinerary->result() as $item): ?>
		<h4><?php echo $item->title ?></h4>
		<?php echo $item->activities ?>
    <?php endforeach; ?> 
	<?php endif; ?>
	
	<?php if(isset($inquiry)): ?>
    <div class="inquiry">
     <a href="contact/<?php echo $safari->url ?>" class="inquiry-button">Inquire About <?php echo $title ?></a>
    </div>
	<?php endif; ?>
  </div>  <!-- end of div first_par -->

   <!--  <div class="clear"></div> -->
  


  <div class="second_part">
  <?php foreach($images->result() as $image): ?>
    <div class="image">
    <img src="images/thumb__<?php echo $image->image ?>" alt="<?php echo $image->title ?>">
   <!-- <div class="text">
      <p><?php echo $image->title ?></p>
    </div>-->
    </div>
	<?php endforeach; ?>
  </div>   <!-- end of div second part  -->
		<div class="clear"></div>
     </div>



