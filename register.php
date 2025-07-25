<?php
$title="TPAWU";
$subtitle="Register";
require_once("includes/header.php");
require_once("includes/config.php");
session_start();
?>
<script type="text/javascript">
    function validatePass() {
        if(document.myform.pasword.value != document.myform.pasword2.value){
            window.alert("Passowrd misMatch");
            document.myform.pasword.focus();
            return false;
        }

    return true;
    }
</script>


<?php
/**
 * Created by MAESTRO.
 * User: Maestro
 * Date: 25/07/2025
 * Time: 10:24
 */

//Check if form is submitted by POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST["email"]) && isset($_POST["pasword"]))
    {
        $userEmail =  filter_input(INPUT_POST, "email",FILTER_SANITIZE_SPECIAL_CHARS);
        $userName = filter_input(INPUT_POST, "name",FILTER_SANITIZE_SPECIAL_CHARS);
        $gender = filter_input(INPUT_POST, "gender",FILTER_SANITIZE_SPECIAL_CHARS);
        $userPass = filter_input(INPUT_POST, "pasword",FILTER_SANITIZE_SPECIAL_CHARS);
        $userPass2 = filter_input(INPUT_POST, "pasword2",FILTER_SANITIZE_SPECIAL_CHARS);

        if($userPass != $userPass2)
        {
            header('Location: '.'register.php?status=ms');die;
        }
        else{

        $sql ="SELECT * FROM sponsor WHERE sponsorEmail='$userEmail'";

        $result = $conn->query($sql);

        $check=0;
        if ($result->num_rows > 0) {


            header('Location: '.'register.php?status=f');die;
        }
        else{
            $query = "INSERT INTO sponsor(sponsorName,sponsorEmail,sponsorPassword,sponsorGender) VALUES('$userName','$userEmail','$userPass','$gender')";
            $exe = mysqli_query($conn,$query);
            if($exe)
            {
                header('Location: '.'register.php?status=t');die;
            }
            else{
                header('Location: '.'register.php?status=e');die;
            }
        }

        if($check==0)
        {
            $error="Invalid Email or Password";?>
            <div style="text-align:center;" class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign"></span>
                <?php echo $error?>
                <button type="button" class="close" data-dismiss="alert">x</button>
            </div>
            <?php
        }
        $conn->close();
    }

    }



}


?>




<?php
if (isset($_GET['status'])){
    if ($_GET['status'] == 't'){ ?>
        <div style="text-align:center;" class="alert alert-success" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            Changes saved successfully!
            <button type="button" class="close" data-dismiss="alert">x</button>
        </div>
        <?php
    }
    else  if ($_GET['status'] == 'f'){ ?>
        <div style="text-align:center;" class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            You have already registered
            <button type="button" class="close" data-dismiss="alert">x</button>
        </div>
        <?php
    }
    else if ($_GET['status'] == 'ms'){ ?>
        <div style="text-align:center;" class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            Password mismatch.
            <button type="button" class="close" data-dismiss="alert">x</button>
        </div>
        <?php
    }
    else if ($_GET['status'] == 'e'){ ?>
        <div style="text-align:center;" class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            Error!
            <button type="button" class="close" data-dismiss="alert">x</button>
        </div>
        <?php
    }
}

?>

<title>Register | TPAWU </title>


</head>

<body class="hold-transition login-page">
<div class="register-box">
    <!--
    <div class="login-logo">
        <a href="<?php echo siteroot;?>"><img src="./img/logo_type.png" alt="fyp_logo" class="img-responsive"></a>
    </div>
-->
    <!-- /.login-logo -->
    <p class="login-box-msg">
    <div class="login-box-body">
        <center><b>REGISTER</b></center></p>

    <form name="myform" action="" method="POST">
        <div class="form-group has-feedback">
            <label>Full Name</label>
            <input type="text" class="form-control" id="password" name="name" placeholder="Full Name" required>
            <span class="fa fa-edit form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
            <label>Email</label>
            <input type="email" class="form-control" name="email" placeholder="Email" data-toggle="validator" required autofocus >
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <label>Gender</label> <br/>
            <input type="radio" name="gender" value="Male" data-toggle="validator"> Male
            <input type="radio" name="gender" value="Female" data-toggle="validator" autofocus > Female
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <label>Password</label>
            <input type="password" class="form-control" id="password" name="pasword" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <label>Re-type Password</label>
            <input type="password" class="form-control" id="password" name="pasword2" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>


        <div class="row">
            <div class="col-xs-8">

            </div>
            <!-- /.col -->
            <div class="col-lg-12">
                <button type="submit"  onclick="validatePass()" class="btn btn-primary btn-block btn-flat">Register</button>
            </div>
            <!-- /.col -->
        </div>
    </form>

    <br />
    <a href="index.php" class="text-center">I already have a membership</a>

</div>
<!-- /.login-box-body -->
</div>
<?php require_once("includes/required_js.php");?>
</body>
</html>
