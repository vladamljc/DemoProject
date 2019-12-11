# DemoProject
#My first project

Project's purpose is to be used as online catalog. Project is divided into two parts. One part 
is for administration of the website and the other one is for visitor(user of the catalog).

##Database constants:

| Name          | Default value      | Description                          |
| ------------- | ------------------ |--------------------------------------|
| DB_DRIVER     | mysql              | setting driver for database          |
| DB_HOST       | localhost          | setting where the site is hosted     |
| DB_NAME       | database name      | setting how is the database called   |                                  |
| DB_USER       | user's name        | setting username for database access |                                    |
| DB_PASS       | user's password    | setting password for database access |                                    |
| DB_PORT       | 80                 | setting listening port for mysql     |    

When setting database on local machine, set constant's values to your database settings.

##Routes

LOAD_ROUTES_FROM constant contains path to file where routes are defined.

                                 