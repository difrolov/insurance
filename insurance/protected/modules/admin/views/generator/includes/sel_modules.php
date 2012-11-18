	<div id="<?="sel_modules"?>">
      <ol>
        <li>Щёлкните нужную колонку; </li>
        <li>Щёлкните модули для размещения в ней.</li>
      </ol>
        <div id="select_mod" onClick="addModuleIntoBlock(event,this);">
        <?php // получить все текущие модули:
			foreach($model_modules as $key_mod=>$val_mod):?>
            <div onclick="_generator_modules.getModule(<?php

				echo $model_modules[$key_mod]['id'];

				?>)" data-module-type="<?php echo $model_modules[$key_mod]['name']; ?>"><?php echo $model_modules[$key_mod]['name']; ?></div>
        <?php endforeach; ?>
        	<div data-module-type="Текст" class="mod_type_text" title="Содержание текстового модуля вы можете задавать/изменять самостоятельно">Текст</div>
        </div>
    </div>