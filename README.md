BlissAdmin for the Bliss hive
=========

DayZ Administration panel. Windows-only version

Requirements
=========

MySQL 5.4 or higher

Apache 2.2 or higher

PHP 5.3 with short_open_tag = On (Should no longer be needed)

Same server as for DayZ and the same database (Currently Being update to remove this need)

Correctly installed and configured Battleye RCON


Features
=========

Lists of players and vehicles.

Player/vehicle inventory, states and position.

Google maps API based Cherno map with players and vehicles.

Inventory check for unknown items.

Search for items, vehicles, players.

Rcon-based online players list, kick-ban features and global messaging.

Reset Players locations.

Map removeal of deploables.


Installation
=========

Import dayz.sql to your database

Rename config.php-dist to config.php

Edit config.php to set right values. That is highly important!

Default login: admin/123456