RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' \
/etc/apache2/sites-available/*.conf \
/etc/apache2/apache2.conf
