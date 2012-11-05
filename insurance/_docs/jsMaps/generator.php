<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Карта клиентских скриптов</title>
<style>
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
</style>
</head>
<body>
<h3>Последовательность вызова клиентских скриптов:</h3>
    <table width="90%" border="1" cellpadding="8" cellspacing="0">
  <tr bgcolor="#FFCCFF">
    <td><h4>#</h4></td>
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
    <td>&nbsp;</td>
    <td>преобразовать контент блока в строку и сохранить в Layout:<br>
    <strong>saveBlockContentString(2);</strong></td>
    <td>&nbsp;</td>
    <td>manage_template.php</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr valign="top">
    <td colspan="4" style="line-height:1px; padding:0;" bgcolor="#CCCCCC">&nbsp;</td>
    </tr>
  <tr valign="top">
    <td>&nbsp;</td>
    <td><p>Подготовить схему макета:<br>
	<strong>defineLayoutSchema(2); </strong></p></td>
    <td rowspan="7">Пиктораммы схем макета</td>
    <td rowspan="7">prepare_data.php</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <p>показать блок "текущий выбор":<br>
        <strong>showBlock(2); </strong></p>
    </blockquote></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <p>обработать скрытые блоки с выбором типа размещения подзаголовка и псевдофутера:<br>
        <strong>handlePyctos(1); </strong></p>
    </blockquote></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <blockquote>
        <p>отобразить блоки следующего уровня, назначить класс первой пиктограмме:<br>
          <strong>startHandleBlock(3);</strong></p>
        </blockquote>
    </blockquote></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <blockquote>
        <p>сделать все пиктограммы блоков 2 и 3 непрозрачными:<br>
          <strong>dropPyctosOpacity(1);</strong> </p>
        </blockquote>
    </blockquote></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <p>установить состояние прозрачности для пиктограмм, добавить информацию о подзаголовке и псевдофутере;<br>
        указать параметры текущего выбора:<br>
        <strong>setCurrentChoiceStatus(2); </strong></p>
    </blockquote></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <p>проверить &#8212; допускает ли текущее состояние макета его загрузку;<br>
        если да, <span class="txtRed">назначить схему для макета</span> :<br>
        <strong>checkLayoutReady();</strong></p>
    </blockquote></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><p>Загрузить макет по сформированному шаблону:<strong><br>
    loadLayout();</strong></p></td>
    <td rowspan="3">Кнопка <q><strong>Загрузить макет</strong></q></td>
    <td rowspan="3">load_template.php</td>
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
    <td>выделить цветом активную колонку:<br>
    <strong>selectColumn(2);</strong></td>
    <td>Колонки макета</td>
    <td>manage_template.php</td>
  </tr>
  <tr>
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
      <p><strong>?</strong> добавить ссылки (команды добавления текста/статьи) в текстовый модуль:<br>
        <strong>addTextModuleComLinks(1);</strong></p>
    </blockquote></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>загрузить предпросмотр статьи:<br>
    <strong>manageArticleText();</strong></td>
    <td>Ссылка (картинка) <strong>Предпросмотр статьи</strong></td>
    <td>handle_text_module.php</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>добавить текст полученной ajax'ом статьи в поле редактора:<br>
    <strong>function addArticleTextToEditor(2);</strong></td>
    <td rowspan="4">Кнопка <strong>Вставить</strong> в окне предпросмотра статьи.</td>
    <td rowspan="4">handle_text_module.php</td>
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
      <p>свернуть окна предпросмотра статьи и таблицы выбора статей:<br>
        <strong>hideArticlesStuff(1);</strong></p>
    </blockquote></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><a name="storeLayoutBlockData"></a>сохранить в Layout индекс  модуля и номер его родительского блока (колонки):<br>
    <strong> storeLayoutBlockData(1);</strong></td>
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2">handle_text_module.php</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <p>получить № блока:<br>
        <span class="txtRed">Layout.blocks.moduleClickedBlockNumber</span>=<strong>getBlockNumber(1);</strong></p>
      <p>получить индекс модуля:<br>
        <span class="txtRed">Layout.blocks.moduleClickedLocalIndex</span>=<strong>getModuleIndex(2);</strong></p>
    </blockquote>    </td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><a id="setTextContentIdentifier"></a>получить суффикс начала строки текстового модуля:<br>
    <strong>setTextContentIdentifier(1);</strong></td>
    <td><p>&nbsp;</p></td>
    <td>handle_text_module.php</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>получить начало строки текстового модуля (может быть просто &quot;Текст&quot;:<br>
    <strong>getTextStart(1);</strong></td>
    <td>&nbsp;</td>
    <td>handle_text_module.php</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><p>сохранить в Layout индекс текстового модуля и номер его родительского блока (колонки):<br>
    <strong>identifyTextBlock(1);</strong></p></td>
    <td rowspan="2"><p>Ссылки внутри добавленного блока:</p>
      <ul>
        <li>&quot;Добавьте произвольное содержание&quot;</li>
        <li> &quot;Выберите из имеющихся статей&quot;</li>
    </ul></td>
    <td rowspan="2">handle_text_module.php</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><blockquote>
      <p><strong><a href="#storeLayoutBlockData">storeLayoutBlockData(curModule)</a>;</strong></p>
    </blockquote></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>добавить в модуль текст новой статьи или id уже существующей:<br>
    <strong>addArticleIdOrTextToModule(2);</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>удалить модуль из колонки и из Layout:<br>
    <strong>removeModule(1);</strong></td>
    <td>&quot;Удалить модуль из колонки&quot;</td>
    <td>manage_template.php</td>
  </tr>
  <tr>
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
</table>

	<hr size="4" color="#0000FF">

</body>
</html>