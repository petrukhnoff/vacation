# vacation

## Structure

* **[index.php](index.php)** - file interface.

* **[scheme_db.sql](scheme_db.sql)** - database dump.

* **[includes](includes/):**
   * **[classes](includes/classes/):** - general classes.
   * **[app.php](includes/app.php):** - connection to the database,  includes files - config.php, autoload.php.
   * **[config.php](includes/config.php)** - database connection configuration.
   * **[autoload.php](includes/autoload.php)**: - autoload classes.

## Installation
* Cloning files on the repository.
* Import scheme_db.sql into database.
* In config.php configure the connection to the database.
* Use index.pxp as an interface.
