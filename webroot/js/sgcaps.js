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