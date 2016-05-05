#Administration interface of Mobiilitiedekerho#

This repository contains Mobiilitiedekerho administration interface.

This project uses CakePHP framework: http://www.cakephp.org

###How to set up the dev environment###

- Install Apache 2, PHP 5 with intl and mysql extensions, MySQL server and client.

- Point Apache 2's webroot to webroot directory.

- Install composer with the command (in your home directory): curl -s https://getcomposer.org/installer | php

- Update CakePHP and its dependencies with the command (in repository root dir): php /path_to_home_dir/composer.phar update

####How to use use/test the administration interface####

Note: The administartion interface runs separately from the back-end server and communicates directly with the database so there is no need to have it running for testing the administration interface.

You need to start the database for using/testing the administartion interface.  
There are scripts in misc-mt for this. Simply running 'install_database.sh' will do this all for you.

- Create database mobiilitiedekerho and user mobiili.

- Grant user mobiili full access to mobiilitiedekerho database.

- Populate the database using scripts init_tables.sql and init_test_instances.sql
