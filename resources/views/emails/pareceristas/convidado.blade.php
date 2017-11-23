<h1>Editora uepg</h1>

<h2>Olá {!! $convite->nome !!} {!! $convite->sobrenome !!}</h2>
<p>Você foi convidado a ser avaliador de uma proposta de publicação da Editora UEPG!</p>

<p><strong>Título: </strong> {!! $obra->titulo !!}</p>
<p><strong>Subtítulo: </strong> {!! $obra->subtitulo !!}</p>
<p><strong>Número de páginas: </strong>{!! $numPaginas !!}</p>
<p><strong>Resumo: </strong> {!! $obra->resumo !!}</p>


<a href="{!! action('ConviteController@createParecerista', $convite->token) !!}">Clique aqui para acessar o sistema.</a>
