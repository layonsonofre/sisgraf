<div id="modalFormaImpressao" class="modal center-text">
    <form class="col s12" role="form" id="formFormaImpressao">
        <div class="modal-content">
            <h4>Atualizar Forma de Impressão</h4>
            <div class="row">
                <div class="input-field col s4">
                    <input name="nome" id="nome" type="text" class="validate" length="15" maxlength="15">
                    <label for="nome">Nome</label>
                </div>
                <div class="input-field col s6">
                    <input name="descricao" id="descricao" type="text" class="validate" length="35" maxlength="35">
                    <label for="descricao">Descrição</label>
                </div>
                <div class="input-field col s5">
                    <input name="valor" id="valor" type="text" class="validate" length="10" maxlength="10">
                    <label for="valor">Valor (R$)</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-action btn waves-effect waves-light green accent-4" type="submit" name="salvar" id="salvar">Salvar<i class="material-icons right">send</i></button>
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
        </div>
        <input type="hidden" name="acao" value="inserirAcabamento">
    </form>
</div>
<script src="js/ajax/formaImpressao.js"></script>