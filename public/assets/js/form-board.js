$(document).ready(function () {
    const params = new URLSearchParams(window.location.search);
    const boardId = params.get('id');
    const token = localStorage.getItem('access_token');

    if (boardId) {
        $.ajax({
          url: `/api/boards/${boardId}`,
          type: 'GET',
          headers: {
            'Authorization': 'Bearer ' + token
          },
          success: function (data) {
            $('input[name="id"]').val(data.id);
            $('input[name="nome"]').val(data.name);
            $('input[name="position"]').val(data.position);

            $('input[name="method"]').val('PUT');
            $('.btn-primary').text('Editar');
          },
          error: function (err) {
            console.error('Erro ao buscar board', err);
            alert("Erro ao carregar dados do board.");
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
            <td>${item.position}</td>
            <td>
              <a href="/admin/boards/form?id=${item.id}" class="btn btn-sm btn-outline-primary">Editar</a>
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
      url: '/api/boards',
      type: 'GET',
      headers: {
        'Authorization': 'Bearer ' + token
      },
      success: function (data) {
        renderBoards(data);
      },
      error: function (err) {
        let errorMessage = 'Erro ao buscar boards.';

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

    $('#form-board').on('submit', function (e) {
      e.preventDefault();

      const nome = $('input[name="nome"]').val();
      const method = $('input[name="method"]').val();
      const id = $('input[name="id"]').val();
      const position = $('input[name="position"]').val();
      const token = localStorage.getItem('access_token');

      const data = {
        name: nome,
        position: position
      }

      $.ajax({
        url: '/api/boards/' + id,
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

    $('.btn-board-delete').on('click', function () {
        selectedBoardId = $(this).data('id');
        const boardName = $(this).data('name');

        $('#boardName').text(boardName);
        const modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
        modal.show();
    });

    $('#btn-board-delete-confirm').on('click', function () {
        if (!selectedBoardId) return;

        const token = localStorage.getItem('access_token');

        $.ajax({
            url: `/api/boards/${selectedBoardId}`,
            type: 'DELETE',
            headers: {
              'Authorization': `Bearer ${token}`
            },
            success: function (response) {
                location.reload();
            },
            error: function (xhr) {
                alert('Erro ao excluir: ' + xhr.responseText);
            }
        });
    });

});
