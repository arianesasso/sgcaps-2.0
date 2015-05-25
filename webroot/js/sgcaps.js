/**
 * Após o documento HTML estar 'pronto' (com todos os elementos do DOM), defino 
 * uma acao de click para os elementos do mesmo que possuírem a classe 
 * 'link-ajax'. 
 * Esse evento fará com que determinada página chamada por meio de um link
 * seja carregada via ajax.
 * 
 * @param {type} param
 */
$(document).ready(function () {
    $('.link-ajax').off('click').on('click', function (event) {
        event.preventDefault();
        var url = $(this).attr('href');

        $.ajax({
            url: url,
            type: 'get',
            success: function (result) {
                $("#content").html(result);
            }
        });
    });
});

/**
 * Após carregar qualquer ajax, defino um evento de click para os elementos html
 * da classe 'send-data'. 
 * Esse evento é responsável por enviar os dados de um formulário via ajax para 
 * a url (action de um controller) definida na action do formulário inicial.
 * 
 * Uso preferencial: em botões de submissão de formulários
 * 
 * @param {type} param
 */
$(document).ajaxComplete(function () {
    $('.link-ajax').off('click').on('click', function (event) {
        event.preventDefault();
        var url = $(this).attr('href');

        $.ajax({
            url: url,
            type: 'get',
            success: function (result) {
                $("#content").html(result);
            }
        });
    });

    $('.send-data').click(function (event) {
        event.preventDefault();
        var form = $("form").serializeArray();
        var url = $("form").attr('action');

        $.ajax({
            url: url,
            type: 'post',
            data: form,
            success: function (result) {
                $("#content").html(result);
            }
        });
    });
});