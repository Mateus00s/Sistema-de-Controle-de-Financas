<?php
include('conexao.php');

if (isset($_GET['id'])) {
    $id_categoria = $_GET['id'];
    
    // Deletar categoria
    $stmt = $conn->prepare("DELETE FROM categorias WHERE id = :id");
    $stmt->bindParam(':id', $id_categoria);
    $stmt->execute();
    
    header("Location: listar_categorias.php");
    exit();
}
?>
