<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

<title><?php echo $title; ?></title>

<style type='text/css'>
<?php $this->file(BASEPATH.'scaffolding/views/stylesheet.css'); ?>
</style>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv='expires' content='-1' />
<meta http-equiv= 'pragma' content='no-cache' />

</head>
<body>

<div id="header">
<div id="header_left">
<h3>Catalogos del sistema:&nbsp; <?php echo $title; ?></h3>
</div>
<div id="header_right">
<!-- TODO agrear variables de session aqui -->
<?php echo anchor( base_url() . index_page() . "/authentication/authenticate/", $scaff_back ); ?> &nbsp;&nbsp;|&nbsp;&nbsp;
<?php echo anchor(array($base_uri, 'view'), $scaff_view_records); ?> &nbsp;&nbsp;|&nbsp;&nbsp;
<?php echo anchor(array($base_uri, 'add'),  $scaff_create_record); ?> &nbsp;&nbsp;|&nbsp;&nbsp;
<?php echo anchor( index_page(), $scaff_exit ); ?>
</div>
</div>

<br clear="all">
<div id="outer">