<div id="modalUnidadeDeMedida" class="modal">
    <form class="form col s12" role="form" id="formUnidadeDeMedida">
        <div class="modal-content">
            <h4>Atualizar Unidade de Medida</h4>
            <div class="row">
                <div class="input-field col s6">
                    <input type="hidden" name="idUnidade" id="idUnidade">
                    <input name="descricaoUnidade" id="descricaoUnidade" type="text" class="valor validate" length="10" maxlength="10" required>
                    <label for="descricaoUnidade">Descrição</label>
                </div>
            </div>
            <div class="row">
                <div id="listaUnidades"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-action btn waves-effect waves-light green accent-4" type="submit" name="salvar" id="salvar">Salvar<i class="material-icons right">send</i></button>
            <a class="waves-effect waves-green btn-flat" id="verUnidades">Ver Unidades de Medida<i class="material-icons left">replay</i></a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat cancelar" id="cancelar">Cancelar</a>
        </div>
        <input type="hidden" name="acao" value="inserirUnidadeDeMedida">
    </form>
</div>
<script src="js/ajax/unidadeDeMedida.js"></script>
<script src="js/autoNumeric-min.js"></script>
<script src="js/valor.js"></script>