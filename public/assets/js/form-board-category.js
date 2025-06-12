$(document).ready(function () {
    $('#form-board').on('submit', function (e) {
      e.preventDefault();

      const nome = $('input[name="nome"]').val();
      const method = $('input[name="method"]').val();
      const id = $('input[name="id"]').val();

      $.ajax({
        url: '/api/boards/' + id,
        type: method,
        data: JSON.stringify({ name: nome }),
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

    $('.btn-board-delete').on('click', function () {
        selectedBoardId = $(this).data('id');
        const boardName = $(this).data('name');

        $('#boardName').text(boardName);
        const modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
        modal.show();
    });

    $('#btn-board-delete-confirm').on('click', function () {
        if (!selectedBoardId) return;

        $.ajax({
            url: `/api/boards/${selectedBoardId}`, // ajuste conforme a rota da sua API
            type: 'DELETE',
            headers: {
            'Authorization': 'Bearer {{ session("token") }}', // se necessário
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (response) {
            location.reload(); // recarrega a página após excluir
            },
            error: function (xhr) {
            alert('Erro ao excluir: ' + xhr.responseText);
            }
        });
    });

});
