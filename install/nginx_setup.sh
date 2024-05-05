#!/bin/bash

# Install Nginx
sudo apt install nginx

# Start Nginx
sudo systemctl start nginx

# Enable Nginx to start on boot
sudo systemctl enable nginx

# Allow 'Nginx Full' in UFW firewall
sudo ufw allow 'Nginx Full'

# Display status of UFW
sudo ufw status
