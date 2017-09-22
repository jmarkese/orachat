# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

    config.vm.box = "scotch/box"
    config.vm.network "private_network", ip: "192.168.33.10"
    config.vm.hostname = "scotchbox"
    config.vm.synced_folder ".", "/var/www", :mount_options => ["dmode=777", "fmode=666"]

    # Optional NFS. Make sure to remove other synced_folder line too
    #config.vm.synced_folder ".", "/var/www", :nfs => { :mount_options => ["dmode=777","fmode=666"] }


    config.vm.provision :shell, inline: <<DATABASE
echo "============================================"
echo "Create orachat database and orachat user"
echo "============================================"
mysql -u root -proot -Bs  <<DBSETUP
DROP DATABASE IF EXISTS orachat;
CREATE DATABASE orachat DEFAULT CHARACTER SET = utf8;
GRANT USAGE ON orachat.* TO 'orachat'@'%' IDENTIFIED BY 'orachat';
DROP USER 'orachat'@'%';
CREATE USER 'orachat'@'%' IDENTIFIED BY 'orachat';
GRANT USAGE ON orachat.* TO 'orachat'@'%' IDENTIFIED BY 'orachat';
GRANT ALL PRIVILEGES ON orachat.* to 'orachat'@'%';
FLUSH PRIVILEGES;
DBSETUP
DATABASE



    config.vm.provision :shell, inline: $apache = <<APACHE
echo "============================================"
echo "Apache Changes"
echo "============================================"
sudo cat > /etc/apache2/sites-enabled/scotchbox.local.conf <<VHOSTCONF
<VirtualHost *:80>
    DocumentRoot "/var/www/laravel55/public"
    ServerName orachat.dev
    ErrorLog "${APACHE_LOG_DIR}/orachat-error_log"
    CustomLog "${APACHE_LOG_DIR}/orachat-access_log" common
    <Directory "/var/www//laravel55/public">
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>
VHOSTCONF
cd /var/www/laravel55
cp .env.example .env
php artisan key:generate
sudo apt-get update
sudo apt-get install php7.0-xml -y
sudo apt-get install php7.0-mbstring -y
sudo service apache2 reload
rm composer.lock
composer install
php artisan migrate:fresh --seed
APACHE

end
