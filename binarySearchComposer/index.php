<form method="post">
    <label for="numero">Digite um número a ser procurado:</label>
    <input type="number" id="numero" name="numero" required>
    <button type="submit">Enviar</button>
</form>

<?php
require 'vendor/autoload.php';
require 'src/Solution.php';

$numero = '';
$array = array(-5, -2, 0, 1, 2, 4, 5, 6, 7, 10);

    if (isset($_POST['numero']))
    {               
        $numero = $_POST['numero'];

        $solution = new Solution();
        

        $solution->exibirArray($array);

        echo 'O número digitado '. $numero . ' está na posição ' . $solution->binarySearch($array, $numero) . ' do array utilizando busca binária.';
    } 
?>
