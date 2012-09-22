<div id="last_seen">
				<span id="last_seen_header" class="txtHeader2 txtLightBlue">
					вы недавно смотрели
				</span>
				<table id="tblSlidesLastSeen" width="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td class="slidesPointer">
							<a href="#"><img src="<?=Yii::app()->request->baseUrl?>/images/pointer_left.png" width="9" height="18" border="0"></a>
						</td>
						<td width="100%" align="center">
	<?	$arrLastSeen=array( 'insur'=>'Страхование имущ-ва',
							'flats'=>'Страхование квартир',
							'family'=>'Готовое решение &quot;Семья&quot;',
							'autosuit'=>'Автоподбор физ. лица',
							'useful'=>'Полезная информация'
						  );
		$i=1;
		foreach($arrLastSeen as $alias=>$header):?>
				<div>
				  <a href="<? echo "site/";?>article=<?=$alias?>">
					<img border="0" src="<?=Yii::app()->request->baseUrl?>/images/pix/<?=$i?>-<?=$alias?>.jpg" width="146" height="92">
					<span><?=$header?></span>
				  </a>
				</div>
	<?		$i++;
		endforeach;?>
						</td>
						<td class="slidesPointer">
							<a href="#"><img src="<?=Yii::app()->request->baseUrl?>/images/pointer_right.png" width="9" height="18" border="0"></a>
						</td>
					</tr>
				</table>
			</div>