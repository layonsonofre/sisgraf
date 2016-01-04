
CREATE TABLE Vias (
                idVias INT AUTO_INCREMENT NOT NULL,
                quantidade SMALLINT NOT NULL,
                PRIMARY KEY (idVias)
);


CREATE TABLE ModeloNotaFiscal (
                idModeloNotaFiscal INT AUTO_INCREMENT NOT NULL,
                modelo VARCHAR(10) NOT NULL,
                descricao VARCHAR(50) NOT NULL,
                valor DECIMAL(10,5) NOT NULL,
                PRIMARY KEY (idModeloNotaFiscal)
);


CREATE TABLE Formato (
                idFormato INT AUTO_INCREMENT NOT NULL,
                formato VARCHAR(32) NOT NULL,
                valor DECIMAL(10,5) NOT NULL,
                base SMALLINT NOT NULL,
                altura SMALLINT NOT NULL,
                PRIMARY KEY (idFormato)
);


CREATE TABLE Acabamento (
                idAcabamento INT AUTO_INCREMENT NOT NULL,
                nome VARCHAR(15) NOT NULL,
                descricao VARCHAR(35) NOT NULL,
                valor DECIMAL(10,5) NOT NULL,
                local VARCHAR(25) NOT NULL,
                PRIMARY KEY (idAcabamento)
);


CREATE TABLE TipoServico (
                idTipoServico INT AUTO_INCREMENT NOT NULL,
                nome VARCHAR(24) NOT NULL,
                descricao VARCHAR(64) NOT NULL,
                valor DECIMAL(10,5) NOT NULL,
                PRIMARY KEY (idTipoServico)
);


CREATE TABLE TipoServico_Formato (
                idFormato INT NOT NULL,
                idTipoServico INT NOT NULL,
                PRIMARY KEY (idFormato, idTipoServico)
);


CREATE TABLE Carimbo (
                idTipoServico INT NOT NULL,
                isAutomatico BOOLEAN NOT NULL,
                nomeCarimbo VARCHAR(15) NOT NULL,
                base SMALLINT NOT NULL,
                altura SMALLINT NOT NULL,
                PRIMARY KEY (idTipoServico)
);


CREATE TABLE NotaFiscal (
                idTipoServico INT NOT NULL,
                idVias INT NOT NULL,
                numeracaoInicial INT NOT NULL,
                numeracaoFinal INT NOT NULL,
                numeroTalao SMALLINT NOT NULL,
                folhasBloco SMALLINT NOT NULL,
                aidf BIGINT NOT NULL,
                idModeloNotaFiscal INT NOT NULL,
                PRIMARY KEY (idTipoServico)
);


CREATE TABLE TipoServico_Acabamento (
                idAcabamento INT NOT NULL,
                idTipoServico INT NOT NULL,
                PRIMARY KEY (idAcabamento, idTipoServico)
);


CREATE TABLE FormaImpressao (
                idFormaImpressao INT AUTO_INCREMENT NOT NULL,
                nome VARCHAR(15) NOT NULL,
                descricao VARCHAR(35) NOT NULL,
                valor DECIMAL(10,5) NOT NULL,
                PRIMARY KEY (idFormaImpressao)
);


CREATE TABLE ArquivoMatriz (
                idArquivoMatriz INT AUTO_INCREMENT NOT NULL,
                url VARCHAR(256) NOT NULL,
                utilizacoes INT NOT NULL,
                idChapa INT NOT NULL,
                PRIMARY KEY (idArquivoMatriz)
);


CREATE TABLE GramaturaPapel (
                idGramaturaPapel INT AUTO_INCREMENT NOT NULL,
                gramatura SMALLINT NOT NULL,
                PRIMARY KEY (idGramaturaPapel)
);


CREATE TABLE OrdemDeServico (
                idOrdemDeServico INT AUTO_INCREMENT NOT NULL,
                dataEntrada CHAR(10) NOT NULL,
                dataPrevistaSaida CHAR(10) NOT NULL,
                dataSaida CHAR(10) NOT NULL,
                status CHAR(24) NOT NULL,
                isOrcamento BOOLEAN NOT NULL,
                valorTotal NUMERIC(10,5) NOT NULL,
                observacoes VARCHAR(2000),
                PRIMARY KEY (idOrdemDeServico)
);


CREATE TABLE Arquivo (
                idArquivo INT AUTO_INCREMENT NOT NULL,
                nome VARCHAR(64) NOT NULL,
                data CHAR(10) NOT NULL,
                idOrdemDeServico INT NOT NULL,
                PRIMARY KEY (idArquivo)
);


CREATE TABLE Arquivo_ArquivoMatriz (
                idArquivo INT NOT NULL,
                idArquivoMatriz INT NOT NULL,
                PRIMARY KEY (idArquivo, idArquivoMatriz)
);


