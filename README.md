# Faber-Ventures-Challenge-2017

This website was made for the faber ventures challenge, it was made from scratch using the laravel framework

### Installation and Deployment

* Install [SQLYog Community]
* Install [Wamp]
* Install [Composer]
* Create a New Database, this can be done via SQLyog by doing `Ctrl+D`, after having created a default connection
* Go to the project folder rename `.env.example` to `.env`
* In the new `.env` change the DB settings to the settings of the database created.
* Open the Command Prompt (Ctrl+R "cmd") and navigate to the project folder
* run `php artisan migrate` to create tables in the database
* run `ph artisan serve` to run server
* in a browser go to `localhost:8000` and see the website rolling


### Author

João Ramiro ramiro.animus@gmail.com

### License

See `License.md`

   [Composer]: <https://getcomposer.org/download/>
   [SQLYog Community]: <https://github.com/webyog/sqlyog-community/wiki/Downloads>
   [Wamp]: <http://www.wampserver.com/en/>
  
