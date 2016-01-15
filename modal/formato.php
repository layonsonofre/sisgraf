<div id="modalFormato" class="modal center-text">
    <form class="col s12" role="form" id="formFormato">
        <div class="modal-content">
            <h4>Atualizar Formato</h4>
            <div class="row">
                <div class="input-field col s4">
                    <input name="formato" id="formato" type="text" class="validate" length="32" maxlength="32">
                    <label for="formato">Formato</label>
                </div>
                <div class="input-field col s3">
                    <input name="baseFormato" id="baseFormato" type="text" class="validate right-align" data-mask="99?99">
                    <label for="baseFormato" class="active">Base (mm)</label>
                </div>
                <div class="input-field col s3">
                    <input name="alturaFormato" id="alturaFormato" type="text" class="validate right-align" data-mask="99?99">
                    <label for="alturaFormato" class="active">Altura (mm)</label>
                </div>
                <div class="input-field col s3">
                    <input name="valorFormato" id="valorFormato" type="text" class="validate" length="10" maxlength="10">
                    <label for="valorFormato">Valor (R$)</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-action btn waves-effect waves-light green accent-4" type="submit" name="salvar" id="salvar">Salvar<i class="material-icons right">send</i></button>
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
        </div>
        <input type="hidden" name="acao" value="inserirFormato">
    </form>
</div>
<script src="js/ajax/formato.js"></script>