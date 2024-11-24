<?php
include('conexao.php');

if (isset($_GET['id'])) {
    $id_mes = $_GET['id'];
    
    $stmt = $conn->prepare("SELECT * FROM movimentacoes WHERE id_mes = :id_mes");
    $stmt->bindParam(':id_mes', $id_mes);
    $stmt->execute();
    $movimentacoes = $stmt->fetchAll();
    
    $total_entradas = 0;
    $total_saidas = 0;
    
    foreach ($movimentacoes as $movimentacao) {
        if ($movimentacao['tipo_transacao'] == 'entrada') {
            $total_entradas += $movimentacao['valor'];
        } else {
            $total_saidas += $movimentacao['valor'];
        }
    }

    $saldo = $total_entradas - $total_saidas;
    $cor = $saldo > 0 ? 'green' : ($saldo < 0 ? 'red' : 'yellow');

    echo "<h3>Resumo do Mês</h3>";
    echo "<p><strong>Total de Entradas:</strong> $total_entradas</p>";
    echo "<p><strong>Total de Saídas:</strong> $total_saidas</p>";
    echo "<p><strong>Saldo Final:</strong> <span style='color:$cor'>$saldo</span></p>";
}
?>
