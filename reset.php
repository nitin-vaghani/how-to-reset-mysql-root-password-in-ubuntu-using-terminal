If you have not allowed default no password then enable it first

sudo gedit /etc/phpmyadmin/config.inc.php

Search: AllowNoPassword

uncomment it.

After,

URL : https://stackoverflow.com/questions/16556497/how-to-reset-or-change-the-mysql-root-password/16556534

What worked for me (Ubuntu 16.04, mysql 5.7):

Stop MySQL

sudo service mysql stop

Make MySQL service directory.

sudo mkdir /var/run/mysqld

Give MySQL user permission to write to the service directory.

sudo chown mysql: /var/run/mysqld

Start MySQL manually, without permission checks or networking.

sudo mysqld_safe --skip-grant-tables --skip-networking &

On another console, log in without a password.

mysql -u root mysql

Then:

UPDATE mysql.user SET authentication_string=PASSWORD('YOURNEWPASSWORD'), plugin='mysql_native_password' WHERE User='root' AND Host='localhost';
EXIT;

Turn off MySQL.

sudo mysqladmin -S /var/run/mysqld/mysqld.sock shutdown

Start the MySQL service normally.

sudo service mysql start
