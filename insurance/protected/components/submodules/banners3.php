<?	$arrBan3=setHTML::getBannersAsObjects('3');
	if (!empty($arrBan3)){?>
<div id="banners3">
<?		$subscr=array('Страхование строительно-монтажных работ',
					'Страхование имущества',
					'Страхование от несчастных случаев'
				);
		foreach($arrBan3 as $i=>$data):?>	
    <div>
      <div>
        <div>
    		<a href="<?=Yii::app()->request->getBaseUrl(true)?>/<? Data::buildAliasPath($arrBan3[$i]['link']);?>"><img src="<?=Yii::app()->request->getBaseUrl(true).'/'.$arrBan3[$i]['src']?>"></a>
        </div>
	  </div>
      <span><a href="<?=Yii::app()->request->getBaseUrl(true)?>/<? Data::buildAliasPath($arrBan3[$i]['link']);?>"><?=$subscr[$i]?></a></span>
    </div>
<?		endforeach;?>
</div>
<? 	}?>
