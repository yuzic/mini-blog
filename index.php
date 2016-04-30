<?php
require "boostrap.php";

(new \Aqua\Aqua)->init();
$app = new \App\Controller\Front;

//$query = 'SELECT * FROM users WHERE id <:id';
//
//
//$params = [
//    ':id' => 10
//];
//
//
//$result  =  \Aqua\Db\Connection::query($query, $params)->asArray();
//
//print_r($result);
//
//
//
//function save()
//{
//    $sql = 'INSERT INTO blog
//            (
//              title,
//              image_path,
//              text,
//              created_at,
//              modify_at
//            )
//            VALUES
//            (
//              :title,
//              :image_path,
//              :text,
//              :created_at,
//              :modify_at
//            )';
//
//    return  \Aqua\Db\Connection::query($sql, [
//        'title' => 'title',
//        'image_path' => 'path',
//        'text' => 'text',
//        'created_at' => time(),
//        'modify_at' => time(),
//    ]);
//}
//
//save();


$app->index();
