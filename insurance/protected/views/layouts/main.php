<?php /* @var $this Controller */
		// переменные на время тестирования:
		// режим отображения статических данных включается только при $test=1
if (isset($_GET['test'])) {
	if(	!$_GET['test']
		|| $_GET['test']=='0'
		|| strstr($_GET['test'],'-')
	  ) $_SESSION['test']=false;
	else $_SESSION['test']=$_GET['test'];
}
if (isset($_SESSION['test'])) $test=$_SESSION['test'];
$tp=false;

if ($oldIE=setHTML::detectOldIE()) {
echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';	require_once dirname(__FILE__)."/old_ie.php";
}else{ echo '<!DOCTYPE HTML>';
	require_once dirname(__FILE__)."/default.php";
}?>
</body>
</html>
