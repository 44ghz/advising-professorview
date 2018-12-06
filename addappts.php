<!DOCTYPE html>
<!-- File name: addappts.php
     Author: George Perez
     Class: CSCI 297 Fall 2018
     Description: This is a script that is meant to go with HW9, and is used to add times to the database.
                  It will call sendappts.php.  -->

<form method="post" action="sendappts.php">

<head>
  <title>Add Times (HW9)</title>
  <link href = "../sheet.css" type = "text/css" rel = "stylesheet"/>
  <style>
  div
  {
    text-align: justify;
    text-justify: inter-word;
    border: 1px solid black;
    height: 540px;
    width: 500px;
    padding: 50px 50px 50px 50px;
    background-color: #95979b;
  }
  </style>
</head>

<body>
  <ul class = "navbar">
		<li class = "navelement"><a class = "navlink" href = ../>Home</a></li>
		<li class = "navelement"><a class = "navlink" href = ../csci297.html>CSCI 297</a></li>
	</ul>

<h3 align="center">
      Add new times for advising<br>
</h3>

<div class='center'>
  <table align='center'>
    <tr>
      <td><u>Day: </u></td>
      <td><u>Time:</u></td>
    </tr>
    <tr>

  <?php
  // George Perez
  define("DAYS_IN_ADVANCE", 28, false); // In case the calendar is meant to go farther

  function calendar()
  {
    $time = time();

    echo "<td>";
    for($j = 0; $j < DAYS_IN_ADVANCE ; $j++) // Cycle through each day in the upcoming time period
    {

      $day = $time + ($j * 86400); // Incrementing the day by the current day times the number of seconds in a day
      $weekendTest = date('w', $day); // Getting the numeric value of the day
      if(($weekendTest == 0) || ($weekendTest == 6)) // If the day is a Saturday or Sunday
      {
        continue;
      }
      echo "<input type='radio' name='date' value=" . date('D', $day) . "&nbsp" . date('M', $day) . "&nbsp" . date('dS', $day) . "&nbsp" . date('Y', $day) . date($day) . ">" . date('D M dS Y', $day) . "<br>";
      if($weekendTest == 5)
      {
        echo "<hr>";
      }
    }
    echo "</td>";

  }

  calendar();



  ?>
  <td>
    <p>
    <input type='checkbox' name='time[]' value='9:00am'>9:00am<br>
    <input type='checkbox' name='time[]' value='9:30am'>9:30am<br>
    <input type='checkbox' name='time[]' value='10:00am'>10:00am<br>
    <input type='checkbox' name='time[]' value='10:30am'>10:30am<br>
    <input type='checkbox' name='time[]' value='11:00am'>11:00am<br>
    <input type='checkbox' name='time[]' value='11:30am'>11:30am<br>
    <hr>
    <input type='checkbox' name='time[]' value='12:00pm'>12:00pm<br>
    <input type='checkbox' name='time[]' value='12:30pm'>12:30pm<br>
    <input type='checkbox' name='time[]' value='1:00pm'>1:00pm<br>
    <input type='checkbox' name='time[]' value='1:30pm'>1:30pm<br>
    <input type='checkbox' name='time[]' value='2:00pm'>2:00pm<br>
    <input type='checkbox' name='time[]' value='2:30pm'>2:30pm<br>
    <hr>
    <input type='checkbox' name='time[]' value='3:00pm'>3:00pm<br>
    <input type='checkbox' name='time[]' value='3:30pm'>3:30pm<br>
    <input type='checkbox' name='time[]' value='4:00pm'>4:00pm<br>
    <input type='checkbox' name='time[]' value='4:30pm'>4:30pm<br>
    <input type='checkbox' name='time[]' value='5:00pm'>5:00pm<br>
    <input type='checkbox' name='time[]' value='6:00pm'>6:00pm<br>
  </td>
  </tr>
  </table>

  <br>
  <center>
  <input type="submit" value="Add times">
  </form>
  <hr>
  <form action='viewopen.php'>
    <input type='submit' value='View Available Appointments' />
  </form>
</div>

</body>
