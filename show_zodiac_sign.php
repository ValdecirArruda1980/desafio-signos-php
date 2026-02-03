<?php include('layouts/header.php'); ?>

<div class="container mt-5">
    <?php
    // Verifica se a data foi enviada
    if (!isset($_POST['data_nascimento'])) {
        echo "<div class='alert alert-warning'>Por favor, informe uma data válida.</div>";
        echo "<a href='index.php' class='btn btn-primary'>Voltar</a>";
        exit;
    }

    $data_nascimento = $_POST['data_nascimento'];
    $signos = simplexml_load_file("signos.xml");

    // Verifica se o XML carregou para evitar erro 500
    if (!$signos) {
        echo "<div class='alert alert-danger'>Erro ao carregar o arquivo de signos.</div>";
        exit;
    }

    $data_nascimento_objeto = new DateTime($data_nascimento);
    $dia_mes_nascimento = $data_nascimento_objeto->format('m-d');

    $signo_encontrado = null;

    foreach ($signos->signo as $signo) {
        // Converte as datas do XML para comparação
        $inicio = DateTime::createFromFormat('d/m', (string)$signo->dataInicio)->format('m-d');
        $fim = DateTime::createFromFormat('d/m', (string)$signo->dataFim)->format('m-d');

        // Lógica para verificar o intervalo (considerando signos que cruzam o ano)
        if ($inicio > $fim) { // Caso de Capricórnio (Dezembro -> Janeiro)
            if ($dia_mes_nascimento >= $inicio || $dia_mes_nascimento <= $fim) {
                $signo_encontrado = $signo;
                break;
            }
        } else {
            if ($dia_mes_nascimento >= $inicio && $dia_mes_nascimento <= $fim) {
                $signo_encontrado = $signo;
                break;
            }
        }
    }

    if ($signo_encontrado) {
        echo "<div class='card shadow p-4 text-center'>";
        echo "<h1>{$signo_encontrado->signoNome}</h1>";
        echo "<p class='lead'>{$signo_encontrado->descricao}</p>";
        echo "<a href='index.php' class='btn btn-secondary mt-3'>Voltar</a>";
        echo "</div>";
    } else {
        echo "<div class='alert alert-danger'>Não foi possível encontrar seu signo.</div>";
        echo "<a href='index.php' class='btn btn-primary'>Voltar</a>";
    }
    ?>
</div>
</body>
</html>