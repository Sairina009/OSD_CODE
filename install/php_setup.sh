#!/bin/bash

# Install PHP and PHP-FPM
sudo apt-get install php libapache2-mod-php php-mysql php-fpm
sudo apt-get install php7.4-fpm

# Configure PHP-FPM
sudo sed -i 's/^listen = .*/listen = \/var\/run\/php\/php7.4-fpm.sock/' /etc/php/7.4/fpm/pool.d/www.conf

# Restart PHP-FPM
sudo systemctl restart php7.4-fpm

# Configure Nginx
sudo sed -i 's/^fastcgi_pass .*/fastcgi_pass unix:\/run\/php\/php7.4-fpm.sock;/' /etc/nginx/sites-available/kvmOct

# Test Nginx Configuration
sudo nginx -t

# Reload Nginx if test successful
if [ $? -eq 0 ]; then
    sudo systemctl reload nginx
    echo "Nginx configuration reloaded."
else
    echo "Nginx configuration test failed. Please check the configuration file for errors."
fi

# Download PHP Pages
sudo mkdir -p /var/www/html/od
# Assuming OSD_SOURCE_CODE folder contains PHP pages
sudo cp -r /home/acclivis/Downloads/OSD_SOURCE_CODE/* /var/www/html/od

# Give permissions to PHP files
sudo chmod -R 777 /var/www/html/od
sudo chmod -R 777 /var/www/html/od/cache
