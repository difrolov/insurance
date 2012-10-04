// JavaScript Document
//
function buildBlockUnit(tNode,blockPrototypeParams){ // только строка
	var blockData,dWidth,dFloat,block_type;
	var dHeight=false;
	if ( blockPrototypeParams
		 && blockPrototypeParams.indexOf(":")!=-1 // '34:left'
	   ) {
		var block_type='wrapper';
		blockData=blockPrototypeParams.split(":");
		dWidth=blockData[0]+'%';
		dFloat=blockData[1];
		dHeight="100%";
	}else{
		dWidth="100%";
		dFloat="none";
	}
	// создать оболочку для блока с конетнтом (без отступов)
	var DivWrapper=document.createElement('div');
	// добавить к макету:
	tNode.appendChild(DivWrapper);
	DivWrapper.style.width=dWidth; 
	if (dHeight) DivWrapper.style.height=dHeight;
	DivWrapper.style.float=dFloat;
	DivWrapper.style.background='cornsilk';
	
	
	
	// если не контейнер:
	if (blockPrototypeParams!="container") {
		// создать блок для контента (с отступами)
		var DivStuff=document.createElement('div');
		DivWrapper.appendChild(DivStuff);
		DivStuff.className='DivStuff';
		DivWrapper.style.background='lightcyan';
	}
}
//
function constructBlocks(tNode,arrayElement){
	if (!arrayElement||typeof(arrayElement)!='object'){ // '34:left'
		buildBlockUnit(tNode,arrayElement);
	}else // если массив, делаем рекурсивный вызов функции: // Array( '66:right' )
			// создать дочерний блок у родительского узла
			// передать этот блок дальше:
		for (var i=0;i<arrayElement.length;i++)
			constructBlocks(tNode,arrayElement[i]);
}
//
function createTemplate(params){ // всегда массив или вообще ничего для макета 100
	/*new Array( '34:left' ),
				  new Array( '66:right',
								'container',
									new Array( '50:left' ),
									new Array( '50:right' ),
								'footer'
						   )*/
	var tmpl=document.getElementById('tmplInner');
	divsCount=(!params)? 1:params.length; // количество вложенных массивов
	for(i=0;i<divsCount;i++){
		constructBlocks(tmpl,params[i]);
	}
}
// загрузим макет по сформированному шаблону
function loadTemplate(){
  try{
	//alert(tmplSchema);	
	$('#tmplPlace').css('display','block');
	var topPos=$('#txtActions').offset().top;
	$("html, body").animate({scrollTop:topPos},1000,
		function(){
		$('#tmplPlace').animate({opacity:1},300);
	});
	var colsCount=tmplSchema.indexOf(1);
	
	//createTemplate(schema);
  }catch(e){
	  alert(e.message);
  }
}