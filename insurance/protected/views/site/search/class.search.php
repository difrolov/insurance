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
{	private $arrStopWords=array("а","без","более","бы","был","была","были","было","быть","в","вам","вас","весь","во","вот","все","всего","всех","вы","где","да","даже","для","до","его","ее","если","есть","ещё","же","за","здесь","и","из","из-за","или","им","их","к","как","как-то","ко","когда","кто","ли","либо","мне","может","мы","на","надо","наш","не","него","неё","нет","ни","них","но","ну","о","об","однако","он","она","они","оно","от","очень","по","под","при","с","со","так","также","такой","там","те","тем","то","того","тоже","той","только","том","ты","у","уже","хотя","чего","чей","чем","что","чтобы","чьё","чья","эта","эти","это","я");
	public $keywords=array();
	
    function __construct()
    {
		$this->found = array();
    }
	public function getStopWords($asString=false){
		return ($asString)? "'".implode("','",$this->arrStopWords)."'":$this->arrStopWords;
	}
    function set_table($table)
    {
        # set table
        $this->table = $table;
    }
    function set_keyword($keywords)
    {
        # set keywords
        $this->keywords = explode(" ", $keywords);
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
    function set_result($fields_to_look)
    {	$stop_string=$this->getStopWords(true);
        # find occurence of inputted keywords
        $key =  $this->key;
        for ($n=0; $n<sizeof($this->field); $n++)
        {
            for($i=0,$k=sizeof($this->keywords); $i<$k; $i++)
            {	$pattern = trim($this->keywords[$i]);
				if (!in_array($pattern,$this->arrStopWords)){
					$field_content=$this->field[$n];
					// seek in insur_article_content:
					$sql = "SELECT id FROM ".$this->table." 
	 WHERE (";
					$where_sql=$and_not='';
					for($f=0,$l=count($fields_to_look);$f<$l;$f++) {
						$field_name=$fields_to_look[$f];
						if ($f) $where_sql .="   
			 OR "; 
						$where_sql.="`".$field_name."` LIKE LOWER('%".$pattern."%')";
					}
					$sql.=$where_sql. "\n       ) "; 
					$result=Yii::app()->db->createCommand($sql)->queryAll();
					foreach($result as $i=>$data){
						$this->found[] =$data['id'];
					}
				}
            } 
        }
        $this->found = array_unique($this->found);
        return $this->found;
    }
}
?>