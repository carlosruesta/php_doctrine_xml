CREATE TABLE ator
(
    id_ator         SERIAL      PRIMARY KEY,
    primeiro_nome   VARCHAR(45) NOT NULL,
    ultimo_nome     VARCHAR(45) NOT NULL,
    data_atualizado TIMESTAMP   NOT NULL DEFAULT 'NOW()'
);
CREATE INDEX idx_ultimo_nome ON ator USING btree (ultimo_nome);

CREATE TABLE idioma
(
    id_idioma       SMALLSERIAL PRIMARY KEY,
    nome            CHAR(20)  NOT NULL,
    data_atualizado TIMESTAMP NOT NULL DEFAULT NOW()
);

CREATE TABLE categoria
(
    id_categoria    SMALLSERIAL PRIMARY KEY,
    nome            VARCHAR(45)  NOT NULL,
    data_atualizado TIMESTAMP NOT NULL DEFAULT NOW()
);

CREATE TYPE CLASSIFICACAO AS ENUM ('G', 'PG', 'PG-13', 'R', 'NC-17');
CREATE TABLE filme
(
    id_filme           SERIAL PRIMARY KEY,
    titulo             VARCHAR(255)	NOT NULL,
    sinopse            TEXT			DEFAULT NULL,
    ano_lancamento     VARCHAR(4)		NOT NULL,
    id_idioma_audio    SMALLINT		NOT NULL,
    id_idioma_original SMALLINT		NOT NULL,
    classificacao      CLASSIFICACAO	DEFAULT 'G',
    data_atualizado    TIMESTAMP		NOT NULL DEFAULT NOW(),
    CONSTRAINT fk_id_idioma_audio_filme FOREIGN KEY (id_idioma_audio) REFERENCES idioma (id_idioma),
    CONSTRAINT fk_id_idioma_original_filme FOREIGN KEY (id_idioma_original) REFERENCES idioma (id_idioma)
);

CREATE TABLE ator_filme
(
    id_ator  INT NOT NULL,
    id_filme INT NOT NULL,
    PRIMARY KEY (id_ator, id_filme),
    CONSTRAINT fk_ator FOREIGN KEY (id_ator) REFERENCES ator (id_ator),
    CONSTRAINT fk_filme FOREIGN KEY (id_filme) REFERENCES filme (id_filme)
);

CREATE TABLE filme_categoria
(
    id_filme     INT NOT NULL,
    id_categoria INT NOT NULL,
    PRIMARY KEY (id_filme, id_categoria),
    CONSTRAINT fk_filme FOREIGN KEY (id_filme) REFERENCES filme (id_filme),
    CONSTRAINT fk_categoria FOREIGN KEY (id_categoria) REFERENCES categoria (id_categoria)
);

CREATE TABLE cliente
(
    id_cliente SERIAL PRIMARY KEY,
    primeiro_nome VARCHAR(45) NOT NULL,
    ultimo_nome VARCHAR(45) NOT NULL,
    data_atualizado TIMESTAMP NOT NULL DEFAULT 'NOW()'
);
CREATE UNIQUE INDEX idx_nome_completo_cliente_unique ON cliente (primeiro_nome, ultimo_nome);

CREATE FUNCTION total_atores_por_categoria(IN categoria_id INTEGER, OUT total INTEGER) AS $$
BEGIN
SELECT INTO total COUNT(DISTINCT ator.id_ator)
FROM ator
    JOIN ator_filme ON ator_filme.id_ator = ator.id_ator
    JOIN filme ON filme.id_filme = ator_filme.id_filme
    JOIN filme_categoria ON filme_categoria.id_filme = filme.id_filme
    JOIN categoria ON categoria.id_categoria = filme_categoria.id_categoria
WHERE categoria.id_categoria = categoria_id;
END;
$$ LANGUAGE plpgsql;

CREATE VIEW atores_mais_atuantes AS SELECT CONCAT(ator.primeiro_nome, ' ', ator.ultimo_nome) AS nome,
                                           COUNT(filme.id_filme) AS qtd_filmes
                                    FROM ator
                                             JOIN ator_filme ON ator_filme.id_ator = ator.id_ator
                                             JOIN filme ON filme.id_filme = ator_filme.id_filme
                                    GROUP BY ator.id_ator
                                    ORDER BY qtd_filmes DESC
    LIMIT 2;

INSERT INTO idioma (nome) VALUES ('Inglês'), ('Alemão'), ('Português');
INSERT INTO ator (primeiro_nome, ultimo_nome) VALUES
('Vinicius', 'Dias'),
('Nico', 'Steppat'),
('Patricia', 'Freitas'),
('Flavio', 'Almeida');
INSERT INTO filme (titulo, ano_lancamento, id_idioma_audio, id_idioma_original) VALUES
('As longas tranças do careca', '2019', 2, 1),
('A volta dos que não foram', '2019', 3, 1),
('Incêndio em alto mar', '2019', 2, 1),
('Acabou a criatividade', '2019', 1, 1);
INSERT INTO ator_filme VALUES (1, 1), (1, 2), (1, 3), (1, 4), (2, 2), (3, 2), (2, 3), (3, 4);


INSERT INTO categoria (nome) VALUES ('Ação'), ('Comédia'), ('Romance'), ('Terror');
INSERT INTO filme_categoria VALUES (1, 1), (2, 1), (2, 2), (2, 3), (3, 1), (4, 4);