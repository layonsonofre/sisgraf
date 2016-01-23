<div id="modalQuantidadeCores" class="modal">
    <form class="col s6" role="form" id="formQuantidadeCores">
        <div class="modal-content">
            <h4>Atualizar Quantidade de Cores</h4>
            <div class="row">
                <div class="input-field col s3">
                    <input name="descricao" id="descricao" type="text" class="validate" length="3" maxlength="3" data-mask="9x9">
                    <label for="descricao">Quantidade (Ex.: 4x4)</label>
                </div>
                <div class="input-field col s3">
                    <input name="valor" id="valor" type="text" class="validate" length="10" maxlength="10">
                    <label for="valor">Valor (R$)</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-action btn waves-effect waves-light green accent-4" type="submit" name="salvar" id="salvar">Salvar<i class="material-icons right">send</i></button>
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
        </div>
        <input type="hidden" name="acao" value="inserirQuantidadeCores">
    </form>
</div>
<script src="js/ajax/quantidadeCores.js"></script>