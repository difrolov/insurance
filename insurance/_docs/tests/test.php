<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Документ без названия</title>
<script>
try{
//Создадим функцию {alert('Hello!')} (а функция, как мы помним, является полноправным объектом) и сделаем переменную test ссылкой на нее
	//test_link=test; //test_link теперь тоже ссылается на нашу функцию
	// test=function() {alert('Hello!')} 
	//test(); //Hello!
	//test_link(); //Hello!
	
	var test={ prop: 'sometext' } //Создаем объект со свойством prop
	test_link=test; //Создаем еще одну ссылку на этот объект

	//alert(test.prop); //sometext
	//alert(test_link.prop); //sometext

//Изменяем свойство объекта
	test_link.prop='newtext';

	//alert(test.prop); //newtext
	//alert(test_link.prop); //newtext

/*Можно было бы сказать, что свойство изменилось и там и тут - но это не так.
Объект-то один. Так что свойство изменилось в нем один раз, а ссылки просто продолжают указывать туда, куда и указывают. */

//Добавляем новое свойство и удаляем старое
	test.new_prop='hello';
	delete test.prop;
	//undefined - такого свойства больше нет:
	alert('alert 1\ntest_link.prop: '+test_link.prop); 
	//hello - что и следовало ожидать:
	alert('alert 2\ntest_link.new_prop: '+test_link.new_prop); 

//Удаляем ссылку
	delete test;

/*В этом месте скрипт выкинет ошибку, потому что test уже не существует, и test.new_prop не существует тем более */
	alert('alert 3\ntest.new_prop: '+test.new_prop); 

/* а вот тут все в порядке, ведь мы удалили не сам объект, а лишь ссылку на него. Теперь на наш объект указывает единственная ссылка test_link */
	alert('alert 4\ntest_link.new_prop: '+test_link.new_prop); //hello
}catch(e){
	alert(e.message);
}
</script>
</head>
<body>
</body>
</html>