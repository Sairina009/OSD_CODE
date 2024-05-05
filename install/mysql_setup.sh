#!/bin/bash

# Install MySQL server
sudo apt-get install mysql-server

# Login to MySQL and create new user and database
sudo mysql -u root -p <<MYSQL_SCRIPT
CREATE USER 'kvm'@'localhost' IDENTIFIED BY 'kvm2023';
CREATE DATABASE kvm;
GRANT ALL PRIVILEGES ON kvm.* TO 'kvm'@'localhost';
FLUSH PRIVILEGES;
quit
MYSQL_SCRIPT

# Import Database File (Replace /path/to/kvm.sql with the actual path)
sudo mysql -u root -p kvm < /home/acclivis/Downloads/OSD_SOURCE_CODE/DATABASE/kvm.sql