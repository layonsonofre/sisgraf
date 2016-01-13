<div id="modalUnidadeDeMedida" class="modal">
    <form class="col s12" role="form" id="formUnidadeDeMedida">
        <div class="modal-content">
            <h4>Atualizar Unidade de Medida</h4>
            <div class="row">
                <div class="input-field col s6">
                    <input name="descricao" id="descricao" type="text" class="validate" length="10" maxlength="10">
                    <label for="descricao">Descrição</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-action btn waves-effect waves-light green accent-4" type="submit" name="salvar" id="salvar">Salvar<i class="material-icons right">send</i></button>
            <a class="modal-action modal-close waves-effect waves-green btn-flat" id="cancelar">Cancelar</a>
        </div>
        <input type="hidden" name="acao" value="inserirUnidadeDeMedida">
    </form>
</div>