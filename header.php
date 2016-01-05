<!-- <header> -->
	<!--<ul id="usuario" class="dropdown-content">
			<li><a href="#">Perfil</a></li>
		<li><a href="#">Sair</a></li>
	</ul>
	<nav>
		<div class="nav-wrapper">
			<ul class="right">
				<li><a class="dropdown-button waves-effect waves-red accent-4" href="#" data-activates="usuario"><i class="material-icons">account_circle</i>&nbsp;&nbsp;<?php echo $_SESSION['usuarioNome'];?><i class="material-icons right">arrow_drop_down</i></a></li>
			</ul>
		</div>
	</nav>-->
        
	<!-- <a href="#" data-activates="nav-mobile" class="button-collapse waves-effect waves-red accent-4 hide-on-large-only"><i class="mdi-navigation-menu"></i></a> -->
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
					<a class="collapsible-header waves-effect waves-red accent-4"><i class="material-icons">account_circle</i>&nbsp;&nbsp;<?php echo $_SESSION['usuarioNome'];?><i class="mdi-navigation-arrow-drop-down right"></i></a>
					<div class="collapsible-body">
						<ul>
							<li><?php echo "<a href='incluirPessoa.php?idPessoa=" . $_SESSION['usuarioID'] . "&tipo=funcionario'" ?>>Perfil</a></li>
							<li><a href="incluirPessoa.php?logout=true">Sair</a></li>
						</ul>
					</div>
				</li>
			</ul>
		</li>
		<!--<li class="bold"><a href="#" class="waves-effect waves-red accent-4"><i class="material-icons">account_circle</i>&nbsp;&nbsp;<?php echo $_SESSION['usuarioNome'];?></a></li>-->
		<li class="no-padding">
			<ul class="collapsible collapsible-accordion">
				<li>
					<a class="collapsible-header waves-effect waves-red accent-4">Cliente<i class="mdi-navigation-arrow-drop-down right"></i></a>
					<div class="collapsible-body">
						<ul>
							<li><a href='incluirPessoa.php?tipo=cliente'>Cadastrar</a></li>
						</ul>
					</div>
				</li>
			</ul>
		</li>
		<li class="no-padding">
			<ul class="collapsible collapsible-accordion">
				<li>
					<a class="collapsible-header waves-effect waves-red accent-4">Fornecedor<i class="mdi-navigation-arrow-drop-down right"></i></a>
					<div class="collapsible-body">
						<ul>
							<li><a href='incluirPessoa.php?tipo=fornecedor'>Cadastrar</a></li>
						</ul>
					</div>
				</li>
			</ul>
		</li>
		<li class="no-padding">
			<ul class="collapsible collapsible-accordion">
				<li>
					<a class="collapsible-header waves-effect waves-red accent-4">Funcionário<i class="mdi-navigation-arrow-drop-down right"></i></a>
					<div class="collapsible-body">
						<ul>
							<li><a href='incluirPessoa.php?tipo=funcionario'>Cadastrar</a></li>
						</ul>
					</div>
				</li>
			</ul>
		</li>
		<li class="no-padding">
			<ul class="collapsible collapsible-accordion">
				<li>
					<a class="collapsible-header waves-effect waves-red accent-4">Material<i class="mdi-navigation-arrow-drop-down right"></i></a>
					<div class="collapsible-body">
						<ul>
							<li><a href='incluirMaterial.php?tipo=material'>Cadastrar</a></li>
						</ul>
					</div>
				</li>
			</ul>
		</li>
		<li class="no-padding">
			<ul class="collapsible collapsible-accordion">
				<li>
					<a class="collapsible-header waves-effect waves-red accent-4">Papel<i class="mdi-navigation-arrow-drop-down right"></i></a>
					<div class="collapsible-body">
						<ul>
							<li><a href='incluirMaterial.php?tipo=papel'>Cadastrar</a></li>
						</ul>
					</div>
				</li>
			</ul>
		</li>
		<!-- <li class="bold"><a href="#" class="waves-effect waves-red accent-4">Showcase</a></li> -->
	</ul>
	<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
<!-- </header> -->