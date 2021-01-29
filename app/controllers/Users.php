<?php
	class Users extends Controller{
		public function __construct(){
			$this->userModel = $this->model('User');
		}

		public function index(){
			if (isLoggedIn()) {
				redirect('users/dashboard');
			}elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				$data = [
					'email' => trim($_POST['email']),
					'password' => trim($_POST['password']),
					'email_err' => '',
					'password_err' => ''
				];

				if (empty($data['email'])) {
					$data['email_err'] = 'please enter email address';
				}
				if (empty($data['password'])) {
					$data['password_err'] = 'please enter password';
				}

				if ($this->userModel->findUserByEmail($data['email'])) {
					//user found
				}else{
					$data['email_err'] = 'no user found';
				}

				if (empty($data['email_err']) && empty($data['password_err'])) {
					$loggedInUser = $this->userModel->login($data['email'], $data['password']); 
					if ($loggedInUser) {
						$this->createUserSession($loggedInUser);
					}else{
					$data['password_err'] = 'password is invalid';
					echo "<script>alert ('incorrect login info')</script>";
					$this->view('users/index', $data);
					}
				}else{
					$this->view('users/index', $data);
				}
			}else{
				$data = [
					'email' => '',
					'password' => '',
					'email_err' => '',
					'password_err' => ''
				];
				$this->view('users/index', $data);
			}
		}

		public function createUserSession($user){
			$_SESSION['user_id'] = $user->id;
			$_SESSION['firstname'] = $user->firstname;
			$_SESSION['surname'] = $user->surname;
			$_SESSION['role'] = $user->role;
			$_SESSION['email'] = $user->email;
			redirect('users/dashboard');
		}

		public function logout(){
			unset($_SESSION['user_id']);
			unset($_SESSION['role']);
			unset($_SESSION['firstname']);
			unset($_SESSION['surname']);
			session_destroy();
			redirect('users');
		}

		public function dashboard(){
			if (!isLoggedIn()) {
				redirect('users');
			}else{
				$this->view('users/dashboard');
			}
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				echo "<script> alert ('credits and debits cannot be accessed at the moment') </script>";
			}
		}

		public function adduser(){
			if (!isLoggedIn()) {
				redirect('users');
			}elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
				#process form
				//sanitize post data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				$data = [
					'surname' => trim($_POST['surname']),
					'firstname' => trim($_POST['firstname']),
					'email' => trim($_POST['email']),
					'password' => trim($_POST['password']),
					'confirm_password' => trim($_POST['confirm_password']),
					'country' => trim($_POST['country']),
					'state' => trim($_POST['state']),
					'photo' => trim($_FILES['photo']['name']),
					'gender' => trim($_POST['gender']),
					'dob' => trim($_POST['dob']),
					'occupation' => trim($_POST['occupation']),
					'status' => trim($_POST['status']),
					'mname' => trim($_POST['mname']),
					'acc_num' => trim($_POST['acc_num']),
					'pin' => trim($_POST['pin']),
					'nok' => trim($_POST['nok']),
					'surname_err' => '',
					'firstname_err' => '',
					'email_err' => '',
					'password_err' => '',
					'confirm_password_err' => '',
					'country_err' => '',
					'state_err' => '',
					'photo_err' => '',
					'gender_err' => '',
					'dob_err' => '',
					'occupation_err' => '',
					'status_err' => '',
					'mname_err' => '',
					'acc_num_err' => '',
					'pin_err' => '',
					'nok_err' => ''
				];

				if (empty($data['surname'])) {
					$data['name_err'] = 'Please enter surname';
				}
				if (empty($data['firstname'])) {
					$data['name_err'] = 'Please enter firstname';
				}
				if (empty($data['email'])) {
					$data['email_err'] = 'Enter email address';
				}else{
					if ($this->userModel->findUserByEmail($data['email'])) {
						$data['email_err'] = 'Email is already taken';
					}
				}
				if (empty($data['password'])) {
					$data['password_err'] = 'Please enter password';
				}elseif (strlen($data['password']) < 6) {
					$data['password_err'] = 'password must be at least 3 xters';
				}
				if (empty($data['confirm_password'])) {
					$data['confirm_password_err'] = 'Please confirm password';
				}elseif (($data['password']) != ($data['confirm_password'])) {
					$data['confirm_password_err'] = 'Password does not match';
				}
				if (empty($data['country'])) {
					$data['country_err'] = 'Please enter country';
				}
				if (empty($data['state'])) {
					$data['state_err'] = 'Please enter state';
				}
				if (empty($data['photo'])) {
					$data['photo_err'] = 'select a file';
				}
				if (empty($data['gender'])) {
					$data['gender_err'] = 'select a gender';
				}
				if (empty($data['dob'])) {
					$data['dob_err'] = 'enter date of birth';
				}
				if (empty($data['mname'])) {
					$data['mname_err'] = 'enter mothers name';
				}
				if (empty($data['acc_num'])) {
					$data['acc_num_err'] = 'enter name account number';
				}
				if (empty($data['pin'])) {
					$data['pin_err'] = 'enter your pin';
				}
				if (empty($data['nok'])) {
					$data['nok_err'] = 'enter next of kin';
				}

				if (empty($data['surname_err']) && empty($data['firstname_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['country_err']) && empty($data['state_err']) && empty($data['photo_err']) && empty($data['gender_err']) && empty($data['dob_err']) &&(empty($data['mname_err'])) && (empty($data['acc_num_err'])) && (empty($data['pin_err'])) && (empty($data['occupation_err'])) && empty($data['nok_err'])) {
					$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
						$reg = $this->userModel->register($data);
						$move = $this->upload();
					if ($reg && $move) {
						redirect('users/allusers');
					}else{
						die('something went wrong');
					}
				}else{
					$this->view('users/adduser', $data);
				}
			}else{
				$data = [
					'surname' => '',
					'firstname' => '',
					'email' => '',
					'password' => '',
					'confirm_password' => '',
					'country' => '',
					'state' => '',
					'photo' => '',
					'gender' => '',
					'dob' => '',
					'occupation' => '',
					'status' => '',
					'mname' => '',
					'acc_num' => '',
					'pin' => '',
					'nok' => '',
					'surname_err' => '',
					'firstname_err' => '',
					'email_err' => '',
					'password_err' => '',
					'confirm_password_err' => '',
					'country_err' => '',
					'state_err' => '',
					'photo_err' => '',
					'gender_err' => '',
					'dob_err' => '',
					'occupation_err' => '',
					'status_err' => '',
					'mname_err' => '',
					'acc_num_err' => '',
					'pin_err' => '',
					'nok_err' => ''
				];
				$this->view('users/adduser', $data);
			}
		}

		public 	function upload(){
		$name = $_FILES['photo']['name'];
		$tmp_name = $_FILES['photo']['tmp_name']; 
		$extension = strtolower(substr($name, strpos($name, '.')+1));	
			$location = '../public/images/';
			if ($extension=='jpg' || $extension=='jpeg'){
				if (move_uploaded_file($tmp_name, $location.$name)) {
					return true;
				}else{
					return false;
				}
			}
		}

		public function allusers(){
			if (!isLoggedIn()) {
				redirect('users');
			}
			$users = $this->userModel->allUsers();

			$data = [
				'users' => $users
			];

			$this->view('users/allusers', $data);
		}

		public function deleteuser($id){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$user = $this->userModel->getUserById($id);

				if ($this->userModel->deleteuser($id)) {
					redirect('users/allusers');
				}else{
					die('something went wrong');
				}
			}else{
				redirect('users/allusers');
			}
		}		

		public function profile($id){
			if (!isLoggedIn()) {
				redirect('users');
			}
			$user = $this->userModel->getUserById($id);
			$data = [
				'user' => $user
			];
			$this->view('users/profile', $data);
		}

		public function show($id){
			if (!isLoggedIn()) {
				redirect('users');
			}
			$user = $this->userModel->getUserById($id);
			$data = [
				'user' => $user
			];
			$this->view('users/show', $data);
		}

		public function update($id){
			if (!isLoggedIn()) {
				redirect('users');
			}
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				$data = [
					'id' => $id,
					'surname' => trim($_POST['surname']),
					'firstname' => trim($_POST['firstname']),
					'email' => trim($_POST['email']),
					'country' => trim($_POST['country']),
					'state' => trim($_POST['state']),
					'photo' => trim($_FILES['photo']['name']),
					'gender' => trim($_POST['gender']),
					'dob' => trim($_POST['dob']),
					'occupation' => trim($_POST['occupation']),
					'status' => trim($_POST['status']),
					'mname' => trim($_POST['mname']),
					'acc_num' => trim($_POST['acc_num']),
					'pin' => trim($_POST['pin']),
					'nok' => trim($_POST['nok']),
					'surname_err' => '',
					'firstname_err' => '',
					'email_err' => '',
					'country_err' => '',
					'state_err' => '',
					'photo_err' => '',
					'gender_err' => '',
					'dob_err' => '',
					'occupation_err' => '',
					'status_err' => '',
					'mname_err' => '',
					'acc_num_err' => '',
					'pin_err' => '',
					'nok_err' => ''
				];

				if (empty($data['surname'])) {
					$data['name_err'] = 'Please enter surname';
				}
				if (empty($data['firstname'])) {
					$data['name_err'] = 'Please enter firstname';
				}
				if (empty($data['email'])) {
					$data['email_err'] = 'Enter email address';
				}
				if (empty($data['country'])) {
					$data['country_err'] = 'Please enter country';
				}
				if (empty($data['state'])) {
					$data['state_err'] = 'Please enter state';
				}
				if (empty($data['photo'])) {
					$data['photo_err'] = 'select a file';
				}
				if (empty($data['gender'])) {
					$data['gender_err'] = 'select a gender';
				}
				if (empty($data['dob'])) {
					$data['dob_err'] = 'enter date of birth';
				}
				if (empty($data['mname'])) {
					$data['mname_err'] = 'enter mothers name';
				}
				if (empty($data['acc_num'])) {
					$data['acc_num_err'] = 'enter name account number';
				}
				if (empty($data['pin'])) {
					$data['pin_err'] = 'enter your pin';
				}
				if (empty($data['nok'])) {
					$data['nok_err'] = 'enter next of kin';
				}

				if (empty($data['surname_err']) && empty($data['firstname_err']) && empty($data['email_err']) && empty($data['country_err']) && empty($data['state_err']) && empty($data['photo_err']) && empty($data['gender_err']) && empty($data['dob_err']) &&(empty($data['mname_err'])) && (empty($data['acc_num_err'])) && (empty($data['pin_err'])) && (empty($data['occupation_err'])) && empty($data['nok_err'])) {
						$reg = $this->userModel->updateuser($data);
						$move = $this->upload();
					if ($reg && $move) {
						redirect('users/allusers');
					}else{
						die('something went wrong');
					}
				}else{
					$this->view('users/update', $data);
				}
			}else{
				$user = $this->userModel->getUserById($id);
				$data = [
					'id' => $id,
					'surname' => $user->surname,
					'firstname' => $user->firstname,
					'email' => $user->email,
					'country' => $user->country,
					'state' => $user->state,
					'photo' => $user->image,
					'gender' => $user->gender,
					'dob' => $user->dob,
					'occupation' => $user->occupation,
					'status' => $user->status,
					'mname' => $user->mname,
					'acc_num' => $user->acc_num,
					'pin' => $user->pin,
					'nok' => $user->nok,
					'surname_err' => '',
					'firstname_err' => '',
					'email_err' => '',
					'country_err' => '',
					'state_err' => '',
					'photo_err' => '',
					'gender_err' => '',
					'dob_err' => '',
					'occupation_err' => '',
					'status_err' => '',
					'mname_err' => '',
					'acc_num_err' => '',
					'pin_err' => '',
					'nok_err' => ''
				];
				$this->view('users/update', $data);
			}
		}

		public function credit($id){
			if (!isLoggedIn()) {
				redirect('users');
			}
			$tracknum = '0123456789ABcdefGHijklMNopqrSTuvwxYZ';
			$result = 'g'.substr(str_shuffle($tracknum), 0, 9). 'lb';
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {		
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				$data = [
					'id' => $id,
					'tid' => trim($_POST['tid']),
					'sender' => trim($_POST['sender']),
					'amount' => trim($_POST['amount']),
					'current_bal' => trim($_POST['current_bal']),
					'avail_bal' => trim($_POST['avail_bal']),
					'dod' => trim($_POST['dod']),
					'id_err' => '',
					'tid_err' => '',
					'sender_err' => '',
					'amount_err' => '',
					'current_bal_err' => '',
					'avail_bal_err' => '',
					'dod_err' => ''
				];
				if (empty($data['amount'])) {
					$data['amount_err'] = 'Please enter amount';
				}
				if (empty($data['current_bal'])) {
					$data['current_bal_err'] = 'Please enter current balance';
				}
				if (empty($data['avail_bal'])) {
					$data['avail_bal_err'] = 'enter transfer available balance';
				}

				if (empty($data['amount_err']) && (empty($data['current_bal_err'])) && empty($data['avail_bal_err'])) {
					if ($this->userModel->deposit($data)) {
						redirect('users/deposits');
					}else{
						die('something went wrong');
					}
				}else{
					$this->view('users/credit', $data);
				}

				}else{	
					$user = $this->userModel->getUserById($id);				
					$data = [
						'id' => $user->id,
						'tid' => $result,
						'sender' => '',
						'amount' => '',
						'current_bal' => '',
						'avail_bal' => '',
						'dod' => '',
						'id_err' => '',
						'tid_err' => '',
						'sender_err' => '',
						'amount_err' => '',
						'current_bal_err' => '',
						'avail_bal_err' => '',
						'dod_err' => ''
					];
					$this->view('users/credit', $data);
				}
		}

		public function account($id){
			if (!isLoggedIn()) {
				redirect('users');
			}
			$user = $this->userModel->getUserById($id);
			$all = $this->userModel->alldeposit($user->id);
			$data = [
				'user' => $user,
				'all' => $all
			];
			$this->view('users/account', $data);
		}

		// public function transfer($id){
		// 	$tracknum = '0123456789ABcdefGHijklMNopqrSTuvwxYZ';
		// 	$result = 'g'.substr(str_shuffle($tracknum), 0, 9). 'lb';
		// 	if ($_SERVER['REQUEST_METHOD'] == 'POST') {		
		// 		$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		// 		$data = [
		// 			'tid' => trim($_POST['tid']),
		// 			'status' => trim($_POST['status']),
		// 			'acc_name' => trim($_POST['acc_name']),
		// 			'acc_num' => trim($_POST['acc_num']),
		// 			'amount' => trim($_POST['amount']),
		// 			'current_bal' => trim($_POST['cb']),
		// 			'avail_bal' => trim($_POST['ab']),
		// 			'pin' => trim($_POST['pin']),
		// 			'date' => date('m-D-Y'),
		// 			'tid_err' => '',
		// 			'acc_name_err' => '',
		// 			'acc_num_err' => '',
		// 			'amount_err' => '',
		// 			'current_bal_err' => '',
		// 			'avail_bal_err' => '',
		// 			'pin_err' => ''
		// 		];
		// 		if (empty($data['acc_name'])) {
		// 			$data['acc_name_err'] = 'Please enter account name';
		// 		}
		// 		if (empty($data['acc_num'])) {
		// 			$data['acc_num_err'] = 'Please enter account number';
		// 		}
		// 		if (empty($data['pin'])) {
		// 			$data['pin_err'] = 'enter transfer pin';
		// 		}
		// 		if (empty($data['acc_name_err']) && (empty($data['acc_num_err'])) && empty($data['pin_err'])) {
		// 			if ($this->userModel->transfer($data) && $this->userModel->addtransfer($data)) {
		// 				redirect('users/complete');
		// 			}else{
		// 				die('something went wrong');
		// 			}
		// 		}else{
		// 			$this->view('users/transfer', $data);
		// 		}

		// 		}else{
		// 			$gettransfer = $this->userModel->gettransferid($id);
		// 			$data = [
		// 				'id' => $gettransfer->id,
		// 				'tid' => $result,
		// 				'acc_name' => '',
		// 				'acc_num' => '',
		// 				'amount' => '',
		// 				'current_bal' => $gettransfer->current_bal,
		// 				'avail_bal' => $gettransfer->available_bal,
		// 				'pin' => '',
		// 				'date' => '',
		// 				'tid_err' => '',
		// 				'acc_name_err' => '',
		// 				'acc_num_err' => '',
		// 				'amount_err' => '',
		// 				'current_bal_err' => '',
		// 				'avail_bal_err' => '',
		// 				'pin_err' => ''
		// 			];
		// 			$this->view('users/transfer', $data);
		// 		}
			
		// }

		// public function complete(){
		// 	$id = $_SESSION['user_id'];
		// 	// $user = $this->userModel->getUserById($id);
		// 	$selectdebit = $this->userModel->selectdebit($id);
		// 	$data = [
		// 		'deposit' => $selectdebit
		// 	];
		// 	$this->view('users/complete', $data);
		// }

		// public function updatebal(){
		// 	$amount = $data['amount'];
		// 	$current_bal = $data['current_bal'];

		// 	$new_bal = (($current_bal) - ($amount));
		// 	$result = $new_bal;
		// }

		public function changepass($id){
			if (!isLoggedIn()) {
				redirect('users');
			}
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				$data = [
					'id' => $id,
					'old_password' => trim($_POST['old_password']),
					'new_password' => trim($_POST['new_password']),
					'rnew_password' => trim($_POST['rnew_password']),
					'old_password_err' => '',
					'new_password_err' => '',
					'rnew_password_err' => ''
				];

				if (empty($data['old_password'])) {
					$data['old_password_err'] = 'Please enter old password';
				}
				if (empty($data['new_password'])) {
					$data['new_password_err'] = 'Please enter your new password';
				}
				if (empty($data['rnew_password'])) {
					$data['rnew_password_err'] = 'Please retype new password';
				}elseif ($data['new_password'] != $data['rnew_password']) {
					$data['rnew_password_err'] = 'Password does not match with new password';
				}

				if (empty($data['rnew_password_err']) && empty($data['old_password_err']) && empty($data['new_password_err'])) {
					$data['new_password'] = password_hash($data['new_password'], PASSWORD_DEFAULT);
					if ($this->userModel->updatepass($data)) {
						// echo "<script>alert ('password has been changed')</script>";
						redirect('users/dashboard');
					}else{
						die('something went wrong');
					}
				}else{
					$this->view('users/changepass', $data);
				}
			}else{
				$data = [
					'id' => $id,
					'old_password' => '',
					'new_password' => '',
					'rnew_password' => '',
					'old_password_err' => '',
					'new_password_err' => '',
					'rnew_password_err' => ''
				];
				$this->view('users/changepass', $data);
			}
			
		}


	}