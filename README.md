# OIC Website - Containerize Laravel Application By Docker Compose

To containerize a web application in lightweight environment known as containers, I use Docker Compose for the service, framework such as Laravel Application, Nginx Server, MySQL Database, phpMyAdmin...

| System | Language | Framework | Web Server | Database |
| ------- | -------- | --------- |----------|--------|
| Ubuntu 20.04 | PHP      | Laravel   | Nginx | MySQL (phpMyAdmin) |

## Introduction

OIC Website is website which allowed host user (host of event) to handle their event post (view, create, edit, delete), generete their invited code (event code) for their guest (guest of event). The invited code is way help that their guest are able to viewing the event and the guest could to post their comment on the event by create an account and log in.

![Homepage](images/oicapp.gif)    

## Features

### Host & Guest
The website has two role for users include:
- Host - Who create event post:
    - All of the guest features
    - Handle the event post with:
        - Create
        - View
        - Update (edit)
        - Delete
- Guest - Who invited by host:
    - View:
        - The detail information of event with the invited code [preview here](images/detail-event.jpg)
        - The basic information of the others
    - Sign up and Login:
        - With sign up or recovery password feature, User has to use their email to verify
    - Congrat or Comment (only user who is logged in)
    - Become to Host with logged in account

![View all events](images/view.jpg)

In the future, I will complete the card generation for the event with vary of template ^^

### Routes & Sitemap
- `/` : View an event with invited code
- `/about` : About OIC Website
- `/event` : View all events
    - `/event/{uuid}` : View an event
    - `/event/create` : Create new event
    - `/event/{uuid}/edit` : Edit an event
- `/login` : Log in
- `/register` : Register
- `/forgot-password`: Recovery password

## Containerize With `docker-compose`

As mentioned in head of this [README](README.md), I will use Docker Compose to containerized the project.

All of I wrote in [this docker-compose.yml](docker-compose.yml) and [Dockerfile](Dockerfile).


## Setup & Run
To run the OIC Website:
- Get this repo:

```shell
git clone https://github.com/nh4ttruong/oicapp
```
- I put the `.env.example` file [here](.env.example), copy and edit this file:

```shell
cd oicapp
cp .env.example .env
```
- Install `docker` and `docker-compose`
- After that, turn the containers up. The command below will up all containers in `docker-compose.yml` file. In local, your web app will appear on `http://localhost:8080` and your `phpMyAdmin` will appear on `http://localhost:8081`:

```shell
sudo docker-compose up -d
```
- Generate `APP_KEY` for your Laravel Application:

```shell
sudo docker-compose exec app php artisan key:generate
```
- Make `composer` up to date:

```shell
sudo docker-compose exec app composer update
#clear config cache
sudo docker-compose exec app php artisan config:cache
```
- Access mysql and grant for `mysql` user root **(this step is helpful when error appear suddently ^^)**:

```shell
sudo docker-compose exec db bash
mysql -u root -p
#type your database password in .env file
```
```mysql
mysql> show databases;
mysql> GRANT ALL ON oicappdb.* TO  '<your database username>'@'%' IDENTIFIED WITH '<your database password>';
mysql> FLUSH PRIVILEGES;
mysql> exit;
```
- Comeback the shell, make the seed file run (sample database):
```shell
sudo docker-compose exec app php artisan migrate:fresh --seed
sudo docker-compose exec app php artisan db:seed --class=PermissionSeeder
sudo docker-compose exec app php artisan db:seed --class=CreateRoleSeeder
```
- Make storage link for static source show up:
```shell
sudo docker-compose exec app php artisan storage:link
```
 If you can't make `/storage` public, you could to search the problem on stackoverfow or visit [File Storage - Laravel Documentation](https://laravel.com/docs/9.x/filesystem).

 Finaly, access `http://localhost:8080` to view OIC Website and `http://localhost:8081` to log in `phpMyAdmin` portal.

## Notes
Hi, maybe in the `Setup & Run` process, the bug will come up. Try to search it with Google to get the fixing way, all method are arround there (because I tried and got success ^^) - Good luck!
