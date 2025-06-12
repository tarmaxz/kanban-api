@extends('template.master')

@section('content')
  <div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>Categorias Cadastradas</h2>
      <a href={{ route('admin.board-categories.form') }} class="btn btn-success">+ Nova Categoria</a>
    </div>

    <div class="card shadow-sm">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-striped mb-0">
            <thead class="table-primary">
              <tr>
                <th>#</th>
                <th>Nome da Categoria</th>
                <th>Quadro</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>To Do</td>
                <td>Projeto App</td>
                <td>
                  <a href="/categorias/1/editar" class="btn btn-sm btn-outline-primary">Editar</a>
                  <a href="/categorias/1/excluir" class="btn btn-sm btn-outline-danger">Excluir</a>
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td>Em andamento</td>
                <td>Estudos</td>
                <td>
                  <a href="/categorias/2/editar" class="btn btn-sm btn-outline-primary">Editar</a>
                  <a href="/categorias/2/excluir" class="btn btn-sm btn-outline-danger">Excluir</a>
                </td>
              </tr>
              <tr>
                <td>3</td>
                <td>Concluído</td>
                <td>Trabalho</td>
                <td>
                  <a href="/categorias/3/editar" class="btn btn-sm btn-outline-primary">Editar</a>
                  <a href="/categorias/3/excluir" class="btn btn-sm btn-outline-danger">Excluir</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  @endsection
