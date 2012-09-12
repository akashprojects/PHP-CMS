<h1>Holla!</h1>
<p>Welcome to <?php echo $place; ?>, <?php echo $name; ?>!</p>

 <?php echo URL::to("/css/my.css");?>
<?php echo HTML::link('an/uri', 'My Link'); ?>

<?php echo HTML::link_to_route('icem','Welcome',array(32,4));?>

