$(document).ready(function () {
    const token = localStorage.getItem('access_token');

    $.ajax({
      url: '/api/boards',
      type: 'GET',
      headers: {
        'Authorization': 'Bearer ' + token
      },
      success: function (data) {
        renderBoards(data);
      },
      error: function (err) {
        console.error('Erro ao buscar boards', err);
        alert("Erro ao carregar boards. Verifique o token.");
      }
    });

    function renderBoards(boards) {
      const container = $('.container-fluid');
      //container.append('<h2 class="text-center mb-5">Kanban</h2>');

      boards.forEach(board => {
        const boardSection = $(`
          <div class="board-section mb-5">
            <div class="board-title h4 mb-3">${board.name}</div>
            <div class="kanban-board d-flex gap-3"></div>
          </div>
        `);

        const boardContent = boardSection.find('.kanban-board');

        board.board_categories.forEach(category => {
          const column = $(`
            <div class="kanban-column bg-light p-3 rounded" data-category-id="${category.id}" style="min-width: 250px;">
              <div class="column-header d-flex justify-content-between align-items-center mb-2">
                <span class="fw-bold">${category.name}</span>
                <button class="btn btn-sm btn-success btn-add-card" data-category-id="${category.id}">+</button>
              </div>
              <div class="kanban-card-list"></div>
            </div>
          `);

          const cardList = column.find('.kanban-card-list');

          category.board_cards.forEach(card => {
            const cardEl = $(`
              <div class="kanban-card border p-2 mb-2 rounded d-flex justify-content-between align-items-center" data-card-id="${card.id}">
                <span>${card.name}</span>
                <div>
                  <button class="btn btn-sm btn-primary btn-edit-card"
                      data-card-id="${card.id}"
                      data-card-name="${ card.name }"
                      data-category-id="${ category.id }"
                      data-position="${ card.position }"
                      data-board-id="${ category.board_id }"
                  >
                      Editar
                  </button>

                  <button class="btn btn-sm btn-danger btn-delete-card" data-card-id="${card.id}">Excluir</button>
                </div>
              </div>
            `);
            cardList.append(cardEl);
          });

          boardContent.append(column);
        });

        container.append(boardSection);
      });
    }

    const modal = new bootstrap.Modal(document.getElementById('cardModal'));

    $(document).on('click', '.btn-add-card', function () {
        $('#cardModalLabel').text('Novo Card');
        $('#cardForm')[0].reset();
        $('#cardId').val('');
        $('#categoryId').val($(this).data('category-id'));
        modal.show();
    });

    $(document).on('click', '.btn-edit-card', function () {
        $('#cardModalLabel').text('Editar Card');
        $('#cardForm')[0].reset();
        $('#cardId').val($(this).data('card-id'));
        $('#cardName').val($(this).data('card-name'));
        $('#categoryId').val($(this).data('category-id'));
        $('#cardPosition').val($(this).data('position'));
        $('#boardId').val($(this).data('board-id'));
        modal.show();
    });

    $('#cardForm').on('submit', function (e) {
        e.preventDefault();
        const cardId = $('#cardId').val();
        const categoryId = $('#categoryId').val();
        const name = $('#cardName').val();
        const position = $('#cardPosition').val();
        const token = localStorage.getItem('access_token');

        const url = cardId
            ? `/api/board-cards/${cardId}`
            : `/api/board-cards`;

        const method = cardId ? 'PUT' : 'POST';

        const data = {
            name: name,
            board_category_id: categoryId,
            position: position,
        }

        $.ajax({
            url: url,
            method: method,
            headers: {
                'Authorization': `Bearer ${token}`
            },
            data: data,
            success: function () {
                modal.hide();
                location.reload();
            },
            error: function () {
                alert('Erro ao salvar o card.');
            }
        });
    });

    let cardIdToDelete = null;

    $(document).on('click', '.btn-delete-card', function () {
        //$('.btn-delete-card').on('click', function () {
        cardIdToDelete = $(this).data('card-id');
        const modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
        modal.show();
    });

    $(document).on('click', '#confirmDeleteBtn', function () {
    //$('#confirmDeleteBtn').on('click', function () {
    if (cardIdToDelete) {
        const token = localStorage.getItem('access_token');

        $.ajax({
        url: `/api/board-cards/${cardIdToDelete}`,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': `Bearer ${token}`
        },
        success: function () {
            $('#confirmDeleteModal').modal('hide');
            $('[data-card-id="' + cardIdToDelete + '"]').remove();
            cardIdToDelete = null;
        },
        error: function () {
            alert('Erro ao excluir o card.');
        }
        });
    }
    });

    let currentCardId = null;
    let currentCategoryId = null;
    let currentBoardId = null;


    $(document).on('click', '#nextCard', function () {
        //$('#nextCard').on('click', function() {
        currentBoardId = $('#boardId').val();
        currentCardId = $('#cardId').val();
        currentCategoryId = $('#categoryId').val();

        if (!currentCardId) return;

        const token = localStorage.getItem('access_token');
        const data = {
            card_id: currentCardId,
            board_category_id: currentCategoryId,
            board_id: currentBoardId,
            move: 'next'
        };

        $.ajax({
            url: `/api/board-cards/${currentCardId}/move`,
            method: 'PUT',
            headers: {
                'Authorization': `Bearer ${token}`
            },
            data: data,
            success: function(response) {
                preencherModal(response.card);
                location.reload();
            },
            error: function() {
                alert('Erro ao buscar próximo card.');
            }
        });
    });

    $(document).on('click', '#previousCard', function () {
        currentCardId = $('#cardId').val();
        currentCategoryId = $('#categoryId').val();
        currentBoardId = $('#boardId').val();

        if (!currentCardId) return;

        const token = localStorage.getItem('access_token');
        const data = {
            card_id: currentCardId,
            board_category_id: currentCategoryId,
            board_id: currentBoardId,
            move: 'previous'
        };

        $.ajax({
            url: `/api/board-cards/${currentCardId}/move`,
            method: 'PUT',
            headers: {
                'Authorization': `Bearer ${token}`
            },
            data: data,
            success: function(response) {
                preencherModal(response.card);
                location.reload();
            },
            error: function() {
                alert('Erro ao buscar card anterior.');
            }
        });
    });
});
