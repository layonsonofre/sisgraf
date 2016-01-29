<div id="modalArquivoMatriz" class="modal center-text">
    <form class="col s12" role="form" id="formArquivoMatriz">
        <div class="modal-content">
            <h4>Atualizar Arquivo Matriz</h4>
            <div class="row">
                <div class="input-field col s11">
                    <input name="urlMatriz" id="urlMatriz" type="file" class="validate" <?php if(isset($_GET['idArquivoMatriz'])) echo "value='".$resultado['urlMatriz']."'"; ?>>
                    <label for="urlMatriz" class="active">URL</label>
                </div>
                <div class="input-field col s6">
                    <input name="utilizacoes" id="utilizacoes" type="text" class="validate right-align" <?php if(isset($_GET['idArquivoMatriz'])) echo "value='".$resultado['utilizacoes']."'"; ?>>
                    <label for="utilizacoes" class="active">Utilizações</label>
                </div>
                <div class="input-field col s6">
                    <input name="idChapa" id="idChapa" type="text" class="validate right-align" <?php if(isset($_GET['idArquivoMatriz'])) echo "value='".$resultado['idChapa']."'"; ?>>
                    <label for="idChapa" class="active">ID da Chapa</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-action btn waves-effect waves-light green accent-4" type="submit" name="salvar" id="salvar">Salvar<i class="material-icons right"></i></button>
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
        </div>
        <input type="hidden" name="acao" value="inserirArquivoMatriz">
    </form>
</div>
<script src="js/ajax/arquivomatriz.js"></script>