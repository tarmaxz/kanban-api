$(document).ready(function () {
    $('#form-board-category').on('submit', function (e) {
      e.preventDefault();

      const nome = $('input[name="nome"]').val();
      const method = $('input[name="method"]').val();
      const id = $('input[name="id"]').val();
      const boardId = $('select[name="board_id"]').val();
      const position = $('input[name="position"]').val();

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
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function (response) {
          $('#mensagem').html('<div class="alert alert-success">Salvo com sucesso!</div>');
        },
        error: function (xhr) {
          const error = xhr?.responseJSON?.message;
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

        $.ajax({
            url: `/api/board-categories/${selectedBoardId}`,
            type: 'DELETE',
            headers: {
            'Authorization': 'Bearer {{ session("token") }}',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
