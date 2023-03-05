# logApp-scaling-octo
# logApp-scaling-octo

This repo is for Practice Set 5-06

1. I created my own database using WAMP64 and MySQL.
2.  To store the information in index.php and connect the data inside the MySQL, I fix the connection "config/config.php" and "config/db.php" 
    that is needed to run in every PHP page. I also replace at the bottom of the code my Github account.
3. I use " (isset($_POST['submit'])) " to set every input such as "lastname, firstname, address and the date and time stamp" in index.php,
    and use query to use database code that will distribute every input in the database that will be place.
4. To log in and view the list, in guestbook-login.php I connect the table of Account in MySQL to the page and if there's no such existing data from each row
    which are user and password then it will prompt a message that it is not valid to go another page.
5. In guestbook-list, i also connect the "config/config.php" and "config/db.php" for easy and fast way to show the database of "Hexzy" where will find the
    table "person", such that there's already a code foreach in PHP below, i replace the persons as "$result as $person" so, the date will be distributed 
    to every row that will be shown.
6. In the last part, i used " header('Location: guestbook-login.php') " to the page "guestbook-logout.php" to go back in the log-in page.
    
