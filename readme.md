# The comment-o-matic api

## installation

1) Download docker

2) clone this repo 

`git clone git@github.com:rickshawhobo/comment-o-matic.git`

3) copy the env 

`cp comment-o-matic/comments/.env.example comment-o-matic/comments/.env`

4) start the docker containers 

`docker-compose -d nginx mysql`

5) run composer 

`docker-compose exec workspace composer --working-dir=comments install`

6) run migrate

`docker-compose exec workspace php comments/artisan migrate`

7) The api is now available on `localhost:8880/api`

8) Use the postman collection to test. Be sure to switch the environment to `dev`