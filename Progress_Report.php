<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

	<style type="text/css">
		<!--
		.style1
		{
			font-size: 12px;
			font-weight: bold;
		}
		
		textarea
		{
    			resize: none;
     		}
		-->
	</style>
    <title>After Action Report</title>
<script>
	window.onload = function() 
	{
		document.getElementById('month').onchange = newDayLimit;
		document.getElementById('year').onchange = newDayLimit;
		document.getElementById('day').onchange = weeklyDate;
	}

	// This function will allow or restrict the user for picking certain day depending on the month that they choose
	function newDayLimit()
	{
		if ( document.getElementById('month').value == 2 )
		{
			if ( (document.getElementById('year').value % 4) )
                        {
                             document.getElementById('day29').disabled = true;
			     document.getElementById('day30').disabled = true;
                             document.getElementById('day31').disabled = true;
			     document.getElementById('day').value = '';
                        }
                        else
                        {
                             document.getElementById('day29').disabled = false;
			     document.getElementById('day30').disabled = true;
                             document.getElementById('day31').disabled = true;
			     document.getElementById('day').value = '';
                        }
		}
		else if (document.getElementById('month').value == 4 || document.getElementById('month').value == 6 || 
		         document.getElementById('month').value == 9 || document.getElementById('month').value == 11 )
		{
			document.getElementById('day29').disabled = false;
			document.getElementById('day30').disabled = false;
                        document.getElementById('day31').disabled = true;
			document.getElementById('day').value = '';
		}
        	else
		{
			document.getElementById('day29').disabled = false;
			document.getElementById('day30').disabled = false;
                        document.getElementById('day31').disabled = false;
			document.getElementById('day').value = '';
		}
	}
	
	function weeklyDate()
	{		
            var date = document.getElementById('day').value;
            var month = document.getElementById('month').value;
            var year = document.getElementById('year').value;

            //Is this a leap year? TRUE = 1, FALSE = 0.
            var isLeapYear;
            
            if (year % 4 != 0)
            {
                isLeapYear = 0;
            }
            else 
            {
                isLeapYear = 1;
            }
  
            //If it's a leap year, February has 29 days.
            var numDays =[ 31,28,31,30,31,30,31,31,30,31,30,31];
		if(isLeapYear == 1)
                {
			numDays[1] = 29;
		}

		//Creating a selected week. Create a var array 0-6, with strings formatted (mm/dd/yyyy)
		//If the Monday selected extends past the numDays, wrap using modulo and continue listing days.
	
		var week = new Array(7);

		for(var i = 0, d = date, m = month, y = year; i<7; ++i, ++d)
                {
                    //Extending into the next month...
                    if(d > numDays[m-1])
                    {
                        d = 1;
                        //And if it's December... rotate back to Jan, advance year +1.
			if(m==12)
                        {
                            m=1;
                            y++;
			}
			//Otherwise, advance the month mod 12 + 1.
			else
                        {
                            m =  (m%12)+1;
			}
                    }
                    
                    if(d.toString().length<2)
                    {
                        d = "0"+d;
                    }
                    
                    if(m.toString().length<2)
                    {
                        m = "0"+m;
                    }
                    
                    //add the completed date into the array.
                    week[i] = m+"/"+d+"/"+y;
                }
		//Use positions 0-6 to grab the days. Yay!
		document.getElementById("mDate").innerHTML = week[0];
		document.getElementById("tDate").innerHTML = week[1];
		document.getElementById("wDate").innerHTML = week[2];
		document.getElementById("trDate").innerHTML = week[3];
		document.getElementById("fDate").innerHTML = week[4];
		document.getElementById("satDate").innerHTML = week[5];
		document.getElementById("sunDate").innerHTML = week[6];

		//Convert the javascript array for php
		var arrayField = document.querySelector("[name=jsArray]");
		arrayField.value = JSON.stringify(week);
	}

	// This function will display or remove textboxs depending on the work option chosen for that specific day
	function blockDisplay(numDay)
	{
		var dayOption;
		var dayReasonRow;
		var dayTasksRow;
		var dayIssuesRow;
		var dayImprovementsRow;
		
		// Depending on the number given to the function the corresponding day will be available to change their text box visibility
		if (numDay == "1")
		{
			dayOption = "monday" + "Option";
			dayReasonRow = "monday" + "ReasonRow";
			dayTasksRow = "monday" + "TasksRow";
			dayIssuesRow = "monday" + "IssuesRow";
			dayImprovementsRow = "monday" + "ImprovementsRow";
		}
		else if (numDay == "2")
		{
			dayOption = "tuesday" + "Option";
			dayReasonRow = "tuesday" + "ReasonRow";
			dayTasksRow = "tuesday" + "TasksRow";
			dayIssuesRow = "tuesday" + "IssuesRow";
			dayImprovementsRow = "tuesday" + "ImprovementsRow";
		}
		else if (numDay == "3")
		{
			dayOption = "wednesday" + "Option";
			dayReasonRow = "wednesday" + "ReasonRow";
			dayTasksRow = "wednesday" + "TasksRow";
			dayIssuesRow = "wednesday" + "IssuesRow";
			dayImprovementsRow = "wednesday" + "ImprovementsRow";
		}
		else if (numDay == "4")
		{
			dayOption = "thursday" + "Option";
			dayReasonRow = "thursday" + "ReasonRow";
			dayTasksRow = "thursday" + "TasksRow";
			dayIssuesRow = "thursday" + "IssuesRow";
			dayImprovementsRow = "thursday" + "ImprovementsRow";
		}
		else if (numDay == "5")
		{
			dayOption = "friday" + "Option";
			dayReasonRow = "friday" + "ReasonRow";
			dayTasksRow = "friday" + "TasksRow";
			dayIssuesRow = "friday" + "IssuesRow";
			dayImprovementsRow = "friday" + "ImprovementsRow";
		}
		else if (numDay == "6")
		{
			dayOption = "saturday" + "Option";
			dayReasonRow = "saturday" + "ReasonRow";
			dayTasksRow = "saturday" + "TasksRow";
			dayIssuesRow = "saturday" + "IssuesRow";
			dayImprovementsRow = "saturday" + "ImprovementsRow";
		}
		else
		{
			dayOption = "sunday" + "Option";
			dayReasonRow = "sunday" + "ReasonRow";
			dayTasksRow = "sunday" + "TasksRow";
			dayIssuesRow = "sunday" + "IssuesRow";
			dayImprovementsRow = "sunday" + "ImprovementsRow";
		}
		
		// After a day has been chosen, depending on the work option of that day a certain text boxs will appear or disappear
		if ( document.getElementById(dayOption).value == 1 )
		{
		     document.getElementById(dayReasonRow).style.display = "none";
		     document.getElementById(dayTasksRow).style.display = "none";
		     document.getElementById(dayIssuesRow).style.display = "none";
		     document.getElementById(dayImprovementsRow).style.display = "none";
		}
		else if ( document.getElementById(dayOption).value == 2 ||
		          document.getElementById(dayOption).value == 3)
		{
		     document.getElementById(dayReasonRow).style.display = "none";
		     document.getElementById(dayTasksRow).style.display = "table-row";
		     document.getElementById(dayIssuesRow).style.display = "table-row";
		     document.getElementById(dayImprovementsRow).style.display = "table-row";
		}
		else if ( document.getElementById(dayOption).value == 4 )
		{
		     document.getElementById(dayReasonRow).style.display = "table-row";
		     document.getElementById(dayTasksRow).style.display = "table-row";
		     document.getElementById(dayIssuesRow).style.display = "table-row";
		     document.getElementById(dayImprovementsRow).style.display = "table-row";
		}
		else
		{
		     document.getElementById(dayReasonRow).style.display = "table-row";
		     document.getElementById(dayTasksRow).style.display = "none";
		     document.getElementById(dayIssuesRow).style.display = "none";
		     document.getElementById(dayImprovementsRow).style.display = "none";
		}
	}
	
	function checkSubmit()
	{
		return confirm("Are you sure you want to submit your AAR?");
	}
