	<div id="<?="sel_modules"?>">
      <ol>
        <li>Щёлкните нужную колонку; </li>
        <li>Щёлкните модули для размещения в ней.</li>
      </ol>
        <div id="select_mod" style="max-width:700px;">
        <?php 
			$allow_mods=false;
			if ($allow_mods) {
				foreach($modules as $key_mod=>$val_mod):
					$mod_name=$modules[$key_mod]['name'];?>
            <div data-module-type="<?=$mod_name?>"><?=$mod_name?></div>
		<? 		endforeach;
			}?>
        	<div data-module-type="Текст" class="mod_type_text" title="Содержание текстового модуля вы можете задавать/изменять самостоятельно">Текст</div>
        </div>
    </div>