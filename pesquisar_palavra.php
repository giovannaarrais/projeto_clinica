<?php 

include_once './config.php';

// Obtém o valor de 'nome' passado na URL
$nome_palavra = filter_input(INPUT_GET, "nome", FILTER_DEFAULT);

if (!empty($nome_palavra)) {
    // Prepara a palavra para busca com o operador LIKE
    $pesquisa_palavra = "%" . $nome_palavra . "%";

    // Consulta SQL ajustada
    $query_palavras = "SELECT 
        nome_paciente,
        cpf_paciente,
        dt_nasc_paciente,
        email_paciente,
        endereco_paciente,
        fone_paciente,
        sexo_paciente 
    FROM 
        paciente 
    WHERE 
        nome_paciente LIKE ? OR 
        cpf_paciente LIKE ? OR 
        dt_nasc_paciente LIKE ? OR 
        email_paciente LIKE ? OR 
        endereco_paciente LIKE ? OR 
        fone_paciente LIKE ? OR 
        sexo_paciente LIKE ?";

    // Preparar a consulta
    $result_palavras = $conn->prepare($query_palavras);

    // Verificar se a preparação foi bem-sucedida
    if (!$result_palavras) {
        $retorna = ['status' => false, 'msg' => 'Erro na preparação da consulta: ' . $conn->error];
        echo json_encode($retorna);
        exit;
    }

    // Vincula os parâmetros para a consulta
    $result_palavras->bind_param('sssssss', $pesquisa_palavra, $pesquisa_palavra, $pesquisa_palavra, $pesquisa_palavra, $pesquisa_palavra, $pesquisa_palavra, $pesquisa_palavra);

    // Executa a consulta
    $result_palavras->execute();
    $result_palavras->store_result();

    if ($result_palavras->num_rows > 0) {
        // Cria um array para armazenar os resultados
        $dados = [];
        
        // Vincula as variáveis para cada coluna da consulta
        $result_palavras->bind_result($nome_paciente, $cpf_paciente, $dt_nasc_paciente, $email_paciente, $endereco_paciente, $fone_paciente, $sexo_paciente);

        // Busca os resultados
        while ($result_palavras->fetch()) {
            // Adiciona os resultados no array $dados
            $dados[] = [
                'nome_paciente' => $nome_paciente,
                'cpf_paciente' => $cpf_paciente,
                'dt_nasc_paciente' => $dt_nasc_paciente,
                'email_paciente' => $email_paciente,
                'endereco_paciente' => $endereco_paciente,
                'fone_paciente' => $fone_paciente,
                'sexo_paciente' => $sexo_paciente,
            ];
        }

        // Resposta com status de sucesso e dados dos pacientes encontrados
        $retorna = ['status' => true, 'data' => $dados];
    } else {
        // Caso não encontre nenhum paciente
        $retorna = ['status' => false, 'msg' => 'Nenhum paciente encontrado'];
    }
} else {
    // Caso o campo de pesquisa esteja vazio
    $retorna = ['status' => false, 'msg' => 'Por favor, insira uma palavra para buscar'];
}

// Retorna a resposta como JSON
echo json_encode($retorna);
?>
