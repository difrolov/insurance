<?

class setHTML{
	/**
	 *
	 */
	function setButtonPrint(){?>
    <button>Печать страницы</button>
<?	}
	/**
	  *
	  */
	function showNews($src=false,$content=false){
		if (!$content) {
			$content="Итак, здесь у нас превью новости. Новость такая новость.
			<p>А в последствии, между прочим, новости будут гороздо новостней, чем сейчас.</p>";
		}?>
	<div class="company_news"><img align="left" name="placeholder" src="<?=$src?>" width="48" height="64" alt="" style="background-color: #99FFCC" /><?=$content?>
    	<div align="right"><a href="#">Подробности &gt;&gt;&gt;</a></div>
    </div>
    <br>
<?	}
	/**
	  *
	  */
	function showReadySolution($icon_src=false,$content=false){
		if (!$content) {
			$content="Наименование продукта";
		}?>
	<div class="ready_solutions_preview">
    	<div><img align="left" name="placeholder" src="<?=$icon_src?>" width="64" height="64" alt="" style="background-color: #ededed" />
		</div>
		<div><a href="#"><?=$content?></a></div>
    </div>
    <div class="clear">&nbsp;</div>
<?	}
}
?>