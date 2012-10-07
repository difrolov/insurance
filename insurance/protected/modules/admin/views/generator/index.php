<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);/*?><h1><?php echo $this->uniqueId . '/' . $this->action->id; ?></h1><? */?>
<div align="left">
	<div id="choice_init">
        <h5>Выберите параметры макета создаваемой страницы</h5>
        <div id="mng">
            <div id="txtActions">
                <div>Колонки:</div>
                <div>Подзаголовок:</div>
                <div>Псевдофутер:</div>
            </div>
            <div id="txtChoice" onClick="defineTemplateSchema(event,this);">
                <div id="tmplColSet">
                    <div class="oneColumn" title="Одна колонка">&nbsp;</div>
                    <div class="twoColumn" title="Две колонки">&nbsp;</div>
                    <div class="threeColumn" title="Три колонки">&nbsp;</div>
                    <div class="fourColumn" title="Четыре колонки">&nbsp;</div>
                </div>
                <div id="<?="chHeaders"?>">
                    <div title="Без подзаголовка">&nbsp;</div>
                    <div title="Внутренний подзаголовок">&nbsp;</div>
                    <div title="Общий подзаголовок">&nbsp;</div>
                </div>
                <div id="<?="psFooter"?>">
                    <div title="Без псевдофутера">&nbsp;</div>
                    <div>&nbsp;</div>
                    <div>&nbsp;</div>
                </div>
            </div>
            <div id="currentChoice">Вы выбрали следующие параметры макета:
                <span id="selectedColumnsSet"></span>
                <span id="selectedSubheaderPlacement"></span>
                <span id="selectedFooterPlacement"></span>
            </div>
        </div>
	</div>
<? //<div id="test">test block</div>?>
<div id="<?="tmpl_commands"?>">
    <button class="active" id="<?="btn_loadTemplate"?>" type="button" onClick="loadTemplate();">Загрузить макет</button>
    <button class="passive" disabled id="<?="btn_changeTemplate"?>" type="button" onClick="changeTemplate(this);">Изменить макет</button>
    <button class="passive" disabled id="<?="btn_cancelTemplateChanges"?>" type="button" onClick="cancelTemplateChanges(this);">Отменить изменения</button>
</div>
<div id="<?="sel_modules"?>">
	<p>Щёлкните нужный блок и модули для размещения в нём:</p>
    <div id="select_mod" onClick="addModuleIntoBlock(event,this);">
        <div>Новости</div>
        <div>Готовое решение</div>
        <div>Программа страхования</div>
        <div>Случайная статья</div>
        <div>Текст</div>
    </div>
</div>
<div id="<?="tmplPlace"?>">
	<div id="<?="tmplInner"?>"></div>
</div>
</div>