CREATE TABLE ArquivoModelo (
                idArquivoModelo INT AUTO_INCREMENT NOT NULL,
                url VARCHAR(256) NOT NULL,
                idArquivo INT NOT NULL,
                PRIMARY KEY (idArquivoModelo)
);


CREATE TABLE QuantidadeCores (
                idQuantidadeCores INT AUTO_INCREMENT NOT NULL,
                descricao CHAR(3) NOT NULL,
                valor DECIMAL(10,5) NOT NULL,
                PRIMARY KEY (idQuantidadeCores)
);


CREATE TABLE OrdemDeServico_TipoServico (
                idTipoServico INT NOT NULL,
                idOrdemDeServico INT NOT NULL,
                quantidade INT NOT NULL,
                valor DECIMAL(10,5) NOT NULL,
                idFormaImpressao INT NOT NULL,
                idQuantidadeCores INT NOT NULL,
                idFormato INT NOT NULL,
                PRIMARY KEY (idTipoServico, idOrdemDeServico)
);


CREATE TABLE Acab_OS_TS (
                idAcab_OS_TS INT AUTO_INCREMENT NOT NULL,
                idTipoServico INT NOT NULL,
                idOrdemDeServico INT NOT NULL,
                idAcabamento INT NOT NULL,
                PRIMARY KEY (idAcab_OS_TS)
);


CREATE TABLE Cor (
                idCor INT AUTO_INCREMENT NOT NULL,
                nome VARCHAR(15) NOT NULL,
                PRIMARY KEY (idCor)
);


CREATE TABLE Cor_OrdemDeServico_TipoServico (
                idCor INT NOT NULL,
                idTipoServico INT NOT NULL,
                idOrdemDeServico INT NOT NULL,
                isFrente BOOLEAN NOT NULL,
                PRIMARY KEY (idCor, idTipoServico, idOrdemDeServico)
);


CREATE TABLE MaterialUnidade (
                idMaterialUnidade INT AUTO_INCREMENT NOT NULL,
                descricao VARCHAR(10) NOT NULL,
                PRIMARY KEY (idMaterialUnidade)
);


CREATE TABLE Material (
                idMaterial INT AUTO_INCREMENT NOT NULL,
                descricao VARCHAR(20) NOT NULL,
                valorUnitario DECIMAL(10,5) NOT NULL,
                quantidade INT NOT NULL,
                quantidadeMinima INT NOT NULL,
                idMaterialUnidade INT NOT NULL,
                PRIMARY KEY (idMaterial)
);


CREATE TABLE Material_Vias (
                idVias INT NOT NULL,
                idMaterial INT NOT NULL,
                PRIMARY KEY (idVias, idMaterial)
);


CREATE TABLE Material_TipoServico (
                idTipoServico INT NOT NULL,
                idMaterial INT NOT NULL,
                valor DECIMAL(10,5) NOT NULL,
                PRIMARY KEY (idTipoServico, idMaterial)
);


CREATE TABLE Papel (
                idMaterial INT NOT NULL,
                tipo VARCHAR(15) NOT NULL,
                idGramaturaPapel INT NOT NULL,
                base SMALLINT NOT NULL,
                altura SMALLINT NOT NULL,
                PRIMARY KEY (idMaterial)
);


CREATE TABLE Cor_Material (
                idMaterial INT NOT NULL,
                idCor INT NOT NULL,
                PRIMARY KEY (idMaterial, idCor)
);


CREATE TABLE Categoria (
                idCategoria INT AUTO_INCREMENT NOT NULL,
                nome VARCHAR(24) NOT NULL,
                Column_3 VARCHAR(60) NOT NULL,
                PRIMARY KEY (idCategoria)
);


CREATE TABLE Categoria_Material (
                idMaterial INT NOT NULL,
                idCategoria INT NOT NULL,
                PRIMARY KEY (idMaterial, idCategoria)
);


CREATE TABLE Pessoa (
                idPessoa INT AUTO_INCREMENT NOT NULL,
                nome VARCHAR(64) NOT NULL,
                status VARCHAR(20) NOT NULL,
                isPessoaFisica BOOLEAN NOT NULL,
                cpf VARCHAR(14),
                rg VARCHAR(12),
                cnpj VARCHAR(18),
                inscricaoEstadual VARCHAR(24),
                inscricaoMunicipal VARCHAR(24),
                razaoSocial VARCHAR(64),
                nomeFantasia VARCHAR(64),
                nomeRua VARCHAR(50) NOT NULL,
                numero INT NOT NULL,
                complemento VARCHAR(32),
                cep VARCHAR(10) NOT NULL,
                bairro VARCHAR(24) NOT NULL,
                estado CHAR(2) NOT NULL,
                PRIMARY KEY (idPessoa)
);


