<div id="modalFormaImpressao" class="modal center-text">
    <form class="col s12" role="form" id="formFormaImpressao">
        <div class="modal-content">
            <h4>Atualizar Forma de Impressão</h4>
            <div class="row">
                <div class="input-field col s4">
                    <input type="hidden" name="idFI" id="idFI">
                    <input name="nomeFI" id="nomeFI" type="text" class="validate" length="15" maxlength="15" required>
                    <label for="nomeFI">Nome</label>
                </div>
                <div class="input-field col s6">
                    <input name="descricaoFI" id="descricaoFI" type="text" class="validate" length="35" maxlength="35" required>
                    <label for="descricaoFI">Descrição</label>
                </div>
                <div class="input-field col s5">
                    <input name="valorFI" id="valorFI" type="text" class="validate" length="10" maxlength="10" required>
                    <label for="valorFI">Valor (R$)</label>
                </div>
            </div>
            <div class="row">
                <div id="listaFI"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-action btn waves-effect waves-light green accent-4" type="submit">Salvar<i class="material-icons right">send</i></button>
            <a class="waves-effect waves-green btn-flat" id="verFI">Ver Formas de Impressão<i class="material-icons left">replay</i></a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat cancelar">Cancelar</a>
        </div>
        <input type="hidden" name="acao" value="inserirFormaImpressao">
    </form>
</div>
<script src="js/ajax/formaImpressao.js"></script>