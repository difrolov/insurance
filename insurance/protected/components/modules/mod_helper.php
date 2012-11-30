<?
/**
 * Получить сведения об xtra-модулях:
 */
function handleFiles($dir) { 
	$dir.='/';
	static $modData=array();
	// Открыть заведомо существующий каталог и начать считывать его содержимое
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			while (($file = readdir($dh)) !== false) {
				if ($file!='.'&&$file!='..') {
					$path=$dir.$file.'/';
					if (is_dir($path)){
						echo "<div class=''>dir= ".$file."</div>";
						handleFiles($path);
					}else{ 
						$af=explode(".",$file);
						if(array_pop($af)=='xml'){
							//echo "<div class=''>xml= ".$file."</div>";
							$xml = simplexml_load_file($dir.$file);
							$modData[]=array( 'module'=>array_pop($af),
											  'name'=>$xml->name,
											  'description'=>$xml->description,
											  'created'=>$xml->created,
											  'author'=>$xml->author
											);
						}
					}
				}
			}
			closedir($dh);
		}
	}
	return $modData;
}?>