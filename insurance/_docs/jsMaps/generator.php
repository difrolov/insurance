<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Карта клиентских скриптов</title>
<style>
blockquote{
	margin-right:0;
	padding-right:0;
}
table *{
	font-size:18px;
	vertical-align:top;
}
h3{
	margin-bottom:8px;
}
.txtRed{
	color:#F00;
}
tr.general td,
td.general {
	background:#CF3;
}
tr.main td {
	background:#CCFFCC;
}
ol, ul{
	padding-left:24px;
}
</style>
</head>
<body>
<h3>Последовательность вызова клиентских скриптов:</h3>
    <table width="100%" border="1" cellpadding="8" cellspacing="0">
  <tr bgcolor="#FFCCFF">
    <td><h4><strong>$_GET</strong></h4></td>
    <td><h4>Function</h4></td>
    <td><h4>event source</h4></td>
    <td><h4>Файл</h4></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><a name="splitBlockContent"></a>преобразовать контент блока (Layout.blocks) в массив:<br>
    <strong>splitBlockContent(1);</strong></td>
    <td>&nbsp;</td>
    <td>manage_template.php</td>
    </tr>
  <tr>
    <td>test140</td>
    <td>преобразовать контент блока в строку и сохранить в Layout:<br>
    <strong>saveBlockContentString(2);</strong></td>
    <td>&nbsp;</td>
    <td>manage_template.php</td>
    </tr>
  <tr valign="top">
    <td colspan="4" style="line-height:10px; border: none; padding:0;" bgcolor="#CCCCCC">&nbsp;</td>
    </tr>
  <tr valign="top" class="general">
    <td>&nbsp;</td>
    <td>инициализировать (и РЕинициализировать) макет:<br>
    <strong>initializeLayout();</strong></td>
    <td><strong>document.ready</strong></td>
    <td rowspan="11">prepare_data.php</td>
  </tr>
  <tr valign="top" class="main">
    <td>&nbsp;</td>
    <td><blockquote>
      <p>Подготовить схему макета:<br>
        <strong>defineLayoutSchema(2); </strong></p>
    </blockquote></td>
    <td rowspan="11">Пиктораммы схем макета</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <blockquote>
        <p>*показать блок "текущий выбор":<br>
          <strong>showBlock(2); </strong></p>
        </blockquote>
    </blockquote></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <blockquote>
        <p>обработать скрытые блоки с выбором типа размещения подзаголовка и псевдофутера:<br>
          <strong>handlePyctos(1); </strong></p>
        </blockquote>
    </blockquote></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <blockquote>
        <blockquote>
          <p>*отобразить блоки следующего уровня, назначить класс первой пиктограмме:<br>
            <strong>startHandleBlock(3);</strong></p>
          </blockquote>
        </blockquote>
    </blockquote></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <blockquote>
        <blockquote>
          <p>*сделать все пиктограммы блоков 2 и 3 непрозрачными:<br>
            <strong>dropPyctosOpacity(1);</strong> </p>
          </blockquote>
        </blockquote>
    </blockquote></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <blockquote>
        <p>установить состояние прозрачности для пиктограмм, добавить информацию о подзаголовке и псевдофутере;<br>
          указать параметры текущего выбора:<br>
          <strong>setCurrentChoiceStatus(2); </strong></p>
        </blockquote>
    </blockquote></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <blockquote>
        <blockquote>
          <p>разместить и отобразить информацию о выборе юзера:<br>
            <strong>displayUserChoice(1);</strong></p>
          </blockquote>
        </blockquote>
    </blockquote></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <blockquote>
        <p>проверить &#8212; допускает ли текущее состояние макета его загрузку;<br>
          если да, <span class="txtRed">назначить схему для макета</span> :<br>
          <strong>checkLayoutReady();</strong></p>
        </blockquote>
    </blockquote></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <blockquote>
        <blockquote>
          <p>вернуть массив уровней с пиктограммами:<br>
            <strong>getLevelsArray();</strong></p>
          </blockquote>
        </blockquote>
    </blockquote></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <blockquote>
        <blockquote>
          <p>*получить начальное значение схемы макета:<br>
            <strong>getSchema(1);</strong></p>
          </blockquote>
        </blockquote>
    </blockquote></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <blockquote>
        <blockquote>
          <p>*управление кнопками:<br>
            <strong>setButtonStat(2);</strong></p>
          </blockquote>
        </blockquote>
    </blockquote></td>
    <td class="general">switch_states.php</td>
    </tr>
  <tr class="main">
    <td>&nbsp;</td>
    <td><p>Загрузить макет по сформированному шаблону:<strong><br>
    loadLayout();</strong></p></td>
    <td rowspan="4">Кнопка <q><strong>Загрузить макет</strong></q></td>
    <td rowspan="4">load_template.php</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <p>назначить параметры отображения задействованным элементам:<br>
        <strong>stateLayoutIsLoaded()</strong>;</p>
    </blockquote></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <p>собрать блочную структуру макета по выбранной ранее схеме:<br>
        <strong>createLayout();</strong></p>
    </blockquote></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <blockquote>
        <p>распарсить схему макета:<br>
          <strong>parseLayoutSchema(); </strong></p>
        </blockquote>
    </blockquote></td>
    </tr>
  <tr class="main">
    <td>&nbsp;</td>
    <td>выделить цветом активную колонку:<br>
    <strong>selectColumn(2);</strong></td>
    <td>Колонки макета</td>
    <td>manage_template.php</td>
    </tr>
  <tr class="main">
    <td>&nbsp;</td>
    <td><p>добавить модуль в активную колонку:<br>
    <strong>addModuleIntoBlock(2);</strong></p></td>
    <td rowspan="3">Кнопка модуля</td>
    <td rowspan="3">manage_template.php</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <p>распарсить Layout и отобразить в тестовом блоке:<br>
        <strong>test_parseLayout();</strong></p>
    </blockquote></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <p><strong><a id="addTextModuleComLinks"></a>?</strong> добавить ссылки (команды добавления текста/статьи) в текстовый модуль:<br>
        <strong>addTextModuleComLinks(1);</strong></p>
    </blockquote></td>
    </tr>
  <tr class="main">
    <td>&nbsp;</td>
    <td>отобразить таблицу выбора статей:<br>
    <strong>showArticlesTable(1);</strong></td>
    <td><strong>Click</strong> по ссылке &quot;Загрузить статью...&quot; (#upload_article)</td>
    <td>handle_text_module.php</td>
  </tr>
  <tr class="main">
    <td>&nbsp;</td>
    <td>получить окно предпросмотра текста в виде объекта:<br>
    <strong>getPreviewWindow();</strong></td>
    <td><strong><a href="#addTextModuleComLinks">addTextModuleComLinks(1);</a></strong></td>
    <td>handle_text_module.php</td>
  </tr>
  <tr class="main">
    <td>&nbsp;</td>
    <td>загрузить предпросмотр статьи:<br>
    <strong>manageArticleText();</strong></td>
    <td><p>1. Ссылка (картинка) <strong>Предпросмотр статьи</strong></p>
    <p>2. Ссылка в текстовом модуле после добавления текста или готовой статьи.</p></td>
    <td>handle_text_module.php</td>
    </tr>
  <tr class="main">
    <td>&nbsp;</td>
    <td><a id="addArticleTextToEditor"></a>добавить текст полученной ajax'ом статьи в поле редактора:<br>
    <strong>addArticleTextToEditor(2);</strong></td>
    <td rowspan="6">Кнопка <strong>Вставить</strong> в окне предпросмотра статьи.</td>
    <td rowspan="6">handle_text_module.php</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <p>находит элемент &quot;поле редактора&quot; и размещает в нём текст:<br>
        <strong>addTextIntoEditor(1);</strong></p>
    </blockquote></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <blockquote>
        <p>разбить полученный контент статьи на заголовок и текст:<br>
          <strong>splitArtContent(content);</strong></p>
      </blockquote>
    </blockquote></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
      ИЛИ
      <blockquote style="margin-top:0; padding-top:0;">
        загружает статью из БД и размещает в поле редактора:<br>
        <strong>getArticleTextFromDB(2);</strong></p>
    </blockquote></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <blockquote>
        <p>разбивает полученный из БД контент статьи на заголовок и текст:<br>
          <strong>splitArtContent(msg);</strong></p>
      </blockquote>
    </blockquote></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <p>свернуть окна предпросмотра статьи и таблицы выбора статей:<br>
        <strong>hideArticlesStuff(1);</strong></p>
    </blockquote></td>
    </tr>
  <tr class="main">
    <td>&nbsp;</td>
    <td>сгенерировать окно предпросмотра текста:<br>
    <strong>    createPreviewWindow(2);</strong></td>
    <td>Щелчок по теме статьи, ранее добавленной в модуль.</td>
    <td>handle_text_module.php</td>
    </tr>
  <tr class="main">
    <td>test387</td>
    <td><a name="storeLayoutBlockData"></a>сохранить в Layout индекс  модуля и номер его родительского блока (колонки):<br>
    <strong> storeLayoutBlockData(1);</strong></td>
    <td rowspan="2"><p>Ссылки внутри добавленного блока:</p>
      <ul>
        <li>&quot;Добавьте произвольное содержание&quot;</li>
        <li> &quot;Выберите из имеющихся статей&quot;</li>
      </ul>
      <hr>
+</td>
    <td rowspan="2">handle_text_module.php</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <p>получить идентификатор (№/footer) активного блока:<br>
        <span class="txtRed">Layout.blocks.activeBlockIdentifier</span>=<strong>getBlockNumber(1);</strong></p>
      <p>получить индекс модуля:<br>
        <span class="txtRed">Layout.blocks.moduleClickedLocalIndex</span>=<strong>getModuleIndex(2);</strong></p>
    </blockquote>    </td>
    </tr>
  <tr class="main">
    <td>&nbsp;</td>
    <td><a id="setTextContentIdentifier"></a>получить суффикс начала строки текстового модуля:<br>
    <strong>setTextContentIdentifier(1);</strong></td>
    <td><p>&nbsp;</p></td>
    <td>handle_text_module.php</td>
    </tr>
  <tr class="main">
    <td>&nbsp;</td>
    <td>получить начало строки текстового модуля (может быть просто &quot;Текст&quot;:<br>
    <strong>getTextStart(1);</strong></td>
    <td>&nbsp;</td>
    <td>handle_text_module.php</td>
    </tr>
  <tr class="main">
    <td>&nbsp;</td>
    <td>добавить в модуль текст новой статьи или id уже существующей:<br>
    <strong>addArticleIdOrTextToModule(2);</strong></td>
    <td rowspan="4"><ul>
      <li><strong>DblClick</strong> по заголовку готовой статьи;</li>
      <li><a href="#addArticleTextToEditor"><strong>addArticleTextToEditor(2);</strong></a></li>
      <!--<li><strong>addArtText(3);</strong></li>-->
      <li><a href="#getDataFromCKeditor"><strong>getDataFromCKeditor();</strong></a>    </li>
    </ul></td>
    <td rowspan="4">handle_text_module.php</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <p>получить начало текстового блока:<br>
        <strong>getTextStar(1);</strong></p>
    </blockquote></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <blockquote>
        <p>добавить в текстовый модуль идентификатор типа контента (id статьи/текст):<br>
          <strong>setTextContentIdentifier(1);</strong></p>
      </blockquote>
    </blockquote></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <p>извлечь целевую колонку (находит также по идентификатору &quot;footer&quot;):<br>
        <strong>getTargetColumn();</strong></p>
    </blockquote></td>
    </tr>
  <tr class="main">
    <td>&nbsp;</td>
    <td>удалить модуль из колонки и из Layout:<br>
    <strong>removeModule(1);</strong></td>
    <td>&quot;Удалить модуль из колонки&quot;</td>
    <td>manage_template.php</td>
    </tr>
  <tr class="main">
    <td>&nbsp;</td>
    <td><p>перестроить последовательность модулей в Layout:<br>
        <strong>rearrangeModulesOrder(1);</strong> </p></td>
    <td rowspan="2">Ручная сортировка порядка модулей в колонке</td>
    <td rowspan="2">manage_template.php</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <p><a href="#splitBlockContent"><strong>splitBlockContent(blockNumber);</strong></a></p>
    </blockquote></td>
    </tr>
  <tr class="main">
    <td>&nbsp;</td>
    <td>загрузить окно редактора:<br>
    <strong>showEditor();</strong></td>
    <td><ol>
      <li>Ссылка <strong>Добавьте произвольное содержание</strong>.</li>
      <li>Кнопка <strong>Редактировать</strong> (предпросмотр текста новой статьи после её добавления)</li>
    </ol>    </td>
    <td>handle_text_module.php</td>
    </tr>
  <tr class="main">
    <td>&nbsp;</td>
    <td><a id="getDataFromCKeditor"></a>забрать заголовок и текст новой статьи из поля редактора и разместить в блоке Layout'а и тестовом модуле:<br>
    <strong>getDataFromCKeditor();</strong></td>
    <td>Кнопка <strong>Сохранить</strong> в окне редактора.</td>
    <td>handle_text_module.php</td>
    </tr>
  <tr class="main">
    <td>test268</td>
    <td>получить и распарсить на заголовок и текст контент текстового модуля ИЗ <strong>Layout</strong> и вставить их в заголовок и область текста области предпросмотра:<br>
    <strong>getTextModuleContentParsedFromLayout();</strong></td>
    <td>Ссылка [<strong>Заголовок статьи</strong>] в текстовом модуле после добавления туда текста.</td>
    <td>&nbsp;</td>
    </tr>
</table>

	<hr size="4" color="#0000FF">

</body>
</html>