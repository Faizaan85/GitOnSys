<div class="container-fluid">
<?php
print_r($envals);
$ccode = '<select class="" name="test">';
foreach ($envals as $key=>$eval)
{
	# code...
	$ccode = $ccode.'<option value="'.$key.'">'.$eval.'</option>';
}
$ccode = $ccode . '</select>';
echo $ccode;
	?>

</div>
