<?	// add section in backend - temporary file ?>
<style>
div#chHeaders{
<? if(!isset($_GET['test'])){?>	display:none; <? }?>
}
div#mng{
	border:solid 4px #CCCCCC;
	margin-top:20px;
	padding-bottom:5px;
	padding-left:6px;
}
div#txtChoice div{
	margin-top:6px;
}
div#txtActions >div{
	line-height:43px;
}
div#txtActions >div:first-child{
	padding-top:4px;
}
div#txtActions div:last-child,
div#txtActions, 
div#txtChoice,
div#currentChoice,
div#txtChoice > div div{
	display:inline-block;
}
div#txtChoice >div div{ /*  */
	height:26px;
	width:35px;
	margin:0 0 0 6px;
}
div.oneColumn,
div.twoColumn,
div.threeColumn,
div.fourColumn,
div#txtChoice 
	>div:last-child div {
	background-image:url(<?php echo Yii::app()->request->baseUrl; ?>/images/admin/add-sectiion.gif);
	background-repeat:no-repeat;
	border:solid 3px #999;
	border-radius:2px;
	cursor:pointer;
	padding:2px;
}
div.oneColumn{
	background-position:1px 1px;
}
div.twoColumn{
	background-position:-37px 1px;
}
div.threeColumn{
	background-position:-75px 1px;
}
div.fourColumn{
	background-position:1px -28px;
}
div.twoColumnInside{
	background-position:-37px -28px;
}
div.threeColumnInside{
	background-position:-75px -28px;
}
div.threeColumnShared{
	background-position:1px -57px;
}
div.fourColumnInside{
	background-position:-37px -57px;
}
div.fourColumnShared{
	background-position:-75px -57px;
}
div#txtActions > div:last-child{ /*	вверх не переносить, иначе возникнет конфликт отображения блока!*/
	margin-top:-4px;
<? if(!isset($_GET['test'])){?>	display:none; <? }?>
}
div#currentChoice{
	background:#CCFFCC;
	border-radius:2px;
	display:inline-block;
	min-height:24px;
	margin-left:20px;
	margin-top:8px;
	opacity:0;
	padding:6px 10px 6px 8px;
	vertical-align:top;
}
</style>
<script type="text/javascript">
function showSubHeadersTbls(par){
  try{
	  //alert(event.srcElement.className);
	var srce=false;
	if (event.srcElement.className.indexOf('Column')!=-1) {
		srce=event.srcElement;
	}
	if (event.srcElement.parentNode.className.indexOf('Column')!=-1) {
		srce=event.srcElement.parentNode;
	}
	if (srce) { //alert(event.srcElement.className);
		var sHdrs=document.getElementById('chHeaders'); // container
		var sActs=document.getElementById('txtActions').getElementsByTagName('div').item(1);
		summarizeTmpl(sHdrs,'force'); 
		yourChoice('',-1);
		showBlock('currentChoice','line');
		var srcePar=par.getElementsByTagName('div');
		for(i=0;i<srcePar.length;i++){
			srcePar[i].style.opacity=((srcePar[i]!=srce))? 0.2:1;
		}
		var uChoice;
		yourChoice('макет: '+srce.title.toLowerCase());
		if (srce.className!="oneColumn"){
			sActs.style.display='block';
			sHdrs.style.display='block';
			var dHdrsDivs=sHdrs.getElementsByTagName('div'); // container/div
			var curTmpl=false;
			var spans=false;
			var hLen=dHdrsDivs.length;
			var hPlace=new Array('Inside','Shared');
			for(i=0;i<hLen;i++){
				curTmpl=dHdrsDivs[i];
				curTmpl.style.display='inline-block';
				if ( srce.className=="twoColumn"
				 	 && i==(hLen-1)
					) curTmpl.style.display='none';
				else
					curTmpl.className=(i)? srce.className+hPlace[i-1]:srce.className;
			}
		}else{
			sActs.style.display='none';
			sHdrs.style.display='none';
		}
	}
  }catch(e){
	  alert(e.message);
  }
}
function summarizeTmpl(sbHdrs,force){
	var dHdrsDivs=sbHdrs.getElementsByTagName('div'); // container/div
	var placeH=false;
	for(i=0;i<dHdrsDivs.length;i++){
		if (force||event.srcElement==dHdrsDivs.item(i)){
			dHdrsDivs.item(i).style.opacity=1;
			if (event.srcElement==dHdrsDivs.item(i)){
				if (event.srcElement.className.indexOf('Inside')!=-1)
					placeH="внутренний";
				else 
					placeH=(event.srcElement.className.indexOf('Shared')!=-1)? "общий":"без подзаголовка";
			}
		}
		dHdrsDivs.item(i).style.opacity=(force||event.srcElement==dHdrsDivs.item(i))? 1:0.2;
	}
	if (placeH)
		yourChoice(';<br>расположение подзаголовка: '+placeH,'plus');
}
function showBlock(tShow,line){
  try{
	var tObj='#'+tShow;
	if (line) {
		$(tObj).animate({opacity:1});
	}
	$(tObj).show('fast');
  }catch(e){
	  alert(e.message);
  }
}
function yourChoice(cText,plus){
	var cID=(plus)? 'your_choice2':'your_choice';
	document.getElementById(cID).innerHTML=(plus=='-1')? '':cText;
}
</script>
<div align="right"><button onClick="showBlock('mng');">Добавить...</button></div>
<div id="mng"<? if(!isset($_GET['test'])){?> style="display:<?="none"?>;"<? }?>>
	<div id="txtActions">
    	<div>Выберите макет создаваемой страницы:</div>
        <div>Выберите расположение подзаголовка:</div>
    </div>
    <div id="txtChoice">
    	<div onClick="showSubHeadersTbls(this)">
            <div class="oneColumn" title="Одна колонка">&nbsp;</div>
            <div class="twoColumn" title="Две колонки">&nbsp;</div>
            <div class="threeColumn" title="Три колонки">&nbsp;</div>
            <div class="fourColumn" title="Четыре колонки">&nbsp;</div>
        </div>
        <div id="<?="chHeaders"?>" onClick="summarizeTmpl(this);">
            <div class="hNone4" title="Без подзаголовка">&nbsp;</div>
            <div class="fourColumnInside" title="Внутренний подзаголовок">&nbsp;</div>
            <div class="fourColumnShared" title="Общий подзаголовок">&nbsp;</div>
        </div>
    </div>
    <div id="currentChoice">Вы выбрали::
    	<span id="your_choice"></span>
        <span id="your_choice2"></span></div>
</div>