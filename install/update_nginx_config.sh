#!/bin/bash

# Define the path to the Nginx configuration file
nginx_conf="/etc/nginx/sites-available/kvmOct"

# Define the new configuration
nginx_config="
server {
    listen 80 default_server;
    listen [::]:80 default_server;

    root /var/www/html/;
    index index.php index.html index.htm index.nginx-debian.html;
    server_name _;

    location / {
        # Existing configuration for serving static files
        # try_files \$uri \$uri/ =404;
        # proxy_pass http://localhost:8080;
    }
    
    location /upload {
        # Existing configuration for proxying upload requests
        # proxy_pass http://localhost:8088;
    }

    location /rtsp-server {
        # Configuration for serving RTSP content
        # Add your RTSP server configuration here
        try_files \$uri \$uri/ =404;
    }

    location /od {
        # Configuration for handling PHP requests
        try_files \$uri \$uri/ /php/index.php\$is_args\$args;

        location ~ \.php$ {
            include snippets/fastcgi-php.conf;
            fastcgi_pass unix:/run/php/php7.4-fpm.sock;
            fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
            include fastcgi_params;
        }
    }

    location ~ /\.ht {
        deny all;
    }
}
"

# Backup the original configuration file
sudo cp $nginx_conf "${nginx_conf}.bak"

# Comment out everything in the existing configuration file
sudo sed -i '/^server {/,$ s/^/#/' $nginx_conf

# Append the new configuration to the Nginx configuration file
echo "$nginx_config" | sudo tee -a $nginx_conf > /dev/null

# Test Nginx configuration
sudo nginx -t

# If the configuration test passes, reload Nginx
if [ $? -eq 0 ]; then
    sudo systemctl reload nginx
    echo "Nginx configuration reloaded."
else
    echo "Nginx configuration test failed. Please check the configuration file for errors."
    # Restore the original configuration file
    sudo mv "${nginx_conf}.bak" $nginx_conf
fi
