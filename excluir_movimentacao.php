<?php
include('conexao.php');

if (isset($_GET['id'])) {
    $id_movimentacao = $_GET['id'];
    
    // Deletar movimentação
    $stmt = $conn->prepare("DELETE FROM movimentacoes WHERE id = :id");
    $stmt->bindParam(':id', $id_movimentacao);
    $stmt->execute();
    
    header("Location: listar_movimentacoes.php");
    exit();
}
?>
