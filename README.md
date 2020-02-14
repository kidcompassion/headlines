# Aggregator of Edmonton Headline Stories

This is a simple Laravel app that grabs, parses and displays headlines in an easy to review format. 

When running locally, start by running 
`composer self-update`
and 
`composer install`
to add dependencies.

To run with standard MAMP install, make sure .env has:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=8888
DB_DATABASE=headlines
DB_USERNAME=root
DB_PASSWORD=root
DB_SOCKET=/Applications/MAMP/tmp/mysql/mysql.sock