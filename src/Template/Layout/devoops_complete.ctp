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
        <?= $this->Html->css('devoops/jquery-ui.min') ?>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <?= $this->Html->css('devoops/righteous.css') ?>
        <?= $this->Html->css('devoops/jquery.fancybox') ?>
        <?= $this->Html->css('devoops/style_v1') ?>
        <?= $this->Html->css('dataTables.bootstrap') ?>
        <?= $this->Html->css('dataTables.fontAwesome') ?>
        <?= $this->Html->css('select2.min') ?>
        <?= $this->Html->css('sgcaps') ?>

        <?= $this->Html->script('devoops/jquery.min') ?>
        <?= $this->Html->script('devoops/jquery-ui.min') ?>
        <?= $this->Html->script('devoops/jquery.ui.datepicker-pt-BR') ?>
        <?= $this->Html->script('devoops/bootstrap') ?>
        <?= $this->Html->script('devoops/devoops') ?>
        <?= $this->Html->script('devoops/raphael') ?>
        <?= $this->Html->script('devoops/morris') ?>
        <?= $this->Html->script('jquery.dataTables.min') ?>
        <?= $this->Html->script('dataTables.bootstrap') ?>
        <?= $this->Html->script('inputmask') ?>
        <?= $this->Html->script('jquery.inputmask') ?>
        <?= $this->Html->script('inputmask.date.extensions') ?>
        <?= $this->Html->script('select2.min') ?>
        <?= $this->Html->script('sgcaps') ?>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
                <script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
        <![endif]-->

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>

        <?php $user = $this->request->session()->read('Auth.User'); ?>
    </head>
    <body>
        <header class="navbar">
            <?= $this->element('Dashboard/dashboard_header', ['user' => $user]); ?>
        </header>
        <div id="main" class="container-fluid">
            <div class="row">
                <div id="sidebar-left" class="col-xs-2 col-sm-2">
                    <?= $this->element('Dashboard/dashboard_sidebar'); ?>
                </div>
                <div id="content" class="col-xs-12 col-sm-10">
                    <?= $this->element('Dashboard/bread_crumbs', ['user' => $user]); ?>
                    <div id ="ajax-contet">
                        <?= $this->Flash->render() ?>
                        <?= $this->fetch('content') ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
