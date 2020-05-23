

<?php
if ($_POST){
//Incrementamos el valor
$conta = $_POST["conta"] + 1;
}
else{
//Valor inicial
$conta = 0;

}
echo $conta;
?>
<html>
...
 
<form name="f1" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
<input type="hidden" name="conta" value="<?=$conta?>">
<input type="submit" value="Incrementar">
</form>
 
...
</html>