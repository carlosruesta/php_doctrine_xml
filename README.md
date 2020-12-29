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