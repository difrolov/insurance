<?	// add section in backend - temporary file ?>
<style>
div#mng{
	border:solid 4px #CCCCCC;
	margin-top:20px;
	padding-bottom:5px;
	padding-left:6px;
}
div#txtChoice,
div#txtActions{
	/*border:solid 1px #FF0000;*/
	vertical-align:top;
}
div#txtChoice div{
	/*background:#99FF66;*/
	margin-top:6px;
}
div#txtActions >div{
	/*height:38px;*/
	line-height:43px;
}
div#txtActions >div:first-child{
	/*background:#FF0;*/
	padding-top:4px;
}
div#txtActions > div:last-child{
	margin-top:-4px;
}
div#txtActions div:last-child,
div#chHeaders{
	display:none;
}
div#txtActions div{
	/*background:#CCFF66;*/
}
div#txtActions, 
div#txtChoice,
div#txtChoice > div div{
	display:inline-block;
}
div#txtChoice span{
	margin-right:1px;
	vertical-align:bottom;
}
div#txtChoice >div:first-child span,
div#chHeaders span{
	background:#F90;
	display:inline-block;
	height:32px;
}
div#txtChoice >div div{ /*  */
	/*background:#00FF00;*/
	height:32px;
	width:42px;
}
div#txtChoice > div > div span:last-child{
	margin-right:0 !important;
}
div#txtChoice > div > div{
	margin:0 0 0 6px;
}
div.oneColumn,
div.twoColumn,
div.threeColumn,
div.fourColumn,
div#txtChoice 
	>div:last-child div {
	border:solid 3px #999;
	cursor:pointer;
	padding:2px;
	position:relative;
}
div.oneColumn span{
	width:41px;
}
div.twoColumn span{
	width:18px;
}
div.threeColumn span{
	width:11px;
}
div.fourColumn span{
	width:7px;
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
		var srcePar=par.getElementsByTagName('div');
		for(i=0;i<srcePar.length;i++){
			srcePar[i].style.opacity=((srcePar[i]!=srce))? 0.2:1;
		}
		var sHdrs=document.getElementById('chHeaders'); // container
		var sActs=document.getElementById('txtActions').getElementsByTagName('div').item(1);
		if (srce.className!="oneColumn"){
			sActs.style.display='block';
			sHdrs.style.display='block';
			var dHdrsDivs=sHdrs.getElementsByTagName('div'); // container/div
			var curTmpl=false;
			var spans=false;
			var hLen=dHdrsDivs.length;
			for(i=0;i<hLen;i++){
				curTmpl=dHdrsDivs[i];
				curTmpl.style.display='inline-block';
				if ( srce.className=="twoColumn"
				 	 && i==(hLen-1)
					) curTmpl.style.display='none';
				else{
					curTmpl.className=srce.className;
					curTmpl.innerHTML=srce.innerHTML;
					if (spans=curTmpl.getElementsByTagName('span')) {
						if (i) {
							for(s=1;s<spans.length;s++) {
								if (!( i==(hLen-1)
									   && s==(spans.length-1)
									 )
								   ) { 
								   spans.item(s).style.height='20px';
								   spans.item(s).style.borderTop='solid 10px red';
								}
									//alert('last SPAN');
							}
						}
					}
				}
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
function showBlockAdd(tShow){
  try{
	$('#'+tShow).show('fast');
  }catch(e){
	  alert(e.message);
  }
}
</script>
<div align="right"><button onClick="showBlockAdd('mng');">Добавить...</button></div>
<div id="mng"<? if(!isset($_GET['test'])){?> style="display:<?="none"?>;"<? }?>>
	<div id="txtActions">
    	<div>Выберите макет страницы:</div>
        <div>Выберите тип подзаголовка:</div>
    </div>
    <div id="txtChoice">
    	<div onClick="showSubHeadersTbls(this)">
            <div class="oneColumn" title="Одна колонка">
            	<span>&nbsp;</span>
            </div>
            <div class="twoColumn" title="Две колонки">
            	<span>&nbsp;</span>
            	<span>&nbsp;</span>
            </div>
            <div class="threeColumn" title="Три колонки">
            	<span>&nbsp;</span>
            	<span>&nbsp;</span>
            	<span>&nbsp;</span>
            </div>
            <div class="fourColumn" title="Четыре колонки">
            	<span>&nbsp;</span>
            	<span>&nbsp;</span>
            	<span>&nbsp;</span>
            	<span>&nbsp;</span>
            </div>
        </div>
        <div id="<?="chHeaders"?>">
            <div>&nbsp;
            </div>
            <div>&nbsp;
            </div>
            <div>&nbsp;
            </div>
        </div>
    </div>
</div>