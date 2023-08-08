<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Contratos</title>
</head>
<body>
    <?php
    // Configuração de conexão com o banco de dados
    $servername = "localhost";
    $username = "seu_usuario";
    $password = "sua_senha";
    $dbname = "seu_banco_de_dados";

    // Criando a conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificando a conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Consulta SQL para obter os dados desejados
    $sql = "SELECT Tb_banco.nome AS nome_banco, Tb_convenio.verba, Tb_contrato.codigo, Tb_contrato.data_inclusao, Tb_contrato.valor, Tb_contrato.prazo
            FROM Tb_contrato
            INNER JOIN Tb_convenio_servico ON Tb_contrato.convenio_servico = Tb_convenio_servico.codigo
            INNER JOIN Tb_convenio ON Tb_convenio_servico.convenio = Tb_convenio.codigo
            INNER JOIN Tb_banco ON Tb_convenio.banco = Tb_banco.codigo";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Exibindo os resultados em uma tabela
        echo "<table>
                <tr>
                    <th>Nome do Banco</th>
                    <th>Verba</th>
                    <th>Código do Contrato</th>
                    <th>Data de Inclusão</th>
                    <th>Valor</th>
                    <th>Prazo</th>
                </tr>";
        
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["nome_banco"]."</td>
                    <td>".$row["verba"]."</td>
                    <td>".$row["codigo"]."</td>
                    <td>".$row["data_inclusao"]."</td>
                    <td>".$row["valor"]."</td>
                    <td>".$row["prazo"]."</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "Nenhum resultado encontrado.";
    }

    // Fechando a conexão com o banco de dados
    $conn->close();
    ?>
</body>
</html>
