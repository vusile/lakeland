<!DOCTYPE html>
<html>
<head>
	<base href = "<?php echo base_url(); ?>" />
	<meta charset="utf-8" />
<?php 
if(isset($css_files))
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php 
if(isset($js_files))
foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<style type='text/css'>
body
{
	font-family: Arial;
	font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
	text-decoration: underline;
}
</style>
</head>
<body>
	<div>
		<a href='<?php echo site_url('logout')?>'>Logout</a> |
		<a href='<?php echo site_url('backend/lakeland_pages')?>'>Pages</a> |
		<a href='<?php echo site_url('backend/lakeland_safaris/1')?>'>Overland Safaris</a> |
		<a href='<?php echo site_url('backend/lakeland_safaris/3')?>'>Day Trips</a> |
		<a href='<?php echo site_url('backend/lakeland_safaris/2')?>'>Weekend Getaways</a> |
		<a href='<?php echo site_url('backend/lakeland_scheduled_trips')?>'>Schedule</a> |
		<a href='<?php echo site_url('backend/lakeland_overland_safaris_packages/')?>'>Overland Safaris Types</a> |
		
		<a href='<?php echo site_url('backend/lakeland_sections')?>'>Main Content Sections</a> |


	</div>
	<div style='height:20px;'></div>  
		<?php if(isset($additional_text)) echo $additional_text; ?>
    <div>
		<?php echo $output; ?>
    </div>
</body>
</html>
