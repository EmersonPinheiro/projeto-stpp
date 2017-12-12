$(document).ready(function() {
  $('[data-toggle="popover"]').popover({
    animation:true,
    delay:0,
    html: true,
    placement: 'top',
    trigger: 'focus',
    container: 'body'
  });

  $('#resumo').keyup(function () {
    var max = 2000;
    var len = $(this).val().length;
    if (len >= max) {
      $('#restantes_r').text('Você atingiu o limite de caracteres!');
    } else {
      var char = max - len;
      $('#restantes_r').text(char + ' caracteres restantes');
    }
  });

  $('#genese_relevancia').keyup(function () {
    var max = 5000;
    var len = $(this).val().length;
    if (len >= max) {
      $('#restantes_gr').text('Você atingiu o limite de caracteres!');
    } else {
      var char = max - len;
      $('#restantes_gr').text(char + ' caracteres restantes');
    }
  });

  $('#info-adicionais').on('click', function(){
    $('.invisivel').slideToggle(300);
  });

  $('.btn-loading').on('click', function() {
    $(this).html('Carregando...').addClass('disabled');
  });

});
