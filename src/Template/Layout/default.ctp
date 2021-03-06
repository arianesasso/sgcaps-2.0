<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset('') ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            <?= 'SGCaps' ?>
        </title>
        <?= $this->Html->meta('icon') ?>

        <?= $this->Html->css('base') ?>
        <?= $this->Html->css('cake') ?>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
    </head>
    <body>
        <header>
            <div class="header-title">
                <span>SGCaps</span>
            </div>
        </header>
        <div id="container">
            <div id="content">
                <?= $this->Flash->render() ?>
                <div class="row">
                    <?= $this->fetch('content') ?>
                </div>
            </div>
            <footer>
            </footer>
        </div>
    </body>
</html>
