<!DOCTYPE html>
<html lang="en"> 
    <head>
	    <title>ELECTRICAL CONSUMPTION CALCULATOR</title>
	    <meta charset="utf-8"> 
        <meta name="viewport" content="width=devide-width, initial-scale=1, user-scalable=yes">
        <link rel="stylesheet" href="css/styles.css">
    </head>
<body>
    <?php
    $resultkWh = $result = '';
    if (isset($_POST['num1']) && isset($_POST['num2'])){
    $num1 = (float) $_POST['num1'];
	$num2 = (float) $_POST['num2'];
	} else {
    $num1 = 0;
	$num2 = 0;
	
	}
	$units = $num1- $num2;    
	$result = calculate($units);
    $resultkWh = 'Electrical energy used: ' . $units . ' kWh';
	$resultRM = 'Amount to be paid: ' . 'RM ' . $result;
/**
 * To calculate electrical consumption as per unit cost
 */
function calculate($units) {
    $unit_cost_first200 = 0.218;
    $unit_cost_next100 = 0.334;
    $unit_cost_remaining = 0.516;

    if($units <= 200) {
        $bill = $units * $unit_cost_first200;
    }
    else if($units > 200 && $units <= 300) {
        $temp = 200 * $unit_cost_first200;
        $remaining_units = $units - 200;
        $bill = $temp + ($remaining_units * $unit_cost_next100);
    }
    else {
        $temp = (200 * $unit_cost_first200) + (100 * $unit_cost_next100);
        $remaining_units = $units - 300;
        $bill = $temp + ($remaining_units * $unit_cost_remaining);
    }
    return number_format((float)$bill, 2, '.', '');
}

?>

<body>
	<div class="content">
		 <h1>ELECTRICAL CONSUMPTION CALCULATOR</h1><br>

		<form action="" method="post" id="quiz-form">
            	<label for="Current">Current Month Meter Reading</label><br>
				<input type="number" name="num1" placeholder="kWh"> <br><br>
            	
				<label for="Previous">Previous Month Meter Reading</label><br>
				<input type="number" name="num2" placeholder="kWh"><br><br>
        
				<input type="submit" value="Calculate" id="calculate">
		</form>

		<div id="summary">
		    <?php echo '<br />' . $resultkWh; ?><br>
			<?php echo '<br />' . $resultRM; ?>
		    </p>
        </div>
    </body>
</html>