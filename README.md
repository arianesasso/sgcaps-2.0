# Como executar o SGcaps 2.0 na sua máquina

## Instalação

1. Baixe e instale o [GIT](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git), no Linux (Ubuntu):

```
$ sudo apt-get install git
```

2. Clone esse repositório, no Linux (Ubuntu):

```
$ git clone https://arianesasso@bitbucket.org/arianesasso/sgcaps-2.0.git
```

3. Baixe o [Composer](http://getcomposer.org/doc/00-intro.md)

4. Se a instalação do composer for local, execute dentro da pasta do sgcaps-2.0: 

```
$ php composer.phar install

```
Se for global, execute:

```
$ composer install
```

4. Recomendo o uso do [lampp](), pois é um pacote que já vem com Apache, Mysql e PHP, atualmente uso o: ...

5. Depois de instalar o lampp, para executá-lo, no Linux (Ubuntu):

```
$ .../lampp/lampp start
```

6. Sugiro criar um link simbólico na pasta htdocs do seu lampp para o projeto sgcaps-2.0, no Linux (Ubuntu):
```
$ ln -s /link/para/sgcaps-2.0 sgcaps
```

## Configurações

Read and edit `config/app.php` and setup the 'Datasources' and any other
configuration relevant for your application.

## Execute as migrations

1. Access `cd app/bin`
2. Run `./cake migrations migrate`
