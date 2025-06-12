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





  <script>
    /*$(document).ready(function () {
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
    });*/
  </script>


</body>
</html>
