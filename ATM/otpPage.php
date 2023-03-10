<!DOCTYPE html>

<html>

<head>

    <title>LOGIN</title>

    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        function phonenumber()
        {
            var x = document.myform.uname.value;
            //var x = /^\d{10}$/;
            if(isNaN(x))
                {
                    document.getElementById("numloc").innerHTML="Enter Numeric value only";
                    return false;
                }

            var length = x.toString().length;
            
            if(length>5 || length<5)
            {
                document.getElementById("numloc").innerHTML="Length of card number should be 5";
                return false;
            }
            else
                {
                    return true;               }
        }
</script>
   
</head>
<body>

     <form action="otpPage.php" name="myform" method="post" onsubmit="return phonenumber()">
     <?php
        require("../ATM/DB.php");
        session_start();
        $name = $_SESSION['uname'];
        if ( isset($_POST['uname'])){
            $name = $_POST['uname'];
            
        }
        $sql = "SELECT * FROM userdetails WHERE CardNo='$name'";
        $result = mysqli_query($conn, $sql);
        $info = mysqli_fetch_array( $result );
        $First=$info['FirstName'];
        $last=$info['LastName'];
        $email = $info['Email'];

        mysqli_close($conn);

    ?>  
     <h2>Welcome <?php echo $First ; echo " ";  echo $last;?></h2>

        <?php if (isset($_GET['error'])) { ?>

            <p class="error"><?php echo $_GET['error']; ?></p>

        <?php } ?>

        <label>Enter OTP</label>

        <input type="text" name="otp" id="card" placeholder="Enter OTP"><span id="numloc"></span><br>

        <button type="submit" name="submit">Submit</button>

     </form>

     <?php
$success = "";
$error_message = "";

		// generate OTP
		$otp = rand(100000,999999);
		// Send OTP
		$mail_status = sendOTP($email,$otp);
		
		if($mail_status == 1) {
			$result = mysqli_query($conn,"INSERT INTO otp_expiry(otp,is_expired,create_at) VALUES ('" . $otp . "', 0, '" . date("Y-m-d H:i:s"). "')");
			$current_id = mysqli_insert_id($conn);
			if(!empty($current_id)) {
				$success=1;
			}
		}
	

if(!empty($_POST["submit"])) {
	$result = mysqli_query($conn,"SELECT * FROM otp_expiry WHERE otp='" . $_POST["otp"] . "' AND is_expired!=1 AND NOW() <= DATE_ADD(create_at, INTERVAL 24 HOUR)");
	$count  = mysqli_num_rows($result);
	if(!empty($count)) {
		$result = mysqli_query($conn,"UPDATE otp_expiry SET is_expired = 1 WHERE otp = '" . $_POST["otp"] . "'");
		$success = 2;	
	} else {
		$success =1;
		$error_message = "Invalid OTP!";
	}	
}
mysqli_close($conn);
?>

    






</body>


</html>