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

    // Jquery Datepicker - Configurações para Data de Nascimento
    $("#birthdate").datepicker({
        showOn: "button",
        buttonImage: "../img/icons/splashy_icons/calendar_month.png",
        maxDate: '-1Y',
        buttonImageOnly: true,
        buttonText: "Selecione uma data",
        changeMonth: true,
        changeYear: true
    }, $.datepicker.regional[ "pt-BR" ]);

    // Usando o plugin jquery.inpumask para criar máscaras
    $('.date-mask').inputmask("date");
    $('.cpf-mask').inputmask('999.999.999-99');
    // http://cartaonet.datasus.gov.br/
    $('.cns-mask').inputmask('999999999999999');
    $('.rg-mask').inputmask({mask: '*{7}[*{1,8}]', greedy: false});
    $('.board-number-mask').inputmask({mask: '*{3}[*{1,7}]'});
    $('.board-mask').inputmask({mask: 'a{2}[a{1,8}]'});
    
    validateAproxAge();
    $('#birthdate').change(validateAproxAge);
    
    // Funções para tratar o input de ocupação
    $(".basic-select").select2({
        language: {
            // Tradução de: https://github.com/select2/select2/blob/master/src/js/select2/i18n/pt-BR.js
            errorLoading: function () {
                return 'Os resultados não puderam ser carregados.';
            },
            inputTooLong: function (args) {
                var overChars = args.input.length - args.maximum;

                var message = 'Apague ' + overChars + ' caracter';

                if (overChars != 1) {
                    message += 'es';
                }

                return message;
            },
            inputTooShort: function (args) {
                var remainingChars = args.minimum - args.input.length;

                var message = 'Digite ' + remainingChars + ' ou mais caracteres';

                return message;
            },
            loadingMore: function () {
                return 'Carregando mais resultados…';
            },
            maximumSelected: function (args) {
                var message = 'Você só pode selecionar ' + args.maximum + ' ite';

                if (args.maximum == 1) {
                    message += 'm';
                } else {
                    message += 'ns';
                }

                return message;
            },
            noResults: function () {
                return 'Nenhum resultado encontrado';
            },
            searching: function () {
                return 'Buscando…';
            }}
    });
    changeOccupationsInput();
    $('#not_found').click(changeOccupationsInput);

});

/**
 * Função para ativar o input de ocupação dependendo da opção 
 * que o usuário escolher. Se ele escolher 'outro', o select 
 * com as ocupações da classificação brasileira de ocupações é
 * desabilitado e é habilitado um input do tipo texto no local.
 * 
 * @returns {undefined}
 */
function changeOccupationsInput() {
    if ($('#not_found').is(':checked')) {
        $('#occupations_text').css("display", "inline");
        $('#occupations_text').prop("disabled", false);
        $('#occupations_select').prop("disabled", true);
        $('#occupations_select').parent().hide();
    } else {
        $('#occupations_text').css("display", "none");
        $('#occupations_text').prop("disabled", true);
        $('#occupations_select').prop("disabled", false);
        $('#occupations_select').parent().show();
    }
}

/**
 * Liberar o campo 'Idade Aproximada' (aprox_age) se o campo 'Data de Nascimento' 
 * (birthdate) estiver vazio e também torná-lo obrigatório nesse caso
 * 
 * @returns {undefined}
 */
function validateAproxAge() {
    if (!$('#birthdate').val()) {
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