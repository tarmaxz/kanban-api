@extends('template.master')

@section('content')
<div class="container-fluid py-4">
    <h2 class="text-center mb-5">Kanban</h2>

    @foreach($list as $board)
        <div class="board-section">
            <div class="board-title">{{ $board->name }}</div>

            <div class="kanban-board">
                @foreach($board->board_categories as $category)
                <div class="kanban-column bg-light p-3 rounded" data-category-id="{{ $category->id }}">
                    <div class="column-header d-flex justify-content-between align-items-center">
                        <span>{{ $category->name }}</span>
                        <button class="btn btn-sm btn-success btn-add-card" data-category-id="{{ $category->id }}">+</button>
                    </div>

                    <div class="kanban-card-list">
                        @foreach($category->board_cards as $card)
                        <div
                          class="kanban-card d-flex justify-content-between align-items-center"
                          data-card-id="{{ $card->id }}"
                        >
                            <span class="card-name">{{ $card->name }}</span>
                            <div>
                              <button class="btn btn-sm btn-primary btn-edit-card"
                                data-card-id="{{ $card->id }}"
                                data-card-name="{{ $card->name }}"
                                data-category-id="{{ $category->id }}"
                                data-position="{{ $card->position }}"
                              >
                                Editar
                              </button>

                              <button
                                class="btn btn-sm btn-danger btn-delete-card"
                                data-card-id="{{ $card->id }}"
                              >
                                Excluir
                              </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    @endforeach

  </div>

  <div class="modal fade" id="cardModal" tabindex="-1" aria-labelledby="cardModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="cardForm">
          <div class="modal-header">
            <h5 class="modal-title" id="cardModalLabel">Novo Card</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="card_id" id="cardId">
            <input type="hidden" name="category_id" id="categoryId">
            <input type="hidden" name="position" id="position">
            <div class="mb-3">
              <label for="cardName" class="form-label">Nome do Card</label>
              <input type="text" class="form-control" id="cardName" name="name" required>
            </div>
            <div class="mb-3">
              <label for="cardName" class="form-label">Posição do Card</label>
              <input type="number" class="form-control" id="cardPosition" name="position" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Exclusão</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
          Tem certeza de que deseja excluir este card?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Excluir</button>
        </div>
      </div>
    </div>
  </div>
@endsection
