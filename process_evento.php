<?php
ob_start();
require_once("globals.php");
require_once("db.php");
require_once("models/evento.php");
require_once("models/message.php");
require_once("dao/eventoDao.php");

$message = new Message($BASE_URL);
$eventoDao = new eventoDAO($conn, $BASE_URL);

// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuário

if ($type === "create") {

    // Receber os dados dos inputs
    $paciente = filter_input(INPUT_POST, "paciente");
    $sexo = filter_input(INPUT_POST, "sexo");
    $idade = filter_input(INPUT_POST, "idade");
    $hospital = filter_input(INPUT_POST, "hospital");
    $data_visita = filter_input(INPUT_POST, "data_visita");
    $data_evento = filter_input(INPUT_POST, "data_evento");
    $rel_evento = filter_input(INPUT_POST, "rel_evento");
    $rel_impacto = filter_input(INPUT_POST, "rel_impacto");
    $auditor = filter_input(INPUT_POST, "auditor");
    $propria = filter_input(INPUT_POST, "propria");
    $empresa = filter_input(INPUT_POST, "empresa");
    $obito = filter_input(INPUT_POST, "obito");
    $prolongamento = filter_input(INPUT_POST, "prolongamento");
    $tipo_evento = filter_input(INPUT_POST, "tipo_evento");
    $gravidade = filter_input(INPUT_POST, "gravidade");
    $impacto = filter_input(INPUT_POST, "impacto");
    $classificacao = filter_input(INPUT_POST, "classificacao");
    $rel_prolongamento = filter_input(INPUT_POST, "rel_prolongamento");
    $evitavel = filter_input(INPUT_POST, "evitavel");
    $senha = filter_input(INPUT_POST, "senha");
    $alta = filter_input(INPUT_POST, "alta");
    $seguradora = filter_input(INPUT_POST, "seguradora");

    $evento = new evento();

    // Validação mínima de dados
    if (!empty($paciente)) {

        $evento->paciente = $paciente;
        $evento->sexo = $sexo;
        $evento->hospital = $hospital;
        $evento->idade = $idade;
        $evento->data_visita = $data_visita;
        $evento->data_evento = $data_evento;
        $evento->rel_evento = $rel_evento;
        $evento->rel_impacto = $rel_impacto;
        $evento->auditor = $auditor;
        $evento->propria = $propria;
        $evento->empresa = $empresa;
        $evento->obito = $obito;
        $evento->prolongamento   = $prolongamento;
        $evento->tipo_evento = $tipo_evento;
        $evento->gravidade = $gravidade;
        $evento->impacto = $hospital;
        $evento->classificacao = $classificacao;
        $evento->rel_prolongamento = $rel_prolongamento;
        $evento->evitavel = $evitavel;
        $evento->senha = $senha;
        $evento->alta = $alta;
        $evento->seguradora = $seguradora;

        $eventoDao->create($evento);
    } else {

        $message->setMessage("Você precisa adicionar pelo menos: evento_ant do evento!", "error", "cad_internacao.php");
    }
} else if ($type === "update") {

    $eventoDao = new eventoDAO($conn, $BASE_URL);

    // Receber os dados dos inputs
    $id_evento = filter_input(INPUT_POST, "id_evento");
    $paciente = filter_input(INPUT_POST, "paciente");
    $sexo = filter_input(INPUT_POST, "sexo");
    $idade = filter_input(INPUT_POST, "idade");
    $hospital = filter_input(INPUT_POST, "hospital");
    $data_visita = filter_input(INPUT_POST, "data_visita");
    $data_evento = filter_input(INPUT_POST, "data_evento");
    $rel_evento = filter_input(INPUT_POST, "rel_evento");
    $rel_impacto = filter_input(INPUT_POST, "rel_impacto");
    $auditor = filter_input(INPUT_POST, "auditor");
    $propria = filter_input(INPUT_POST, "propria");
    $empresa = filter_input(INPUT_POST, "empresa");
    $obito = filter_input(INPUT_POST, "obito");
    $prolongamento = filter_input(INPUT_POST, "prolongamento");
    $tipo_evento = filter_input(INPUT_POST, "tipo_evento");
    $gravidade = filter_input(INPUT_POST, "gravidade");
    $impacto = filter_input(INPUT_POST, "impacto");
    $classificacao = filter_input(INPUT_POST, "classificacao");
    $rel_prolongamento = filter_input(INPUT_POST, "rel_prolongamento");
    $evitavel = filter_input(INPUT_POST, "evitavel");
    $senha = filter_input(INPUT_POST, "senha");
    $alta = filter_input(INPUT_POST, "alta");
    $seguradora = filter_input(INPUT_POST, "seguradora");

    $eventoData = $eventoDao->findById($id_evento);

    $eventoData->id_evento = $id_evento;
    $evento->paciente = $paciente;
    $evento->sexo = $sexo;
    $evento->hospital = $hospital;
    $evento->idade = $idade;
    $evento->data_visita = $data_visita;
    $evento->data_evento = $data_evento;
    $evento->rel_evento = $rel_evento;
    $evento->rel_impacto = $rel_impacto;
    $evento->auditor = $auditor;
    $evento->propria = $propria;
    $evento->empresa = $empresa;
    $evento->obito = $obito;
    $evento->prolongamento   = $prolongamento;
    $evento->tipo_evento = $tipo_evento;
    $evento->gravidade = $gravidade;
    $evento->impacto = $hospital;
    $evento->classificacao = $classificacao;
    $evento->rel_prolongamento = $rel_prolongamento;
    $evento->evitavel = $evitavel;
    $evento->senha = $senha;
    $evento->alta = $alta;
    $evento->seguradora = $seguradora;

    $eventoDao->update($eventoData);

    include_once('list_evento.php');
}
//$type = "delete";
//$type = filter_input(INPUT_POST, "type");

if ($type === "delete") {
    // Recebe os dados do form
    $id_evento = filter_input(INPUT_POST, "id_evento");
    echo (filter_input(INPUT_POST, "id_evento"));
    $eventoDao = new eventoDAO($conn, $BASE_URL);

    $evento = $eventoDao->findById($id_evento);

    if ($evento) {

        $eventoDao->destroy($id_evento);

        include_once('list_evento.php');
    } else {

        $message->setMessage("Informações inválidas!", "error", "index.php");
    }
}
