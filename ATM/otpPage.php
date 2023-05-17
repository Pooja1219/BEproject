<!DOCTYPE html>

<html>

<head>

    <title>OTP</title>

    <link rel="stylesheet" type="text/css" href="style.css">
    
   
</head>
<body>


     <form action="OtpVerification.php" name="myform" method="post">
     
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
        echo shell_exec("python mailViaOtp.py $email")


    ?>  
     <h2>Welcome <?php echo $First ; echo " ";  echo $last;?></h2>

        <?php if (isset($_GET['error'])) { ?>

            <p class="error"><?php echo $_GET['error']; ?></p>

        <?php } ?>

        <label>OTP</label>

        <input type="text" name="arya" id="card" placeholder="Enter OTP"><span id="numloc"></span><br>

        <button type="submit" name="submit">Submit</button>

     </form>

     <?php
                session_start();
                $name = $_POST['arya'];
                $_SESSION['arya'] = $name;
                
                

     ?>

    



</body>


</html>