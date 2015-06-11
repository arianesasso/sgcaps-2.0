/**
 * Após o documento HTML estar 'pronto' (com todos os elementos do DOM),
 * executo os scripts abaixo
 * 
 * @param {type} param
 */
$(document).ready(function () {
    /** 
     * Defino uma ação de click para os elementos que possuírem a classe 
     * .link-ajax. Esse evento fará com que determinada página chamada 
     * por meio de um link seja carregada via ajax. 
     * 
     * Obs.: o on/off são necesários para que não ocorra dois 'binds' de um
     * mesmo evento de clique
     */
    $('.link-ajax').off('click').on('click', function (event) {
        event.preventDefault();
        var url = $(this).attr('href');

        $.ajax({
            url: url,
            type: 'get',
            success: function (result) {
                $("#ajax-contet").html(result);
            }
        });
    });

    /**
     * Carrego organizações que não são usuários via clase 
     * .load-organizations
     */
    $('.load-organizations').on('click', function () {
        $.ajax({
            url: '../organizations/showNoUserList',
            type: 'get',
            success: function (result) {
                $(".users-list").html(result);
            }
        });
    });

    /**
     * Carrego profissionais que não são usuários via clase 
     * .load-professionals. Tanto no evento de click quanto quando
     * o radio button estiver selecionado.
     */
    $('.load-professionals').on('click', function () {
        $.ajax({
            url: '../professionals/showNoUserList',
            type: 'get',
            success: function (result) {
                $(".users-list").html(result);
            }
        });
    });

    if ($('.load-organizations').is(':checked')) {
        $.ajax({
            url: '../organizations/showNoUserList',
            type: 'get',
            success: function (result) {
                $(".users-list").html(result);
            }
        });
    };

    if ($('.load-professionals').is(':checked')) {
        $.ajax({
            url: '../professionals/showNoUserList',
            type: 'get',
            success: function (result) {
                $(".users-list").html(result);
            }
        });
    };
    
    /**
     * Configurações do plugin DataTable
     * Linguagem: Português (language)
     * Default: Não deixar a última coluna ordenável (columnDefs)
     */
    $('#data-table').DataTable({
        columnDefs: [
            {orderable: false, targets: -1}
        ],
        language: {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        }
    });
});

/**
 * Executo os scripts abaixo após realizar uma chamada ajax
 * 
 * @param {type} param
 */
$(document).ajaxComplete(function () {
    /** 
     * Defino uma ação de click para os elementos que possuírem a classe 
     * 'link-ajax'. Esse evento fará com que determinada página chamada 
     * por meio de um link seja carregada via ajax.
     * 
     * Obs.: o on/off são necesários para que não ocorra dois 'binds' de um
     * mesmo evento de clique
     */
    $('.link-ajax').off('click').on('click', function (event) {
        event.preventDefault();
        var url = $(this).attr('href');

        $.ajax({
            url: url,
            type: 'get',
            success: function (result) {
                $("#ajax-contet").html(result);
            }
        });
    });

    /**
     * Defino um evento de click para os elementos html da classe 'send-data'. 
     * Esse evento é responsável por enviar os dados de um formulário via ajax para 
     * a url (action de um controller) definida na action do formulário inicial.
     * 
     * Uso preferencial: em botões de submissão de formulários 
     */
    $('.send-data').click(function (event) {
        event.preventDefault();
        var form = $("form").serializeArray();
        var url = $("form").attr('action');

        $.ajax({
            url: url,
            type: 'post',
            data: form,
            success: function (result) {
                $("#ajax-contet").html(result);
            }
        });
    });
});