CREATE TABLE ServicoExterno (
                idTipoServico INT NOT NULL,
                idPessoa INT NOT NULL,
                PRIMARY KEY (idTipoServico)
);


CREATE TABLE Funcionario (
                idPessoa INT NOT NULL,
                usuario VARCHAR(32) NOT NULL,
                senha CHAR(64) NOT NULL,
                tipoFuncionario CHAR(20) NOT NULL,
                PRIMARY KEY (idPessoa)
);


CREATE TABLE Pessoa_OrdemDeServico (
                idOrdemDeServico INT NOT NULL,
                idPessoa INT NOT NULL,
                data CHAR(10) NOT NULL,
                PRIMARY KEY (idOrdemDeServico, idPessoa)
);


CREATE TABLE Fornecedor_Categoria (
                idPessoa INT NOT NULL,
                idCategoria INT NOT NULL,
                PRIMARY KEY (idPessoa, idCategoria)
);


CREATE TABLE Email (
                idEmail INT AUTO_INCREMENT NOT NULL,
                idPessoa INT NOT NULL,
                endereco VARCHAR(42) NOT NULL,
                PRIMARY KEY (idEmail)
);


CREATE TABLE Telefone (
                idTelefone INT AUTO_INCREMENT NOT NULL,
                idPessoa INT NOT NULL,
                numero VARCHAR(14) NOT NULL,
                PRIMARY KEY (idTelefone)
);


