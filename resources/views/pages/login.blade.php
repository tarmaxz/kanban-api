@extends('template.master')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="login-container">
        <h2 class="text-center mb-4">Entrar</h2>
        <form>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" placeholder="seuemail@exemplo.com" required>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" placeholder="Digite sua senha" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
    </div>
</div>

@endsection
