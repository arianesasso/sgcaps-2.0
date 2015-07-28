<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-3 top-margin sgcaps-home">
            <h3>Bem vindo ao projeto SGCaps</h3>
            <br/>
            <p>Este projeto foi desenvolvido por Ariane Morassi Sasso.</p>
            <p>   
                <?php
                echo $this->Html->link('Login', ['controller' => 'Users', 'action' => 'login'], ['class' => 'btn btn-primary']);
                ?>
            </p>
        </div>
    </div>
</div>