ALTER TABLE Material_Vias ADD CONSTRAINT vias_material_vias_fk
FOREIGN KEY (idVias)
REFERENCES Vias (idVias)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE NotaFiscal ADD CONSTRAINT vias_notafiscal_fk
FOREIGN KEY (idVias)
REFERENCES Vias (idVias)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE NotaFiscal ADD CONSTRAINT modelonotafiscal_notafiscal_fk
FOREIGN KEY (idModeloNotaFiscal)
REFERENCES ModeloNotaFiscal (idModeloNotaFiscal)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE TipoServico_Formato ADD CONSTRAINT formato_tiposervico_formato_fk
FOREIGN KEY (idFormato)
REFERENCES Formato (idFormato)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE TipoServico_Acabamento ADD CONSTRAINT acabamento_tiposervico_acabamento_fk
FOREIGN KEY (idAcabamento)
REFERENCES Acabamento (idAcabamento)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE OrdemDeServico_TipoServico ADD CONSTRAINT tiposervico_ordemdeservico_tiposervico_fk
FOREIGN KEY (idTipoServico)
REFERENCES TipoServico (idTipoServico)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Material_TipoServico ADD CONSTRAINT tiposervico_material_tiposervico_fk
FOREIGN KEY (idTipoServico)
REFERENCES TipoServico (idTipoServico)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE ServicoExterno ADD CONSTRAINT tiposervico_servicoexterno_fk
FOREIGN KEY (idTipoServico)
REFERENCES TipoServico (idTipoServico)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE TipoServico_Acabamento ADD CONSTRAINT tiposervico_tiposervico_acabamento_fk
FOREIGN KEY (idTipoServico)
REFERENCES TipoServico (idTipoServico)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE NotaFiscal ADD CONSTRAINT tiposervico_notafiscal_fk
FOREIGN KEY (idTipoServico)
REFERENCES TipoServico (idTipoServico)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Carimbo ADD CONSTRAINT tiposervico_carimbo_fk
FOREIGN KEY (idTipoServico)
REFERENCES TipoServico (idTipoServico)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE TipoServico_Formato ADD CONSTRAINT tiposervico_tiposervico_formato_fk
FOREIGN KEY (idTipoServico)
REFERENCES TipoServico (idTipoServico)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE OrdemDeServico_TipoServico ADD CONSTRAINT formaimpressao_ordemdeservico_tiposervico_fk
FOREIGN KEY (idFormaImpressao)
REFERENCES FormaImpressao (idFormaImpressao)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Arquivo_ArquivoMatriz ADD CONSTRAINT arquivomatriz_arquivo_arquivomatriz_fk
FOREIGN KEY (idArquivoMatriz)
REFERENCES ArquivoMatriz (idArquivoMatriz)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Papel ADD CONSTRAINT gramaturapapel_papel_fk
FOREIGN KEY (idGramaturaPapel)
REFERENCES GramaturaPapel (idGramaturaPapel)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Pessoa_OrdemDeServico ADD CONSTRAINT ordemdeservico_pessoa_ordemdeservico_fk
FOREIGN KEY (idOrdemDeServico)
REFERENCES OrdemDeServico (idOrdemDeServico)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Arquivo ADD CONSTRAINT ordemdeservico_arquivo_fk
FOREIGN KEY (idOrdemDeServico)
REFERENCES OrdemDeServico (idOrdemDeServico)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE OrdemDeServico_TipoServico ADD CONSTRAINT ordemdeservico_ordemdeservico_tiposervico_fk
FOREIGN KEY (idOrdemDeServico)
REFERENCES OrdemDeServico (idOrdemDeServico)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE ArquivoModelo ADD CONSTRAINT arquivo_arquivomodelo_fk
FOREIGN KEY (idArquivo)
REFERENCES Arquivo (idArquivo)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Arquivo_ArquivoMatriz ADD CONSTRAINT arquivo_arquivo_arquivomatriz_fk
FOREIGN KEY (idArquivo)
REFERENCES Arquivo (idArquivo)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE OrdemDeServico_TipoServico ADD CONSTRAINT quantidadecores_ordemdeservico_tiposervico_fk
FOREIGN KEY (idQuantidadeCores)
REFERENCES QuantidadeCores (idQuantidadeCores)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Cor_OrdemDeServico_TipoServico ADD CONSTRAINT ordemdeservico_tiposervico_cor_quantidadecores_fk
FOREIGN KEY (idTipoServico, idOrdemDeServico)
REFERENCES OrdemDeServico_TipoServico (idTipoServico, idOrdemDeServico)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Acab_OS_TS ADD CONSTRAINT ordemdeservico_tiposervico_acab_os_ts_fk
FOREIGN KEY (idTipoServico, idOrdemDeServico)
REFERENCES OrdemDeServico_TipoServico (idTipoServico, idOrdemDeServico)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Cor_Material ADD CONSTRAINT cor_cor_material_fk
FOREIGN KEY (idCor)
REFERENCES Cor (idCor)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Cor_OrdemDeServico_TipoServico ADD CONSTRAINT cor_cor_quantidadecores_fk
FOREIGN KEY (idCor)
REFERENCES Cor (idCor)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Material ADD CONSTRAINT materialunidade_material_fk
FOREIGN KEY (idMaterialUnidade)
REFERENCES MaterialUnidade (idMaterialUnidade)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Cor_Material ADD CONSTRAINT material_cor_material_fk
FOREIGN KEY (idMaterial)
REFERENCES Material (idMaterial)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Papel ADD CONSTRAINT material_papel_fk
FOREIGN KEY (idMaterial)
REFERENCES Material (idMaterial)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Material_TipoServico ADD CONSTRAINT material_material_tiposervico_fk
FOREIGN KEY (idMaterial)
REFERENCES Material (idMaterial)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Material_Vias ADD CONSTRAINT material_material_vias_fk
FOREIGN KEY (idMaterial)
REFERENCES Material (idMaterial)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Categoria_Material ADD CONSTRAINT material_categoria_material_fk
FOREIGN KEY (idMaterial)
REFERENCES Material (idMaterial)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Fornecedor_Categoria ADD CONSTRAINT categoria_fornecedor_categoria_fk
FOREIGN KEY (idCategoria)
REFERENCES Categoria (idCategoria)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Categoria_Material ADD CONSTRAINT categoria_categoria_material_fk
FOREIGN KEY (idCategoria)
REFERENCES Categoria (idCategoria)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Telefone ADD CONSTRAINT pessoa_telefone_fk
FOREIGN KEY (idPessoa)
REFERENCES Pessoa (idPessoa)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Email ADD CONSTRAINT pessoa_email_fk
FOREIGN KEY (idPessoa)
REFERENCES Pessoa (idPessoa)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Fornecedor_Categoria ADD CONSTRAINT pessoa_fornecedor_categoria_fk
FOREIGN KEY (idPessoa)
REFERENCES Pessoa (idPessoa)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Pessoa_OrdemDeServico ADD CONSTRAINT pessoa_pessoa_ordemdeservico_fk
FOREIGN KEY (idPessoa)
REFERENCES Pessoa (idPessoa)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Funcionario ADD CONSTRAINT pessoa_funcionario_fk
FOREIGN KEY (idPessoa)
REFERENCES Pessoa (idPessoa)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE ServicoExterno ADD CONSTRAINT pessoa_servicoexterno_fk
FOREIGN KEY (idPessoa)
REFERENCES Pessoa (idPessoa)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE `Pessoa`
ADD COLUMN `cidade` varchar(32) NOT NULL AFTER `estado`;

ALTER TABLE `Pessoa`
ADD COLUMN `orgaoExpedidor` varchar(9) NOT NULL AFTER `cidade`;

ALTER TABLE `Categoria`
CHANGE `Column_3` `descricao` varchar(60) NOT NULL;