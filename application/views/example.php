<!DOCTYPE html>
<html>
<head>
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
		<a href='<?php echo site_url('backend/nf_news')?>'>News</a> |
		<a href='<?php echo site_url('backend/nf_projects_and_publications/1')?>'>Project Categories</a> | 
		<a href='<?php echo site_url('backend/nf_projects_and_publications/2')?>'>Publication Categories</a> | 
		<a href='<?php echo site_url('backend/nf_directory')?>'>Directory</a> | 
		<a href='<?php echo site_url('backend/nf_company_types')?>'>Company Types</a> |
		<a href='<?php echo site_url('backend/nf_company_sectors')?>'>Company Sectors</a> |
		<a href='<?php echo site_url('backend/nf_team')?>'>The Team</a> |
		<a href='<?php echo site_url('backend/nf_newsletters')?>'>Newsletters</a> |
		<a href='<?php echo site_url('backend/nf_settings')?>'>Settings</a> 

	</div>
	<div style='height:20px;'></div>  
    <div>
		<?php echo $output; ?>
    </div>
</body>
</html>
