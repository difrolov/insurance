<?
function showVarDump($ob,$fixed=true,$die=false){?>
	<div id="debug_object" class="testBlock" style="position:fixed; left:0; bottom:0; max-height:70%; overflow:auto;">
    	<div><b>Object</b></div>
<?	var_dump("<pre>",$ob,"</pre>");?>
	</div>
<?	if ($die) die();
}?>