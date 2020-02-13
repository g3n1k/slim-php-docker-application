# first php docker application

## setup
lets get latest php image 
````
$ docker pull php:latest
````
create new folder and hello world file
````
mkdir app
echo "<?php echo 'hello world';?>" >> app/hello.php
````
now test the code with docker
````
docker run --rm -v $(pwd)/app/:/app php:latest php /app/hello.php
````
if everthing okay you can see
````
hello world
````
the code  
 `--rm` mean the docker only fire first and then shutdown  
 `-v` folder to mount in docker  
 `php /app/hello.php` execute php to file hello.php  

## lets download slim framework
we will using slim as framework, install with docker composer
````
docker run --rm -v $(pwd)/app:/app composer:latest require slim/slim "^3.0"
````
the output
````
Unable to find image 'composer:latest' locally
latest: Pulling from library/composer
c9b1b535fdd9: Pull complete 
c1c0a1817bec: Pull complete 
cdd5b3ea1fc3: Pull complete 
db87396003bd: Pull complete 
5fa47f19b1e8: Pull complete 
4556adb19ddc: Pull complete 
205de55b7ed0: Pull complete 
c35aa7da966a: Pull complete 
82a54ca6f814: Pull complete 
7814beba2ab0: Pull complete 
b13fbce728ae: Pull complete 
b57edc146252: Pull complete 
3129b3f701e3: Pull complete 
15289548f5ee: Pull complete 
997a01e12008: Pull complete 
Digest: sha256:956f09ecb7ed6985f98cbf180098e677f165227d067c29574cdd9131dac64754
Status: Downloaded newer image for composer:latest
./composer.json has been created
Loading composer repositories with package information
Updating dependencies (including require-dev)
Package operations: 5 installs, 0 updates, 0 removals
  - Installing psr/container (1.0.0): Downloading (100%)         
  - Installing nikic/fast-route (v1.3.0): Downloading (100%)         
  - Installing psr/http-message (1.0.1): Downloading (100%)         
  - Installing pimple/pimple (v3.2.3): Downloading (100%)         
  - Installing slim/slim (3.12.3): Downloading (100%)         
Writing lock file
Generating autoload files
````
this will download slim framework with his depedency

## what we will create ?

we will fetch data from [https://openweathermap.org/](https://openweathermap.org/) to get latest wheather  
you can register and get the key api there to using in app, but its need couple hours to activate  

## 00. clone the code
````
git clone https://github.com/g3n1k/slim-php-docker-application.git
````

## 01. test router
slim framework feels like echo framework in golang, first must declare the router  
now lets change our branch to `01_test_router`
````
git checkout 01_test_router
````
and see index.file

````
<?php require 'vendor/autoload.php';

// Initiate the APP object
$app = new \Slim\App();

// Declare routes
$app->get('location/{id}', function ($req, $res, $args){
    return $res->withStatus(200)->write("Location {$args['id']}");
});

$app->delete('location/{id}', function ($req, $res, $args){
    return $res->withStatus(200)->write("Location {$args['id']}");
});

// run the application
$app->run();
````

we create 2 end point `get` and `delete`  

now lets run our app for first time
````
docker run --rm -p 3800:80 -v $(pwd)/app:/var/www/html php:7.2-apache
````

and open browser to [localhost:3800/index.php/location/12](localhost:3800/index.php/location/12)
