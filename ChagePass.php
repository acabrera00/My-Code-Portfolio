<?php
    include_once 'include/function.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

        <title>Secure Login: Registration Form</title>

        <style type="text/css">
		<!--
		.style1 {
			font-size: 12px;
			font-weight: bold;
		}
		-->
	</style>
    	<title>Change Password</title>
    </head>
    <body>
    <div id="pageContainer">
    
                <div id="mainContentAdmin">
                    <div style="width: 830px;text-align: center;">
                        <div style="margin: 0px auto; width: 350px;">
                            <div class="contentdiv">

        <center><h1 style="font-size:28px; color:#888888;">Change Password</h1></center>
        <?php
        if (!empty($error_msg))
        {
           echo $error_msg;
        }
        ?>
<!------------------------------------------------------------------------------->

<?php 
// display form if user has not clicked submit

if (!isset($_POST["btn_submit"])) {
?>
        <ul>
            <li>Passwords must be at least 6 characters long</li>
        </ul>
        <form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="change_form"><br>
        
            <center>
            Old Password:&#8198&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type='password' class='text' maxlength="30" name='oldPass' id='oldPass' /><br><br>

            New Password:&#8198&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type='password' class='text' maxlength="30" name='newPass' id='newPass' /><br><br>

            Confirm Password:&#8198&nbsp&nbsp&nbsp<input type='password' class='text' maxlength="40" name='confirm' id='confirm' /><br><br>

	    <input type="submit" value="Submit" name="btn_submit" onclick="return check(this.form, this.form.oldPass, this.form.newPass, this.form.confirm)" />
	    </center>
        
        </form>

<?php          
	} 
     	else
     	{  // the user has submitted the form
		$oldKey= $_POST['oldPass'];
	   	$newKey= $_POST['newPass'];
	   	$confirmPass = $_POST['confirm'];
     	   
     	   	if($goFurther == 0)
     	   	{
     	   		echo "<br><center>The old password is incorrect.</center>";
     	   		echo "<br><center><a href=\"ChangePass.php\">Please try again</a></center>";
     	   	}
     	   	else
     	   	{
     	   		echo "<br><center>Your password has been updated.</center>";
     	   	}
	}
?>
 
<script>
function check(testForm, oldPass, updatePass, confirmPass)
{
	if(updatePass.value != confirmPass.value)
     	{
     		alert("The new password and confirmation password don't match.");
     		return false;
     	}
     	else
     	{
     		if (confirmPass.value.length < 6)
    		{
        		alert("Passwords must be at least 6 characters long.  Please try again.");
        		return false;
    		}
    		else if (confirmPass.value.length > 100)
    		{
        		alert("Passwords must be 100 characters or less.  Please try again.");
        		return false;
    		}
	}

}
</script>

<br>
        <center><p><a href="Portal.php">Return to Portal</a></p></center>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>			
    </body>
</html>
