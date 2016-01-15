<div id="modalModeloNotaFiscal" class="modal center-text">
    <form class="col s12" role="form" id="formModeloNotaFiscal">
        <div class="modal-content">
            <h4>Atualizar Modelo de Nota Fiscal</h4>
            <div class="row">
                <div class="input-field col s4">
                    <input name="modelo" id="modelo" type="text" class="validate" length="10" maxlength="10">
                    <label for="modelo">Modelo</label>
                </div>
                <div class="input-field col s8">
                    <input name="descricao" id="descricao" type="text" class="validate" length="50">
                    <label for="descricao">Descrição</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-action btn waves-effect waves-light green accent-4" type="submit" name="salvar" id="salvar">Salvar<i class="material-icons right">send</i></button>
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
        </div>
        <input type="hidden" name="acao" value="inserirModeloNotaFiscal">
    </form>
</div>
<script src="js/ajax/modeloNotaFiscal.js"></script>