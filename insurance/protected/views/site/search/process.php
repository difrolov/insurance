<?php

require_once 'class.search.php';

$config = array('localhost','root','','database');
$table = 'bizmain';
$key = 'biz_id';
$fields = array('biz_name','biz_address','biz_cat');

$keyword = $_POST['keyword'].' '.$_POST['location'];

$found = new search_engine($config);
$found->set_table($table);
$found->set_primarykey($key);
$found->set_keyword($keyword);
$found->set_fields($fields);

$result = $found->set_result();
print_r($result);

// Display the results
$data = join( ",", $result);
$sql = "SELECT * FROM bizmain WHERE biz_id IN ($data) ";
$process = @mysql_query($sql);
echo "<br><pre><table border=1>";
while ($row = mysql_fetch_object($process))
{
    echo "<tr>";
    echo "<td>".$row->biz_id."</td>";
    echo "<td>".$row->biz_name."</td>";
    echo "</tr>";
}
echo "</table>"

?>


