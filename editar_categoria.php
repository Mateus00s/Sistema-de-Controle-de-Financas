<?php
include('conexao.php');

if (isset($_GET['id'])) {
    $id_categoria = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM categorias WHERE id = :id");
    $stmt->bindParam(':id', $id_categoria);
    $stmt->execute();
    $categoria = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_categoria = $_POST['nome_categoria'];
    
    $stmt = $conn->prepare("UPDATE categorias SET nome = :nome_categoria WHERE id = :id");
    $stmt->bindParam(':nome_categoria', $nome_categoria);
    $stmt->bindParam(':id', $id_categoria);
    $stmt->execute();
    
    header("Location: listar_categorias.php");
    exit();
}
?>

<form action="" method="POST">
    <label for="nome_categoria">Nome da Categoria:</label>
    <input type="text" name="nome_categoria" id="nome_categoria" value="<?= $categoria['nome'] ?>" required>
    <button type="submit">Atualizar Categoria</button>
</form>
