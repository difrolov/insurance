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
						handleFiles($path);
					}else{ 
						$af=explode(".",$file); // разбиваем имя файла собственно на имя (это будет имя модуля) и расширение
						if( array_pop($af)=='xml'
							&& $file!='dwsync.xml' // fucking DW
						  ){
							$xml = simplexml_load_file($dir.$file);
							$modData[]=array( 
										'module'=>array_pop($af),
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