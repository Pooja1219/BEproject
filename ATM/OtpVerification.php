<!DOCTYPE html>

<html>

<head>

    <title>OTP Verification</title>

    <link rel="stylesheet" type="text/css" href="style.css">
    
   
</head>
<body>


     <form name="myform2" method="post">
     
     <?php
       
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
        $retrivedOtp = $_SESSION['arya'];
        if ( isset($_POST['arya'])){
            $retrivedOtp = $_POST['arya'];
            
        }
        
        
        
        echo shell_exec("python VerificationOtp.py $retrivedOtp")


    ?>  
     

       
            

     </form>


</body>


</html>