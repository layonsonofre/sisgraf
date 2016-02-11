<div id="modalModeloNotaFiscal" class="modal center-text">
    <form class="col s12" role="form" id="formModeloNotaFiscal">
        <div class="modal-content">
            <h4>Atualizar Modelo de Nota Fiscal</h4>
            <div class="row">
                <div class="input-field col s5">
                    <input type="hidden" name="idModeloModal" id="idModeloModal">
                    <input name="modeloNotaModal" id="modeloNotaModal" type="text" class="validate" length="10" maxlength="10" required>
                    <label for="modeloNotaModal">Modelo</label>
                </div>
                <div class="input-field col s7">
                    <input name="descricaoNotaModal" id="descricaoNotaModal" type="text" class="validate" length="50" maxlength="50" required>
                    <label for="descricaoNotaModal">Descrição</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s5">
                    <input name="valorNotaModal" id="valorNotaModal" type="text" class="validate" length="10" maxlength="10" required>
                    <label for="valorNotaModal">Valor (R$)</label>
                </div>
            </div>
            <div class="row">
                <div id="listaModelos"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-action btn waves-effect waves-light green accent-4" type="submit">Salvar<i class="material-icons right">send</i></button>
            <a class="waves-effect waves-green btn-flat" id="verModelos">Ver Modelos<i class="material-icons left">replay</i></a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat cancelar">Cancelar</a>
        </div>
        <input type="hidden" name="acao" value="inserirModeloNotaFiscal">
    </form>
</div>
<script src="js/ajax/modeloNotaFiscal.js"></script>