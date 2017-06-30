#!/bin/bash

chown www-data:www-data -R /var/www/app/logs
chown www-data:www-data -R /var/www/app/cache
chown www-data:www-data -R /var/www/src/Frontend/Cache/
chown www-data:www-data -R /var/www/library
chown www-data:www-data -R /var/www/app/config/
chown www-data:www-data -R /var/www/src/Backend/Cache/
chown www-data:www-data -R /var/www/src/Backend/Cache/
chown www-data:www-data -R /var/www/src/Backend/

# moved
chown www-data:www-data -R /var/www/web/Cache/
chown www-data:www-data -R /var/www/web/Files/

# sudo chown thijzer:users -R ../src/chown www-data:www-data -R /var/www/src/Frontend/Files/
