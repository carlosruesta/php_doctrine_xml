# php_doctrine_xml

### Aula 01

+ Uso de comandos:

  ./vendor/bin/doctrine list
  ./vendor/bin/doctrine orm:mapping:describe Ator
  ./vendor/bin/doctrine orm:validate-schema
  ./vendor/bin/doctrine orm:info
  
### Aula 02

+ Como limitar o tamanho de uma coluna, através do atributo length
+ Como mudar a forma como o banco gera os valores para um ID, através do atributo stragegy, da anotação GeneratedValue
+ Como definir se uma coluna pode ou não ser nula, através do nullable
+ Como informar que um campo é único, através da propriedade unique
+ Como definir o valor padrão de uma coluna, através das options
+ Como atribuir manualmente a definição da coluna, com o atributo columnDefinition

+ Uso de comando
  ./vendor/bin/doctrine orm:schema-tool:create --dump-sql

### Aula 03

+ O Doctrine permite o mapeamento de entidades utilizando XML
+ O arquivo XML de uma entidade precisa seguir algumas convenções:
+ Cada entidade precisa ter seu próprio arquivo de configuração
+ Ter seu nome igual ao nome completo da classe (com namespaces separados por pontos)
+ A extensão destes arquivos deve ser .dcm.xml
+ Como realizar o mapeamento utilizando XML

+ Uso de comandos
 ./vendor/bin/doctrine orm:info
 
### Aula 04

+ Como mapear relacionamentos com XML, através da tag <many-to-many> (no nosso caso, de muitos-para-muitos)
+ Como criar o schema do banco de dados, utilizando o Doctrine (sem migrations) e os comandos da CLI
 DI
 
### Aula 05 e 06

+ Relacionamentos many-to-many, one-to-many e many-to-one
+ Como configurar as opções em cascata no Doctrine, utilizando a tag <cascade>
+ Como definir um tipo de coluna fixo (no caso de string, o tipo CHAR), através da tag <options>
+ Como realizar mapeamentos <many-to-one>
+ Que é possível ter mais de um relacionamento com a mesma entidade
+ Que as join-column, por padrão, são nullable

+ Comandos usados
    vendor\bin\doctrine orm:schema-tool:drop --force
    
+ Gerando os mapeamentos:
    + Gerando as entidades sem anotacões 
    vendor\bin\doctrine orm:generate-entities src\Entity
    
    + Gerando mapeamento em xml
    vendor\bin\doctrine orm:convert-mapping --from-database --namespace Alura\Doctrine\Entity xml mapeamentos
    
    + Gerando mapeamento em anotacao
    vendor\bin\doctrine orm:convert-mapping --from-database --namespace Alura\Doctrine\Entity annotation src\Entity 
    
# Curso parte 2 de Doctrine ORM: 
## Use índices, SQL nativo, funções e stored procedures

### Aula 01: Mapeando índices no Doctrine

* Como mapear índices utilizando o Doctrine, através da tag <indexes>
* Que o Doctrine trata os índices UNIQUE de forma diferente, mapeando-os com a tag <unique-constraints>
* Usamos para verificar mudanças   
    ./vendor/bin/doctrine orm:schema-tool:create --dump-sql
    
### Aula 02: Definindo tipos personalizados

+ Para que a gente consiga utilizar um tipo personalizado, ele precisa existir no banco de dados.
+ Doctrine não cria esse tipo automaticamente, então o tipo personalizo será criado direto no banco:
    CREATE TYPE CLASSIFICACAO AS ENUM ('G', 'PG', 'PG-13', 'R', 'NC-17');
    
+ No momento de criar a conexão com o banco de dados preciso informar que será usado um tipo personalizado
    + Preciso informar ao Doctrine que será adicionado um tipo personalizado e qual classe PHP que tratará com ele
        + Type::addType(string_nome_do_tipo, classe_php_do_tipo)
        + Type::addType('classificacao', TipoClassificacao::class)
    + Também é necessário pedir para o Doctrine realizar o mapeamento:
        + $em->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('CLASSIFICACAO', 'classificacao');
        
+ No PHP Será necessário criar uma classe TipoClassificacao que será a responsável por realizar o mapeamento
    entre os valores do PHP e os valores do Banco de dados;
    + A classe extende a classe Doctrine\DBAL\Types\Type;
    + Nessa classe poderia se instanciar classes que tratariam cada valor (MUITO INTERESSANTE)
    + No caso do exemplo da aula será somente devolvido o valor correspondente
    + O mapeamento realizado é bidirecional: PHP -> Banco (Salvar dados) e Banco -> PHP (Leitura)
    + PHP -> Banco (Salvar dados)   -> convertToPHPValue
    + Banco -> PHP (Leitura)        -> convertToDatabaseValue

+ Precisa também definir o campo e o tipo corretamente no XML de mapeamento (ou na classe se for por anotação);

+ No PHP precisarei alterar a classe Filme mapeando o novo campo classificação e permitindo a inserção de valores

+ No caso no mapeamento no XML evitamos o column definition
    <field name="classificacao" column-definition="CLASSIFICACAO DEFAULT 'G'"/>-->
    + Evitamos isso porque a classificação chegaria no PHP como uma string, que pode não ter muito significado para o negócio.
    
    + Ao definir os  Doctrine Types e a classe de definicao de tipo personalizado no PHP, o Doctrine vai mapear para nós 
      esta string para classes relevantes do domínio.
    
          <field name="classificacao"
              column="classificacao"
              type="classificacao">
              <options>
              <option name="default">G</option>
              </options>
          </field>
          
+ Inclusão do uso de Enum
    + O PHP não suporta Enums por padrão. Para ter acesso a esta funcionalidade, precisamos recorrer a componentes externos.
    + Inclusão de uma lib externa: **myclabs/php-enum**.
    + Seu funcionamento se dá através do método mágico __callStatic, que permite que, ao chamar um método estático não existente, alguma ação seja tomada. 
    + Com isso, conseguimos acessar ClassificacaoEnum::LIVRE(), por exemplo.
+ Para funcionamento do ENUM precisamos alterar:
    + Criar o Enum: ClassificacaoEnum.php
    + A classe filme obrigar a receber no construtor o tipo ClassificacaoEnum
    + Na definição do TipoClassificacao foi tratado para o Doctrine ao momento de mapear já entregar e ler um Enum;
       