<?php
include('conexao.php');

$stmt = $conn->prepare("SELECT m.id, m.nome, m.ano, SUM(IF(t.tipo_transacao = 'entrada', t.valor, 0)) AS total_entradas, 
                       SUM(IF(t.tipo_transacao = 'saida', t.valor, 0)) AS total_saidas
                       FROM meses m
                       LEFT JOIN movimentacoes t ON m.id = t.id_mes
                       GROUP BY m.id");
$stmt->execute();
$meses = $stmt->fetchAll();

echo "<table>";
echo "<tr><th>Mês</th><th>Entradas</th><th>Saídas</th><th>Saldo</th></tr>";
foreach ($meses as $mes) {
    $saldo = $mes['total_entradas'] - $mes['total_saidas'];
    $cor = $saldo > 0 ? 'green' : ($saldo < 0 ? 'red' : 'yellow');
    echo "<tr style='color: $cor'>
            <td>{$mes['nome']} {$mes['ano']}</td>
            <td>{$mes['total_entradas']}</td>
            <td>{$mes['total_saidas']}</td>
            <td>$saldo</td>
          </tr>";
}
echo "</table>";
?>
