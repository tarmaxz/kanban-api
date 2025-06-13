<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Meus Quadros de Kanban</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href={{ asset('assets/css/styles.css') }} rel="stylesheet">
</head>
<body style="background-color: #f8f9fa;">
  @yield('content')
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  <script src={{ asset('assets/js/form-board.js') }}></script>
  <script src={{ asset('assets/js/form-board-category.js') }}></script>




  <script>
    $(document).ready(function () {
        const modal = new bootstrap.Modal(document.getElementById('cardModal'));

        $('.btn-add-card').on('click', function () {
            $('#cardModalLabel').text('Novo Card');
            $('#cardForm')[0].reset();
            $('#cardId').val('');
            $('#categoryId').val($(this).data('category-id'));
            modal.show();
        });

        $('.btn-edit-card').on('click', function () {
            $('#cardModalLabel').text('Editar Card');
            $('#cardForm')[0].reset();
            $('#cardId').val($(this).data('card-id'));
            $('#cardName').val($(this).data('card-name'));
            $('#categoryId').val($(this).data('category-id'));
            $('#cardPosition').val($(this).data('position'));
            modal.show();
        });

        $('#cardForm').on('submit', function (e) {
            e.preventDefault();
            const cardId = $('#cardId').val();
            const categoryId = $('#categoryId').val();
            const name = $('#cardName').val();
            const position = $('#cardPosition').val();

            const url = cardId
                ? `/api/board-cards/${cardId}`
                : `/api/board-cards`;

            const method = cardId ? 'PUT' : 'POST';

            const data = {
                name: name,
                board_category_id: categoryId,
                position: position
            }

            $.ajax({
                url: url,
                method: method,
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

        $('.btn-delete-card').on('click', function () {
        cardIdToDelete = $(this).data('card-id');
        const modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
        modal.show();
        });

        $('#confirmDeleteBtn').on('click', function () {
        if (cardIdToDelete) {
            $.ajax({
            url: `/api/board-cards/${cardIdToDelete}`,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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


    });
    </script>


</body>
</html>
