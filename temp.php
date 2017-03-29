<?php
/**
 * Created by PhpStorm.
 * User: pawel
 * Date: 27.03.17
 * Time: 00:09
 */

require 'src/Photo.php';

define ('DB_DSN', 'mysql:dbname=sklep;host=localhost');
define ('DB_USER', 'root');
define ('DB_PASSWD', 'coderslab');
define ('DB_NAME', 'sklep');

$pdo = new PDO(DB_DSN, DB_USER, DB_PASSWD);

$photo = Photo::loadPhotoById($pdo, 1);

var_dump($photo);

echo $photo->getId();