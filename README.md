## Setting up
<p>First thing first you need to have running docker and docker-compose on your
end. This setup uses the following platforms:</p>

* PHP 7 FPM
* MySQL 5.6
* NGINX 1.10

## Knowing the Services
<p>The setup consist of three services namely:</p>

* app - The Laravel application.
* database - The database of the app
* web - The service responsible for rendering the app which will be
the NGINX.

<p>These services are commonly used for building Laravel applications, you can
change the database and web services for your own preferences. And also you can
add your own services like redis, memcache or beanstalkd. The <b>app</b> service
can be modified by adding additional programs or packages like installing nodejs
or php extension imagick for image processing.</p>

## Installing Laravel
<p>There are many ways to get started with Laravel installation. But for this,
we prepare the following below:</p>

We’ll create a throw-away container which install new copy of Laravel in `tmp`
folder using the following command:
```
$ docker run --rm -v $(pwd):/var -w /var composer/composer \
    create-project --prefer-dist laravel/laravel tmp
```

It will just tell the docker to create and run a container from
`composer/composer` image then run the composer's `create-project` command.

After the installation you can now move all the content of `tmp` folder to your
project root. You can achieve it also using the following command:

```
$ docker run --rm -v $(pwd):/var -w /var bash \
    mv tmp/* /var && mv tmp/.[^.]* var/
```

You can also use `re-create.sh` script to do the same above.

```
$ bash re-create.sh
```

** Getting Started
<p>Initially you need to put up the services using docker-compose then from that
you may stop, pause or start them. See the following commands below or you may
go deeply at <a href="https://docs.docker.com/compose/reference/overview/">
docker-compose documentation</a>.</p>

<em>Take note that you should be running the following commands below inside
the directory where the `docker-compose.yml`</em> reside.

To start services in the background
```
$ docker-compose up -d
```

To start a stopped or paused service
```
$ docker-compose start [SERVICE..]
```

To stop a current running service
```
$ docker-compose start [SERVICE..]
```

To pause a current running service
```
$ docker-compose pause [SERVICE..]
```

To resume a paused service
```
$ docker-compose unpause [SERVICE..]
```

To remove all the services.
```
$ docker-compose rm
```
<em>I deeply encourage you to know more of these commands
<a href="https://docs.docker.com/compose/reference">here</a></em>

<em>This is derived from the blog: <a href="https://medium.com/@shakyShane/laravel-docker-part-1-setup-for-development-e3daaefaf3c">Laravel + Docker Part 1 — setup for Development</a> of <a href="https://medium.com/@shakyShane">Shane Osbourne</a></em>
