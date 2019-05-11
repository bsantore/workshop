# Refactoring
This project is a base from PHPStorm and will be used as starting point for PHPhilly to refactor and build as neccesarry. This is a sample application used for learning purposues only. It should not be deployed and used in a production environment.

# Structural changes
* Moved html files into public
* Site now runs off of nginx

# Running the project
* Make sure you are running win 10 pro or enterprise
* [Install docker desktop](https://docs.docker.com/docker-for-windows/install/)
* Clone this repository
* [If you need to install PHP Composer for Windows](https://getcomposer.org/download/)
* I haven't included the vendor directory so Navigate to the project folder via command prompt
* type `Composer Install` (this installs everything in composer.json)
* Once this is done bring up your docker environment
* Type docker-compose up --build
* Wait for machine to load and then go to localhost:8080
* If things get weird try restarting Docker desktop
* You can also try docker network prune to make sure no weird networks are messing you up

# ToDo
* STILL NEEDS MYSQL to be added to Docker!!!!!!!!!
* Implement Twig, for templating
* Extract business logic of pages into src directory
* 