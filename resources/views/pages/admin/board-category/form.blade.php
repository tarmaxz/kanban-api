@extends('template.master')

@section('content')
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ $details?->id ? 'Editar Categoria' : 'Cadastrar Nova Categoria' }}</h4>
          </div>
          <div class="card-body">
            <form id="form-board-category">
              <input type="hidden" name="method" value="{{ $details?->id ? 'PUT' : 'POST' }}">
              <input type="hidden" name="id" value={{ $details?->id }}>
              <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" value="{{ $details?->name ?? '' }}">
              </div>
              <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <select class="form-select" name="board_id">
                  <option value="">Selecione</option>
                  @foreach($list as $item)
                    <option value="{{ $item->id }}" {{ $details?->board_id == $item->id ? 'selected' : '' }}>
                      {{ $item->name }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="position" class="form-label">Posição</label>
                <input type="number" class="form-control" name="position" value="{{ $details?->position ?? 1 }}">
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">{{ $details?->id ? 'Editar' : 'Cadastrar' }}</button>
              </div>
              <div class="mt-3">
                <a href="{{ route('admin.board-categories.index') }}" class="btn btn-secondary">← Voltar</a>
              </div>
            </form>
            <div id="mensagem" class="mt-3"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @endsection
