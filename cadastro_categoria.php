<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_categoria = $_POST['nome_categoria'];

    // Inserir categoria no banco de dados
    $stmt = $conn->prepare("INSERT INTO categorias (nome) VALUES (:nome_categoria)");
    $stmt->bindParam(':nome_categoria', $nome_categoria);
    $stmt->execute();
}
?>

<form action="" method="POST">
    <label for="nome_categoria">Nome da Categoria:</label>
    <input type="text" name="nome_categoria" id="nome_categoria" required>
    <button type="submit">Cadastrar Categoria</button>
</form>
