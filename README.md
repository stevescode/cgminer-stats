cgminer-stats
=============

A Simple Script for Recording CGMiner Stats into an SQL Database

1. Add SQL and Miner details to the functions.inc.php file.

2. Create the SQL table using the create-table.sql script.

3. Copy the update-db.php file to your raspberry pi and schedule it to run the script as a cron job at your required interval.

4. Upload the index.php, style.css and functons.inc.php files onto your webserver to view the Database records.
