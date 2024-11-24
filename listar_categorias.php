<?php
include('conexao.php');

$stmt = $conn->prepare("SELECT * FROM categorias");
$stmt->execute();
$categorias = $stmt->fetchAll();

echo "<ul>";
foreach ($categorias as $categoria) {
    echo "<li>{$categoria['nome']} <a href='editar_categoria.php?id={$categoria['id']}'>Editar</a> | 
    <a href='excluir_categoria.php?id={$categoria['id']}'>Excluir</a></li>";
}
echo "</ul>";
?>
