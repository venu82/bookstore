# bookstore
Test application for bookstore

You need to install composer to install the dependencies before running the application, more on how to install composer can be found here: https://getcomposer.org/download/

After installing the composer go to application root and issue the command <composer install> and it will start fetching the dependencies and in the process it will prompt for the database name, username and password. Providing those details will ensure connection to  MySql is established.


How to run the appication:
    unzip the folder to your web root either(apache or windows)
    Initialize the database by the following below
    Browse to home page
    http://localhost/bookstore/web/app_dev.php/Home
    your url might differ if you have any changes/setup done for virtual hosts
    you might have change the file permissions to writable for the below files:
          /bookstore/app/cache/dev/
          /bookstore/app/logs/

How to initialize dabase:

    to initialize the database you need to run the symfony's “console command line utility”.
    
    In your command prompt browse to /bookstore application directory and Issue the below commands sequentially.

    php app/console doctrine:database:create
    (This will create the database)

    php app/console doctrine:schema:update
    (This will create tables)

    php app/console csv:import –file=”path to books.csv”

    (Note: books.csv file is located in /bookstore application directory, so in the above you need to provide the path to books.csv file).
    This command will import the data from csv to database

Technologies and frameworks used:
    Symfony framework 2.8.*
    Twitter Bootstrap
    MySql
    Twig templating engine

Database Tables:
  Two tables are used in this application
    1. books
    2. orders

The books table is used to store the imported data from CSV
The orders table stores the douments purchased along with email, date and time.
 

Summary 

    Symfony framework has been used to develop this application as it provides:
    Doctrine, which provides ORM and with this application can be developed fast.
