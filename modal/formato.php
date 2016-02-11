<div id="modalFormato" class="modal center-text">
    <form class="col s12" role="form" id="formFormato">
        <div class="modal-content">
            <h4>Atualizar Formato</h4>
            <div class="row">
                <div class="input-field col s4">
                    <input type="hidden" name="idFormatoModal" id="idFormatoModal">
                    <input name="formato" id="formatoModal" type="text" class="validate" length="32" maxlength="32" required>
                    <label class="active" for="formato">Formato</label>
                </div>
                <div class="input-field col s3">
                    <input name="baseFormato" id="baseFormatoModal" type="text" class="validate right-align" data-mask="99?99" required>
                    <label class="active" for="baseFormato">Base (mm)</label>
                </div>
                <div class="input-field col s3">
                    <input name="alturaFormato" id="alturaFormatoModal" type="text" class="validate right-align" data-mask="99?99" required>
                    <label class="active" for="alturaFormato">Altura (mm)</label>
                </div>
                <div class="input-field col s2">
                    <input name="valorFormato" id="valorFormatoModal" type="text" class="validate" length="10" maxlength="10" required>
                    <label class="active" for="valorFormato">Valor (R$)</label>
                </div>
            </div>
            <div class="row">
                <div id="listaFormatos"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-action btn waves-effect waves-light green accent-4" type="submit" name="salvar" id="salvar">Salvar<i class="material-icons right">send</i></button>
            <a class="waves-effect waves-green btn-flat" id="verFormatos">Ver Formatos<i class="material-icons left">replay</i></a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat cancelar">Cancelar</a>
        </div>
        <input type="hidden" name="acao" value="inserirFormato">
    </form>
</div>
<script src="js/ajax/formato.js"></script>