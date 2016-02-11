<div id="modalAcabamento" class="modal center-text">
    <form class="col s12" role="form" id="formAcabamento">
        <div class="modal-content">
            <h4>Atualizar Acabamento</h4>
            <div class="row">
                <div class="input-field col s5">
                    <input name="idAcabamento" id="idAcabamento" type="hidden">
                    <input name="nomeAcabamento" id="nomeAcabamento" type="text" class="validate" length="15" maxlength="15" required>
                    <label for="nomeAcabamento">Nome</label>
                </div>
                <div class="input-field col s7">
                    <input name="descricaoAcabamento" id="descricaoAcabamento" type="text" class="validate" length="35" maxlength="35" required>
                    <label for="descricaoAcabamento">Descrição</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s7">
                    <input name="localAcabamento" id="localAcabamento" type="text" class="validate" length="25" maxlength="25" required>
                    <label for="localAcabamento">Local de Aplicação</label>
                </div>
                <div class="input-field col s5">
                    <input name="valorAcabamento" id="valorAcabamento" type="text" class="validate" length="10" maxlength="10" required>
                    <label for="valorAcabamento">Valor (R$)</label>
                </div>
            </div>
            <div class="row">
                <div id="listaAcabamentos"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-action btn waves-effect waves-light green accent-4" type="submit" name="salvar" id="salvar">Salvar<i class="material-icons right">send</i></button>
            <a class="waves-effect waves-green btn-flat" id="verAcabamentos">Ver Acabamentos<i class="material-icons left">replay</i></a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat cancelar">Cancelar</a>
        </div>
        <input type="hidden" name="acao" value="inserirAcabamento">
    </form>
</div>
<script src="js/ajax/acabamento.js"></script>