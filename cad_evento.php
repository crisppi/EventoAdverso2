<?php
//session_start();

require_once("templates/header.php");
require_once("dao/eventoDao.php");
require_once("models/message.php");

$message = new Message($BASE_URL);

$flassMessage = $message->getMessage();
if (!empty($flassMessage["msg"])) {
    // Limpar a mensagem
    $message->clearMessage();
}
$eventoDao = new eventoDAO($conn, $BASE_URL);

// Receber id do evento
$id_evento = filter_input(INPUT_GET, "id_evento");

?>
<div id="main-container" class="container-fluid">

    <div class="row">
        <h3 class="page-title">Cadastrar - Evento Adverso</h3>
        <p class="page-description">Adicione informações sobre o evento</p>

        <form class="formulario" action="<?= $BASE_URL ?>process_evento.php" id="add-evento-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="create">
            <hr>
            <div class="form-group row">
                <div class="form-group col-sm-4">
                    <label for="paciente">Nome do Paciente</label>
                    <input type="text" class="form-control" id="paciente" required name="paciente" placeholder="Digite o nome do paciente" required>
                </div>
                <div class="form-group col-sm-1">
                    <label for="idade">Idade</label>
                    <input type="text" class="form-control" id="idade" name="idade" placeholder="Digite a idade">
                </div>
                <div class="form-group col-sm-1 ">
                    <label class="control-label" for="sexo">Sexo</label>
                    <select class="form-control" id="sexo" name="sexo">
                        <option value="">Selecione</option>
                        <option value="Feminino">Feminino</option>
                        <option value="Masculino">Masculino</option>
                    </select>
                </div>
                <div class="form-group col-sm-2">
                    <label class="control-label" for="hospital">Hospital</label>
                    <select class="form-control" id="hospital" name="hospital">
                        <option value="">Selecione</option>
                        <option value="São Luiz Itaim">São Luiz Itaim</option>
                        <option value="São Luiz Anália Franco">São Luiz Anália Franco</option>
                    </select>
                </div>
                <div class="form-group col-sm-1">
                    <label for="senha">Senha</label>
                    <input type="text" class="form-control" id="senha" name="senha" placeholder="Digite a senha" required>
                </div>
                <div class="form-group col-sm-1">
                    <label for="data_evento">Data do EA</label>
                    <input type="date" class="form-control" id="data_evento" name="data_evento">
                </div>
                <div class="form-group col-sm-1">
                    <label for="data_visita">Data visita</label>
                    <input type="date" class="form-control" id="data_visita" name="data_visita">
                </div>
                <div class="form-group row">
                    <div class="form-group col-sm-2">
                        <label class="control-label" for="propria">Auditoria própria</label>
                        <select class="form-control" id="propria" name="propria">
                            <option value="">Selecione</option>
                            <option value="s">Sim</option>
                            <option value="n">Não</option>
                        </select>

                    </div>
                    <div class="form-group col-sm-2">
                        <label class="control-label" for="empresa">Nome da Empresa</label>
                        <select class="form-control" id="empresa" name="empresa">
                            <option value="">Selecione</option>
                            <option value="HM">HM</option>
                            <option value="Conex">Conex</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="auditor">Nome do auditor</label>
                        <input type="text" class="form-control" id="auditor" name="auditor" placeholder="Digite o nome do auditor" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="form-group col-sm-2">
                        <label class="control-label" for="prolongamento">Prolongamento da internação</label>
                        <select class="form-control" id="prolongamento" name="prolongamento">
                            <option value="">Selecione</option>
                            <option value="s">Sim</option>
                            <option value="n">Não</option>
                        </select>
                        <p style="text-align:justify;font-size:0.6em;padding-left:7px">Caso entenda que o prolongamento da internação foi causada pelo EA</p>
                    </div>
                    <div class="form-group col-sm-10">
                        <label for="rel_prolongamento">Motivo do prolongamento </label>
                        <textarea rows="10" class="form-control" id="rel_prolongamento" name="rel_prolongamento"></textarea>
                    </div>
                </div>
                <div class="form-group row">

                    <div class="form-group col-sm-2 ">
                        <label class="control-label" for="impacto">Impacto nos custos da internação</label>
                        <select class="form-control" id="impacto" name="impacto">
                            <option value="">Selecione</option>
                            <option value="s">Sim</option>
                            <option value="n">Não</option>
                        </select>
                        <p style="text-align:justify;font-size:0.6em;padding-left:7px">Selecione caso entenda que o evento causou impacto no custo da internação</p>
                    </div>
                    <div class="form-group col-sm-10">
                        <label for="rel_impacto">Relatório sobre impacto nos custos </label>
                        <textarea rows="10" class="form-control" id="rel_impacto" name="rel_impacto"></textarea>
                    </div>
                </div>
                <div class="form-group col-sm-2 ">
                    <label class="control-label" for="gravidade">Classificação do EA</label>
                    <select class="form-control" id="gravidade" name="gravidade">
                        <option value="">Selecione</option>
                        <option value="Grave">Grave</option>
                        <option value="Moderado">Moderado</option>
                        <option value="Leve">Leve</option>
                    </select>
                    <p style="text-align:justify;font-size:0.6em;padding-left:7px">Qual sua opinão sobre a gravidade do evento?</p>
                </div>
                <div class="form-group col-sm-2 ">
                    <label class="control-label" for="evitavel">Evitável</label>
                    <select class="form-control" id="evitavel" name="evitavel">
                        <option value="">Selecione</option>
                        <option value="s">Sim</option>
                        <option value="n">Não</option>
                    </select>
                    <p style="text-align:justify;font-size:0.6em;padding-left:7px">Na sua opinião poderia ser evitado?</p>
                </div>
                <div class="form-group row">
                    <div class="form-group col-sm-12">
                        <label for="rel_evento">Relatório sobre o caso </label>
                        <textarea rows="10" class="form-control" id="rel_evento" name="rel_evento"></textarea>
                    </div>
                </div>
            </div>
            <br>
    </div>
    <button style="margin:10px" type="submit" class="btn-sm btn-info">Cadastrar</button>
    <br>
    <?php if (!empty($flassMessage["msg"])) : ?>
        <div class="msg-container">
            <p class="msg <?= $flassMessage["type"] ?>"><?= $flassMessage["msg"] ?></p>
        </div>
    <?php endif; ?>
</div>

</form>
<div>
    <hr>

    <a class="btn btn-success" style="margin-left:20px" href="list_evento.php">Listar
    </a>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<?php
require_once("templates/footer.php");
?>