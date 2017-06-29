#!/bin/bash

chown www-data:www-data -R /var/www/app/logs
chown www-data:www-data -R /var/www/app/cache
chown www-data:www-data -R /var/www/src/Frontend/Cache/
chown www-data:www-data -R /var/www/src/Frontend/Files/
chown www-data:www-data -R /var/www/library
chown www-data:www-data -R /var/www/app/config/
chown www-data:www-data -R /var/www/src/Backend/Cache/*
chown www-data:www-data -R /var/www/src/Backend/Cache/
chown www-data:www-data -R /var/www/src/Backend/