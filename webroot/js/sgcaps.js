/**
 * Após o documento HTML estar 'pronto' (com todos os elementos do DOM),
 * executo as ações abaixo
 * 
 * @param {type} param
 */
$(document).ready(function () {
    /** 
     * Defino uma ação de click para os elementos que possuírem a classe 
     * .link-ajax. Esse evento fará com que determinada página chamada 
     * por meio de um link seja carregada via ajax
     * 
     * Obs.: o on/off são necesários para que não ocorra dois 'binds' de um
     * mesmo evento de clique no mesmo elemento
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
     * Carrego organizações que não são usuários via clase .load-organizations
     * Tanto no evento de click quanto quando o radio button estiver selecionado
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

    if ($('.load-organizations').is(':checked')) {
        $.ajax({
            url: '../organizations/showNoUserList',
            type: 'get',
            success: function (result) {
                $(".users-list").html(result);
            }
        });
    }
    ;

    /**
     * Carrego profissionais que não são usuários via clase .load-professionals 
     * Tanto no evento de click quanto quando o radio button estiver selecionado
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

    if ($('.load-professionals').is(':checked')) {
        $.ajax({
            url: '../professionals/showNoUserList',
            type: 'get',
            success: function (result) {
                $(".users-list").html(result);
            }
        });
    }
    ;

    /**
     * Configurações do plugin DataTable
     * Linguagem (language): Português 
     * Default (columnDefs): Não deixar a última coluna ordenável
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

    //Jquery Datepicker - Configurações para Data de Nascimento
    $("#birthdate").datepicker({
        showOn: "button",
        buttonImage: "../img/icons/splashy_icons/calendar_month.png",
        maxDate: '-1Y',
        buttonImageOnly: true,
        buttonText: "Selecione uma data",
        changeMonth: true,
        changeYear: true
    }, $.datepicker.regional[ "pt-BR" ]);

    //Usando o plugin jquery.inpumask para criar máscaras
    $('.date-mask').inputmask("date");
    $('.cpf-mask').inputmask('999.999.999-99');
    // http://cartaonet.datasus.gov.br/
    $('.cns-mask').inputmask('999999999999999');
    $('.rg-mask').inputmask({mask: '*{7}[*{1,8}]', greedy: false});
    
    validateAproxAge();
    $('#birthdate').change(validateAproxAge);

});

// Liberar o campo 'Idade Aproximada' (aprox_age) se o campo 'Data de Nascimento' 
// (birthdate) estiver vazio e também torná-lo obrigatório nesse caso
function validateAproxAge() {
    if ($('#birthdate').val().length === 0) {
        $("#aprox_age").prop("disabled", false);
        $("#aprox_age").prop("required", true);
        $("#mandatory_aprox_age").css("display", "inline");
    }
    else {
        $("#aprox_age").prop("disabled", true);
        $("#aprox_age").prop("required", false);
        $("#mandatory_aprox_age").css("display", "none");
        $("#aprox_age").val(null);        
    }
}

/**
 * Executo os scripts abaixo após realizar uma chamada ajax
 * 
 * @param {type} param
 */
$(document).ajaxComplete(function () {
    /** 
     * Defino uma ação de click para os elementos que possuírem a classe 
     * 'link-ajax'. Esse evento fará com que determinada página chamada 
     * por meio de um link seja carregada via ajax
     * 
     * Obs.: o on/off são necesários para que não ocorra dois 'binds' de um
     * mesmo evento de clique no mesmo elemento
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