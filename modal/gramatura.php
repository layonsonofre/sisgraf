<div id="modalGramatura" class="modal">
    <form class="col s12" role="form" method="POST" action="control/material.php">
        <div class="modal-content">
            <h4>Atualizar Gramatura</h4>
            <div class="row">
                <div class="input-field col s6">
                    <input name="gramatura" id="gramatura" type="text" class="validate right-align">
                    <label for="gramatura">Gramatura (g/cm^3)</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-action btn waves-effect waves-light green accent-4" type="submit" name="salvar">Salvar<i class="material-icons right">send</i></button>
            <a href="#" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
        </div>
        <input type="hidden" name="acao" value="inserirGramatura">
        <input type="hidden" name="tipo" value="">
    </form>
</div>