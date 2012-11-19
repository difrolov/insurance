<?	
if (isset($data)) {
	$section_data=$data[0]; // данные подраздела (array, имена полей таблицы)?>
<script>
$(function(){
  try{ 	
	//initializeLayout(); // создать объект для сохранения данных макета
	// получить текущую схему макета:
<?		
		//**********************************
		//var_dump("<h1>section_data:</h1><pre>",$section_data,"</pre>"); die();
		$getSchema=(isset($_GET['Schema']))? $_GET['Schema']:'100';
		$section_data=array( 'content'=>
								array('Schema'=>$getSchema)
						   );
		//**********************************
	
	if ($section_data['content']):?>
	Layout.Schema='<? 
		echo $section_data['content']['Schema'];
		// если раздел создаётся впервые, макет создаётся вызовом функции initializeLayout()?>';
  	// распарсить схему макета посимвольно:
	var arrLayoutSchema=parseLayoutSchema();
	// получить объект пиктограммы для текущего макета:
	// div# :
	// tmplColSet // 
	// chHeaders //
	// psFooter // 
	//*************************************************
	// СМ. схему ВСЕХ макетов в _docs\сайт.xlsx
	//*************************************************
	// отобразить все ряды выбора опций макета: колонки, подзаголовок, футер:
	var tPyct,tRow,tIndex,tmplColSet,chHeaders,psFooter;
	
	var rColumns=$('div#tmplColSet > div'); // строка Колонки
	
	switch(Layout.Schema){
		case "100":
		  tPyct=$(rColumns)[0]; // строка Колонки / первая пиктограмма
		break;

		//case "200":case "210":
		
		case "200":
		  tPyct=$('div#chHeaders > div')[0];
		break;
		
		case "210":
		  tPyct=$('div#chHeaders > div')[1];
			break;
		
		/*default:
			
			switch(arrLayoutSchema[0]){
				case "3":
					switch(arrLayoutSchema[1]){
						case "0": // 300, 30s
						  if (arrLayoutSchema[2]=="0")
								tIndex=0;
						  else if (arrLayoutSchema[2]=="s")
								tIndex=1;
						  tPyct=$('div#psFooter > div')[tIndex];
							break;
						case "i": // 3i0
						  tPyct=$('div#chHeaders > div')[1];
							break;
						case "s":
							// code
							break;
					}
				break;
				case "4":
					switch(arrLayoutSchema[1]){						
						case "0": // 40[0/i/s]
							switch(arrLayoutSchema[2]){						
								case "0": // 400
					  				tPyct=$('div#psFooter > div.fourColumn');
								break;
								case "i": // 40i
									tIndex=1;
								break;
								case "s": // 40s
									tIndex=2;
								break;
							}
						break;
						
						
						case "i":
							tIndex=1;
						break;
						case "s":
							tIndex=2;
						break;
					}

					switch(arrLayoutSchema[2]){	
					}
					


					case "":
					  tPyct=$('div#psFooter > div');
						break;
					case "":
					  tPyct=$('div#psFooter > div');
						break;
					case "":
					  tPyct=$('div#psFooter > div');
						break;
					case "":
					  tPyct=$('div#psFooter > div');
						break;
					case "":
					  tPyct=$('div#psFooter > div');
						break;
					case "":
					  tPyct=$('div#psFooter > div');
						break;
					break;
			}*/
	}

	//$(tPyct).trigger('click'); // клик по пиктограмме макета
	//$(btn_loadLayout).trigger('click'); // клик по пиктограмме загрузки макета
	//$('div#tmplPlace >div:first-child >div:first-child').trigger('click'); // клик по активной (первой) колонке
	
	<?	$go=true;
		if ($go){?>	
	//alert($(tPyct).attr('title'));
	defineLayoutSchema(event,tPyct);
	<?	} 
	endif;?>
  }catch(e){
	  alert(e.message);
  }
});
</script>    
<?	
}
$groot=$this->groot; // директория Генератора
$includes=$groot.'includes/'; // директория подключаемых файлов
// вывести блок контроля Layout в тестовом режиме:
require_once $includes.'test_control.php';
$this->breadcrumbs=array($this->module->id,);?>
<div id="article_preview_text">
</div>
<div align="left">
<form style="margin:0;" name="content_save" id="content_save" method="post" action="<?php echo Yii::app()->createUrl('admin/generator/save/') ?>">
<? // подключить опции начального выбора макета:
require_once $includes.'choice_init.php';?>
<? // подключить кнопки управления макетом:
require_once $includes.'tmpl_commands.php';?>
<? // подключить текущие модули:
require_once $includes.'sel_modules.php';?>
    <!--	БЛОК ДИНАМИЧЕСКОЙ ГЕНЕРАЦИИ МАКЕТА	-->
    <div id="<?="tmplPlace"?>">
        <div id="<?="tmplInner"?>"></div>
    </div>
<? // подключить опции метаописания, выбора родительского раздела, заголовка, названия страницы и алиаса:
require_once $includes.'save_tmpl_block.php';?>  	
</form>    
</div>
<? // подключить WYSWYG-редактор и его опции:
require_once $includes.'editor.php';?>