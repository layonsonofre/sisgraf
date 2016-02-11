<ul id="nav-mobile" class="side-nav fixed">
	<!-- <li class="search">
		<div class="search-wrapper card">
			<input id="search"><i class="material-icons">search</i>
			<div class="search-results"></div>
		</div>
	</li> -->
	<li class="bold"><a href="index.php" class="waves-effect waves-red accent-4"><b>Gráfica do Paulinho</b></a></li>
	<li class="no-padding">
		<ul class="collapsible collapsible-accordion">
			<li>
				<a class="collapsible-header waves-effect waves-red accent-4"><i class="material-icons">account_circle</i>&nbsp;&nbsp;<?php echo $_SESSION['usuarioNome'];?><i class="mdi mdi-menu-down right"></i></a>
				<div class="collapsible-body">
					<ul>
						<li><?php echo "<a href='incluirPessoa.php?idPessoa=" . $_SESSION['usuarioID'] . "&tipo=funcionario'" ?>>Perfil</a></li>
						<li><a href="incluirPessoa.php?logout=true">Sair</a></li>
					</ul>
				</div>
			</li>
		</ul>
	</li>
	<li class="no-padding">
		<ul class="collapsible collapsible-accordion">
			<li>
				<a class="collapsible-header waves-effect waves-red accent-4">Ordem de Serviço<i class="mdi mdi-menu-down right"></i></a>
				<div class="collapsible-body">
					<ul>
						<li id="novaOS"><a href='incluirOS.php'>Cadastrar</a></li>
						<li><a href='listarOS.php'>Buscar</a></li>
					</ul>
				</div>
			</li>
		</ul>
	</li>
	<li class="no-padding">
		<ul class="collapsible collapsible-accordion">
			<li>
				<a class="collapsible-header waves-effect waves-red accent-4">Arquivo<i class="mdi mdi-menu-down right"></i></a>
				<div class="collapsible-body">
					<ul>
						<li><a href='incluirArquivo.php'>Cadastrar</a></li>
						<li><a href='listarArquivo.php'>Buscar</a></li>
					</ul>
				</div>
			</li>
		</ul>
	</li>
	<li class="no-padding">
		<ul class="collapsible collapsible-accordion">
			<li>
				<a class="collapsible-header waves-effect waves-red accent-4">Tipo Serviço<i class="mdi mdi-menu-down right"></i></a>
				<div class="collapsible-body">
					<ul>
						<li><a href='incluirTipoDeServico.php?tipo=outro'>Cadastrar</a></li>
						<li><a href='listarTipoDeServico.php?tipo=outro'>Buscar</a></li>
					</ul>
				</div>
			</li>
		</ul>
	</li>
	<li class="no-padding">
		<ul class="collapsible collapsible-accordion">
			<li>
				<a class="collapsible-header waves-effect waves-red accent-4">Carimbo<i class="mdi mdi-menu-down right"></i></a>
				<div class="collapsible-body">
					<ul>
						<li><a href='incluirTipoDeServico.php?tipo=carimbo'>Cadastrar</a></li>
						<li><a href='listarTipoDeServico.php?tipo=carimbo'>Buscar</a></li>
					</ul>
				</div>
			</li>
		</ul>
	</li>
	<li class="no-padding">
		<ul class="collapsible collapsible-accordion">
			<li>
				<a class="collapsible-header waves-effect waves-red accent-4">Material<i class="mdi mdi-menu-down right"></i></a>
				<div class="collapsible-body">
					<ul>
						<li><a href='incluirMaterial.php?tipo=material'>Cadastrar</a></li>
						<li><a href='listarMaterial.php?tipo=material'>Buscar</a></li>
					</ul>
				</div>
			</li>
		</ul>
	</li>
	<li class="no-padding">
		<ul class="collapsible collapsible-accordion">
			<li>
				<a class="collapsible-header waves-effect waves-red accent-4">Papel<i class="mdi mdi-menu-down right"></i></a>
				<div class="collapsible-body">
					<ul>
						<li><a href='incluirMaterial.php?tipo=papel'>Cadastrar</a></li>
						<li><a href='listarMaterial.php?tipo=papel'>Buscar</a></li>
					</ul>
				</div>
			</li>
		</ul>
	</li>
	<li class="no-padding">
		<ul class="collapsible collapsible-accordion">
			<li>
				<a class="collapsible-header waves-effect waves-red accent-4">Cliente<i class="mdi mdi-menu-down right"></i></a>
				<div class="collapsible-body">
					<ul>
						<li><a href='incluirPessoa.php?tipo=cliente'>Cadastrar</a></li>
						<li><a href='listarPessoa.php?tipo=cliente'>Buscar</a></li>
					</ul>
				</div>
			</li>
		</ul>
	</li>
	<li class="no-padding">
		<ul class="collapsible collapsible-accordion">
			<li>
				<a class="collapsible-header waves-effect waves-red accent-4">Fornecedor<i class="mdi mdi-menu-down right"></i></a>
				<div class="collapsible-body">
					<ul>
						<li><a href='incluirPessoa.php?tipo=fornecedor'>Cadastrar</a></li>
						<li><a href='listarPessoa.php?tipo=fornecedor'>Buscar</a></li>
					</ul>
				</div>
			</li>
		</ul>
	</li>
	<li class="no-padding">
		<ul class="collapsible collapsible-accordion">
			<li>
				<a class="collapsible-header waves-effect waves-red accent-4">Funcionário<i class="mdi mdi-menu-down right"></i></a>
				<div class="collapsible-body">
					<ul>
						<li><a href='incluirPessoa.php?tipo=funcionario'>Cadastrar</a></li>
						<li><a href='listarPessoa.php?tipo=funcionario'>Buscar</a></li>
					</ul>
				</div>
			</li>
		</ul>
	</li>
</ul>
<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="mdi mdi-menu"></i></a>