<?
$upersimg=Yii::app()->request->getBaseUrl(true).'/upload/img/vidi_srahovania/';
$upers=Yii::app()->request->getBaseUrl(true).'/fizicheskim_litzam/';
$lnews=$this->getLastNews();
$wdate=$lnews[0];
$wtext=$lnews[1];
$all_news='<a href="'.Yii::app()->request->getBaseUrl(true).'/o_kompanii/novosti_kompanii"  style="text-decoration:none;">все новости</a>';
?>
<div id="bottom_insur">
    <? 	
	if ($oldIE=setHTML::detectOldIE()||isset($_GET['iexp'])) {?>
	<table id="mod_insur_species" width="980" cellpadding="0" cellspacing="0" style="margin-left:25px; margin-bottom:10px;">
  <tr>
    <td width="590" style="padding-left:10px;"><h2 class="txtLightBlue" style="margin-bottom:0;">Виды страхования</h2></td>
    <td class="modSpNews"><div class="clear">Новости</div>
    

    </td>
  </tr>
  <tr>
    <td valign="bottom">
    	<table id="innerSp" width="100%" cellspacing="0" cellpadding="0">
      		<tr align="center">
        		<td width="25%"><div><img src="<?=$upersimg?>car.png" width="77" height="49">
    <a href="<?=$upers?>avtostrahovanie" class="txtLightBlue">Автострахование</a></div></td>
        <td width="25%"><div><img src="<?=$upersimg?>health.png" width="54" height="47">
    <a href="<?=$upers?>zdorovie_ch" class="txtLightBlue">Здоровье</a></div></td>
        <td width="25%"><div><img src="<?=$upersimg?>home.png" width="67" height="50">
    <a href="<?=$upers?>imuschestvo_ch" class="txtLightBlue">Имущество</a></div></td>
        <td width="25%"><div><img src="<?=$upersimg?>travel.png" width="63" height="52">
    <a href="<?=$upers?>puteshestvie" class="txtLightBlue">Путешествия</a></div></td>
      </tr>
    </table></td>
    <td class="modSpNews"><div class="clear" style="margin-bottom:26px;">
        <span id="issue_date" style="margin-top:20px;"><?=$wdate?></span>
        <span class="floatRight txtLightBlue" id="all_news" style="border-bottom:dotted 1px; font-size:10.5px; margin-top:18px;"><?=$all_news?></span>
        </div>
        <div id="new_preview"><? /*
        мы делаем вам подарок мы делаем вам подарок мы делаем вам подарок мы делаем вам подарок мы делаем вам подарок мы делаем вам подарок мы делаем вам подарок*/
		
		echo $wtext;
		
		?></div>
</td>
  </tr>
</table>

<? 
	}else{?>
    <div id="mod_insur_species">
	<h2 class="txtLightBlue">Виды страхования</h2>
	<div><img src="<?=$upersimg?>car.png" width="77" height="49">
    <a href="<?=$upers?>avtostrahovanie" class="txtLightBlue">Автострахование</a></div>
    <div><img src="<?=$upersimg?>health.png" width="54" height="47">
    <a href="<?=$upers?>zdorovie_ch" class="txtLightBlue">Здоровье</a></div>
    <div><img src="<?=$upersimg?>home.png" width="67" height="50">
    <a href="<?=$upers?>imuschestvo_ch" class="txtLightBlue">Имущество</a></div>
    <div><img src="<?=$upersimg?>travel.png" width="63" height="52">
    <a href="<?=$upers?>puteshestvie" class="txtLightBlue">Путешествия</a></div>
    
	</div>        
	<div align="left" id="last_news" style="position:relative;">
        <div class="clear">Новости</div>
        <!--<p class="txtLightBlue txtInpact floatLeft" id="textLastNew">Последняя новость</p>-->
        <div class="clear" style="margin-bottom:26px;">
        	<span id="issue_date" style="margin-top:20px;"><?=$wdate?></span>
        	<span class="floatRight txtLightBlue" id="all_news" style="border-bottom:dotted 1px; font-size:10.5px; margin-top:18px;"><?=$all_news?></span>
        </div>
        <div id="new_preview"><?
		
		echo $wtext;
		
		?></div>
    </div>        
<?	}?>
</div>