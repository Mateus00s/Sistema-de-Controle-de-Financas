<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_mes = $_POST['nome_mes'];
    $ano = $_POST['ano'];

    // Inserir mês no banco de dados
    $stmt = $conn->prepare("INSERT INTO meses (nome, ano) VALUES (:nome_mes, :ano)");
    $stmt->bindParam(':nome_mes', $nome_mes);
    $stmt->bindParam(':ano', $ano);
    $stmt->execute();
}
?>

<form action="" method="POST">
    <label for="nome_mes">Nome do Mês:</label>
    <select name="nome_mes" id="nome_mes" required>
        <option value="Janeiro">Janeiro</option>
        <option value="Fevereiro">Fevereiro</option>
        <option value="Março">Março</option>
        <option value="Abril">Abril</option>
        <option value="Maio">Maio</option>
        <option value="Junho">Junho</option>
        <option value="Julho">Julho</option>
        <option value="Agosto">Agosto</option>
        <option value="Setembro">Setembro</option>
        <option value="Outubro">Outubro</option>
        <option value="Novembro">Novembro</option>
        <option value="Dezembro">Dezembro</option>
    </select>
    <input type="number" name="ano" id="ano" required>
    <button type="submit">Cadastrar Mês</button>
</form>
