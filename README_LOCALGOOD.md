# Document for LocalGood Edition

## Instration

* $ git clone https://github.com/LocalGood/Goteo.git .
* $ git checkout master
* $ chmod -R o+w ./data
* $ chmod o+w ./locale/ja_JP/LC_MESSAGES
* Access to URL you set on web server (Apache, Enginx etc..)
* Copy php configuration code and paste to ./local-settings.php
* Set you DB config in local-settings.php
* Import ./db/goteo.sql first and then the others
* Import LocalGood customization in ./db/localgood
* Access to /user/login and login by root / root
* Change your password for security

## Contributed by

* Masaki Hidano
* Souta Ito
* Masaki Ike
* Naoko Usui
* Shohei Sato
* Taiichiro Tokunaga

## Note

LocalGood Edition is currently operated only in Japanese. Nobody test for other languages.
