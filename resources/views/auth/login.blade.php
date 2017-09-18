@foreach ($errors->all() as $error)
<p class="alert alert-danger">{{ $error }}</p>
@endforeach

@if (Auth::guest())
<div class="quadro-form-login">
  <!-- LOGIN -->
  <form action="{!! route('login') !!}" method="post">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
    <div class="form-group">
      <label for="email-login">E-mail</label>
      <div class="input-group">
        <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
        <input type="email" class="form-control" id="email-login" name="email" placeholder="E-mail" required>
      </div>
    </div>
    <div class="form-group">
      <label for="password">Senha</label>
      <div class="input-group">
        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
        <input id="password" type="password" class="form-control" name="password" placeholder="Senha" required>
      </div>
    </div>
    <div class="form-group">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Lembrar-me
        </label>
      </div>
    </div>
    <p class="text-right"><a href="{{ route('password.request') }}">Esqueceu sua senha?</a></p>
    <button type="submit" class="btn btn-success btn-block">Entrar</button><br />
  </form>
  <a class="btn btn-primary btn-block" href="/cadastro" role="button">Cadastro</a>
</div> <!-- quadro-form -->
@else

@endif
