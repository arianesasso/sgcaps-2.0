<!DOCTYPE html>
<html lang="pt">
    <head>
        <?= $this->Html->charset('') ?>
        <?= $this->Html->meta('description', 'description'); ?>
        <?= $this->Html->meta('author', 'Evgeniya'); ?>
        <?= $this->Html->meta('keywords', 'keywords'); ?>
        <?= $this->Html->meta('viewport', 'width=device-width, initial-scale=1'); ?>
        <?= $this->Html->meta('icon') ?>
        <title>
            <?= 'SGCaps' ?>
        </title>

        <?= $this->Html->css('devoops/bootstrap') ?>
        <?= $this->Html->css('devoops/font-awesome.min.css') ?>
        <?= $this->Html->css('devoops/righteous.css') ?>
        <?= $this->Html->css('devoops/style_v1.css') ?>

        <?= $this->Html->script('devoops/jquery.min') ?>
        <?= $this->Html->script('devoops/bootstrap') ?>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
                <script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
        <![endif]-->

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
    </head>
    <body>
        <div id="container">
            <div id="content">
                <?= $this->Flash->render() ?>
                <div class="row">
                    <?= $this->fetch('content') ?>
                </div>
            </div>
        </div>
    </body>
</html>
