<div id="modalCategoria" class="modal center-text">
    <form class="form col s12" role="form" id="formCategoria">
        <div class="modal-content">
            <h4>Atualizar Categoria</h4>
            <div class="row">
                <div class="input-field col s4">
                    <input type="hidden" name="idCategoria" id="idCategoria">
                    <input name="nomeCategoria" id="nomeCategoria" type="text" class="validate" length="24" maxlength="24" required>
                    <label for="nomeCategoria">Nome</label>
                </div>
                <div class="input-field col s8">
                    <input name="descricaoCategoria" id="descricaoCategoria" type="text" class="validate" maxlength="60" length="60" required>
                    <label for="descricaoCategoria">Descrição</label>
                </div>
            </div>
            <div class="row">
                <div id="listaCategorias"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-action btn waves-effect waves-light green accent-4" type="submit" name="salvar" id="salvar">Salvar<i class="material-icons right">send</i></button>
            <a class="waves-effect waves-green btn-flat" id="verCategorias">Ver Categorias<i class="material-icons left">replay</i></a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat cancelar">Cancelar</a>
        </div>
        <input type="hidden" name="acao" value="inserirCategoria">
    </form>
</div>
<script src="js/ajax/categorias.js"></script>