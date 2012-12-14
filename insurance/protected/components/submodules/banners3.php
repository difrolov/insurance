<?	if(Yii::app()->controller->getId()!="user"){
		$oldIE=(setHTML::detectOldIE()||isset($_GET['iexp']))? true:false;
		$arrBan3=setHTML::getBannersAsObjects('3');
		if (!empty($arrBan3)){
			if ($oldIE){?>
    <table class="bottomBannersWrapper" id="tblBanners3" cellpadding="0" cellspacing="0">
    	<tr>
		<? 	}else{?>
	<div class="bottomBannersWrapper">
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
						<a href="<?=Yii::app()->request->getBaseUrl(true)?>/<? Data::buildAliasPath($arrBan3[$i]['link']);?>"><img src="<?=Yii::app()->request->getBaseUrl(true).'/'.$arrBan3[$i]['src']?>"></a>
					</div>
				</div>
		  		<span><a href="<?=Yii::app()->request->getBaseUrl(true)?>/<? Data::buildAliasPath($arrBan3[$i]['link']);?>"><?=$subscr[$i]?></a>
          		</span>
			</div>
			<?	$imgObjs=ob_get_contents();
				ob_end_clean();

				if ($oldIE){?>
            <td><?=$imgObjs?></td>
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
		<?	}
		}
	}?>