	<div id="<?="sel_modules"?>">
      <ol>
        <li>Щёлкните нужную колонку; </li>
        <li>Щёлкните модули для размещения в ней.</li>
      </ol>
        <div id="select_mod">
        <?php 
			// var_dump("<h1>modData:</h1><pre>",$modData,"</pre>");
			//foreach($model_modules as $key_mod=>$val_mod):
			foreach($modules as $key_mod=>$val_mod):
				$mod_name=$modules[$key_mod]['name'];?>
            <div<? /*onclick="_generator_modules.getModule(<?php

				echo $model_modules[$key_mod]['id'];

				?>)"*/?> data-module-type="<?=$mod_name?>"><?=$mod_name?></div>
        <?php endforeach;?>
        	<div data-module-type="Текст" class="mod_type_text" title="Содержание текстового модуля вы можете задавать/изменять самостоятельно">Текст</div>
        </div>
    </div>