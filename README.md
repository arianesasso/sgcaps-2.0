# Como executar o SGcaps 2.0 na sua máquina

## Instalação

* Baixe e instale o [GIT](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git), no Linux (Ubuntu):

```
$ sudo apt-get install git
```

* Clone esse repositório, no Linux (Ubuntu):

```
$ git clone https://arianesasso@bitbucket.org/arianesasso/sgcaps-2.0.git
```

* Baixe o [Composer](http://getcomposer.org/doc/00-intro.md)

* Se a instalação do composer for local, execute dentro da pasta do sgcaps-2.0: 

```
$ php composer.phar install

```
* Se for global, execute:

```
$ composer install
```

* Recomendo o uso do [xampp](https://www.apachefriends.org/download.html), pois é um pacote que já vem com Apache, Mysql e PHP, atualmente uso o: ...

* Depois de instalar o xampp, para executá-lo, no Linux (Ubuntu):

```
$ .../lampp/lampp start
```

* Sugiro criar um link simbólico na pasta htdocs do seu lampp para o projeto sgcaps-2.0, no Linux (Ubuntu):
```
$ ln -s /link/para/sgcaps-2.0 sgcaps
```

## Configurações

* No seu SGBD criei um banco para o sgcaps-2.0, sugestão: sgcaps, no MySQL:
```
$ mysql> create database sgcaps;
```

* Accesse dentro da aplicação sgcaps-2.0:
```
$ cd app/bin
```

* Execute:
```
$ ./cake migrations migrate`
```

* Accesse dentro da aplicação sgcaps-2.0:
```
$ cd config/app.php
```

* Altere os dados de conexão default em 'Datasources' para acessar o banco sgcaps, exemplo:

``` 
'Datasources' => [
        'default' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'persistent' => false,
            'host' => 'localhost',
            /**
             * CakePHP will use the default DB port based on the driver selected
             * MySQL on MAMP uses port 8889, MAMP users will want to uncomment
             * the following line and set the port accordingly
             */
            //'port' => 'nonstandard_port_number',
            'username' => 'meu_usuario',
            'password' => 'minha_senha',
            'database' => 'sgcaps',
            'encoding' => 'utf8',
            'timezone' => 'UTC',
            'cacheMetadata' => true,
	    ...
```