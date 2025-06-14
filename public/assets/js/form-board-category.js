$(document).ready(function () {
    const params = new URLSearchParams(window.location.search);
    const boardId = params.get('id');
    const token = localStorage.getItem('access_token');

    function loadingBoardsSelect(boardSelecionado = null) {
        $.ajax({
            url: '/api/boards',
            type: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token
            },
            success: function (data) {
                const select = $('select[name="board_id"]');
                select.empty();
                select.append('<option value="">Selecione</option>');

                data.forEach(board => {
                    const selected = boardSelecionado == board.id ? 'selected' : '';
                    select.append(`<option value="${board.id}" ${selected}>${board.name}</option>`);
                });
            },
            error: function (err) {
                console.error('Erro ao carregar selects', err);
            }
        });
    }

    loadingBoardsSelect();

    if (boardId) {
        $.ajax({
          url: `/api/board-categories/${boardId}`,
          type: 'GET',
          headers: {
            'Authorization': 'Bearer ' + token
          },
          success: function (data) {
            $('input[name="id"]').val(data.id);
            $('input[name="nome"]').val(data.name);
            $('input[name="position"]').val(data.position);

            loadingBoardsSelect(data.board_id);

            $('input[name="method"]').val('PUT');
            $('.btn-primary').text('Editar');
          },
          error: function (err) {
            console.error('Erro ao buscar categorias', err);
          }
        });
    }

    function renderBoards(data) {
      const tbody = $('table tbody');
      tbody.empty();

      data.forEach(item => {
        const row = `
          <tr>
            <td>${item.id}</td>
            <td>${item.name}</td>
            <td>${item.board.name}</td>
            <td>${item.position}</td>
            <td>
              <a href="/admin/board-categories/form?id=${item.id}" class="btn btn-sm btn-outline-primary">Editar</a>
              <button
                class="btn btn-sm btn-outline-danger btn-board-delete"
                data-id="${item.id}"
                data-name="${item.name}"
              >Excluir</button>
            </td>
          </tr>
        `;
        tbody.append(row);
      });
    }

    $.ajax({
      url: '/api/board-categories',
      type: 'GET',
      headers: {
        'Authorization': 'Bearer ' + token
      },
      success: function (data) {
        renderBoards(data);
      },
      error: function (err) {
        let errorMessage = 'Erro ao buscar categorias.';

        if (err.responseJSON?.errors?.[0]) {
          errorMessage = err.responseJSON.errors[0];
          console.error(errorMessage);
        }

        $('#mensagem').html(`
          <div class="alert alert-danger" role="alert">
            ${errorMessage}
          </div>
        `);
      }
    });


    $('#form-board-category').on('submit', function (e) {
      e.preventDefault();

      const nome = $('input[name="nome"]').val();
      const method = $('input[name="method"]').val();
      const id = $('input[name="id"]').val();
      const boardId = $('select[name="board_id"]').val();
      const position = $('input[name="position"]').val();
      const token = localStorage.getItem('access_token');

      const data = {
        name: nome,
        board_id: boardId,
        position: position
      }

      $.ajax({
        url: '/api/board-categories/' + id,
        type: method,
        data: JSON.stringify(data),
        contentType: 'application/json',
        headers: {
          'Authorization': `Bearer ${token}`
        },
        success: function (response) {
          $('#mensagem').html('<div class="alert alert-success">Salvo com sucesso!</div>');
        },
        error: function (err) {
            const error = err.responseJSON?.errors?.[0];
            if (error) {
                $('#mensagem').html('<div class="alert alert-danger">'+ error +'</div>');
            } else {
                $('#mensagem').html('<div class="alert alert-danger">Erro ao salvar, por favor contate o suporte.</div>');
            }
          }
      });
    });

    $('.btn-board-category-delete').on('click', function () {
        selectedBoardId = $(this).data('id');
        const boardName = $(this).data('name');

        $('#boardName').text(boardName);
        const modal = new bootstrap.Modal(document.getElementById('confirmDeleteCategoryModal'));
        modal.show();
    });

    $('#btn-board-category-delete-confirm').on('click', function () {
        if (!selectedBoardId) return;
        const token = localStorage.getItem('access_token');

        $.ajax({
            url: `/api/board-categories/${selectedBoardId}`,
            type: 'DELETE',
            headers: {
                'Authorization': `Bearer ${token}`
            },
            success: function (response) {
                location.reload();
            },
            error: function (err) {
                alert('Erro ao excluir: ' + err.responseText);
            }
        });
    });

});
