<div id="modalCor" class="modal">
    <form class="col s6" role="form" id="formCor">
        <div class="modal-content">
            <h4>Atualizar Cor</h4>
            <div class="row">
                <div class="input-field col s6">
                    <input name="cor" id="cor" type="text" class="validate" length="15" maxlength="15">
                    <label for="cor">Nome da Cor</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-action btn waves-effect waves-light green accent-4" type="submit" name="salvar" id="salvar">Salvar<i class="material-icons right">send</i></button>
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
        </div>
        <input type="hidden" name="acao" value="inserirCor">
    </form>
</div>
<script src="js/ajax/cor.js"></script>