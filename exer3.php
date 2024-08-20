<?php require("cabecalho.php"); ?>
<h1>Atividade 3</h1>
<?php

echo "<h2>Distribuição de Bônus Anual</h2>";
$lucro = 100;
$funcionarios = [
   ['nome' => 'Tharson', 'escalafao' => 5],
   ['nome' => 'Noah', 'escalafao' => 3],
   ['nome' => 'Lucas', 'escalafao' => 1],
   ['nome' => 'Gabriela', 'escalafao' => 4],
   ['nome' => 'Giovani', 'escalafao' => 2],
];
$bonusDistribuido = [];
foreach ($funcionarios as $funcionario) {
   $percentual = 0;
   switch ($funcionario['escalafao']) {
       case 1:
           $percentual = 0.01;
           break;
       case 2:
           $percentual = 0.02;
           break;
       case 3:
           $percentual = 0.03;
           break;
       case 4:
           $percentual = 0.05;
           break;
       case 5:
           $percentual = 0.07;
           break;
   }
   $bonus = $lucro * $percentual;
   $bonusDistribuido[] = [
       'nome' => $funcionario['nome'],
       'bonus' => $bonus
   ];
}

echo "<table class='table'>";
echo "<tr><th>Funcionário</th><th>Bônus</th></tr>";
foreach ($bonusDistribuido as $bonus) {
   echo "<tr>";
   echo "<td>" . $bonus['nome'] . "</td>";
   echo "<td>R$ " . number_format($bonus['bonus'], 2, ',', '.') . "</td>";
   echo "</tr>";
}
echo "</table>";
require("rodape.php");
?>