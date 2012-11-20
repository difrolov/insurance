<?
// трабл с кодировкой возник
class Data {
	/**
	  * @package		content
	  * @subpackage		navigation
	  * Р—Р°РіСЂСѓР¶Р°РµС‚ РєРѕРЅС‚РµРЅС‚ СЂР°Р·РґРµР»Р°/РїРѕРґСЂР°Р·РґРµР»Р° РёР· Р‘Р” РїРѕ РїРѕР»СѓС‡РµРЅРЅРѕРјСѓ Р°Р»РёР°СЃСѓ
	  * РўСЂРµР±СѓРµС‚ СѓСЃС‚Р°РЅРѕРІРєРё РїСЂР°РІРёР» РІ UrlManager!
	  */
	function getDataByAlias( $default_alias, // РіР»Р°РІРЅС‹Р№ СЂР°Р·РґРµР». РўРѕ, С‡С‚Рѕ РІ Р‘Р” СЃ parent_id -1/-2
							 $alias=false // alias РїРѕРґСЂР°Р·РґРµР»Р°
						   ){
		if (!$alias) {
			$alias=$default_alias;	
			$subsection=true;
		}
		$data = InsurInsuranceObject::model()->findByAttributes(array('alias' => $alias));
		if ($data === null&&$subsection) {
			throw new CHttpException(404, 'Not found');		
		}
		return $data;	
	}
	/*
	 *	@package		content
	 *	@subpackage		metadata
	 *	Р—Р°РіСЂСѓР·РёС‚СЊ РјР°РєРµС‚ РїРѕРґСЂР°Р·РґРµР»Р°, СЂР°Р·РјРµСЃС‚РёС‚СЊ РґР°РЅРЅС‹Рµ Рё РІС‹РґР°С‚СЊ РІ HTML
	 */
	function setPageData($this_obj, $section_data, $test=false){
		// РіРµРЅРµСЂРёСЂСѓРµС‚ Рё СЂР°Р·РјРµС‰Р°РµС‚ title СЃС‚СЂР°РЅРёС†С‹:
		$this_obj->pageTitle=Yii::app()->name . ' - '.$section_data->title;
		// РіРµРЅРµСЂРёСЂСѓРµС‚ Рё СЂР°Р·РјРµС‰Р°РµС‚ РЅР°Р·РІР°РЅРёРµ СЃС‚СЂР°РЅРёС†С‹ РІ С†РµРїРѕС‡РєРµ breadcrumbs:
		$breadcrumbs=array();
		if ($section_data->parent_id>0)	{	
			$parentName=InsurInsuranceObject::model()->find(array(
							'select'=>'name',
							'condition'=>'id = '.$section_data->parent_id,
						)); 
			$this_obj->breadcrumbs=array(
				$parentName->name=>array('index'),
				$section_data->name
			);
		}else 
			$this_obj->breadcrumbs=array(
				$section_data->name,
			);
		// СѓСЃС‚Р°РЅР°РІР»РёРІР°РµС‚ description СЃС‚СЂР°РЅРёС†С‹:
		Yii::app()->clientScript->registerMetaTag($section_data->description, 'description');
		// РїСЂРѕРїРёСЃС‹РІР°РµС‚ РїРµСЂРІС‹Р№ Р·Р°РіРѕР»РѕРІРѕРє РЅР° СЃС‚СЂР°РЅРёС†Рµ, СЃСЂР°Р·Сѓ Р¶Рµ РїРѕРґ breadcrumbs.
		// РµСЃР»Рё Р·Р°РіРѕР»РѕРІРѕРє РЅРµ СѓСЃС‚Р°РЅРѕРІР»РµРЅ (РЅРµС‚ РІ Р‘Р”), РїРѕРґСЃС‚Р°РІР»СЏРµС‚ РЅР°Р·РІР°РЅРёРµ СЃС‚СЂР°РЅРёС†С‹:
		if (!$section_data->first_header)
			$section_data->first_header=$section_data->name;
	$arrItems=array( 'Рћ РєРѕРјРїР°РЅРёРё',  
					 'Рћ РєРѕСЂРїРѕСЂР°С†РёРё',  
					 'Р СѓРєРѕРІРѕРґСЃС‚РІРѕ',  
					 'Р Р°СЃРєСЂС‹С‚РёРµ РёРЅС„РѕСЂРјР°С†РёРё',  
					 'РљР»РёРµРЅС‚С‹ РєРѕРјРїР°РЅРёРё',  
					 'РџР°СЂС‚РЅРµСЂС‹ РєРѕРјРїР°РЅРёРё', 
					 'РќРѕРІРѕСЃС‚Рё РєРѕРјРїР°РЅРёРё',  
					 'Р’Р°РєР°РЅСЃРёРё',  
					 'РљРѕРЅС‚Р°РєС‚С‹');
	$items_data=Yii::app()->db->createCommand("
	SELECT id, name,  `status` , 
		IF( parent_id <0, 
			(	SELECT alias
				FROM insur_insurance_object
				WHERE id = i2.id
			), 
			(	SELECT alias
				FROM insur_insurance_object
				WHERE id = i2.parent_id
			) 
		) AS parent, alias
		FROM insur_insurance_object AS i2
		WHERE name
		IN (  '".implode("','",$arrItems)."'
			)")->queryAll();
			//var_dump("<pre>",$_GET,"</pre>");?>
	<div id="inner_left_menu">
	<?	$cnt=0;		
		for($i=0,$j=count($arrItems);$i<$j;$i++){?>
        <div<?
			
			if ( isset($_GET['alias'])
				 && $items_data[$cnt]['alias']
				 && $arrItems[$i]==$items_data[$cnt]['name']
			   ) : 	if ($_GET['alias']==$items_data[$cnt]['alias']):
						?> class="active"<? 
					endif;
			endif;?>><?		
			
			if ($arrItems[$i]==$items_data[$cnt]['name']){?>
            	<a href="<?=Yii::app()->request->getBaseUrl(true)?>/<?
                echo $items_data[$cnt]['parent'];
				if ($items_data[$cnt]['parent']!=$items_data[$cnt]['alias']){
					?>/<? echo $items_data[$cnt]['alias'];
				}?>"><?=$items_data[$cnt]['name']?></a>
	<?		}else{
				echo $arrItems[$i];
				$cnt--;
			}
			$cnt++;?>
        </div>
	<?	}?>
    		
    </div>
    <div id="inner_content">
	<?
		// СЌС‚Рѕ РѕРЅ - Р·Р°РіРѕР»РѕРІРѕРє :)
		echo "<h1>HEADER: ".$section_data->first_header."</h1>";
		// РµСЃР»Рё С‚РµСЃС‚РёСЂСѓРµРјСЃСЏ:
		if ($test) {
			echo "parent_id = ".$section_data->parent_id."<hr>";
			echo "title: ".$section_data->title."<hr>";
			echo "keywords: ".$section_data->keywords."<hr>";
			echo "description: ".$section_data->description."<hr>";
		}else{ // Р·Р°РіСЂСѓР·РёС‚СЊ РјР°РєРµС‚
			
		}?>
   </div>     
	<?
	}
}
?>