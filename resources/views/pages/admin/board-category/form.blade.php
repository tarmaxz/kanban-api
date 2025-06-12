@extends('template.master')

@section('content')
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Cadastrar Nova Categoria</h4>
          </div>
          <div class="card-body">
            <form id="form-categoria">
              <div class="mb-3">
                <label for="nome" class="form-label">Nome da Categoria</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
              </div>

              <div class="mb-3">
                <label for="quadro" class="form-label">Selecionar Quadro</label>
                <select class="form-select" id="quadro" name="quadro_id" required>
                  <option value="" disabled selected>Selecione um quadro</option>
                  <option value="1">Projeto App</option>
                  <option value="2">Estudos</option>
                  <option value="3">Trabalho</option>
                </select>
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
