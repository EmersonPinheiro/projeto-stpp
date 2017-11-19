<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@yield('title')</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('img/editora_uepg.ico') }}"/>

    <!-- Bootstrap -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    @if (Auth::check())
      @include('shared.navbar_logged')
    @else
      @include('shared.navbar')
    @endif

    @yield('content')

    @include('shared.footer')

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

    <script>
      $(document).ready(function() {
        $('[data-toggle="popover"]').popover({
          animation:true,
          delay:0,
          html: true,
          placement: 'right',
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

        $(document).on('click', '#info-adicionais', function(){
    			$('.invisivel').slideToggle(300);
    		});
      });

    </script>

  </body>
</html>
