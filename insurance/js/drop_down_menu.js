// JavaScript Document
// set ddMenu positions
var nav=navigator.appName;
try{	
	var mMenu=document.getElementById('mainmenu');
	var ulMenus=document.getElementById('mainmenu').getElementsByTagName('li');
	var mMenuSecond=document.getElementById('main_submenu');
	var ulMenusSecond=document.getElementById('main_submenu').getElementsByTagName('li');
	
	var ddMenus=mMenu.getElementsByTagName('div');
	var ddMenusSecond=mMenuSecond.getElementsByTagName('div');
	
	var ulm=new Array(ulMenus,ulMenusSecond);
	var ddm=new Array(ddMenus,ddMenusSecond);
	
	for (j=0;j<ddm.length;j++) {
		for(i=0;i<ddm[j].length;i++){
			var li=ulm[j].item(i+1);
			var pos = jQuery(li).offset().left; 
			var ddM=ddm[j].item(i); 
			$(ddM).offset({left:pos+8}); 
		}
	}
	
}catch(e){
	alert(e.message);
}
var manageDDMenu = function(e) {	
  try{
	// ВНИМАНИЕ! Важно: уровень вложенности элементов внутри блока с выпадающим меню.
	// устанавливается в начале метода (HTML) и в блоке для события mouseout
	//var testBlock=document.getElementById("AfterMenu");
	var ULlist=mMenu.getElementsByTagName('ul').item(0).getElementsByTagName('li'); 
	if (nav=='Netscape') {
		var eventSource=e.target;
		//
	}else{ 
		var eventSource=e.srcElement; // event source
	}
	var eventSourceTagName=eventSource.nodeName.toLowerCase(); // event source tag name
	var eventSourceParent=eventSource.parentNode; // event source parent
	var eventSourceParentParent=eventSourceParent.parentNode; // event source parent parent
	
	if ( // li in menu:
		 ( eventSourceTagName=='li'
		   && (eventSourceParentParent==mMenu || eventSourceParentParent==mMenuSecond) 
		 ) 
		 || // a inside li:
		 ( eventSourceTagName=='a'
		   && (eventSourceParentParent.parentNode==mMenu || eventSourceParentParent.parentNode==mMenuSecond)
		 ) 
		 || // drop-down menu:
		 ( eventSourceTagName=='div'
		   && (eventSourceParent==mMenu || eventSourceParent==mMenuSecond)
		   && eventSource.id.indexOf("ddMenu_")!=-1 )
	   ) {  
		// получить объект списка (ul) в меню:
		var UL=mMenu.getElementsByTagName('ul').item(0);
		// получить все пункты меню в виде набора объектов:
		var ULlist=UL.getElementsByTagName('li'); 
		// первое меню, без подменю:
		var firstLI=UL.getElementsByTagName('li').item(0);
		
		if (eventSourceTagName!='div') {
			if ( eventSource!=firstLI
				 && eventSourceParent!=firstLI
			   ) { //alert(eventSource.innerHTML+'\n'+firstLI.innerHTML);
				// получить объект текущего элемента li:
				var targetLI=(eventSourceTagName=='li')? eventSource:eventSourceParent;
				// получить индекс текущего пункта меню и на его основе - индекс объекта выпадающего меню:
				var LiIndex=$(ULlist).index(targetLI)-1;
				// получить объект выпадающего меню:
				var dropDownMenuDIV=ddMenus.item(LiIndex);
			}
		}else dropDownMenuDIV=eventSource;
		
		if(e.type=='mouseover') {
			if ( dropDownMenuDIV) dropDownMenuDIV.style.top='22px';
		}else if(e.type=='mouseout'){
			var relToElement=e.relatedTarget; // to Element
			if ( relToElement 
				 && dropDownMenuDIV
			   ) {
				if( relToElement.id.indexOf("ddMenu_")==-1
					&& relToElement.parentNode.id.indexOf("ddMenu_")==-1
					&& relToElement.parentNode.parentNode.id.indexOf("ddMenu_")==-1
					/*&& relToElement.parentNode.nodeName.toLowerCase()!='li'*/
				  )
				dropDownMenuDIV.style.top='-4000px';
			}
		}
	}			
  }catch(e){
	  alert(e.message);
  }
}
document.addEventListener('mouseover', manageDDMenu, false);
document.addEventListener('mouseout', manageDDMenu, false);
