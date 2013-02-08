	<div style="margin-top: 10px;"></div>
<div class="right">
	<h1 class="sitetitle"><?php if(isset($details->browser_title) and $details->browser_title != '') echo $details->browser_title; else echo $details->title;  ?></h1>

<div class="content">

 <?php echo validation_errors(); ?>

 <?php if(isset($button)) echo $button;?>
  <?php echo $details->content; ?>
 
</div>