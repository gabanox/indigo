<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Indigo</title>
<base href="<?=base_url();?>" />
<link href="system/application/libraries/css/default.css" rel="stylesheet" type="text/css" />
<script src="system/application/libraries/js/jquery-1.4.4.js"></script>
<script src="system/application/libraries/js/jquery.validate.js"></script>
<script src="system/application/libraries/js/jquery.metadata.js"></script>
<script src="system/application/libraries/js/additional-methods.js"></script>
<script src="system/application/libraries/js/jquery.validate.pack.js"></script>
<script src="system/application/libraries/js/jquery.confirm.js"></script>
<script>
$(document).ready( function(){

	/* form validation */

 	var container = $('div.container');
 	
    var validator = $("#saveForm").validate({
        errorContainer: container,
        errorLabelContainer: $("ol", container),
        wrapper: 'li',
        meta: "validate"
    });
    
    var validator = $("#editForm").validate({
        errorContainer: container,
        errorLabelContainer: $("ol", container),
        wrapper: 'li',
        meta: "validate"
    });
    
    var validator = $("#recepcionForm").validate({
        errorContainer: container,
        errorLabelContainer: $("ol", container),
        wrapper: 'li',
        meta: "validate"
    });

    

    $("#numeroDeGuia").keyup(function(){
  	  this.value = this.value.toUpperCase();
  	});

    $("input[type='text']:first", document.forms[0]).focus();
	    
    $(".cancel").click(function() {
        validator.resetForm();
    });
	    
	/* form validation */

	/* main list */

    $('table tbody tr').mouseover(function() {
        $(this).addClass('highlight');
     }).mouseout(function() {
        $(this).removeClass('highlight');
     });
    
	/* main list */

	/* confirm dialog */

	/* confirm dialog */
	
});
</script>


<style type="text/css">
.cmxform fieldset p.error label { color: red; }
div.container {
    background-color: #FEF1EC;
    border: 1px solid #CD0A0A;
	color: #CD0A0A;
    margin: 5px;
    padding: 5px;
}
div.container ol li {
    list-style-type: disc;
    margin-left: 20px;
}
div.container { display: none }
.container label.error {
    display: inline;
}
form.cmxform label.error {
    display: block;
    margin-left: 1em;
    width: auto;
}
</style>

</head>