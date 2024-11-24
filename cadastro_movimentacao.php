<?php
include('conexao.php');

$stmt = $conn->prepare("SELECT * FROM categorias");
$stmt->execute();
$categorias = $stmt->fetchAll();

$stmt_mes = $conn->prepare("SELECT * FROM meses");
$stmt_mes->execute();
$meses = $stmt_mes->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data_transacao = $_POST['data_transacao'];
    $tipo_transacao = $_POST['tipo_transacao'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $categoria = $_POST['categoria'];
    $mes = $_POST['mes'];

    // Inserir movimentação no banco de dados
    $stmt = $conn->prepare("INSERT INTO movimentacoes (data_transacao, tipo_transacao, descricao, valor, id_categoria, id_mes) 
                            VALUES (:data_transacao, :tipo_transacao, :descricao, :valor, :categoria, :mes)");
    $stmt->bindParam(':data_transacao', $data_transacao);
    $stmt->bindParam(':tipo_transacao', $tipo_transacao);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':valor', $valor);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':mes', $mes);
    $stmt->execute();
}
?>

<form action="" method="POST">
    <label for="data_transacao">Data:</label>
    <input type="date" name="data_transacao" id="data_transacao" required>

    <label for="tipo_transacao">Tipo de Transação:</label>
    <select name="tipo_transacao" id="tipo_transacao" required>
        <option value="entrada">Entrada</option>
        <option value="saida">Saída</option>
    </select>

    <label for="descricao">Descrição:</label>
    <input type="text" name="descricao" id="descricao" required>

    <label for="valor">Valor:</label>
    <input type="number" name="valor" id="valor" step="0.01" required>

    <label for="categoria">Categoria:</label>
    <select name="categoria" id="categoria" required>
        <?php foreach ($categorias as $categoria) { ?>
            <option value="<?= $categoria['id'] ?>"><?= $categoria['nome'] ?></option>
        <?php } ?>
    </select>

    <label for="mes">Mês:</label>
    <select name="mes" id="mes" required>
        <?php foreach ($meses as $mes) { ?>
            <option value="<?= $mes['id'] ?>"><?= $mes['nome'] ?> <?= $mes['ano'] ?></option>
        <?php } ?>
    </select>

    <button type="submit">Cadastrar Movimentação</button>
</form>
