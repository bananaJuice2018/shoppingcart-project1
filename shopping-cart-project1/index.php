
<?php
	$request = $_SERVER['REQUEST_URI'];
	$pos = strpos($request, '?');
	if($pos) {
		$request = substr($request, 0, $pos);
	}

	switch ($request) {
		case '/' :
			require __DIR__ . '/views/services.php';
			break;
		case '' :
			require __DIR__ . '/views/services.php';
			break;
		case '/login' :
			require __DIR__ . '/views/login.php';
			break;
		case '/logout' :
			require __DIR__ . '/views/logout.php';
			break;
		case '/about' :
			require __DIR__ . '/views/about.php';
			break;
		case '/services' :
			require __DIR__ . '/views/services.php';
			break;
		case '/detail' :
			require __DIR__ . '/views/detail.php';
			break;
		case '/checkout' :
			require __DIR__ . '/views/checkout.php';
			break;
		case '/employee' :
			require __DIR__ . '/views/admin/employee.php';
			break;
		case '/product' :
			require __DIR__ . '/views/admin/product.php';
			break;
		case '/api' :
			require __DIR__ . '/action/action.php';
			break;
		case '/checkout_action' :
			require __DIR__ . '/views/checkout_action.php';
			break;
		case '/confirmation' :
			require __DIR__ . '/views/confirmation.php';
			break;
		default:
			break;
	}
?>