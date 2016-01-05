<div id="modalCategoria" class="modal center-text">
    <form class="col s12" role="form" method="POST" action="control/material.php">
        <div class="modal-content">
            <h4>Atualizar Categoria</h4>
            <div class="row">
                <div class="input-field col s4">
                    <input name="nome" id="nome" type="text" class="validate">
                    <label for="nome">Nome</label>
                </div>
                <div class="input-field col s8">
                    <input name="descricao" id="descricao" type="text" class="validate">
                    <label for="descricao">Descrição</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-action btn waves-effect waves-light green accent-4" type="submit" name="salvar">Salvar<i class="material-icons right">send</i></button>
            <a href="#" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
        </div>
        <input type="hidden" name="acao" value="inserirCategoria">
        <input type="hidden" name="tipo" value="">
        <input type="hidden" name="redirecionar" value="">
    </form>
</div>