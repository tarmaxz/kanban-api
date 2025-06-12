@extends('template.master')

@section('content')
  <div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>Boards Cadastrados</h2>
      <a href={{ route('admin.boards.form') }} class="btn btn-success">+ Nova</a>
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
                  <a href={{ route('admin.boards.form', ['id' => $item->id]) }} class="btn btn-sm btn-outline-primary">Editar</a>
                  <a href="/categorias/1/excluir" class="btn btn-sm btn-outline-danger">Excluir</a>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>


        </div>
      </div>
    </div>
  </div>

  @endsection
