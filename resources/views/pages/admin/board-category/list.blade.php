@extends('template.master')

@section('content')
  <div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>Categorias Cadastradas</h2>
      <a href={{ route('admin.board-categories.form') }} class="btn btn-success">+ Nova</a>
    </div>

    <div class="card shadow-sm">
      <div class="card-body p-0">
        <div class="table-responsive">

          <table class="table table-striped mb-0">
            <thead class="table-primary">
              <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>

            @foreach($list as $item)
            <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>
                <a href={{ route('admin.board-categories.form', ['id' => $item->id]) }} class="btn btn-sm btn-outline-primary">Editar</a>
                <button
                  class="btn btn-sm btn-outline-danger btn-board-delete"
                  data-id={{ $item->id }}
                  data-name={{ $item->name }}
                >
                Excluir
                </button>
            </td>
            </tr>
            @endforeach

            </tbody>
          </table>


        </div>
      </div>
    </div>
  </div>

  <div
    class="modal fade"
    id="confirmDeleteModal"
    tabindex="-1"
    aria-labelledby="confirmDeleteModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title">Confirmar Exclusão</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
          Tem certeza que deseja excluir a categoria <strong id="boardName"></strong>?
        </div>
        <div class="modal-footer">
          <button type="button" id="btn-board-delete-confirm" class="btn btn-danger">Sim, excluir</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

  @endsection
