<div class="row">
    <div class="col-xs-12 col-lg-6">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-search"></i>
                    <span>Quantidade de Pacientes x Sexo x Mês</span>
                </div>
                <div class="box-icons">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="expand-link">
                        <i class="fa fa-expand"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content">
                <div id="morris-chart-1" style="height: 200px;"></div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-lg-6">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-search"></i>
                    <span>Quantidade de Novos Pacientes x Mês</span>
                </div>
                <div class="box-icons">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="expand-link">
                        <i class="fa fa-expand"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content">
                <div id="morris-chart-4" style="height: 200px;"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    // Draw all test Morris Charts
    function DrawAllMorrisCharts() {
        MorrisChart1();
        //MorrisChart2();
        //MorrisChart3();
        MorrisChart4();
        //MorrisChart5();
    }
    $(document).ready(function () {
        // Load required scripts and draw graphs
        LoadMorrisScripts(DrawAllMorrisCharts);
        WinMove();
    });
</script>