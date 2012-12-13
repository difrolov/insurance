<<<<<<< HEAD
<?	$arrBan3=setHTML::getBannersAsObjects('3');
	if (!empty($arrBan3)){?>
<div class="bottomBannersWrapper">
<?		$subscr=array('Страхование строительно-монтажных работ',
					'Страхование имущества',
					'Страхование от несчастных случаев'
				);
		foreach($arrBan3 as $i=>$data):?>
    <div class="external">
        <div class="middle">
            <div class="internal">
    		<a href="<?=Yii::app()->request->getBaseUrl(true)?>/<? Data::buildAliasPath($arrBan3[$i]['link']);?>"><img src="<?=Yii::app()->request->getBaseUrl(true).'/'.$arrBan3[$i]['src']?>"></a>
        	</div>
	  	</div>
      <span><a href="<?=Yii::app()->request->getBaseUrl(true)?>/<? Data::buildAliasPath($arrBan3[$i]['link']);?>"><?=$subscr[$i]?></a></span>
    </div>
<?		endforeach;?>
</div>
<? 	}?>
=======
<?	if(Yii::app()->controller->getId()!="user"){
		$arrBan3=setHTML::getBannersAsObjects('3');
		if (!empty($arrBan3)){?>
	<div class="bottomBannersWrapper">
	<?		$subscr=array('Страхование строительно-монтажных работ',
						'Страхование имущества',
						'Страхование от несчастных случаев'
					);
			foreach($arrBan3 as $i=>$data):?>	
		<div class="external">
			<div class="middle">
				<div class="internal">
				<a href="<?=Yii::app()->request->getBaseUrl(true)?>/<? Data::buildAliasPath($arrBan3[$i]['link']);?>"><img src="<?=Yii::app()->request->getBaseUrl(true).'/'.$arrBan3[$i]['src']?>"></a>
				</div>
			</div>
		  <span><a href="<?=Yii::app()->request->getBaseUrl(true)?>/<? Data::buildAliasPath($arrBan3[$i]['link']);?>"><?=$subscr[$i]?></a></span>
		</div>
	<?		endforeach;?>
	</div>
	<? 	}
	}?>
>>>>>>> 1c381a7b9cf9686526b1d97ffaaf8ff45f8ed14a
