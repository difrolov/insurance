<?	if(Yii::app()->controller->getId()!="user"){
		$oldIE=(setHTML::detectOldIE()||isset($_GET['iexp']))? true:false;
		$arrBan3=setHTML::getBannersAsObjects('3');
		if (!empty($arrBan3)){
			if (!$oldIE){?>
<div align="center">	
    <div class="bottomBannersWrapper">
		<?	require_once Yii::getPathOfAlias('webroot').'/protected/components/modules/save_and_print/default.php';?>
		<?	}else{?>
    <table class="bottomBannersWrapper" id="tblBanners3" cellpadding="0" cellspacing="0">
    	<tr>
        	<td colspan="3"><?
        require_once Yii::getPathOfAlias('webroot').'/protected/components/modules/save_and_print/default.php';
		?></td>
        </tr>
        <tr valign="top" class="spans">
	<?		}
			$subscr=array('Страхование строительно-монтажных работ',
						'Страхование имущества',
						'Страхование от несчастных случаев'
					);
			$cnt=1;
			foreach($arrBan3 as $i=>$data):
				ob_start(); ?>
            <div class="external" id="imExt<?=$cnt?>">
				<div class="middle">
					<div class="internal">
					<a href="<?=Yii::app()->request->getBaseUrl(true)?>/<? Data::buildAliasPath($arrBan3[$i]['link']);?>"><img src="<?=Yii::app()->request->getBaseUrl(true).'/'.$arrBan3[$i]['src']?>"></a>	</div>
				</div>
                <!---->
                <?	if (!$oldIE){?>	
		  		<span class="outer">
                    <span class="bl">&nbsp;</span>
                    <span class="bc">
                    	<a href="<?=Yii::app()->request->getBaseUrl(true)?>/<? Data::buildAliasPath($arrBan3[$i]['link']);?>"><?=$subscr[$i]?></a>
                    </span>
          		</span>
                <?	}else{?>
                    	<table class="outer" cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td class="linkImg"><img src="images/separator_vertical.png" width="4" height="35" align="absmiddle" style="height:35px; width:4px;" /></td>
                                <td class="txtLink"><a href="<?=Yii::app()->request->getBaseUrl(true)?>/<? Data::buildAliasPath($arrBan3[$i]['link']);?>"><?=$subscr[$i]?></a></td>
                            </tr>
                        </table>
				<? 	}?>
			</div>
			<?	$imgObjs=ob_get_contents();
				ob_end_clean();
				
				if ($oldIE){?>
            <td class="blueBorder"><?=$imgObjs?></td>
			<? 	}else{
					echo $imgObjs;
				}
				$cnt++;			
			endforeach;
			if($oldIE){?>
		</tr>
	</table>
		<? 	}else{?>
	</div>
</div>
		<?	} 			
		}
	}?>