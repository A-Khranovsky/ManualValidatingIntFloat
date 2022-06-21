<?php
$product_positions = filter_input(INPUT_POST, 'product_positions', FILTER_CALLBACK, ['options' =>
	function($value){
		switch(true){
			case ($value < 0):
				$result = false;
			break;
			case (!filter_var($value, FILTER_VALIDATE_INT)):
				$result = false;
			break;
			default : $result = $value;
		}
		return $result;
	}]);

$price = filter_input(INPUT_POST, 'price', FILTER_CALLBACK, ['options' =>
	function($value){
		switch(true){
			case ($value < 0): 
				$result = false;	
			break;
			case (!filter_var($value, FILTER_VALIDATE_FLOAT)):
				$result = false;
			break;
			default : $result = $value;
		}
		return $result;
	}]);

if($product_positions && $price){
	$total = $product_positions * round($price, 2);

}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>	
	<form method='post'>		
		<?php echo ($total !== null) ? 'Общая цена: ' . $total . '<br />' : null; ?>
		Количество товарных позиций: <br />
		<input type='text' name='product_positions' value='<?=$product_positions?>' /><br />
		Цена: <br />
		<input type='text' name='price' value='<?=($price !== false) ? sprintf("%.2f",$price) : '###.##'?>' /><br />
		<input type='submit' value='Send' />
	</form>
</body>
</html>