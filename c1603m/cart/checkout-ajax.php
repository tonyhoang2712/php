<?php 
require '../config.php';
$carts = get_cart();

if (!empty($_POST)) {
	$full_name = $_POST['full_name'];
	$email = $_POST['email'];	
	
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$total_amount = $_POST['total_amount'];
	$note = $_POST['note'];
	if (!empty($email)) {
		$user = get_one('user','email',$email);
		if ($user) {
			$uid = $user['user_id'];
		}else{
			$uid = insert('user',[
				'username' => $email,
				'email' => $email,
				'password' => MD5(123456),
				'phone' => $phone,
				'full_name' => $full_name,
				'address' => $address,
			]);
		}

		$oid = insert('`order`',[
			'customer_id' => $uid,
			'total_amount' => $total_amount,
			'status' => 0,
			'note' => $note,
			'created_date' => time(),
		]);

		foreach ($carts as $cart) {
			insert('order_detail',[
				'order_id' => $oid,
				'product_id' => $cart['id'],
				'quantity' => $cart['quantity'],
				'price' => $cart['price'],
				'return_status' => 0
			]);
			 
		}

		echo 1;
		clear_cart();
	}else{
		echo 0;
	}

}

?>