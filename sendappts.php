<!DOCTYPE html>
<!-- File name: sendappts.php
     Author: George Perez
     Class: CSCI 297 Fall 2018
     Description: This is the script companion for addappts.php. It will add the times requested by the professor to the database. -->

<html>

<head>
  <title>Appointments Updated (HW9)</title>
  <link href = "../sheet.css" type = "text/css" rel = "stylesheet"/>
  <style>
  div
  {
    text-align: justify;
    text-justify: inter-word;
    border: 1px solid black;
    height: 160px;
    width: 400px;
    padding: 25px 50px 50px 50px;
    background-color: #95979b;
  }
  </style>

</head>

<body>
  <center>
  <ul class = "navbar">
		<li class = "navelement"><a class = "navlink" href = ../>Home</a></li>
		<li class = "navelement"><a class = "navlink" href = ../csci297.html>CSCI 297</a></li>
	</ul>


  <?php
  // George Perez
  echo "<p>";
  echo "<div>";

  if((!isset($_POST['time'])) && (!isset($_POST['date']))) // If no information was added
  {
    echo "<h3> Times have not been added</h3>";
    echo "Please provide a day and at least one time to add. <br>Use the button below to return to the selection page, or view appointments.<br><br>";
    echo "<form action='addappts.php'>
          <input type='submit' value='Add more times' />
          </form>
          <hr>
          <form action='viewopen.php'>
          <input type='submit' value='View Available Appointments' />
          </form>";
    echo "</div";
    exit;
  }

  if(isset($_POST['time'])) // If a time was added
  {
    $time = $_POST['time']; // Copy the array from the form
  }
  else // If a time was not added
  {
    echo "<h3> Times have not been added</h3>";
    echo "Please enter at least one time. <br>Use the button below to return to the selection page, or view appointments.<br><br>";
    echo "<form action='addappts.php'>
          <input type='submit' value='Add more times' />
          </form>
          <hr>
          <form action='viewopen.php'>
          <input type='submit' value='View Available Appointments' />
          </form>";
    echo "</div";
    exit;
  }

  if(!isset($_POST['date'])) // If no date was added
  {
    echo "<h3> Times have not been added</h3>";
    echo "Please enter a day. <br>Use the button below to return to the selection page, or view appointments. <br><br>";
    echo "<form action='addappts.php'>
          <input type='submit' value='Add more times' />
          </form>
          <hr>
          <form action='viewopen.php'>
          <input type='submit' value='View Available Appointments' />
          </form>";
    echo "</div";
    exit;
  }


  $timeCount = count($time, 0); // The number of times the user added
  $timeGrammar = "times";
  $wasGrammar = "were";

  if($timeCount == 1)
  {
    $timeGrammar = "time";
    $wasGrammar = "was";
  }

  // Connect the database
  $DBconn = new mysqli("deltona.birdnest.org", "USER", "PASS", "DB");

  $date = $_POST['date'];

  $Day = substr($date, 0, 3);
  $Month = substr($date, 8, 3);
  $DayNum = substr($date, 16, 4);
  $Year = substr($date, 25, 4);
  $LongDate = substr($date, 29);

  foreach($time as $nexttime) // For every time, add it to the end of the line
  {
    $query  = "INSERT INTO appointments (id, Day, Month, Day_Num, Time, Year, Long_Date) VALUES(NULL, '$Day', '$Month', '$DayNum', '$nexttime', '$Year', '$LongDate');";
    if(!mysqli_query($DBconn, $query))
    {
      echo "<h3> Times have not been added</h3>";
      echo "The time <strong>$nexttime</strong> has already been set as an appointment time for <strong>$Month $DayNum, $Year</strong>. <br>Use the button below to view the appointments. <br><br>";
      echo "<form action='viewopen.php'>
      <input type='submit' value='View Available Appointments' />
      </form>";
      exit;
    }
  }

  echo "<h3> Times have been added! </h3>";
  echo "$timeCount $timeGrammar $wasGrammar added. <br>Use the button below to add more times, or you can return to the viewing page.<br>";
  mysqli_close($DBconn);
  ?>

  <br>
  <form action="addappts.php">
    <input type="submit" value="Add more times" />
  </form>
  <hr>
  <form action="viewopen.php">
    <input type="submit" value="View Available Appointments" />
  </form>
  </div>
</body>

</html>
