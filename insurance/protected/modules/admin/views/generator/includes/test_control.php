<?	// если в тестовом режиме:
if (isset($_GET['test'])){?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/admin/generator/test.php?base_url=<?=Yii::app()->request->baseUrl?>"></script>
<div data-test="template">
	<div id="test_block_appearance" class="link">свернуть</div>
	<h4>Текущие данные создаваемого подраздела:</h4>
    <h5>Схема макета:  <span id="tmpl-shema"></span></h5>
  	<h5 class="margin0">Блоки/модули:</h5>
    <div id='obj_place'></div>
</div>
<?php
}?>
