# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = '2'

@script = <<SCRIPT
# Install dependencies
apt-get update
apt-get install -y apache2 git curl sqlite3 php7.0 php7.0-bcmath php7.0-bz2 php7.0-cli php7.0-curl php7.0-intl php7.0-json php7.0-mbstring php7.0-opcache php7.0-soap php7.0-sqlite3 php7.0-pgsql php7.0-xml php7.0-xsl php7.0-zip libapache2-mod-php7.0

apt-get install -y postgresql-9.5 postgresql-contrib-9.5

APP_DB_USER="dev"
APP_DB_PASSWORD="dev"
APP_DB_NAME="dev"
POSTGRES_PASSWORD="postgres"
PG_CONF="/etc/postgresql/9.5/main/postgresql.conf"
PG_HBA="/etc/postgresql/9.5/main/pg_hba.conf"
echo -e "$POSTGRES_PASSWORD\n$POSTGRES_PASSWORD" | (sudo passwd postgres)
echo "host    $APP_DB_NAME      $APP_DB_USER             samenet                 md5" >> "$PG_HBA"
echo "client_encoding = utf8" >> "$PG_CONF"
service postgresql restart

cat << EOF | su - postgres -c psql
DROP USER $APP_DB_USER;
CREATE USER $APP_DB_USER WITH PASSWORD '$APP_DB_PASSWORD';
DROP DATABASE $APP_DB_NAME;
CREATE DATABASE $APP_DB_NAME WITH OWNER=$APP_DB_USER ENCODING='UTF8' TEMPLATE=template1;
EOF

echo "${APP_DB_PASSWORD}" | psql -h localhost -p 5432 -U "${APP_DB_USER}" -f /var/www/data/schema.sql "${APP_DB_NAME}"

# Configure Apache
echo "<VirtualHost *:80>
	DocumentRoot /var/www/public
	AllowEncodedSlashes On

	<Directory /var/www/public>
		Options +Indexes +FollowSymLinks
		DirectoryIndex index.php index.html
		Order allow,deny
		Allow from all
		AllowOverride All
	</Directory>

	ErrorLog ${APACHE_LOG_DIR}/error.log
	CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf
a2enmod rewrite
service apache2 restart

if [ -e /usr/local/bin/composer ]; then
    /usr/local/bin/composer self-update
else
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
fi

# Reset home directory of vagrant user
if ! grep -q "cd /var/www" /home/vagrant/.profile; then
    echo "cd /var/www" >> /home/vagrant/.profile
fi

SCRIPT

@scriptSetup = <<SCRIPT
composer install
composer development-enable
SCRIPT

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = 'bento/ubuntu-16.04'
  config.vm.network "forwarded_port", guest: 80, host: 8080
  config.vm.synced_folder '.', '/var/www'
  config.vm.synced_folder 'data', '/var/www/data',
	owner: "vagrant", group: "www-data",
	mount_options: ["dmode=775,fmode=664"]
  config.vm.provision 'shell', inline: @script
  config.vm.provision 'shell', inline: @scriptSetup, privileged: false

  config.vm.provider "virtualbox" do |vb|
	vb.customize ["modifyvm", :id, "--cableconnected1", "on"]
    vb.customize ["modifyvm", :id, "--memory", "1024"]
    vb.customize ["modifyvm", :id, "--name", "ZF Application - Ubuntu 16.04"]
  end
end
