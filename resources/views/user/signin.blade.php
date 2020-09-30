@extends('layouts.master')

@section('content')
<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<h1>Entrar</h1>
		@if(count($errors) > 0)
			<div class="alert alert-danger">
				@foreach($errors->all() as $error)
					<p>{{ $error }}</p>
				@endforeach
			</div>
		@endif
		<form action="{{ route('user.signin') }}" method="post">
			<div class="form-group">
				<label for='email'>E-mail</label>
				<input type="text" id="email" name="email" class="form-control">
			</div>
			<div class="form-group">
				<label for='password'>Senha</label>
				<input type="password" id="password" name="password" class="form-control">
			</div>
			<button type="submit" class="btn btn-primary">Entrar</button>
			{{ csrf_field() }}
		</form>
		<p>Não tem uma Conta? <a href="{{ route('user.signup') }}">Inscrevasse Agora!</a></p>
	</div>
</div>
@endsection