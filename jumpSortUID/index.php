

<form method="post">
    <label for="chave">Digite a chave a ser procurada:</label>
    <input type="text" id="chave" name="chave">
    <button type="submit">Enviar</button>
    <button type="submit" name="reset">Resetar chaves</button>
</form>

<?php
//Usando jumpsort em um array de UUIDs
session_start();

require_once('Solution.php');
require_once('arrayGenerator.php');

if (isset($_POST['reset'])) {
    unset($_SESSION['arr']);
}

if (!isset($_SESSION['arr'])) {
    $array = new ArrayGenerator();

    $teste = $array->genArray();   
    $_SESSION['arr'] = $array->genArray();   
    sort($_SESSION['arr']);
}

$arr = $_SESSION['arr'];
//$arr = [1, 2, 3, 5, 8, 13, 21, 34, 55, 89, 144, 233, 377, 610, 611, 612];
echo 'Para as chaves geradas: <br>';
foreach ($arr as $value) echo $value . '<br>';
echo '<br><br>';

if (isset($_POST['chave']))
    {
        $find = $_POST['chave'];            
        
        $solution = new Solution();

        $posicao = $solution->jumpSort($arr, $find);

        if ($posicao !== NULL) echo 'A chave ' . $find . ' está na posição ' . $posicao;
            else echo 'A chave ' . $find . ' não está no array.';
    }