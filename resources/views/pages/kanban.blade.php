@extends('template.master')

@section('content')
<div class="container-fluid py-4">
    <h2 class="text-center mb-5">Kanban</h2>
    <div class="d-flex justify-content-center mb-5 gap-2">
        <a href={{ route('admin.boards.index') }} class="btn btn-primary btn-navigation-board">Criar Board</a>
        <a href={{ route('admin.board-categories.index') }} class="btn btn-outline-secondary btn-navigation-board">Criar Categorias</a>
        <a href='#' class="btn btn-outline-secondary btn-board-logout">Sair</a>
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
                <div id="mensagem" class="mt-3"></div>
                <input type="hidden" name="card_id" id="cardId">
                <input type="hidden" name="category_id" id="categoryId">
                <input type="hidden" name="position" id="position">
                <input type="hidden" name="board_id" id="boardId">
                <div class="mb-3">
                <label for="cardName" class="form-label">Nome do Card</label>
                <input type="text" class="form-control" id="cardName" name="name" required>
                </div>
                <div class="mb-3">
                <label for="cardName" class="form-label">Posição do Card</label>
                <input type="number" class="form-control" id="cardPosition" name="position" required>
                </div>
                <div class="mb-3">
                    <a class="btn btn-primary" id="previousCard">Retroceder</a>
                    <a class="btn btn-outline-secondary" id="nextCard">Avançar</a>
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
            <div id="mensagem" class="mt-3"></div>
            Tem certeza de que deseja excluir este card?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Excluir</button>
        </div>
        </div>
    </div>
    </div>

    @section('scripts')
        <script src="{{ asset('assets/js/verify.js') }}"></script>
        <script src="{{ asset('assets/js/kanban.js') }}"></script>
        <script src="{{ asset('assets/js/logout.js') }}"></script>
    @endsection
@endsection
