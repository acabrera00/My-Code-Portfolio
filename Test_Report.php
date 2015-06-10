<?php
    include_once 'includes/functions.php';
    require("includes/PHPMailer/class.phpmailer.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <style type="text/css">
        <!--
            .style1
            {
                font-size: 12px;
		font-weight: bold;
            }
	-->
    </style>
    <title>Report</title>
    <script>
        window.onload = function() 
	{
            document.getElementById('retryAmount').onchange = disableField;
            document.getElementById('results').onchange = disableComment;
	}
	
	function disableField()
	{
            if ( document.getElementById('retryAmount').value == 1 )
            {
		document.getElementById('retry1').style.display = "table-row";
		document.getElementById('retry11').value = "";
		document.getElementById('retry12').value = "";
		
		document.getElementById('retry2').style.display = "none";
		document.getElementById('retry21').value = "N/A";
		document.getElementById('retry22').value = "N/A";
            }
            else if ( document.getElementById('retryAmount').value == 2 )
            {
		document.getElementById('retry1').style.display = "table-row";
		document.getElementById('retry11').value = "";
		document.getElementById('retry12').value = "";
		
		document.getElementById('retry2').style.display = "table-row";
		document.getElementById('retry21').value = "";
		document.getElementById('retry22').value = "";
            }
            else
            {
		document.getElementById('retry1').style.display = "none";
		document.getElementById('retry11').value = "N/A";
		document.getElementById('retry12').value = "N/A";
			
		document.getElementById('retry2').style.display = "none";
		document.getElementById('retry21').value = "N/A";
		document.getElementById('retry22').value = "N/A";
            }
	}
	
	function disableComment()
	{
            if ( document.getElementById('results').value == "SP" )
            {
		document.getElementById('Excomment').style.display = "none";
		document.getElementById('Excomment').value = "";
            }
            else
            {
		document.getElementById('Excomment').style.display = "table-row";
		document.getElementById('Excomment').value = "";
            }
	}
	
	function checkInfo(form,startH, startM, finishH, finishM)
	{
            if(!validateInfo("hour", startH))
            {
		alert("Please enter a correct starting hour.");
		selectField("startH");
            }
            else if(!validateInfo("minute", startM))
            {
            	alert("Please enter a correct starting minute.");
		selectField("startM");
            }
            else if(!validateInfo("hour", finishH))
            {
                alert("Please enter a correct finishing hour.");
		selectField("finishH");
            }
            else if(!validateInfo("minute", finishM))
            {
            	alert("Please enter a correct finishing minute.");
		selectField("finishM");
            }
            else
            {
                return true;
            }
            
            return false;
	}
	
	function validateInfo(type, data)
	{
		var check;
                
		if(type == "hour")
		{
			check = data.value.test(/(^[0-9]$|^1[0-9]$|^2[0-3]$)/);
		}
		else if(type == "minute")
		{
			check = data.value.match(/^\d$|^[0-5]\d$/);
		}
		else
		{
			return false
		}
                
		if(check)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function selectField(whichField)
	{
		document.getElementById(whichField).select();
	}
</script>	

</head>
    <body>
        <div id="pageContainer">
            <div id="mainContentAdmin">
                <div style="width: 830px;text-align: center;">
                    <div style="margin: 0px auto; width: 810px;">
                        <div align="center" class="form">
                            
                            <?php 
                                // display form if user has not clicked submit
                                if (!isset($_POST["btn_submit"])) 
                                {
                            ?>
                            
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="post" id="FileUploader">
                                <table border="0" cellpadding="4" cellspacing="2"  width="500">
                                    <tbody>
                                       <!--This portion is for the radio button to choose which server the report was for.-->
                                       <tr>
                                            <td align="right" valign="middle" style="font-size:11px">System:</td>
                                            <td align="left" valign="middle" style="width:78%">
                                                    <select name="system" id="system" style="height:20px;font-size:10px" required>
                                                    <option value="1">Main</option>
                                                    <option value="2">Secondary</option>
                                                    <option value="3">Back Up</option>
                                                    </select>				
                                            </td>
                                        </tr>

                                       <tr>
                                            <td align="right" valign="middle" style="font-size:11px">Testing Type:</td>
                                            <td align="left" valign="middle" style="width:78%">
                                                    <select name="testType" id="testType" style="height:20px;font-size:10px" required>
                                                    <option value="1">Basic</option>
                                                    <option value="2">Internal</option>
                                                    <option value="3">Full System</option>
                                                    </select>				
                                            </td>
                                        </tr>

                                        <tr>
                                            <td align="right" valign="middle" style="font-size:11px">Test Started:</td>
                                            <td align="left" valign="middle">
                                                    <input name='startH' id='startH' type='number' placeholder="HH" min="00" max="23" maxlength="2" style="width:35px;font-size:11px" required> : 
                                                    <input name='startM' id='startM' type='number' placeholder="MM" min="00" max="59" maxlength="2" style="width:35px;font-size:11px" required>
                                                    (Ex. 20:57)
                                            </td>
                                        </tr>  

                                        <tr>
                                            <td align="right" valign="middle" style="font-size:11px">Test Finished:</td>
                                            <td align="left" valign="middle">
                                                    <input name='finishH' id='finishH' type='number' placeholder="HH" min="00" max="23" maxlength="2" style="width:35px;font-size:11px" required> : 
                                                    <input name='finishM' id='finishM' type='number' placeholder="MM" min="00" max="59" maxlength="2" style="width:35px;font-size:11px" required> 
                                                    (Ex. 15:46)
                                            </td>
                                        </tr>

                                        <!-- This section is for the retry section -->
                                        <tr>
                                            <td align="right" valign="middle" style="font-size:11px">Retry</td>
                                            <td align="left" valign="middle">
                                                    <select name="retryAmount" id="retryAmount" style="width:46px;font-size:10px">
                                                    <option value="0">00</option>
                                                    <option value="1">01</option>
                                                    <option value="2">02</option>
                                                    </select>				
                                            </td>
                                        </tr>

                                        <tr name="retry1" id="retry1" style="display:none;">
                                            <td align="right" valign="top" style="width:37px;font-size:11px">Test 2:</td>
                                            <td align="left" valign="middle">
                                                <select name="retryResults1" id="retryResults1" style="width:46px;font-size:10px">
                                                <option value="Passed">Passed</option>
                                                <option value="Failed">Failed</option>
                                                </select>
                                            </td> 
                                        </tr>

                                        <tr name="retry2" id="retry2" style="display:none;">
                                            <td align="right" valign="top" style="width:37px;font-size:11px">Test 3:</td>
                                            <td align="left" valign="middle">
                                                <select name="retryResults2" id="retryResults2" style="width:46px;font-size:10px">
                                                <option value="Passed">Passed</option>
                                                <option value="Failed">Failed</option>
                                                </select>
                                            </td> 
                                        </tr>
                                        <!-- End of the Retry section -->

                                        <tr>
                                            <td align="right" valign="middle" style="font-size:11px">Final Test Results:</td>
                                            <td align="left" valign="middle">
                                                    <select name="results" id="results" style="width:46px;font-size:10px">
                                                    <option value="SP">Passed</option>
                                                    <option value="SF">Failed</option>
                                                    </select>				
                                            </td>
                                        </tr>

                                        <tr name="Excomment" id="Excomment" style="display:none;">
                                            <td align="right" valign="middle" style="font-size:11px">Extra Comments:</td>
                                            <td align="left" valign="middle">
                                            <textarea name="extraComment" id="extraComment" cols="30" rows="8" maxlength="350" placeholder="Describe results here..." wrap="hard" required></textarea>
                                            </td> 
                                        </tr>

                                        <tr>
                                             <td align="left" valign="middle" colspan="2">
                                                    <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                                                    <label><br>
                                                            <span class="small"></span>
                                                    </label>
                                                    <input type="file" name="mFile" id="mFile" required>(Format: xlsx/xls)<br><br>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td align="right" valign="middle">&nbsp;</td>
                                            <td align="left" valign="middle">
                                                    <input type="hidden" name="loadtime" value="', time(), '">
                                                    <input type="submit" name="btn_submit" value="Submit" onclick="return checkInfo(this.form, this.form.startH,
                                                    this.form.startM, this.form.finishH, this.form.finishM)"/>
                                            </td>
                                       </tr>

                                    </tbody>
                                 </table>
                            </form>
                            <br>
                                
                            <?php               
                            } 
                            else 
                            {
                                $system = $_POST['system'];
                                
                                $testType = $_POST['testType'];
                                
                                $startTime = $_POST['startH'] . ":" . $_POST['startM'];

                                $finishTime = $_POST['finishH'] . ":" . $_POST['finishM'];
                                
                                $retry = $_POST['retryAmount'];
                                
                                $statement = "The test failed " . $retry . " times.";
                                
                                if($retry == 1)
                                {
                                    $statementContinue = "The first retest " . retryResults1 . ".\n\n";
                                    $statementContinue2 = "";
                                }
                                else if($retry == 2)
                                {
                                    $statementContinue = "The first retest " . retryResults1 . ".\n\n";
                                    $statementContinue2 = "The second retest " . retryResults2 . ".";
                                }
                                else
                                {
                                    $statementContinue = "";
                                    $statementContinue2 = "";
                                }

                                $systemResults = $_POST['results'];

                                if($systemResults == "SF")
                                {
                                    $extraC = $_POST['extraComment'];
                                }
                                else
                                {
                                    $extraC = " ";
                                }

                                $firstname = grabFName();
                                $lastname = grabLName();

                                $today = date("dmy"); 

                                $userMail = grabEMail();
                                
                                $testid = $today . $system;                              
                                
                                //-----------------------------------------------------------------------------------------------------------------------------------------------------------

                                //file upload 
                                //Upload Directory, ends with slash & make sure folder exist
                                $UploadDirectory    = 'uploads/'; 

                                if (!@file_exists($UploadDirectory)) 
                                {
                                    //destination folder does not exist
                                    die("Make sure Upload directory exist!");
                                }

                                if($_POST)
                                {
                                    if($_FILES['mFile']['error'])
                                    {
                                        //File upload error encountered
                                        die(upload_errors($_FILES['mFile']['error']));
                                    }

                                    $FileName       = strtolower($_FILES['mFile']['name']); //uploaded file name

                                    $FileTitle      = mysql_real_escape_string($_POST['mName']); // file title
                                    $ImageExt       = substr($FileName, strrpos($FileName, '.')); //file extension
                                    $FileType       = $_FILES['mFile']['type']; //file type

                                    $FileSize       = $_FILES['mFile']["size"]; //file size
                                    $uploaded_date  = date("Y-m-d H:i:s");

                                    switch(strtolower($FileType))
                                    {
                                        //allowed file types
                                        case "application/vnd.ms-excel": //ms excel file
                                            break;
                                        case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':// for .xlsx files
                                            break;
                                        default:
                                            die('Unsupported File!'); //output error
                                    }

                                    //File Title will be used as new File name
                                    $NewFileName = $testid.$ImageExt;

                                    //Rename and save uploded file to destination folder.
                                    if(move_uploaded_file($_FILES['mFile']["tmp_name"], $UploadDirectory . $NewFileName ))
                                    {

                                    }
                                    else
                                    {
                                        die('error uploading File!');
                                    }
                                }

                                $mail = new PHPMailer();
                                $mail->AddReplyTo($userMail);
                                $fileLocation = "upload/".$testid.$ImageExt;

                                $mail->SetFrom('Report@mailer.mail', 'Report');
                                $address = "Mailer@mailer.mail";

                                $mail->AddAddress($address, "Test");

                                $mail->AddAttachment($fileLocation);   

                                $mail->Subject  = "Test Report: " . $system;
                                $mail->Body     = "The Test for $system was completed. Please review the attached file for details.\n\n".
                                " Test Started at: $shour:$sminute  \n\n". 
                                " Test Completed at: $hour:$minute  \n\n". 
                                " $statement \n\n".
                                " $statementContinue $statementContinue2 \n\n".
                                " Final Test Results:\r\n results \n\n".
                                " $extraC";
                                $mail->WordWrap = 100;
                                
                                if(!$mail->Send()) 
                                {
                                    echo 'Message was not sent.';
                                    echo 'Mailer error: ' . $mail->ErrorInfo;
                                } 
                                else
                                {
                                    echo "&nbsp;&nbsp;&nbsp; The results have been submitted successfully<br/>"; 
                                    echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                    echo "<a href='report.php'>Click here to return : Report </a>"; 
                                }
                            }
    
                            //function outputs upload error messages
                            function upload_errors($err_code) 
                            {
                                switch ($err_code) 
                                {
                                    case UPLOAD_ERR_INI_SIZE:
                                        return 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
                                    case UPLOAD_ERR_FORM_SIZE:
                                        return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
                                    case UPLOAD_ERR_PARTIAL:
                                        return 'The uploaded file was only partially uploaded';
                                    case UPLOAD_ERR_NO_FILE:
                                        return 'No file was uploaded';
                                    case UPLOAD_ERR_NO_TMP_DIR:
                                        return 'Missing a temporary folder';
                                    case UPLOAD_ERR_CANT_WRITE:
                                        return 'Failed to write file to disk';
                                    case UPLOAD_ERR_EXTENSION:
                                        return 'File upload stopped by extension';
                                    default:
                                        return 'Unknown upload error';
                                }
                            }    
                            ?>
                            <br>
                            <center><p><a href="Portal.php">Return to Portal</a></p></center>
                        </div>
                    </div>      
                </div>
            </div>
	</div>
    </body>
</html>
