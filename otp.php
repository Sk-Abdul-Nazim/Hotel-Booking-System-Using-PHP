<?php
error_reporting(0);
  print_r(generateNumericOTP());
  ?>
  <br>
  <a href="otpgenerator.php">Back</a>
<?php
function generateNumericOTP() {

	$generator = "1357902468";

	$result = "";
  $n = 4;
	for ($i = 1; $i <= $n; $i++) {
		$result .= substr($generator, (rand()%(strlen($generator))), 1);
	}
  // print_r(generateNumericOTP());
	// Return result
	return $result;
}
?>
