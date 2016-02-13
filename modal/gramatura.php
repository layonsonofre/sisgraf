<div id="modalGramatura" class="modal">
    <form class="form col s12" role="form" id="formGramatura">
        <div class="modal-content">
            <h4>Atualizar Gramatura</h4>
            <div class="row">
                <div class="input-field col s6">
                    <input type="hidden" id="idGramatura" name="idGramatura">
                    <input name="gramatura" id="gramatura" type="text" class="validate right-align">
                    <label for="gramatura">Gramatura <i>(g/m<sup>2</sup>)</i></label>
                </div>
            </div>
            <div class="row">
                <div id="listaGramaturas"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-action btn waves-effect waves-light green accent-4" type="submit" name="salvar" id="salvar">Salvar<i class="material-icons right">send</i></button>
            <a class="waves-effect waves-green btn-flat" id="verGramaturas">Ver Gramaturas<i class="material-icons left">replay</i></a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat cancelar">Cancelar</a>
        </div>
        <input type="hidden" name="acao" value="inserirGramatura">
    </form>
</div>
<script src="js/ajax/gramatura.js"></script>