</script>	
	
	
</head>
    <body>
        <div id="pageContainer">
            <div id="mainContentAdmin">
                <div style="width: 830px;text-align: center;">
                    <div class="contentdiv">

                    <h1 style="text-align:center">After Action Report</h1>
            <?php 
            //This function will take the schedule option number for a specific day and will return the text associated with that option number.
            function scheduleString($choice)
            {
                 if($choice == "1")
                 {
                      return "Not Scheduled";
                 }
                 else if($choice == "2")
                 {
                      return "In Office";
                 }
                 else if($choice == "3")
                 {
                      return "Worked Remotely";
                 }
                 else if($choice == "4")
                 {
                      return "On Call (Called in)";
                 }
                 else if($choice == "5")
                 {
                      return "On Call (Not called in)";
                 }
                 else if($choice == "6")
                 {
                      return "Holiday";
                 }
                 else if($choice == "7")
                 {
                      return "Unpaid Time Off-Approved";
                 }
                 else if($choice == "8")
                 {
                      return "Unpaid Time Off-Extreme Circumstances";
                 }
                 else if($choice == "9")
                 {
                      return "Sick";
                 }
                 else if($choice == "10")
                 {
                      return "Suspended";
                 }
                 else if($choice == "11")
                 {
                      return "No Show";
                 }
                 else
                 {
                      return "No Call/No Show";
                 }
            }

            //This function will create the body of text needed for the report by taking in the schedule option number and the information taken
            // from a day's text fields and creates the body in the form it needs to be in.
            function dayBody($schedule, $dReason, $dTask, $dIssues, $dImprove)
            {
                 $dBody = "";

                 $txtReasons = "<p name='txtMReasons' style='text-align:left; padding-left:5em;'><i>Reasons:</i> $dReason</p>";
                 $txtTasks = "<p name='txtMTasks' style='text-align:left; padding-left:5em;'><i>Tasks:</i> $dTask</p>";
                 $txtIssues = "<p name='txtMIssues' style='text-align:left; padding-left:5em;'><i>Issues:</i> $dIssues</p>";
                 $txtImprovements = "<p name='txtMImprovements' style='text-align:left; padding-left:5em;'><i>Improvements:</i> $dImprove</p>";

                 if ( $schedule == "1" )
                 {
                      $dBody = "<br>";
                      return $dBody;
                 }
                 else if ( $schedule == "2" || $schedule == "3")
                 {
                      $dBody = $txtTasks;
                      $dBody .= $txtIssues;
                      $dBody .= $txtImprovements;
                      return $dBody;
                 }
                 else if ( $schedule == "4" )
                 {
                      $dBody = $txtReasons;
                      $dBody .= $txtTasks;
                      $dBody .= $txtIssues;
                      $dBody .= $txtImprovements;
                      return $dBody;
                 }
                 else
                 {
                      $dBody = $txtReasons;
                      return $dBody;
                 }

                 return "This is out of the if statement.";
            }
           
            // display form if user has not clicked submit
            if (!isset($_POST["btn_submit"])) 
            {
            ?>

      <!--This will be the form that will hold the information of the entire page.-->
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

           <!--This table is designed for the date of Monday-->
           <table border="0" cellpadding="1" cellspacing="2" width="800">
                <tbody>

			<input type="hidden" name="jsArray" />

                <tr>
                     <td align="right" valign="middle" style="font-size:11px;width:48%">The date of Monday:</td>

                     <!--This section is for the Month of the Monday-->
                     <td align="right" valign="middle" style="width:5%">
                          <select name="month" id="month" style="font-size:12px">
                               <option value="01">Jan</option>
                               <option value="02">Feb</option>
                               <option value="03">Mar</option>
                               <option value="04">Apr</option>
                               <option value="05">May</option>
                               <option value="06">Jun</option>
                               <option value="07">Jul</option>
                               <option value="08">Aug</option>
                               <option value="09">Sep</option>
                               <option value="10">Oct</option>
                               <option value="11">Nov</option>
                               <option value="12">Dec</option>
                          </select>
                     </td>

                     <!--This section is for the Day of the Monday-->
                     <td align="center" valign="middle" style="width:7.5%">/
                         <select name="day" id="day" style="font-size:12px" required>
                               <option selected disabled></option>
                               <option value="01">01</option>
                               <option value="02">02</option>
                               <option value="03">03</option>
                               <option value="04">04</option>
                               <option value="05">05</option>
                               <option value="06">06</option>
                               <option value="07">07</option>
                               <option value="08">08</option>
                               <option value="09">09</option>
                               <option value="10">10</option>
                               <option value="11">11</option>
                               <option value="12">12</option>
                               <option value="13">13</option>
                               <option value="14">14</option>
                               <option value="15">15</option>
                               <option value="16">16</option>
                               <option value="17">17</option>
                               <option value="18">18</option>
                               <option value="19">19</option>
                               <option value="20">20</option>
                               <option value="21">21</option>
                               <option value="22">22</option>
                               <option value="23">23</option>
                               <option value="24">24</option>
                               <option value="25">25</option>
                               <option value="26">26</option>
                               <option value="27">27</option>
                               <option value="28">28</option>
                               <option value="29" id="day29">29</option>
                               <option value="30" id="day30">30</option>
                               <option value="31" id="day31">31</option>
                          </select>
                     </td>

                     <!--This section is for the Year of the Monday-->
                     <td align="left" valign="middle" style="width:9%">/
                          <select name="year" id="year" style="font-size:12px">
                               <option value="10">2010</option>
                               <option value="11">2011</option>
                               <option value="12">2012</option>
                               <option value="13">2013</option>
                               <option value="14">2014</option>
                               <option value="15" selected>2015</option>
                               <option value="16">2016</option>
                               <option value="17">2017</option>
                               <option value="18">2018</option>
                               <option value="19">2019</option>
                               <option value="20">2020</option>
                          </select>        
                     </td>
                     
                     <!--This section is used to center the rest of the information fields on the page-->
                     <td style="width:33%"></td>
                </tr>
                
                </tbody>
           </table>

           <table border="0" cellpadding="4" cellspacing="2" width="800">
                <tbody>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Beginning Monday''s Section ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!-- This section gives a drop down box with options to choose from.  Depending on the option the user picks a certain amount
                     of text and text areas with become visible.-->
                <tr>
		     <td align="right" valign="middle" width="42%" style="font-size:13px">Monday(<span id="mDate"></span>):</td>
                     <td align="left" valign="middle" style="width:58%">
                          <select name="mondayOption" id="mondayOption" style="font-size:12px" onchange = "blockDisplay(1)" required>
                          <option selected disabled></option>
                               <option value="1">Not Scheduled</option>
                               <option value="2">In Office</option>
                               <option value="3">Worked Remotely</option>
                               <option value="4">On Call (Called in)</option>
                               <option value="5">On Call (Not called in)</option>
                               <option value="6">Holiday</option>
                               <option value="7">Unpaid Time Off-Approved</option>
                               <option value="8">Unpaid Time Off-Extreme Circumstances</option>
                               <option value="9">Sick</option>
                               <option value="10">Suspended</option>
                               <option value="11">No Show</option>
                               <option value="12">No Call/No Show</option>
                          </select>        
                     </td>
                </tr>
                
                <!--This tr is for the Reasons text box.  It initially starts off undisplayed until the user changes the schedule option to one of the associated
                    option with this text box-->
                <tr name="mondayReasonRow" id="mondayReasonRow" style="display:none;">
		     <td align="right" valign="top" style="font-size:12px">Reasons:</td>
		     <td align="left" valign="middle">
		     <textarea name="mondayReasons" cols="30" rows="8" id="mondayReason" maxlength="200" placeholder="Reasons why..." wrap="hard"></textarea>
		     </td> 
		</tr>
                
                <!--This tr is for the Tasks text box.  It initially starts off undisplayed until the user changes the schedule option to one of the associated
                    option with this text box-->
                <tr name="mondayTasksRow" id="mondayTasksRow" style="display:none;">
		     <td align="right" valign="top" style="font-size:12px">Tasks:</td>
		     <td align="left" valign="middle">
		     <textarea name="mondayTasks" cols="50" rows="10" id="mondayTasks" maxlength="1000" placeholder="Monday's Tasks" wrap="hard"></textarea>
		     </td> 
		</tr>
		
		<!--This tr is for the Issues text box.  It initially starts off undisplayed until the user changes the schedule option to one of the associated
                    option with this text box-->
		<tr name="mondayIssuesRow" id="mondayIssuesRow" style="display:none;">
		     <td align="right" valign="top" style="font-size:12px">Issues:</td>
		     <td align="left" valign="middle">
		     <textarea name="mondayIssues" cols="50" rows="10" id="mondayIssues" maxlength="1000" placeholder="Monday's Issues" wrap="hard"></textarea>
		     </td> 
		</tr>
		
		<!--This tr is for the Improvements text box.  It initially starts off undisplayed until the user changes the schedule option to one of the associated
                    option with this text box-->
		<tr name="mondayImprovementsRow" id="mondayImprovementsRow" style="display:none;">
		     <td align="right" valign="top" style="font-size:12px">Improvement:</td>
		     <td align="left" valign="middle">
		     <textarea name="mondayImprovements" cols="50" rows="10" id="mondayImprovements" maxlength="1000" placeholder="Monday's Improvements" wrap="hard"></textarea>
		     </td> 
		</tr>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Ending Monday''s Section ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Beginning Tuesday''s Section ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!-- This section gives a drop down box with options to choose from.  Depending on the option the user picks a certain amount
                     of text and text areas with become visible.-->
                <tr>
		     <td align="right" valign="middle" width="25%" style="font-size:13px">Tuesday(<span id="tDate" style="display:inline;"></span>):</td>
                     <td align="left" valign="middle" style="width:75%">
                          <select name="tuesdayOption" id="tuesdayOption" style="font-size:12px" onchange = "blockDisplay(2)" required>
                               <option selected disabled></option>
                               <option value="1">Not Scheduled</option>
                               <option value="2">In Office</option>
                               <option value="3">Worked Remotely</option>
                               <option value="4">On Call (Called in)</option>
                               <option value="5">On Call (Not called in)</option>
                               <option value="6">Holiday</option>
                               <option value="7">Unpaid Time Off-Approved</option>
                               <option value="8">Unpaid Time Off-Extreme Circumstances</option>
                               <option value="9">Sick</option>
                               <option value="10">Suspended</option>
                               <option value="11">No Show</option>
                               <option value="12">No Call/No Show</option>
                          </select>        
                     </td>
                </tr>
                
                <!--This tr is for the Reasons text box.  It initially starts off undisplayed until the user changes the schedule option to one of the associated
                    option with this text box-->
                <tr name="tuesdayReasonRow" id="tuesdayReasonRow" style="display:none;">
		     <td align="right" valign="top" style="font-size:12px">Reasons:</td>
		     <td align="left" valign="middle">
		     <textarea name="tuesdayReasons" cols="30" rows="8" id="tuesdayReason" maxlength="200" placeholder="Reasons why..." wrap="hard"></textarea>
		     </td> 
		</tr>
                
                <!--This tr is for the Tasks text box.  It initially starts off undisplayed until the user changes the schedule option to one of the associated
                    option with this text box-->
                <tr name="tuesdayTasksRow" id="tuesdayTasksRow" style="display:none;">
		     <td align="right" valign="top" style="font-size:12px">Tasks:</td>
		     <td align="left" valign="middle">
		     <textarea name="tuesdayTasks" cols="50" rows="10" id="tuesdayTasks" maxlength="1000" placeholder="Tuesday's Tasks" wrap="hard"></textarea>
		     </td> 
		</tr>
		
		<!--This tr is for the Issues text box.  It initially starts off undisplayed until the user changes the schedule option to one of the associated
                    option with this text box-->
		<tr name="tuesdayIssuesRow" id="tuesdayIssuesRow" style="display:none;">
		     <td align="right" valign="top" style="font-size:12px">Issues:</td>
		     <td align="left" valign="middle">
		     <textarea name="tuesdayIssues" cols="50" rows="10" id="tuesdayIssues" maxlength="1000" placeholder="Tuesday's Issues" wrap="hard"></textarea>
		     </td> 
		</tr>
		
		<!--This tr is for the Improvements text box.  It initially starts off undisplayed until the user changes the schedule option to one of the associated
                    option with this text box-->
		<tr name="tuesdayImprovementsRow" id="tuesdayImprovementsRow" style="display:none;">
		     <td align="right" valign="top" style="font-size:12px">Improvement:</td>
		     <td align="left" valign="middle">
		     <textarea name="tuesdayImprovements" cols="50" rows="10" id="tuesdayImprovements" maxlength="1000" placeholder="Tuesday's Improvements" wrap="hard"></textarea>
		     </td> 
		</tr>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Ending Tuesday''s Section ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Beginning Wednesday''s Section ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!-- This section gives a drop down box with options to choose from.  Depending on the option the user picks a certain amount
                     of text and text areas with become visible.-->
                <tr>
		     <td align="right" valign="middle" width="25%" style="font-size:13px">Wednesday(<span id="wDate" style="display:inline;"></span>):</td>
                     <td align="left" valign="middle" style="width:75%">
                          <select name="wednesdayOption" id="wednesdayOption" style="font-size:12px" onchange = "blockDisplay(3)" required>
                               <option selected disabled></option>
                               <option value="1">Not Scheduled</option>
                               <option value="2">In Office</option>
                               <option value="3">Worked Remotely</option>
                               <option value="4">On Call (Called in)</option>
                               <option value="5">On Call (Not called in)</option>
                               <option value="6">Holiday</option>
                               <option value="7">Unpaid Time Off-Approved</option>
                               <option value="8">Unpaid Time Off-Extreme Circumstances</option>
                               <option value="9">Sick</option>
                               <option value="10">Suspended</option>
                               <option value="11">No Show</option>
                               <option value="12">No Call/No Show</option>
                          </select>        
                     </td>
                </tr>
                
                <!--This tr is for the Reasons text box.  It initially starts off undisplayed until the user changes the schedule option to one of the associated
                    option with this text box-->
                <tr name="wednesdayReasonRow" id="wednesdayReasonRow" style="display:none;">
		     <td align="right" valign="top" style="font-size:12px">Reasons:</td>
		     <td align="left" valign="middle">
		     <textarea name="wednesdayReasons" cols="30" rows="8" id="wednesdayReason" maxlength="200" placeholder="Reasons why..." wrap="hard"></textarea>
		     </td> 
		</tr>
                
                <!--This tr is for the Tasks text box.  It initially starts off undisplayed until the user changes the schedule option to one of the associated
                    option with this text box-->
                <tr name="wednesdayTasksRow" id="wednesdayTasksRow" style="display:none;">
		     <td align="right" valign="top" style="font-size:12px">Tasks:</td>
		     <td align="left" valign="middle">
		     <textarea name="wednesdayTasks" cols="50" rows="10" id="wednesdayTasks" maxlength="1000" placeholder="Wednesday's Tasks" wrap="hard"></textarea>
		     </td> 
		</tr>
		
		<!--This tr is for the Issues text box.  It initially starts off undisplayed until the user changes the schedule option to one of the associated
                    option with this text box-->
		<tr name="wednesdayIssuesRow" id="wednesdayIssuesRow" style="display:none;">
		     <td align="right" valign="top" style="font-size:12px">Issues:</td>
		     <td align="left" valign="middle">
		     <textarea name="wednesdayIssues" cols="50" rows="10" id="wednesdayIssues" maxlength="1000" placeholder="Wednesday's Issues" wrap="hard"></textarea>
		     </td> 
		</tr>
		
		<!--This tr is for the Improvements text box.  It initially starts off undisplayed until the user changes the schedule option to one of the associated
                    option with this text box-->
		<tr name="wednesdayImprovementsRow" id="wednesdayImprovementsRow" style="display:none;">
		     <td align="right" valign="top" style="font-size:12px">Improvement:</td>
		     <td align="left" valign="middle">
		     <textarea name="wednesdayImprovements" cols="50" rows="10" id="wednesdayImprovements" maxlength="1000" placeholder="Wednesday's Improvements" wrap="hard"></textarea>
		     </td> 
		</tr>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Ending Wednesday''s Section ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Beginning Thursday''s Section ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!-- This section gives a drop down box with options to choose from.  Depending on the option the user picks a certain amount
                     of text and text areas with become visible.-->
                <tr>
		     <td align="right" valign="middle" width="25%" style="font-size:13px">Thursday(<span id="trDate" style="display:inline;"></span>):</td>
                     <td align="left" valign="middle" style="width:75%">
                          <select name="thursdayOption" id="thursdayOption" style="font-size:12px" onchange = "blockDisplay(4)" required>
                               <option selected disabled></option>
                               <option value="1">Not Scheduled</option>
                               <option value="2">In Office</option>
                               <option value="3">Worked Remotely</option>
                               <option value="4">On Call (Called in)</option>
                               <option value="5">On Call (Not called in)</option>
                               <option value="6">Holiday</option>
                               <option value="7">Unpaid Time Off-Approved</option>
                               <option value="8">Unpaid Time Off-Extreme Circumstances</option>
                               <option value="9">Sick</option>
                               <option value="10">Suspended</option>
                               <option value="11">No Show</option>
                               <option value="12">No Call/No Show</option>
                          </select>        
                     </td>
                </tr>
                
                <!--This tr is for the Reasons text box.  It initially starts off undisplayed until the user changes the schedule option to one of the associated
                    option with this text box-->
                <tr name="thursdayReasonRow" id="thursdayReasonRow" style="display:none;">
		     <td align="right" valign="top" style="font-size:12px">Reasons:</td>
		     <td align="left" valign="middle">
		     <textarea name="thursdayReasons" cols="30" rows="8" id="thursdayReason" maxlength="200" placeholder="Reasons why..." wrap="hard"></textarea>
		     </td> 
		</tr>
                
                <!--This tr is for the Tasks text box.  It initially starts off undisplayed until the user changes the schedule option to one of the associated
                    option with this text box-->
                <tr name="thursdayTasksRow" id="thursdayTasksRow" style="display:none;">
		     <td align="right" valign="top" style="font-size:12px">Tasks:</td>
		     <td align="left" valign="middle">
		     <textarea name="thursdayTasks" cols="50" rows="10" id="thursdayTasks" maxlength="1000" placeholder="Thursday's Tasks" wrap="hard"></textarea>
		     </td> 
		</tr>
		
		<!--This tr is for the Issues text box.  It initially starts off undisplayed until the user changes the schedule option to one of the associated
                    option with this text box-->
		<tr name="thursdayIssuesRow" id="thursdayIssuesRow" style="display:none;">
		     <td align="right" valign="top" style="font-size:12px">Issues:</td>
		     <td align="left" valign="middle">
		     <textarea name="thursdayIssues" cols="50" rows="10" id="thursdayIssues" maxlength="1000" placeholder="Thursday's Issues" wrap="hard"></textarea>
		     </td> 
		</tr>
		
		<!--This tr is for the Improvements text box.  It initially starts off undisplayed until the user changes the schedule option to one of the associated
                    option with this text box-->
		<tr name="thursdayImprovementsRow" id="thursdayImprovementsRow" style="display:none;">
		     <td align="right" valign="top" style="font-size:12px">Improvement:</td>
		     <td align="left" valign="middle">
		     <textarea name="thursdayImprovements" cols="50" rows="10" id="thursdayImprovements" maxlength="1000" placeholder="Thursday's Improvements" wrap="hard"></textarea>
		     </td> 
		</tr>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Ending Thursday''s Section ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Beginning Friday''s Section ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!-- This section gives a drop down box with options to choose from.  Depending on the option the user picks a certain amount
                     of text and text areas with become visible.-->
                <tr>
		     <td align="right" valign="middle" width="25%" style="font-size:13px">Friday(<span id="fDate" style="display:inline;"></span>):</td>
                     <td align="left" valign="middle" style="width:75%">
                          <select name="fridayOption" id="fridayOption" style="font-size:12px" onchange = "blockDisplay(5)" required>
                               <option selected disabled></option>
                               <option value="1">Not Scheduled</option>
                               <option value="2">In Office</option>
                               <option value="3">Worked Remotely</option>
                               <option value="4">On Call (Called in)</option>
                               <option value="5">On Call (Not called in)</option>
                               <option value="6">Holiday</option>
                               <option value="7">Unpaid Time Off-Approved</option>
                               <option value="8">Unpaid Time Off-Extreme Circumstances</option>
                               <option value="9">Sick</option>
                               <option value="10">Suspended</option>
                               <option value="11">No Show</option>
                               <option value="12">No Call/No Show</option>
                          </select>        
                     </td>
                </tr>
                
                <!--This tr is for the Reasons text box.  It initially starts off undisplayed until the user changes the schedule option to one of the associated
                    option with this text box-->
                <tr name="fridayReasonRow" id="fridayReasonRow" style="display:none;">
		     <td align="right" valign="top" style="font-size:12px">Reasons:</td>
		     <td align="left" valign="middle">
		     <textarea name="fridayReasons" cols="30" rows="8" id="fridayReason" maxlength="200" placeholder="Reasons why..." wrap="hard"></textarea>
		     </td> 
		</tr>
                
                <!--This tr is for the Tasks text box.  It initially starts off undisplayed until the user changes the schedule option to one of the associated
                    option with this text box-->
                <tr name="fridayTasksRow" id="fridayTasksRow" style="display:none;">
		     <td align="right" valign="top" style="font-size:12px">Tasks:</td>
		     <td align="left" valign="middle">
		     <textarea name="fridayTasks" cols="50" rows="10" id="fridayTasks" maxlength="1000" placeholder="Friday's Tasks" wrap="hard"></textarea>
		     </td> 
		</tr>
		
		<!--This tr is for the Issues text box.  It initially starts off undisplayed until the user changes the schedule option to one of the associated
                    option with this text box-->
		<tr name="fridayIssuesRow" id="fridayIssuesRow" style="display:none;">
		     <td align="right" valign="top" style="font-size:12px">Issues:</td>
		     <td align="left" valign="middle">
		     <textarea name="fridayIssues" cols="50" rows="10" id="fridayIssues" maxlength="1000" placeholder="Friday's Issues" wrap="hard"></textarea>
		     </td> 
		</tr>
		
		<!--This tr is for the Improvements text box.  It initially starts off undisplayed until the user changes the schedule option to one of the associated
                    option with this text box-->
		<tr name="fridayImprovementsRow" id="fridayImprovementsRow" style="display:none;">
		     <td align="right" valign="top" style="font-size:12px">Improvement:</td>
		     <td align="left" valign="middle">
		     <textarea name="fridayImprovements" cols="50" rows="10" id="fridayImprovements" maxlength="1000" placeholder="Friday's Improvements" wrap="hard"></textarea>
		     </td> 
		</tr>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Ending Friday''s Section ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Beginning Saturday''s Section ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!-- This section gives a drop down box with options to choose from.  Depending on the option the user picks a certain amount
                     of text and text areas with become visible.-->
                <tr>
		     <td align="right" valign="middle" width="25%" style="font-size:13px">Saturday(<span id="satDate" style="display:inline;"></span>):</td>
                     <td align="left" valign="middle" style="width:75%">
                          <select name="saturdayOption" id="saturdayOption" style="font-size:12px" onchange = "blockDisplay(6)" required>
                               <option selected disabled></option>
                               <option value="1">Not Scheduled</option>
                               <option value="2">In Office</option>
                               <option value="3">Worked Remotely</option>
                               <option value="4">On Call (Called in)</option>
                               <option value="5">On Call (Not called in)</option>
                               <option value="6">Holiday</option>
                               <option value="7">Unpaid Time Off-Approved</option>
                               <option value="8">Unpaid Time Off-Extreme Circumstances</option>
                               <option value="9">Sick</option>
                               <option value="10">Suspended</option>
                               <option value="11">No Show</option>
                               <option value="12">No Call/No Show</option>
                          </select>        
                     </td>
                </tr>
                
                <!--This tr is for the Reasons text box.  It initially starts off undisplayed until the user changes the schedule option to one of the associated
                    option with this text box-->
                <tr name="saturdayReasonRow" id="saturdayReasonRow" style="display:none;">
		     <td align="right" valign="top" style="font-size:12px">Reasons:</td>
		     <td align="left" valign="middle">
		     <textarea name="saturdayReasons" cols="30" rows="8" id="saturdayReason" maxlength="200" placeholder="Reasons why..." wrap="hard"></textarea>
		     </td> 
		</tr>
                
                <!--This tr is for the Tasks text box.  It initially starts off undisplayed until the user changes the schedule option to one of the associated
                    option with this text box-->
                <tr name="saturdayTasksRow" id="saturdayTasksRow" style="display:none;">
		     <td align="right" valign="top" style="font-size:12px">Tasks:</td>
		     <td align="left" valign="middle">
		     <textarea name="saturdayTasks" cols="50" rows="10" id="saturdayTasks" maxlength="1000" placeholder="Saturday's Tasks" wrap="hard"></textarea>
		     </td> 
		</tr>
		
		<!--This tr is for the Issues text box.  It initially starts off undisplayed until the user changes the schedule option to one of the associated
                    option with this text box-->
		<tr name="saturdayIssuesRow" id="saturdayIssuesRow" style="display:none;">
		     <td align="right" valign="top" style="font-size:12px">Issues:</td>
		     <td align="left" valign="middle">
		     <textarea name="saturdayIssues" cols="50" rows="10" id="saturdayIssues" maxlength="1000" placeholder="Saturday's Issues" wrap="hard"></textarea>
		     </td> 
		</tr>
		
		<!--This tr is for the Improvements text box.  It initially starts off undisplayed until the user changes the schedule option to one of the associated
                    option with this text box-->
		<tr name="saturdayImprovementsRow" id="saturdayImprovementsRow" style="display:none;">
		     <td align="right" valign="top" style="font-size:12px">Improvement:</td>
		     <td align="left" valign="middle">
		     <textarea name="saturdayImprovements" cols="50" rows="10" id="saturdayImprovements" maxlength="1000" placeholder="Saturday's Improvements" wrap="hard"></textarea>
		     </td> 
		</tr>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Ending Saturday''s Section ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Beginning Sunday''s Section ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!-- This section gives a drop down box with options to choose from.  Depending on the option the user picks a certain amount
                     of text and text areas with become visible.-->
                <tr>
		     <td align="right" valign="middle" width="25%" style="font-size:13px">Sunday(<span id="sunDate" style="display:inline;"></span>):</td>
                     <td align="left" valign="middle" style="width:75%">
                          <select name="sundayOption" id="sundayOption" style="font-size:12px" onchange = "blockDisplay(7)" required>
                               <option selected disabled></option>
                               <option value="1">Not Scheduled</option>
                               <option value="2">In Office</option>
                               <option value="3">Worked Remotely</option>
                               <option value="4">On Call (Called in)</option>
                               <option value="5">On Call (Not called in)</option>
                               <option value="6">Holiday</option>
                               <option value="7">Unpaid Time Off-Approved</option>
                               <option value="8">Unpaid Time Off-Extreme Circumstances</option>
                               <option value="9">Sick</option>
                               <option value="10">Suspended</option>
                               <option value="11">No Show</option>
                               <option value="12">No Call/No Show</option>
                          </select>        
                     </td>
                </tr>
                
                <!--This tr is for the Reasons text box.  It initially starts off undisplayed until the user changes the schedule option to one of the associated
                    option with this text box-->
                <tr name="sundayReasonRow" id="sundayReasonRow" style="display:none;">
		     <td align="right" valign="top" style="font-size:12px">Reasons:</td>
		     <td align="left" valign="middle">
		     <textarea name="sundayReasons" cols="30" rows="8" id="sundayReason" maxlength="200" placeholder="Reasons why..." wrap="hard"></textarea>
		     </td> 
		</tr>
                
                <!--This tr is for the Tasks text box.  It initially starts off undisplayed until the user changes the schedule option to one of the associated
                    option with this text box-->
                <tr name="sundayTasksRow" id="sundayTasksRow" style="display:none;">
		     <td align="right" valign="top" style="font-size:12px">Tasks:</td>
		     <td align="left" valign="middle">
		     <textarea name="sundayTasks" cols="50" rows="10" id="sundayTasks" maxlength="1000" placeholder="Sunday's Tasks" wrap="hard"></textarea>
		     </td> 
		</tr>
		
		<!--This tr is for the Issues text box.  It initially starts off undisplayed until the user changes the schedule option to one of the associated
                    option with this text box-->
		<tr name="sundayIssuesRow" id="sundayIssuesRow" style="display:none;">
		     <td align="right" valign="top" style="font-size:12px">Issues:</td>
		     <td align="left" valign="middle">
		     <textarea name="sundayIssues" cols="50" rows="10" id="sundayIssues" maxlength="1000" placeholder="Sunday's Issues" wrap="hard"></textarea>
		     </td> 
		</tr>
		
		<!--This tr is for the Improvements text box.  It initially starts off undisplayed until the user changes the schedule option to one of the associated
                    option with this text box-->
		<tr name="sundayImprovementsRow" id="sundayImprovementsRow" style="display:none;">
		     <td align="right" valign="top" style="font-size:12px">Improvement:</td>
		     <td align="left" valign="middle">
		     <textarea name="sundayImprovements" cols="50" rows="10" id="sundayImprovements" maxlength="1000" placeholder="Sunday's Improvements" wrap="hard"></textarea>
		     </td> 
		</tr>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Ending Sunday''s Section ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
               
                <tr>
                <br>
                     <td align="center" valign="middle" colspan="2"><input type="submit" name="btn_submit" value="Submit" onclick="return checkSubmit()"></td>
                </tr>
                </tbody>               
           </table>
      </form>
      
                        <?php 
                            } 
                            else 
                            {
                                date_default_timezone_set('America/New_York');

                                //These commands will grab the first and last name along with the user's e-mail address
                                $firstName = grabFName();
                                $lastName = grabLName();
                                $userMail = grabEMail();

                                //These commands will get the date of the monday based off the information given by the user in the AAR form.
                                $startMonth = $_POST['month'];
                                $startDay = $_POST['day'];
                                $startYear = $_POST['year'];

                                //This portion of the code gets the dates for each day ready to be put in to the e-mail.
                                $datesOfWeek = json_decode($_POST['jsArray']);
                                $dateMonday = $datesOfWeek[0];
                                $dateTuesday = $datesOfWeek[1];
                                $dateWednesday = $datesOfWeek[2];
                                $dateThursday = $datesOfWeek[3];
                                $dateFriday = $datesOfWeek[4];
                                $dateSaturday = $datesOfWeek[5];
                                $dateSunday = $datesOfWeek[6];

                                //Monday - scheduleString will get the text version of this day's schedule option number and dayBody will create the body of text for Monday.
                                $mondayOption = scheduleString($_POST['mondayOption']);
                                $mondayBody = dayBody($_POST['mondayOption'], $_POST['mondayReasons'], $_POST['mondayTasks'], $_POST['mondayIssues'], $_POST['mondayImprovements']);

                                //Tuesday - scheduleString will get the text version of this day's schedule option number and dayBody will create the body of text for Tuesday.
                                $tuesdayOption = scheduleString($_POST['tuesdayOption']);
                                $tuesdayBody = dayBody($_POST['tuesdayOption'], $_POST['tuesdayReasons'], $_POST['tuesdayTasks'], $_POST['tuesdayIssues'], $_POST['tuesdayImprovements']);

                                //Wednesday - scheduleString will get the text version of this day's schedule option number and dayBody will create the body of text for Wednesday.
                                $wednesdayOption = scheduleString($_POST['wednesdayOption']);
                                $wednesdayBody = dayBody($_POST['wednesdayOption'], $_POST['wednesdayReasons'], $_POST['wednesdayTasks'], $_POST['wednesdayIssues'], $_POST['wednesdayImprovements']);

                                //Thursday - scheduleString will get the text version of this day's schedule option number and dayBody will create the body of text for Thursday.
                                $thursdayOption = scheduleString($_POST['thursdayOption']);
                                $thursdayBody = dayBody($_POST['thursdayOption'], $_POST['thursdayReasons'], $_POST['thursdayTasks'], $_POST['thursdayIssues'], $_POST['thursdayImprovements']);

                                //Friday - scheduleString will get the text version of this day's schedule option number and dayBody will create the body of text for Friday.
                                $fridayOption = scheduleString($_POST['fridayOption']);
                                $fridayBody = dayBody($_POST['fridayOption'], $_POST['fridayReasons'], $_POST['fridayTasks'], $_POST['fridayIssues'], $_POST['fridayImprovements']);

                                //Saturday - scheduleString will get the text version of this day's schedule option number and dayBody will create the body of text for Saturday.
                                $saturdayOption = scheduleString($_POST['saturdayOption']);
                                $saturdayBody = dayBody($_POST['saturdayOption'], $_POST['saturdayReasons'], $_POST['saturdayTasks'], $_POST['saturdayIssues'], $_POST['saturdayImprovements']);

                                //Sunday - scheduleString will get the text version of this day's schedule option number and dayBody will create the body of text for Sunday.
                                $sundayOption = scheduleString($_POST['sundayOption']);
                                $sundayBody = dayBody($_POST['sundayOption'], $_POST['sundayReasons'], $_POST['sundayTasks'], $_POST['sundayIssues'], $_POST['sundayImprovements']);

                                $startYear = $startYear + 2000;

                                //This creates the final version of the Report to send out.
                                $email_from = 'AAR@mailer.mail';
                                $to = "TO@mailer.mail";
                                $cc = "CC@mailer.mail";
                                $bcc = "BCC@mailer.mail";
                                $email_subject = "AAR $firstName $lastName [$startMonth/$startDay/$startYear]";
                                $email_body =  "
                                                <html>
                                                <head>
                                                        <title>After Action Report for the week of $dateMonday</title>
                                                </head>
                                                <body>
                                                        <header>
                                                                <h1 style = 'text-align: center'>After Action Report</h1> 
                                                        </header>

                                                        <tr>
                                                                <td>
                                                                        <h2>Weekly Report</h2>
                                                                        <p>
                                                                                <b>Monday ($dateMonday)</b> -$mondayOption 
                                                                                        $mondayBody
                                                                                <b>Tuesday ($dateTuesday)</b> -$tuesdayOption 
                                                                                        $tuesdayBody
                                                                                <b>Wednesday ($dateWednesday)</b> -$wednesdayOption 
                                                                                        $wednesdayBody
                                                                                <b>Thursday ($dateThursday)</b> -$thursdayOption 
                                                                                        $thursdayBody
                                                                                <b>Friday ($dateFriday)</b> -$fridayOption 
                                                                                        $fridayBody
                                                                                <b>Saturday ($dateSaturday)</b> -$saturdayOption 
                                                                                        $saturdayBody
                                                                                <b>Sunday ($dateSunday)</b> -$sundayOption 
                                                                                        $sundayBody
                                                                        </p>
                                                                </td>
                                                        </tr>

                                                        <tr>
                                                                <td>
                                                                        <p>
                                                                                Regards,
                                                                                        <br><br>
                                                                                $firstName $lastName
                                                                        </p>
                                                                </td>
                                                        </tr>
                                                </body>
                                                </html>";

                                        $headers = array();
                                        $headers[] = "MIME-Version: 1.0";
                                        $headers[] = "Content-type: text/html; charset=iso-8859-1";
                                        $headers[] = "To: Test TO<$to>";
                                        $headers[] = "From: After Action Report<$email_from>"; 
                                        $headers[] = "Cc: Test CC <$cc1>";
                                        $headers[] = "Bcc: Test Bcc<$bcc>";
                                        $headers[] = "Reply-To: $firstName $lastName <$userMail>";
                                        $headers[] = "Subject: {$email_subject}";
                                        $headers[] = "X-Mailer: PHP/".phpversion();

                                mail($to,$email_subject,$email_body,implode("\r\n", $headers));

                                //This is just used to center the confirmation and return link.
                                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                echo "The After Action Report has been submitted!<br/>"; 
                                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                echo "<a href='portal.php'>Return to Portal</a>"; 
                            } //end else
                        ?>
                        <br>
                        <center><p><a href="Portal.php">Return to Portal</a></p></center>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
