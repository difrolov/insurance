<?php
class UrlRules extends CBaseUrlRule
{
    public $connectionID = 'db';

    public function createUrl($manager,$route,$params,$ampersand)
    {

    /* 	parent::createUrl($manager,$route,$params,$ampersand); */
    }

    public function parseUrl($manager,$request,$pathInfo,$rawPathInfo){

    	 if (preg_match('%^(\w+)(/(\w+))?$%', $pathInfo, $matches))
            {

            	$objects = InsurInsuranceObject::model()->findAll(array('select'=>'alias','condition'=>'alias="'.$matches[0].'"'));
            	if (!empty($objects)){
            		$_SESSION['second_section']=$objects[0]->alias;
            	}
				return $objects[0]->alias;
            }

            return false;

	}

}