<!DOCTYPE html>
<!-- File name: viewscheduled.php
     Author: George Perez
     Class: CSCI 297 Fall 2018
     Description: This script will allow the professor to see which students have signed up for advising and at what time. -->


<head>
  <title>Scheduled Appointments (HW9)</title>
  <link href = "../sheet.css" type = "text/css" rel = "stylesheet"/>
</head>

<body>
  <ul class = "navbar">
		<li class = "navelement"><a class = "navlink" href = ../>Home</a></li>
		<li class = "navelement"><a class = "navlink" href = ../csci297.html>CSCI 297</a></li>
	</ul>

<h3 align = "center">
      Professor View<br>
</h3>
  <center>
  <table rules = all border = 5 cellpadding = "5">
  <tr>
  <td bgcolor = darkgrey colspan = 6 align = center><font color = black>Scheduled Appointments
  <tr>
  <td bgcolor = lightgrey>id      </td>
  <td bgcolor = lightgrey>Day     </td>
  <td bgcolor = lightgrey>Time    </td>
  <td bgcolor = lightgrey>Student </td>
  <td bgcolor = lightgrey>Notes   </td>
  <td bgcolor = lightgrey>Delete  </td>

  <?php
    // George Perez
    // Connect the database
    $DBconn = new mysqli("deltona.birdnest.org", "USER", "PASS", "DB");

    echo "<form method = 'post' action = 'viewscheduled.php'>";

    if(isset($_POST['delete'])) // If the user deleted an appointment
    {
      $toDelete = $_POST['delete'];
      $deletion = "DELETE FROM appointments WHERE id = '$toDelete'";
      mysqli_query($DBconn, $deletion);
    }

    if(isset($_POST['Notes'])) // If the user added a note
    {
      $toUpdate = $_POST['Notes'];
      $updateID = $_POST['id'];
      $update = "UPDATE appointments SET Notes = '$toUpdate' WHERE id = $updateID"; // Add a note to the
      mysqli_query($DBconn, $update);
    }

    // Submit and process the query for existing warehouses
    $query = "SELECT * FROM appointments WHERE Available = '0'";
    $query .= "ORDER BY Long_Date ASC;";
    $result = mysqli_query($DBconn, $query);

    $currentTime = time();
    while($row = mysqli_fetch_object($result))
    {
      // Checking if there are any appointments for today
      if(($row->Day_Num == date('dS', $currentTime)) && ($row->Month == date('M', $currentTime)) && ($row->Year == date('Y', $currentTime)))
      {
        $bgColor = "#ddddc5";
      }
      else
      {
        $bgColor = "";
      }
      echo("
        <tr>
        <td bgcolor = $bgColor> $row->id
        <td bgcolor = $bgColor> $row->Day $row->Month $row->Day_Num $row->Year
        <td bgcolor = $bgColor> $row->Time
        <td bgcolor = $bgColor> $row->Stu_First $row->Stu_Last
        <td bgcolor = $bgColor> $row->Notes
        <td bgcolor = $bgColor> <input type = 'submit' action = 'viewscheduled.php' name = delete value = '$row->id'>
          ");
    }

    echo "</form>";
  ?>
  </table>
  <form method = "post" action = "addappts.php">
  <br>
    <input type = submit value = "Add More Times">
  </form>

  <br>
  <form action='viewopen.php'>
    <input type='submit' value='View Available Appointments' />
  </form>

  <hr>

  <form method = "post" action = "viewscheduled.php">
    <pre>
     New Note:
id   <input type=text name="id" required>
Note <input type=text name="Notes">
     <input type = submit value = "Add Note"> <!-- Not required in case the user wants to clear the note -->
   </pre>
</body>
