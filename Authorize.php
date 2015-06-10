<?php
    include_once 'include/function.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

	<style type="text/css">
		<!--
		.style1 {
			font-size: 12px;
			font-weight: bold;
		}
		-->
	</style>
        
</head>
    <body>
	<div id="pageContainer">
            <div id="mainContentAdmin">
                <div style="width: 830px;">
                    <div style="margin: 0px auto; padding-left:20px; width: 810px;">
                        <div class="form" style="margin-left:250px">
                            <?php
                            function validateEmailAddress($email)
                            {
                                return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email);
                            }
                            ?>

                            <?php 
                                // display form if user has not clicked submit
                                if (!isset($_POST["btn_submit"])) {
                            ?>

                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <table border="0" cellpadding="4" cellspacing="2" width="500">
                                    <tbody>
                                        <tr>
                                            <td align="right" valign="middle" width="90">Email Address:</td>
                                            <td align="left" valign="middle" width="408">
                                                <input name="email"  size="15" maxlength="25" type="text">  
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right" valign="middle" width="90" style="font-size:11px">Account Type:</td>
                                            <td align="left" valign="middle" width="408">
                                                <select name="level" id="level" style="font-size:11px">
                                                <option value="Admin">Administrator</option>
                                                <option value="User">New User</option>
                                                <option value="Temp">Temp</option>
                                                </select>				
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right" valign="middle">&nbsp;</td>
                                            <td align="left" valign="middle">
                                                <input type="submit" name="btn_submit" value="Submit" />
                                            </td>
                                        </tr>	
                                    </tbody>
                                </table>
                            </form>

                            <?php 
                                } 
                                else
                                {  // the user has submitted the form
                                    if( isset($_POST['btn_submit']) )
                                    { 
                                        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                                        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
                                        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                                        {
                                            // Not a valid email
                                            $errors[] = 'Please enter a valid email';
                                        }

                                        //printing errors and allowing to try again   
                                        if( !empty($errors) ) 
                                        {
                                           foreach( $errors as $e ) echo "$e <br />";
                                           echo "<br><a href=\"Authorize.php\">Try Again</a>";
                                        }
                                        // if no errors email will be sent
                                        else
                                        {
                                            $level = $_POST['level'];
                                            if( strcmp($level, "Admin") )
                                            {
                                                $permission = "Admin";
                                            }
                                            else if( strcmp($level, "User") )
                                            {
                                                $permission = "User";
                                            }
                                            else
                                            {
                                                $permission = "Temp";
                                            }

                                            $length = 32;
                                            $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@*&^#$?";
                                            $randomString = '';
                                            for ($i = 0; $i < $length; $i++)
                                            {
                                                $randomString = $randomString . $characters[rand(0, strlen($characters) - 1)];
                                            }

                                                date_default_timezone_set('America/New_York');

                                                // send mail
                                                $errors = array();
                                                $sender = grabEMail();			
                                                
                                                //This section of the code is to sent out a reminder of who was authorized.
                                                $email_from = 'Authorize@mailer.mail';
                                                $email_subject = "Authorization";
                                                $email_body = "The following user has been given access for NexGen Service.\n". "\n Email address: $email\n".  
                                                " This user has been given access of level: $permission\n\n". 

                                                $to = "$sender";
                                                $headers = "From: $email_from \r\n"; 
                                                mail($to,$email_subject,$email_body,$headers);
                                                //End of Reminder section
                                                
                                                //This section of the code is to let the new user know their registatrion code
                                                $email_from = 'Authorize@mailer.mail';
                                                $email_subject = "Authorization";
                                                $email_body = "This an automated e-mail do not reply.\n\nThe following code is needed to complete your registration with our service's site\n\n".  
                                                "Registration Code: $randomString\n\n".
                                                "Please enter the code above in the Registration Code field on the register page.\n\n\n http://nexgenservices.us/register.php\n\n
                                                Either click the link below - or - copy and paste it into your browser address bar.\n\n\n ".

                                                $to = "$email";
                                                $headers = "From: $email_from \r\n"; 
                                                mail($to,$email_subject,$email_body,$headers);
                                                //End of Registration Code Section
                                                
                                                echo "Registration Code has been authorized, email has been sent"; 
                                                echo '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="authorize.php">Return<br><br></a>';
                                        }
                                    }
                                }
                            ?>
                            <br>
                            <p><a href="Portal.php">Return to Portal</a></p>
                        </div>
                    </div>			
                </div>
            </div>
	</div>
    </body>
</html>
