/* Database export results for db dbSisgraf */

/* Preserve session variables */
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS;
SET FOREIGN_KEY_CHECKS=0;

/* Export data */

/* Table structure for Acab_OS_TS */
CREATE TABLE `Acab_OS_TS` (
  `idAcab_OS_TS` int(11) NOT NULL AUTO_INCREMENT,
  `idTipoServico` int(11) NOT NULL,
  `idOrdemDeServico` int(11) NOT NULL,
  `idAcabamento` int(11) NOT NULL,
  PRIMARY KEY (`idAcab_OS_TS`),
  KEY `ordemdeservico_tiposervico_acab_os_ts_fk` (`idTipoServico`,`idOrdemDeServico`),
  CONSTRAINT `ordemdeservico_tiposervico_acab_os_ts_fk` FOREIGN KEY (`idTipoServico`, `idOrdemDeServico`) REFERENCES `OrdemDeServico_TipoServico` (`idTipoServico`, `idOrdemDeServico`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/* data for Table Acab_OS_TS */
INSERT INTO `Acab_OS_TS` VALUES (2,27,2,1);
INSERT INTO `Acab_OS_TS` VALUES (4,27,3,1);
INSERT INTO `Acab_OS_TS` VALUES (5,27,4,1);
INSERT INTO `Acab_OS_TS` VALUES (6,27,4,1);
INSERT INTO `Acab_OS_TS` VALUES (7,27,5,1);
INSERT INTO `Acab_OS_TS` VALUES (8,27,5,1);
INSERT INTO `Acab_OS_TS` VALUES (9,27,5,1);
INSERT INTO `Acab_OS_TS` VALUES (10,27,5,1);
INSERT INTO `Acab_OS_TS` VALUES (11,0,5,1);
INSERT INTO `Acab_OS_TS` VALUES (12,27,5,1);
INSERT INTO `Acab_OS_TS` VALUES (13,27,5,1);
INSERT INTO `Acab_OS_TS` VALUES (14,27,5,1);
INSERT INTO `Acab_OS_TS` VALUES (15,27,5,1);
INSERT INTO `Acab_OS_TS` VALUES (16,27,13,1);
INSERT INTO `Acab_OS_TS` VALUES (17,27,15,1);
INSERT INTO `Acab_OS_TS` VALUES (18,44,16,1);
INSERT INTO `Acab_OS_TS` VALUES (19,44,17,1);

/* Table structure for Acabamento */
CREATE TABLE `Acabamento` (
  `idAcabamento` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(15) NOT NULL,
  `descricao` varchar(35) NOT NULL,
  `valor` decimal(10,5) NOT NULL,
  `local` varchar(25) NOT NULL,
  PRIMARY KEY (`idAcabamento`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/* data for Table Acabamento */
INSERT INTO `Acabamento` VALUES (1,"Refile","Corte na guilhotina","0.00000","Reto nas margens de corte");
INSERT INTO `Acabamento` VALUES (2,"Verniz Local","AplicaÃ§Ã£o de verniz localizado","0.00000","Depende do modelo");
INSERT INTO `Acabamento` VALUES (3,"Meio Corte","Facilita a remoÃ§Ã£o dos adesivos","1.00000","Depende do modelo");

/* Table structure for Arquivo */
CREATE TABLE `Arquivo` (
  `idArquivo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(64) NOT NULL,
  `data` char(10) NOT NULL,
  `idOrdemDeServico` int(11) NOT NULL,
  PRIMARY KEY (`idArquivo`),
  KEY `ordemdeservico_arquivo_fk` (`idOrdemDeServico`),
  CONSTRAINT `ordemdeservico_arquivo_fk` FOREIGN KEY (`idOrdemDeServico`) REFERENCES `OrdemDeServico` (`idOrdemDeServico`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/* data for Table Arquivo */
INSERT INTO `Arquivo` VALUES (3,"carimbo glaucia yuri tho engenheira civil","09/02/2016",14);
INSERT INTO `Arquivo` VALUES (4,"cartÃ£o de visita pedrÃ£o borracheiro","09/02/2016",15);
INSERT INTO `Arquivo` VALUES (5,"promoÃ§Ã£o carnaval 2016 mercado","12/02/2016",16);
INSERT INTO `Arquivo` VALUES (6,"festa na laje","13/02/2016",17);

/* Table structure for ArquivoMatriz */
CREATE TABLE `ArquivoMatriz` (
  `idArquivoMatriz` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(256) NOT NULL,
  `utilizacoes` int(11) NOT NULL,
  `idChapa` int(11) NOT NULL,
  PRIMARY KEY (`idArquivoMatriz`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/* data for Table ArquivoMatriz */
INSERT INTO `ArquivoMatriz` VALUES (7,"",0,0);
INSERT INTO `ArquivoMatriz` VALUES (9,"",0,0);

/* Table structure for ArquivoModelo */
CREATE TABLE `ArquivoModelo` (
  `idArquivoModelo` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(256) NOT NULL,
  `idArquivo` int(11) NOT NULL,
  `status` varchar(24) NOT NULL,
  PRIMARY KEY (`idArquivoModelo`),
  KEY `arquivo_arquivomodelo_fk` (`idArquivo`),
  CONSTRAINT `arquivo_arquivomodelo_fk` FOREIGN KEY (`idArquivo`) REFERENCES `Arquivo` (`idArquivo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/* data for Table ArquivoModelo */
INSERT INTO `ArquivoModelo` VALUES (3,"/home/layon/carimbo glaucia yuri tho engenharia civil.cdr",3,"desenvolvimento");
INSERT INTO `ArquivoModelo` VALUES (4,"/home/layon/cartao de visitas pedrÃ£o borracheiro.cdr",4,"desenvolvimento");
INSERT INTO `ArquivoModelo` VALUES (5,"/home/layon/modelo panfleto carnaval 2016 mercado.png",5,"aprovado");
INSERT INTO `ArquivoModelo` VALUES (6,"/home/layon/modelo festa na laje.png",6,"aprovado");

/* Table structure for Arquivo_ArquivoMatriz */
CREATE TABLE `Arquivo_ArquivoMatriz` (
  `idArquivo` int(11) NOT NULL,
  `idArquivoMatriz` int(11) NOT NULL,
  PRIMARY KEY (`idArquivo`,`idArquivoMatriz`),
  KEY `arquivomatriz_arquivo_arquivomatriz_fk` (`idArquivoMatriz`),
  CONSTRAINT `arquivo_arquivo_arquivomatriz_fk` FOREIGN KEY (`idArquivo`) REFERENCES `Arquivo` (`idArquivo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `arquivomatriz_arquivo_arquivomatriz_fk` FOREIGN KEY (`idArquivoMatriz`) REFERENCES `ArquivoMatriz` (`idArquivoMatriz`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/* data for Table Arquivo_ArquivoMatriz */
INSERT INTO `Arquivo_ArquivoMatriz` VALUES (3,7);
INSERT INTO `Arquivo_ArquivoMatriz` VALUES (6,9);

/* Table structure for Carimbo */
CREATE TABLE `Carimbo` (
  `idTipoServico` int(11) NOT NULL,
  `isAutomatico` tinyint(1) NOT NULL,
  `nomeCarimbo` varchar(15) NOT NULL,
  `base` smallint(6) NOT NULL,
  `altura` smallint(6) NOT NULL,
  PRIMARY KEY (`idTipoServico`),
  CONSTRAINT `tiposervico_carimbo_fk` FOREIGN KEY (`idTipoServico`) REFERENCES `TipoServico` (`idTipoServico`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/* data for Table Carimbo */
INSERT INTO `Carimbo` VALUES (28,1,"C30",17,46);

/* Table structure for Categoria */
CREATE TABLE `Categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(24) NOT NULL,
  `descricao` varchar(60) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/* data for Table Categoria */
INSERT INTO `Categoria` VALUES (1,"Cola Branca","Cola usada para manter unido os blocos");
INSERT INTO `Categoria` VALUES (2,"Grampo","Utilizado para manter junto as folhas de um bloco");
INSERT INTO `Categoria` VALUES (3,"Papel","Material de vÃ¡rios tipos utilizados de base para impressÃ£o");

/* Table structure for Categoria_Material */
CREATE TABLE `Categoria_Material` (
  `idMaterial` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  PRIMARY KEY (`idMaterial`,`idCategoria`),
  KEY `categoria_categoria_material_fk` (`idCategoria`),
  CONSTRAINT `categoria_categoria_material_fk` FOREIGN KEY (`idCategoria`) REFERENCES `Categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `material_categoria_material_fk` FOREIGN KEY (`idMaterial`) REFERENCES `Material` (`idMaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/* data for Table Categoria_Material */
INSERT INTO `Categoria_Material` VALUES (1,3);
INSERT INTO `Categoria_Material` VALUES (2,3);
INSERT INTO `Categoria_Material` VALUES (3,3);

/* Table structure for Cor */
CREATE TABLE `Cor` (
  `idCor` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(15) NOT NULL,
  PRIMARY KEY (`idCor`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/* data for Table Cor */
INSERT INTO `Cor` VALUES (1,"Preto");
INSERT INTO `Cor` VALUES (2,"Branco");
INSERT INTO `Cor` VALUES (3,"Azul");
INSERT INTO `Cor` VALUES (4,"Transparente");
INSERT INTO `Cor` VALUES (5,"Verde");
INSERT INTO `Cor` VALUES (6,"Rosa");
INSERT INTO `Cor` VALUES (7,"Amarelo");

/* Table structure for Cor_Material */
CREATE TABLE `Cor_Material` (
  `idMaterial` int(11) NOT NULL,
  `idCor` int(11) NOT NULL,
  PRIMARY KEY (`idMaterial`,`idCor`),
  KEY `cor_cor_material_fk` (`idCor`),
  CONSTRAINT `cor_cor_material_fk` FOREIGN KEY (`idCor`) REFERENCES `Cor` (`idCor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `material_cor_material_fk` FOREIGN KEY (`idMaterial`) REFERENCES `Material` (`idMaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/* data for Table Cor_Material */
INSERT INTO `Cor_Material` VALUES (1,3);
INSERT INTO `Cor_Material` VALUES (2,4);
INSERT INTO `Cor_Material` VALUES (3,1);
INSERT INTO `Cor_Material` VALUES (3,2);
INSERT INTO `Cor_Material` VALUES (3,3);

/* Table structure for Cor_OrdemDeServico_TipoServico */
CREATE TABLE `Cor_OrdemDeServico_TipoServico` (
  `idCor` int(11) NOT NULL,
  `idTipoServico` int(11) NOT NULL,
  `idOrdemDeServico` int(11) NOT NULL,
  `isFrente` tinyint(1) NOT NULL,
  PRIMARY KEY (`idCor`,`idTipoServico`,`idOrdemDeServico`),
  KEY `ordemdeservico_tiposervico_cor_quantidadecores_fk` (`idTipoServico`,`idOrdemDeServico`),
  CONSTRAINT `cor_cor_quantidadecores_fk` FOREIGN KEY (`idCor`) REFERENCES `Cor` (`idCor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ordemdeservico_tiposervico_cor_quantidadecores_fk` FOREIGN KEY (`idTipoServico`, `idOrdemDeServico`) REFERENCES `OrdemDeServico_TipoServico` (`idTipoServico`, `idOrdemDeServico`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/* data for Table Cor_OrdemDeServico_TipoServico */
INSERT INTO `Cor_OrdemDeServico_TipoServico` VALUES (1,27,4,1);
INSERT INTO `Cor_OrdemDeServico_TipoServico` VALUES (1,27,13,1);
INSERT INTO `Cor_OrdemDeServico_TipoServico` VALUES (1,27,15,1);
INSERT INTO `Cor_OrdemDeServico_TipoServico` VALUES (1,44,16,1);
INSERT INTO `Cor_OrdemDeServico_TipoServico` VALUES (2,27,2,1);
INSERT INTO `Cor_OrdemDeServico_TipoServico` VALUES (3,27,3,1);
INSERT INTO `Cor_OrdemDeServico_TipoServico` VALUES (3,27,5,1);
INSERT INTO `Cor_OrdemDeServico_TipoServico` VALUES (3,42,8,1);
INSERT INTO `Cor_OrdemDeServico_TipoServico` VALUES (3,44,16,1);
INSERT INTO `Cor_OrdemDeServico_TipoServico` VALUES (5,44,17,1);

/* Table structure for Email */
CREATE TABLE `Email` (
  `idEmail` int(11) NOT NULL AUTO_INCREMENT,
  `idPessoa` int(11) NOT NULL,
  `endereco` varchar(42) NOT NULL,
  PRIMARY KEY (`idEmail`),
  KEY `pessoa_email_fk` (`idPessoa`),
  CONSTRAINT `pessoa_email_fk` FOREIGN KEY (`idPessoa`) REFERENCES `Pessoa` (`idPessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/* data for Table Email */
INSERT INTO `Email` VALUES (16,1,"graficadopaulinho@uol.com.br");
INSERT INTO `Email` VALUES (17,6,"layonsonofre@gmail.com");
INSERT INTO `Email` VALUES (18,2,"selby.cristiane@hotmail.com");
INSERT INTO `Email` VALUES (19,7,"yuri_tho@hotmail.com");
INSERT INTO `Email` VALUES (20,21,"layonsonofre@gmail.com");
INSERT INTO `Email` VALUES (21,21,"layonsonofre@outlook.com");
INSERT INTO `Email` VALUES (22,22,"layonsonofre@gmail.com");

/* Table structure for FormaImpressao */
CREATE TABLE `FormaImpressao` (
  `idFormaImpressao` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(15) NOT NULL,
  `descricao` varchar(35) NOT NULL,
  `valor` decimal(10,5) NOT NULL,
  PRIMARY KEY (`idFormaImpressao`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/* data for Table FormaImpressao */
INSERT INTO `FormaImpressao` VALUES (1,"Offset","ImpressÃ£o em larga escala","0.00000");
INSERT INTO `FormaImpressao` VALUES (2,"Digital","ImpressÃ£o em pequenas quantidades","1.00000");

/* Table structure for Formato */
CREATE TABLE `Formato` (
  `idFormato` int(11) NOT NULL AUTO_INCREMENT,
  `formato` varchar(32) NOT NULL,
  `valor` decimal(10,5) NOT NULL,
  `base` smallint(6) NOT NULL,
  `altura` smallint(6) NOT NULL,
  PRIMARY KEY (`idFormato`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/* data for Table Formato */
INSERT INTO `Formato` VALUES (1,"9","0.00000",210,297);
INSERT INTO `Formato` VALUES (3,"CartÃ£o de Visita","0.00000",90,50);
INSERT INTO `Formato` VALUES (26,"18","2.00000",14,21);

/* Table structure for Fornecedor_Categoria */
CREATE TABLE `Fornecedor_Categoria` (
  `idPessoa` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  PRIMARY KEY (`idPessoa`,`idCategoria`),
  KEY `categoria_fornecedor_categoria_fk` (`idCategoria`),
  CONSTRAINT `categoria_fornecedor_categoria_fk` FOREIGN KEY (`idCategoria`) REFERENCES `Categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `pessoa_fornecedor_categoria_fk` FOREIGN KEY (`idPessoa`) REFERENCES `Pessoa` (`idPessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/* data for Table Fornecedor_Categoria */
INSERT INTO `Fornecedor_Categoria` VALUES (3,1);
INSERT INTO `Fornecedor_Categoria` VALUES (3,2);
INSERT INTO `Fornecedor_Categoria` VALUES (3,3);
INSERT INTO `Fornecedor_Categoria` VALUES (6,3);

/* Table structure for Funcionario */
CREATE TABLE `Funcionario` (
  `idPessoa` int(11) NOT NULL,
  `usuario` varchar(32) NOT NULL,
  `senha` char(64) NOT NULL,
  `tipoFuncionario` char(20) NOT NULL,
  PRIMARY KEY (`idPessoa`),
  CONSTRAINT `pessoa_funcionario_fk` FOREIGN KEY (`idPessoa`) REFERENCES `Pessoa` (`idPessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/* data for Table Funcionario */
INSERT INTO `Funcionario` VALUES (1,"paulinho","71fb6e698e80dc0a7b032e8dfacee85f","padrao");
INSERT INTO `Funcionario` VALUES (2,"selby","2d58b0ac72f929ca9ad3238ade9eab69","padrao");

/* Table structure for GramaturaPapel */
CREATE TABLE `GramaturaPapel` (
  `idGramaturaPapel` int(11) NOT NULL AUTO_INCREMENT,
  `gramatura` smallint(6) NOT NULL,
  PRIMARY KEY (`idGramaturaPapel`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/* data for Table GramaturaPapel */
INSERT INTO `GramaturaPapel` VALUES (1,75);
INSERT INTO `GramaturaPapel` VALUES (2,300);
INSERT INTO `GramaturaPapel` VALUES (5,180);

/* Table structure for Material */
CREATE TABLE `Material` (
  `idMaterial` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(20) NOT NULL,
  `valorUnitario` decimal(10,5) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `quantidadeMinima` int(11) NOT NULL,
  `idMaterialUnidade` int(11) NOT NULL,
  PRIMARY KEY (`idMaterial`),
  KEY `materialunidade_material_fk` (`idMaterialUnidade`),
  CONSTRAINT `materialunidade_material_fk` FOREIGN KEY (`idMaterialUnidade`) REFERENCES `MaterialUnidade` (`idMaterialUnidade`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/* data for Table Material */
INSERT INTO `Material` VALUES (1,"Papel","10.00000",100,2100,3);
INSERT INTO `Material` VALUES (2,"Laser Film","1.00000",100,20,3);
INSERT INTO `Material` VALUES (3,"Papel","0.30000",500,20,3);

/* Table structure for MaterialUnidade */
CREATE TABLE `MaterialUnidade` (
  `idMaterialUnidade` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(10) NOT NULL,
  PRIMARY KEY (`idMaterialUnidade`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/* data for Table MaterialUnidade */
INSERT INTO `MaterialUnidade` VALUES (1,"Litro");
INSERT INTO `MaterialUnidade` VALUES (2,"Kilograma");
INSERT INTO `MaterialUnidade` VALUES (3,"Folha");
INSERT INTO `MaterialUnidade` VALUES (4,"Unidade");

/* Table structure for Material_TipoServico */
CREATE TABLE `Material_TipoServico` (
  `idTipoServico` int(11) NOT NULL,
  `idMaterial` int(11) NOT NULL,
  `valor` decimal(10,5) NOT NULL,
  PRIMARY KEY (`idTipoServico`,`idMaterial`),
  KEY `material_material_tiposervico_fk` (`idMaterial`),
  CONSTRAINT `material_material_tiposervico_fk` FOREIGN KEY (`idMaterial`) REFERENCES `Material` (`idMaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tiposervico_material_tiposervico_fk` FOREIGN KEY (`idTipoServico`) REFERENCES `TipoServico` (`idTipoServico`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/* data for Table Material_TipoServico */
INSERT INTO `Material_TipoServico` VALUES (27,1,"123.00000");
INSERT INTO `Material_TipoServico` VALUES (43,1,"2.00000");
INSERT INTO `Material_TipoServico` VALUES (44,1,"1.00000");
INSERT INTO `Material_TipoServico` VALUES (45,1,"0.00000");
INSERT INTO `Material_TipoServico` VALUES (46,1,"0.00000");

/* Table structure for Material_Vias */
CREATE TABLE `Material_Vias` (
  `idVias` int(11) NOT NULL,
  `idMaterial` int(11) NOT NULL,
  PRIMARY KEY (`idVias`,`idMaterial`),
  KEY `material_material_vias_fk` (`idMaterial`),
  CONSTRAINT `material_material_vias_fk` FOREIGN KEY (`idMaterial`) REFERENCES `Material` (`idMaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `vias_material_vias_fk` FOREIGN KEY (`idVias`) REFERENCES `Vias` (`idVias`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/* data for Table Material_Vias */

/* Table structure for ModeloNotaFiscal */
CREATE TABLE `ModeloNotaFiscal` (
  `idModeloNotaFiscal` int(11) NOT NULL AUTO_INCREMENT,
  `modelo` varchar(10) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `valor` decimal(10,5) NOT NULL,
  PRIMARY KEY (`idModeloNotaFiscal`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/* data for Table ModeloNotaFiscal */
INSERT INTO `ModeloNotaFiscal` VALUES (1,"D1","Nota fiscal de venda a consumidor","0.00000");

/* Table structure for NotaFiscal */
CREATE TABLE `NotaFiscal` (
  `idTipoServico` int(11) NOT NULL,
  `idVias` int(11) NOT NULL,
  `numeracaoInicial` int(11) NOT NULL,
  `numeracaoFinal` int(11) NOT NULL,
  `numeroTalao` smallint(6) NOT NULL,
  `folhasBloco` smallint(6) NOT NULL,
  `aidf` bigint(20) NOT NULL,
  `idModeloNotaFiscal` int(11) NOT NULL,
  PRIMARY KEY (`idTipoServico`),
  KEY `vias_notafiscal_fk` (`idVias`),
  KEY `modelonotafiscal_notafiscal_fk` (`idModeloNotaFiscal`),
  CONSTRAINT `modelonotafiscal_notafiscal_fk` FOREIGN KEY (`idModeloNotaFiscal`) REFERENCES `ModeloNotaFiscal` (`idModeloNotaFiscal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tiposervico_notafiscal_fk` FOREIGN KEY (`idTipoServico`) REFERENCES `TipoServico` (`idTipoServico`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `vias_notafiscal_fk` FOREIGN KEY (`idVias`) REFERENCES `Vias` (`idVias`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/* data for Table NotaFiscal */
INSERT INTO `NotaFiscal` VALUES (42,2,1,100,1,50,1234,1);

/* Table structure for OrdemDeServico */
CREATE TABLE `OrdemDeServico` (
  `idOrdemDeServico` int(11) NOT NULL AUTO_INCREMENT,
  `dataEntrada` char(10) DEFAULT NULL,
  `dataSaida` char(10) DEFAULT NULL,
  `status` char(24) DEFAULT NULL,
  `isOrcamento` tinyint(1) DEFAULT NULL,
  `valorTotal` decimal(10,5) DEFAULT NULL,
  `observacoes` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`idOrdemDeServico`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/* data for Table OrdemDeServico */
INSERT INTO `OrdemDeServico` VALUES (1,"03/02/2016","09/02/2016","cadastro",0,"125.00000","teste123");
INSERT INTO `OrdemDeServico` VALUES (2,"03/02/2016","","cadastro",0,"0.00000","");
INSERT INTO `OrdemDeServico` VALUES (3,"03/02/2016","","cadastro",0,"0.00000","");
INSERT INTO `OrdemDeServico` VALUES (4,"03/02/2016","","cadastro",0,"0.00000","");
INSERT INTO `OrdemDeServico` VALUES (5,"03/02/2016","","cadastro",0,"0.00000","");
INSERT INTO `OrdemDeServico` VALUES (6,"03/02/2016","","cadastro",0,"0.00000","");
INSERT INTO `OrdemDeServico` VALUES (7,"04/02/2016","","cancelada",0,"0.00000","");
INSERT INTO `OrdemDeServico` VALUES (8,"04/02/2016","","cadastro",0,"0.00000","");
INSERT INTO `OrdemDeServico` VALUES (9,"04/02/2016","","cadastro",0,"0.00000","");
INSERT INTO `OrdemDeServico` VALUES (10,"04/02/2016","","cadastro",0,"0.00000","");
INSERT INTO `OrdemDeServico` VALUES (11,"04/02/2016","","cadastro",0,"10.00000","");
INSERT INTO `OrdemDeServico` VALUES (12,"06/02/2016","","cadastro",0,"100.00000","");
INSERT INTO `OrdemDeServico` VALUES (13,"06/02/2016","","pronto",0,"0.00000","");
INSERT INTO `OrdemDeServico` VALUES (14,"09/02/2016","","desenvolvimento",0,"100.00000","Embalagem Rosa");
INSERT INTO `OrdemDeServico` VALUES (15,"09/02/2016","","aprovacao",0,"60.00000","Fundo Preto/Letra Branca");
INSERT INTO `OrdemDeServico` VALUES (16,"12/02/2016","","pronto",0,"10.00000","Quero um serviÃ§o bem bonito!");
INSERT INTO `OrdemDeServico` VALUES (17,"13/02/2016","","impressao",0,"100.00000","");

/* Table structure for OrdemDeServico_TipoServico */
CREATE TABLE `OrdemDeServico_TipoServico` (
  `idTipoServico` int(11) NOT NULL,
  `idOrdemDeServico` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor` decimal(10,5) DEFAULT NULL,
  `idFormaImpressao` int(11) DEFAULT NULL,
  `idQuantidadeCores` int(11) DEFAULT NULL,
  `idFormato` int(11) DEFAULT NULL,
  `idMaterial` int(11) DEFAULT NULL,
  PRIMARY KEY (`idTipoServico`,`idOrdemDeServico`),
  KEY `formaimpressao_ordemdeservico_tiposervico_fk` (`idFormaImpressao`),
  KEY `quantidadecores_ordemdeservico_tiposervico_fk` (`idQuantidadeCores`),
  CONSTRAINT `formaimpressao_ordemdeservico_tiposervico_fk` FOREIGN KEY (`idFormaImpressao`) REFERENCES `FormaImpressao` (`idFormaImpressao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `quantidadecores_ordemdeservico_tiposervico_fk` FOREIGN KEY (`idQuantidadeCores`) REFERENCES `QuantidadeCores` (`idQuantidadeCores`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/* data for Table OrdemDeServico_TipoServico */
INSERT INTO `OrdemDeServico_TipoServico` VALUES (0,5,1,"2.00000",1,5,3,1);
INSERT INTO `OrdemDeServico_TipoServico` VALUES (27,2,1,"2.00000",2,4,3,1);
INSERT INTO `OrdemDeServico_TipoServico` VALUES (27,3,10,"10.00000",1,3,3,1);
INSERT INTO `OrdemDeServico_TipoServico` VALUES (27,4,1,"2.00000",2,2,3,1);
INSERT INTO `OrdemDeServico_TipoServico` VALUES (27,5,1,"2.00000",1,5,3,1);
INSERT INTO `OrdemDeServico_TipoServico` VALUES (27,13,100,"40.00000",1,2,3,1);
INSERT INTO `OrdemDeServico_TipoServico` VALUES (27,15,1000,"60.00000",1,2,3,1);
INSERT INTO `OrdemDeServico_TipoServico` VALUES (28,9,10,"1.00000",NULL,NULL,NULL,NULL);
INSERT INTO `OrdemDeServico_TipoServico` VALUES (28,10,10,"1.00000",NULL,NULL,NULL,NULL);
INSERT INTO `OrdemDeServico_TipoServico` VALUES (28,12,3,"100.00000",NULL,NULL,NULL,NULL);
INSERT INTO `OrdemDeServico_TipoServico` VALUES (28,13,1,"10.00000",NULL,NULL,NULL,NULL);
INSERT INTO `OrdemDeServico_TipoServico` VALUES (28,14,1,"35.00000",NULL,NULL,NULL,NULL);
INSERT INTO `OrdemDeServico_TipoServico` VALUES (42,8,0,"0.00000",1,2,0,1);
INSERT INTO `OrdemDeServico_TipoServico` VALUES (44,16,1000,"60.00000",1,3,1,1);
INSERT INTO `OrdemDeServico_TipoServico` VALUES (44,17,1000,"100.00000",1,2,26,1);

/* Table structure for Papel */
CREATE TABLE `Papel` (
  `idMaterial` int(11) NOT NULL,
  `tipo` varchar(15) NOT NULL,
  `idGramaturaPapel` int(11) NOT NULL,
  `base` smallint(6) NOT NULL,
  `altura` smallint(6) NOT NULL,
  PRIMARY KEY (`idMaterial`),
  KEY `gramaturapapel_papel_fk` (`idGramaturaPapel`),
  CONSTRAINT `gramaturapapel_papel_fk` FOREIGN KEY (`idGramaturaPapel`) REFERENCES `GramaturaPapel` (`idGramaturaPapel`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `material_papel_fk` FOREIGN KEY (`idMaterial`) REFERENCES `Material` (`idMaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/* data for Table Papel */
INSERT INTO `Papel` VALUES (1,"CouchÃª",2,680,900);
INSERT INTO `Papel` VALUES (3,"Cartolina",5,680,460);

/* Table structure for Pessoa */
CREATE TABLE `Pessoa` (
  `idPessoa` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(64) NOT NULL,
  `status` varchar(20) NOT NULL,
  `isPessoaFisica` tinyint(1) NOT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `rg` varchar(12) DEFAULT NULL,
  `cnpj` varchar(18) DEFAULT NULL,
  `inscricaoEstadual` varchar(24) DEFAULT NULL,
  `inscricaoMunicipal` varchar(24) DEFAULT NULL,
  `razaoSocial` varchar(64) DEFAULT NULL,
  `nomeFantasia` varchar(64) DEFAULT NULL,
  `nomeRua` varchar(50) NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(32) DEFAULT NULL,
  `cep` varchar(10) NOT NULL,
  `bairro` varchar(24) NOT NULL,
  `estado` char(2) NOT NULL,
  `cidade` varchar(32) NOT NULL,
  `orgaoExpedidor` varchar(9) NOT NULL,
  PRIMARY KEY (`idPessoa`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/* data for Table Pessoa */
INSERT INTO `Pessoa` VALUES (1,"Paulo Eduardo Onofre","funcionarioAtivo",1,"404.988.888-27","48.130.023-5","","","","","","Rua dos GerÃ¢nios",205,"Esquina","18960-000","Jardim Brasil IV","SP","Bernardino de Campos","SSP/SP");
INSERT INTO `Pessoa` VALUES (2,"Selby Cristiane de Souza Onofre","funcionarioAtivo",1,"328.405.018-30","27.597.177-6","","","","","","Rua dos GerÃ¢nios",205,"Esquina Linda e Bonita","18960-000","Jardim Brasil IV","SP","Bernardino de Campos","SSP/SP");
INSERT INTO `Pessoa` VALUES (3,"","fornecedorInativo",1,"404.988.888-27","48.130.023-5","11.111.111/1111-11","111.111.111.111","123456","Marcia Ltda ME","Alternativa Papeis","Rua Comendador MirÃ³",2050,"","84031-029","Centro","PR","Ponta Grossa","SSP/SP");
INSERT INTO `Pessoa` VALUES (6,"Joaquim da Vila","fornecedorAtivo",1,"404.988.888-27","48.130.023-5","","","","","","Rua Com. Paulo Pinheiro Schimidt",344,"Apto. 01","18960-000","Uvaranas","PR","Ponta Grossa","ssp/sp");
INSERT INTO `Pessoa` VALUES (7,"Glaucia Yuri Tho","clienteAtivo",1,"404.988.888-27","48.130.023-5","","","","","","Av. Jacinto Ferreira de SÃ¡",2005,"","18680-000","Vila SÃ¢ndano","SP","Ourinhos","ssp/sp");
INSERT INTO `Pessoa` VALUES (21,"Layon de Souza Onofre","clienteAtivo",1,"404.988.888-27","48.130.023-5","","","","","","Avenida Coronel Albino Alves Garcia",970,"","18960-000","Centro","SP","Bernardino de Campos","SSP/SP");
INSERT INTO `Pessoa` VALUES (22,"Layon de Souza Onofre","clienteAtivo",1,"404.988.888-27","48.130.023-5","","","","","","Rua dos GerÃ¢nios",205,"","18960-000","Jardim Brasil IV","SP","Bernardino de Campos","SSP/SP");

/* Table structure for Pessoa_OrdemDeServico */
CREATE TABLE `Pessoa_OrdemDeServico` (
  `idOrdemDeServico` int(11) NOT NULL,
  `idPessoa` int(11) NOT NULL,
  `data` char(10) NOT NULL,
  PRIMARY KEY (`idOrdemDeServico`,`idPessoa`),
  KEY `pessoa_pessoa_ordemdeservico_fk` (`idPessoa`),
  CONSTRAINT `ordemdeservico_pessoa_ordemdeservico_fk` FOREIGN KEY (`idOrdemDeServico`) REFERENCES `OrdemDeServico` (`idOrdemDeServico`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `pessoa_pessoa_ordemdeservico_fk` FOREIGN KEY (`idPessoa`) REFERENCES `Pessoa` (`idPessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/* data for Table Pessoa_OrdemDeServico */
INSERT INTO `Pessoa_OrdemDeServico` VALUES (11,3,"04/02/2016");
INSERT INTO `Pessoa_OrdemDeServico` VALUES (12,7,"06/02/2016");
INSERT INTO `Pessoa_OrdemDeServico` VALUES (13,7,"06/02/2016");
INSERT INTO `Pessoa_OrdemDeServico` VALUES (14,7,"09/02/2016");
INSERT INTO `Pessoa_OrdemDeServico` VALUES (15,2,"09/02/2016");
INSERT INTO `Pessoa_OrdemDeServico` VALUES (16,22,"12/02/2016");
INSERT INTO `Pessoa_OrdemDeServico` VALUES (17,22,"13/02/2016");

/* Table structure for QuantidadeCores */
CREATE TABLE `QuantidadeCores` (
  `idQuantidadeCores` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` char(3) NOT NULL,
  `valor` decimal(10,5) NOT NULL,
  PRIMARY KEY (`idQuantidadeCores`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/* data for Table QuantidadeCores */
INSERT INTO `QuantidadeCores` VALUES (2,"1x0","0.00000");
INSERT INTO `QuantidadeCores` VALUES (3,"2x0","0.00000");
INSERT INTO `QuantidadeCores` VALUES (4,"3x0","0.00000");
INSERT INTO `QuantidadeCores` VALUES (5,"4x0","0.00000");
INSERT INTO `QuantidadeCores` VALUES (6,"2x1","0.00000");
INSERT INTO `QuantidadeCores` VALUES (7,"2x2","0.00000");
INSERT INTO `QuantidadeCores` VALUES (8,"3x1","0.00000");
INSERT INTO `QuantidadeCores` VALUES (9,"3x2","0.00000");
INSERT INTO `QuantidadeCores` VALUES (10,"3x3","0.00000");
INSERT INTO `QuantidadeCores` VALUES (11,"4x1","0.00000");
INSERT INTO `QuantidadeCores` VALUES (12,"4x2","0.00000");
INSERT INTO `QuantidadeCores` VALUES (13,"4x3","0.00000");
INSERT INTO `QuantidadeCores` VALUES (14,"4x4","0.00000");

/* Table structure for ServicoExterno */
CREATE TABLE `ServicoExterno` (
  `idTipoServico` int(11) NOT NULL,
  `idPessoa` int(11) NOT NULL,
  `idOrdemDeServico` int(11) NOT NULL,
  PRIMARY KEY (`idTipoServico`,`idOrdemDeServico`),
  KEY `pessoa_servicoexterno_fk` (`idPessoa`),
  CONSTRAINT `pessoa_servicoexterno_fk` FOREIGN KEY (`idPessoa`) REFERENCES `Pessoa` (`idPessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tiposervico_servicoexterno_fk` FOREIGN KEY (`idTipoServico`) REFERENCES `TipoServico` (`idTipoServico`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/* data for Table ServicoExterno */

/* Table structure for Telefone */
CREATE TABLE `Telefone` (
  `idTelefone` int(11) NOT NULL AUTO_INCREMENT,
  `idPessoa` int(11) NOT NULL,
  `numero` varchar(15) NOT NULL,
  PRIMARY KEY (`idTelefone`),
  UNIQUE KEY `indexTel` (`idTelefone`,`idPessoa`),
  KEY `pessoa_telefone_fk` (`idPessoa`),
  CONSTRAINT `pessoa_telefone_fk` FOREIGN KEY (`idPessoa`) REFERENCES `Pessoa` (`idPessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

/* data for Table Telefone */
INSERT INTO `Telefone` VALUES (23,1,"(14) 9978-29811");
INSERT INTO `Telefone` VALUES (24,6,"(14) 9970-33867");
INSERT INTO `Telefone` VALUES (25,2,"(14) 9974-10301");
INSERT INTO `Telefone` VALUES (26,2,"(14) 3346-1345");
INSERT INTO `Telefone` VALUES (29,7,"(14) 9969-84832");
INSERT INTO `Telefone` VALUES (30,21,"(14) 9970-33867");
INSERT INTO `Telefone` VALUES (31,22,"(14) 9970-33867");

/* Table structure for TipoServico */
CREATE TABLE `TipoServico` (
  `idTipoServico` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(24) NOT NULL,
  `descricao` varchar(64) NOT NULL,
  `valor` decimal(10,5) NOT NULL,
  `status` varchar(24) NOT NULL,
  PRIMARY KEY (`idTipoServico`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

/* data for Table TipoServico */
INSERT INTO `TipoServico` VALUES (27,"CartÃ£o de Visita","ContÃ©m os dados de contato de pessoas/empresas","10.00000","ativo");
INSERT INTO `TipoServico` VALUES (28,"Carimbo","Material auxiliar de uso diverso","40.00000","ativo");
INSERT INTO `TipoServico` VALUES (34,"Nota Fiscal","Impresso utilizado como documento fiscal","70.00000","ativo");
INSERT INTO `TipoServico` VALUES (35,"Nota Fiscal","Impresso utilizado como documento fiscal","0.00000","ativo");
INSERT INTO `TipoServico` VALUES (36,"Nota Fiscal","Impresso utilizado como documento fiscal","70.00000","ativo");
INSERT INTO `TipoServico` VALUES (37,"Nota Fiscal","Impresso utilizado como documento fiscal","70.00000","ativo");
INSERT INTO `TipoServico` VALUES (38,"Nota Fiscal","Impresso utilizado como documento fiscal","70.00000","ativo");
INSERT INTO `TipoServico` VALUES (39,"Nota Fiscal","Impresso utilizado como documento fiscal","100.00000","ativo");
INSERT INTO `TipoServico` VALUES (40,"Nota Fiscal","Impresso utilizado como documento fiscal","70.00000","ativo");
INSERT INTO `TipoServico` VALUES (41,"Nota Fiscal","Impresso utilizado como documento fiscal","70.00000","ativo");
INSERT INTO `TipoServico` VALUES (42,"Nota Fiscal","Impresso utilizado como documento fiscal","20.00000","ativo");
INSERT INTO `TipoServico` VALUES (43,"Cartaz","Material utilizado para divulgaÃ§Ã£o de eventos, ocasiÃµes, etc","2.00000","ativo");
INSERT INTO `TipoServico` VALUES (44,"Panfleto","Material utilizado para divulgaÃ§Ã£o de eventos, ocasiÃµes, etc","0.00000","ativo");
INSERT INTO `TipoServico` VALUES (45,"","","0.00000","excluido");
INSERT INTO `TipoServico` VALUES (46,"","","0.00000","excluido");

/* Table structure for TipoServico_Acabamento */
CREATE TABLE `TipoServico_Acabamento` (
  `idAcabamento` int(11) NOT NULL,
  `idTipoServico` int(11) NOT NULL,
  PRIMARY KEY (`idAcabamento`,`idTipoServico`),
  KEY `tiposervico_tiposervico_acabamento_fk` (`idTipoServico`),
  CONSTRAINT `acabamento_tiposervico_acabamento_fk` FOREIGN KEY (`idAcabamento`) REFERENCES `Acabamento` (`idAcabamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tiposervico_tiposervico_acabamento_fk` FOREIGN KEY (`idTipoServico`) REFERENCES `TipoServico` (`idTipoServico`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/* data for Table TipoServico_Acabamento */
INSERT INTO `TipoServico_Acabamento` VALUES (1,27);
INSERT INTO `TipoServico_Acabamento` VALUES (1,43);
INSERT INTO `TipoServico_Acabamento` VALUES (1,44);

/* Table structure for TipoServico_Formato */
CREATE TABLE `TipoServico_Formato` (
  `idFormato` int(11) NOT NULL,
  `idTipoServico` int(11) NOT NULL,
  PRIMARY KEY (`idFormato`,`idTipoServico`),
  KEY `tiposervico_tiposervico_formato_fk` (`idTipoServico`),
  CONSTRAINT `formato_tiposervico_formato_fk` FOREIGN KEY (`idFormato`) REFERENCES `Formato` (`idFormato`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tiposervico_tiposervico_formato_fk` FOREIGN KEY (`idTipoServico`) REFERENCES `TipoServico` (`idTipoServico`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/* data for Table TipoServico_Formato */
INSERT INTO `TipoServico_Formato` VALUES (1,43);
INSERT INTO `TipoServico_Formato` VALUES (1,44);
INSERT INTO `TipoServico_Formato` VALUES (3,27);
INSERT INTO `TipoServico_Formato` VALUES (26,44);

/* Table structure for Vias */
CREATE TABLE `Vias` (
  `idVias` int(11) NOT NULL AUTO_INCREMENT,
  `quantidade` smallint(6) NOT NULL,
  PRIMARY KEY (`idVias`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/* data for Table Vias */
INSERT INTO `Vias` VALUES (1,1);
INSERT INTO `Vias` VALUES (2,2);
INSERT INTO `Vias` VALUES (3,3);
INSERT INTO `Vias` VALUES (4,4);

/* Restore session variables to original values */
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
