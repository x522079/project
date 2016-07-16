<?php
$redis=new Redis();
$redis->connect('localhost','6379');
$redis->set('name','zhangsan');
$name=$redis->get('name');
echo $name;
