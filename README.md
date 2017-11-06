# train-smart-payment-gateway
***

A payment gateway for users of the Train Smart app to subscribe to make use of the app.


## Prerequisites for LAMP(Linux/Apache/MySQL/PHP) stack

1) Install PHP 7.0 or 7.1 (reference: [installation in ubuntu](https://tecadmin.net/install-php-7-on-ubuntu/))

2) Install MySQL v5.7 (reference: [installation in ubuntu](https://www.digitalocean.com/community/tutorials/how-to-install-mysql-on-ubuntu-14-04))

3) Install Apache2 (reference: [installation in ubuntu](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-16-04))

4) Install Composer (reference: [installation in ubuntu](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-composer-on-ubuntu-14-04))

5) Install Node.js v8.7.0 & Npm v5.4.2 (reference: [installation in ubuntu](https://askubuntu.com/questions/594656/how-to-install-the-latest-versions-of-nodejs-and-npm-for-ubuntu-14-04-lts))

6) Upgrade Npm to the latest version (`$ sudo npm install npm -g`)

7) Install php extensions 

- In the case of PHP v7.0 (`$ sudo apt-get install php7.0-fpm php7.0-dom php7.0-intl php7.0-mbstring php7.0-xml php7.0-mysql php7.0-curl php7.0-mcrypt php7.0-cli php7.0-dev php7.0-zip php7.0-gd`)

- In the case of PHP v7.1 (`$ sudo apt-get install php7.1-fpm php7.1-dom php7.1-intl php7.1-mbstring php7.1-xml php7.1-mysql php7.1-curl php7.1-mcrypt php7.1-cli php7.1-dev php7.1-zip php7.1-gd`)


## Application Setup in the Local Dev Environment

Clone [trs-payment-gateway](https://github.com/throwsmartdev/trs-payment-gateway.git) repository to ~/apache2/htdocs/ folder, checkout your dev branch (or develop branch)

In the /path/to/app folder,

1) Create a .env file copying from .env.example.

2) Run `$ composer install` to install the necessary dependencies.

3) Run `$ npm install` to install the node modules & libraries by NPM. 

4) Run `$ npm run dev` to compile the JS/CSS/SCSS into a single files by Laravel Mix + Webpack.

5) Get the sql dump file from the remote dev database. Then import it into the local database.

6) Fill out all necessary parameters (local DB credentials) in .env file.

7) Run `$ php artisan key:generate` to generate a new APP_KEY.

8) Run `$ php artisan config:cache` to reflect the .env configuration.


## Running the application with LAMP stack on the remote server

Clone [trs-payment-gateway](https://github.com/throwsmartdev/trs-payment-gateway.git) repository to ~/var/www/ folder. Then repeat the above prerequisites & installation steps.

In the /path/to/app folder,

- File permissions (`$ sudo chmod -R 777 storage bootstrap/cache`)

- Create Apache VirtualHost. (reference: [configuration in ubuntu](https://tecadmin.net/install-laravel-framework-on-ubuntu/))


## Commands Reference
***

#### Command Line Tools

- composer

- artisan

- npm

- git

#### Artisan commands for laravel development process

In the ~/path/to/app folder,

- After changing the conf parameters of .env file or modifying the setting of ./config directory: `$ php artisan config:cache`.

- If some controller changes are not reflected after modifying them: `$ php artisan cache:clear`.

- If some views changes are not working immediately: `$ php artisan view:clear`.

- After changing the JS/CSS/SCSS/Images files, `$ npm run dev`. 


## Coding Style

- Use [PSR-1](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md) and [PSR-4](http://www.php-fig.org/psr/psr-4/) coding standards.

- PHP tab size is 4.

- Blade/HTML tab size is 2.

- SCSS/JavaScript tab size is 4.

- Translate tabs to spaces.

- Ensure newline at end of file.

- Trim trailing white space.
