<?php
// +----------------------------------------------------------------------+
// | PHP version 4.4.2                                                    |
// +----------------------------------------------------------------------+
// | Copyright (c) 2006, padik.blogspot.com                               |
// | All rights reserved.                                                 |
// |                                                                      |
// | Redistribution and use in source and binary forms, with or           |
// | without modification, are permitted provided that the                |
// | following conditions are met:                                        |
// |                                                                      |
// | 1. Redistributions of source code must retain the above copyright    |
// |    notice, this list of conditions and the following disclaimer.     |
// | 2. Redistributions in binary form must reproduce the above copyright |
// |    notice, this list of conditions and the following disclaimer in   |
// |    the documentation and/or other materials provided with the        |
// |    distribution.                                                     |
// | 3. Neither the name of padik.blogspot.com nor the name of the        |
// |    contributor may be used to endorse or promote products derived    |
// |    from this software without specific prior written permission.     |
// |                                                                      |
// | THIS SOFTWARE IS PROVIDED BY CONTRIBUTOR ``AS IS'' AND ANY EXPRESS   |
// | OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED    |
// | WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE   |
// | ARE DISCLAIMED. IN NO EVENT SHALL THE CONTRIBUTOR BE LIABLE FOR      |
// | ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR             |
// | CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT    |
// | OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS;      |
// | OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF        |
// | LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT            |
// | (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF        |
// | THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF      |
// | SUCH DAMAGE.                                                         |
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Rhoderick Espineda <padik@users.sourceforge.net>             |
// +----------------------------------------------------------------------+

class search_engine
{
    function __construct($mysql)
    {
        # set database connection
        $this->host = $mysql[0];
        $this->username = $mysql[1];
        $this->password = $mysql[2];
        $this->database = $mysql[3];
        $this->link = mysql_connect($this->host,$this->username,$this->password) or die(mysql_error());
        $this->db_selected = mysql_select_db($this->database,$this->link) or die(mysql_error());
        $this->found = array();
    }
    function set_table($table)
    {
        # set table
        $this->table = $table;
    }
    function set_keyword($keyword)
    {
        # set keywords
        $this->keyword = explode(" ", $keyword);
    }
    function set_primarykey($key)
    {
        # set primary key
        $this->key = $key;
    }
    function set_fields($field)
    {
        # set fieldnames to search
        $this->field =$field;
    }
    function set_dump()
    {
        # var dump objects
        echo '<pre>';
        var_dump($this->found);
        echo '</pre>';
    }
    function set_total()
    {
        # total results found
        return sizeof($this->found);
    }
    function set_result()
    {
        # find occurence of inputted keywords
        $key =  $this->key;
        for ($n=0; $n<sizeof($this->field); $n++)
        {
            for($i =0; $i<sizeof($this->keyword); $i++)
            {
                $pattern = trim($this->keyword[$i]);
                $sql = "SELECT * FROM ".$this->table." WHERE `".$this->field[$n]."` LIKE '%".$pattern."%'";
                $result = mysql_query($sql);
                while ($row = mysql_fetch_object($result) AND !empty($pattern))
                {
                    $this->found[] = $row->$key;
                }
            }
        }
        $this->found = array_unique($this->found);
        return $this->found;
    }
}

?>
