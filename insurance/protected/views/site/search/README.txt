This is a basic MySQL search engine class you can use immediately to
your site. All you have to do is fill up basic database
configurations.

Steps:
    1. Specify your host, username, password in array form
    2. Specify the tablename you want to use
    3. Specify primary key field of the table
    4. Specify the fieldnames of the table you want to look up

Example:

/*
<?php

require_once 'class.search.php';

$config = array('localhost','root','','database');   // basic db configurations
$table = 'bizmain';                                  // tablename you want to search
$key = 'biz_id';                                     // primary key field of the table
$fields = array('biz_name','biz_address','biz_cat'); // fieldnames of the table
                                                     // you want to look up for keyword occurence

$keyword = $_POST['keyword'];

$found = new search_engine($config);
$found->set_table($table);
$found->set_primarykey($key);
$found->set_keyword($keyword);
$found->set_fields($fields);

$result = $found->set_result();
print_r($result);

?>
*/
