# advising-professorview
This is a tool for professors to use to schedule available advising times. 

/// Purpose ///

This was created for my course in PHP, in Fall 2018. The main goal of the program was to enable a professor to set advising times and see which students have registered for an appointment, along with the ability to delete appointments and set notes for students. This was accomplished by connecting to a MySQL database on the school's webserver.

/// How to use ///

The program is unable to be used at this time, and the database connection credentials have been censored. However, normally there would be a total of four scripts being used, which would allow the professor to see open times, scheduled times, and add appointments (the fourth script being the one that sends over the new appointments). This would be done through the browser, and the resulting information sent via PHP to the MySQL server to be added to the database.

/// How it works ///

This program works by taking information entered from the user in the webpage and sending it to the MySQL server via mysqli_queries in PHP. Once the professor adds a time, it will be available to see to both the professor and the students. The information is retrieved from the server and is output to a table format. Any appointments, scheduled or open, will be highlighted in yellow if they match the current day. 
