<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */
	$this->widget('application.extensions.email.components.debug');		
	Data::includeXtraCss();
	Data::includeXtraJS('validate_data.js');?>
<div id="inner_left_menu">
	<h2 class="txtLightBlue">Отправить заявку</h2>
    	<div class="blockMail" style="display:inline-block;">
    <?=CHtml::beginForm(Yii::app()->request->getBaseUrl(true).'/site/sendapplication','post',array('onsubmit'=>'return validateFields([\'name\',\'email\',\'phone\',\'message\',\'insur_species\']);'));?>
          <table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td>&nbsp;</td>
                <td align="center" class="txtLightBlue bold" nowrap style="padding:8px;">Ваша заявка</td>
              </tr>
              <tr>
                <td>Ваше имя:</td>
                <td><?=CHtml::textField('name','',array('onblur'=>'toggleFieldWarning(this.id);'))?>  
</td>
              </tr>
              <tr>
                <td>Ваш контактный email:</td>
                <td><?=CHtml::textField('email','',array('onblur'=>'toggleFieldWarning(this.id);'));?> </td>
              </tr>
              <tr>
                <td>Контактный телефон:</td>
                <td><?=CHtml::textField('phone','',array('onblur'=>'toggleFieldWarning(this.id);'));?> </td>
              </tr>
              <tr>
                <td>Вид страхования:</td>
                <td><?
					$auto='Автострахование';
					$med='Добровольное медицинское страхование';
					$accident='Страхование от несчастного случая';
					$go_beyond='Страхование выезжающих за рубеж';
					$fisics='Страхование имущества физических лиц';
					$judgment='Страхование имущества юридических лиц';
					$resp='Страхование ответственности';
					$cargos='Страхование грузов';
					$build='Страхование строительно-монтажных работ';
					$dangerous='Страхование особо опасных объектов';
					$listOptions=array( '0'=>'-Выберите из списка-',
								$auto=>$auto,
								$med=>$med,
								$accident=>$accident,
								$go_beyond=>$go_beyond,
								$fisics=>$fisics,
								$judgment=>$judgment,
								$resp=>$resp,
								$cargos=>$cargos,
								$build=>$build,
								$dangerous=>$dangerous
							);
					echo CHtml::dropDownList('insur_species','',$listOptions,array('onblur'=>'toggleFieldWarning(this.id);'));?>
                </td>
              </tr>
              <tr>
                <td>Текст вашей заявки:</td>
                <td><?=CHtml::textArea('message','',array('rows'=>10,'onblur'=>'toggleFieldWarning(this.id);'));?></td>
              </tr>
	  </table>
    	<div align="center" class="row submit">
    <?php echo CHtml::submitButton('Отправить заявку!'); ?>
    	</div>
    </div>
<?=CHtml::endForm();?>
</div>
