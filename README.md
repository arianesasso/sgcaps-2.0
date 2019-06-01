# Como executar o SGcaps 2.0 na sua máquina / How to Execute SGcaps 2.0 in your machine

## Instalação / Installation

* Baixe e instale o [GIT](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git), no Linux (Ubuntu) / Install Git (Linux):

```
$ sudo apt-get install git
```

* Clone esse repositório, no Linux (Ubuntu) / Clone Repository (Linux)

```
$ git clone https://arianesasso@bitbucket.org/arianesasso/sgcaps-2.0.git
```

* Baixe o [Composer](http://getcomposer.org/doc/00-intro.md) / Donwload Composer:

* Se a instalação do composer for local, execute dentro da pasta do sgcaps-2.0 / For a local installation, execute the following command inside the sgcaps-2.0 folder:

```
$ php composer.phar install

```
* Se for global, execute / For a Global Installation:

```
$ composer install
```

* Recomendo o uso do [xampp](https://www.apachefriends.org/download.html), pois é um pacote que já vem com Apache, MySQL e PHP, utilizei a versão: XAMPP for Linux 64bit 5.6.3-0 / XAMPP Installation (Apache + MySQL + PHP)

* Depois de instalar o xampp, para executá-lo, no Linux (Ubuntu) / Executing Lampp:

```
$ .../lampp/lampp start
```

* Sugiro criar um link simbólico na pasta htdocs do seu lampp para o projeto sgcaps-2.0, no Linux (Ubuntu): / Creating a symbolic link from the htdocs lampp folder to the sgcaps-2.0 project (Linux)
```
$ ln -s /link/para/sgcaps-2.0 sgcaps
```

## Configurações / Configurations

* No seu SGBD criei um banco para o sgcaps-2.0, sugestão no MySQL: / Database Creation using MySQL
```
$ mysql> create database sgcaps;
```

* Para executar as migrations, accesse dentro da aplicação sgcaps-2.0: / To execute the Migrations access the bin folder:
```
$ cd bin
```

* Execute / Execute:
```
$ ./cake migrations migrate`
```

* Por fim, para configurar o datasource default, accesse dentro da aplicação sgcaps-2.0 / To alter the default datasource, access:
```
$ cd config/app.php
```

* Altere os dados de conexão default em 'Datasources', exemplo: / Change the default connection configuration in 'Datasources', example:

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

* Usuário inicial para acessar o sistema: / Initial User
```
nome: admin
senha: 1234
```

* Teste o sistema no Heroku: [SGCaps no Heroku](http://sgcaps.herokuapp.com/) / Try the system on Heroku

* Note: most of the comments in the repository and in the code are in Portuguese
