<div id="modalQuantidadeCores" class="modal">
    <form class="form col s6" role="form" method="POST" action="control/tipoDeServico.php" id="formQuantidadeCores">
        <div class="modal-content">
            <h4>Atualizar Quantidade de Cores</h4>
            <div class="row">
                <div class="input-field col s3">
                    <input type="hidden" name="idQC" id="idQC">
                    <input name="descricaoQC" id="descricaoQC" type="text" class="validate" length="3" maxlength="3" data-mask="9x9" required>
                    <label for="descricaoQC">Quantidade (Ex.: 4x4)</label>
                </div>
                <div class="input-field col s3">
                    <input name="valorQC" id="valorQC" type="text" class="valor validate" length="10" maxlength="10" required>
                    <label for="valorQC">Valor (R$)</label>
                </div>
            </div>
            <div class="row">
                <div id="listaQC"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-action btn waves-effect waves-light green accent-4" type="submit">Salvar<i class="material-icons right">send</i></button>
            <a class="waves-effect waves-green btn-flat" id="verQC">Ver Quantidades<i class="material-icons left">replay</i></a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat cancelar">Cancelar</a>
        </div>
        <input type="hidden" name="acao" value="inserirQuantidadeCores">
    </form>
</div>
<script src="js/ajax/quantidadeCores.js"></script>
<script src="js/autoNumeric-min.js"></script>
<script src="js/valor.js"></script>