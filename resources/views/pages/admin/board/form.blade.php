@extends('template.master')


<?php
//var_dump($details);
?>

@section('content')
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Cadastrar Novo Board</h4>
          </div>
          <div class="card-body">
            <form id="form-categoria">
              <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" value="{{ $details->name ?? '' }}" required>
              </div>

              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Cadastrar Categoria</button>
              </div>
            </form>

            <div id="mensagem" class="mt-3"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @endsection
