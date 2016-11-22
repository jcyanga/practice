<?php
	$var = "level";
	$str_splt = str_split($var);
	$ctr = count($str_splt);
	$val = "";

	for($i=$ctr-1;$i>=0;$i--) {
		$val .= $var[$i];
	}
	
	if($var == $val) {
		echo "It's a Palindrome.";
	}else {
		echo "It's not a Palindrome.";
	}

	echo '<br/>';

	$arr = array(1,1,2,3,4,4,5,6,7,8,8,6,9,10);
	$count = count($arr);

	for($x=0;$x<$count;$x++) {
		$temp = $arr[$x];
		for($y=0;$y<$count;$y++) {
			if($y != $x) {
				if($temp == $arr[$y]) {
					echo $temp . '<br/>';
					$arr[$y] = "";
				}
			}
		}
	}

	echo '<br/>';

	$number1 = 1;
	$number2 = 20;

	for($n=$number1;$n<=$number2;$n++) {
		for($m=2;$m<=$n;$m++) {
			if($n % $m == 0) {
				break;
			}
		}
		if($m == $n) {
			echo "The Prime number is, " . $n . '<br/>';
		}
	}

	echo '<br/>';

	$array = array('j','i','g','h','d','f','e','b','a','c');
	$arrlen = count($array);

	for($e=0;$e<=$arrlen;$e++) {
		for($f=$e+1;$f<$arrlen;$f++) {
			if($array[$e] > $array[$f]) {
				$result = $array[$e];
				$array[$e] = $array[$f];
				$array[$f] = $result;
			}
		}
	}

	foreach($array as $arr_result) {
		echo $arr_result . '<br/>';
	}

	echo '<br/>';

	include_once 'database/crud.php';
	$mycrud = new My_Crud();
	$table = 'userlist';
	$result = $mycrud->read($table);

	$user = $password = $fullname = "";
	$err_user = $err_password = $err_fullname = "";
	$id = "";

	if(isset($_POST['Submit'])) {
		if(empty($_POST['user'])) {
			$err_user = "*required field.";
		}else {
			$user = test_data($_POST['user']);
		}

		if(empty($_POST['password'])) {
			$err_password = "*required field.";
		}else {
			$password = test_data($_POST['password']);
		}

		if(empty($_POST['fullname'])) {
			$err_fullname = "*required field.";
		}else {
			$fullname = test_data($_POST['fullname']);
		}

		$mycrud->create($table,$user,$password,$fullname);
	}

	if(isset($_GET['delete'])) {
		$id = $_GET['id'];
		$mycrud->delete($table,$id);
	}

	if(isset($_GET['edit'])) {
		$id = $_GET['id'];
		$getdata = $mycrud->get($table,$id);
		$row = $getdata->fetch_assoc();
		$id = $row['id'];
		$user = $row['user'];
		$password = $row['password'];
		$fullname = $row['fullname'];
	}

	function test_data($data) {
		$data = trim($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>

<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
	<input type="text" name="id" id="id" value="<?php echo $id; ?>" />
	<table>
		<tr>
			<td>USERNAME</td>
			<td>
				<input type="text" name="user" id="user" placeholder="Write username here." value="<?php echo $user; ?>" />
				<span><?php echo $err_user; ?></span>
			</td>
		</tr>
		<tr>
			<td>PASSWORD</td>
			<td>
				<input type="text" name="password" id="password" placeholder="Write password here." value="<?php echo $password; ?>" />
				<span><?php echo $err_password; ?></span>
			</td>
		</tr>
		<tr>
			<td>FULLNAME</td>
			<td>
				<input type="text" name="fullname" id="fullname" placeholder="Write fullname here." value="<?php echo $fullname; ?>" />
				<span><?php echo $err_fullname; ?></span>
			</td>
		</tr>
		<tr>
			<td><input type="submit" name="Submit" id="Submit" value="Submit Record" ></td>
		</tr>
	</table>
</form>
<br/>

<table>
	<thead>
		<tr>
			<td>ID</td>
			<td>USERNAME</td>
			<td>PASSWORD</td>
			<td>FULLNAME</td>
			<td>UPDATE</td>
			<td>DELETE</td>
		</tr>
	</thead>
	<tbody>
		<?php while($row=$result->fetch_assoc()){ ?>
			<tr>
				<td><?php echo $row['id']; ?></td>
				<td><?php echo $row['user']; ?></td>
				<td><?php echo $row['password']; ?></td>
				<td><?php echo $row['fullname']; ?></td>
				<td><a href="index.php?edit=TRUE&id=<?php echo $row['id']; ?>">EDIT</a></td>
				<td><a href="index.php?delete=TRUE&id=<?php echo $row['id']; ?>">DELETE</a></td>
			</tr>
		<?php } ?>
	</tbody>
</table>