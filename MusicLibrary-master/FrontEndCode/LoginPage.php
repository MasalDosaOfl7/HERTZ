<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
    <title>LoginPage</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Merienda+One&display=swap');
    </style>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Jost&display=swap');
    </style>
    <link rel="stylesheet" type="text/css" href="loginpagefe.css">
    <script>
        //script to load new user registration page on click of sign up button.
        function NewUserRegistrationPage() {
                window.location.assign("NewUserRegister.php");
        }
    </script>
</head>
<body>
    <!--Form contains the login details and action:SELF to load the same page after the form is submitted on Submit button.-->
    <form name="loginform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <p id = "he"> <img src="logo.png" alt="" style="height: 57px;width:57px;">HERTZ</p>
    <div id="login_container">
                 <!--User Input fields to capture user entered info-->
                 <label><b>Username</b></label>
                 <input type="text" id="Uname" name="username" placeholder="Enter your username"/></br></br>
                 <label><b>Password</b></label><br>
                 <input type="password" name="password" id="Pass" placeholder="Enter your password"/></br></br><br>
                 <input type="submit" id="submit1" style="color: black;" value="LOG IN" name="submit"/>
                 <br/><br><br>
                 <label>New User? &nbsp;&nbsp;<button type="button" id="submit2" onclick ="javasript:NewUserRegistrationPage()">SIGN UP</button></label>
    </div>
    </form>
</body>
</html>
<?php
    //creates session for each user
    session_start();

    //when user submits the form on clicking the submit button, below code is executed in order to authenticate the user by validating the user data in database.

    if(isset($_POST['submit'])) 
    { 
        if (empty($_POST['username'])) {
            echo "<font color='red'><h3><center>* Enter Username!</center></h3></font>";
        }
        elseif(empty($_POST['password'])){
            echo "<font color='red'><h3><center>* Enter Password!</center></h3></font>";
        }
        else {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $conn=connectDB();
            //validates if user with the entered credentials exist in database. if yes proceed to next page.
            $query="select * from user where user_name='{$username}' and password= '{$password}'";
            $result=mysqli_query($conn,$query);
            if(mysqli_num_rows($result) > 0 ){

                echo "Success";
                $row=mysqli_fetch_array($result);
                $_SESSION['userID'] = $row['userID'];
                //$_SESSION["user_name"] = $[user_name];

            }
            else{
                echo "<font color='red'><h3><center>* Invalid Username or Password!</center></h3></font>";
            }       
        }

        //Once the user is succcessfully validated if user is admin then redirected to MusicLibrary_admin page else to MusicLibrary_user page.
        if(isset($_SESSION['userID'])) {
            if(($_SESSION['userID']) == 1){
                header("Location:MusicLibrary_admin.php");
            }
            else{
                header("Location:MusicLibrary_user.php");        
            }
        
        }
    }
    //function to connect to the db with login details and the database selection.
    //Modify the localhost,username,password,database name as per individual credentials.
    function connectDB()
    {
        $conn = mysqli_connect("localhost:3306", "root", "", "dbproject");   
        //echo"connected DB"     ;
        if (!$conn) 
        {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        return $conn;
    }
?>
