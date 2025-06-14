$(document).ready(function () {
    $('#loginForm').on('submit', function (e) {
      e.preventDefault();

      const email = $('#email').val();
      const password = $('#senha').val();

      const data = {
          email: email,
          password: password
      };

      $.ajax({
        url: '/api/login',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function (response) {
          localStorage.setItem('access_token', response.access_token);
          window.location.href = '/kanban';
        },
        error: function (xhr) {
          let errorMsg = 'Erro ao fazer login.';
          if (xhr.responseJSON && xhr.responseJSON.message) {
            errorMsg = xhr.responseJSON.message;
          }
          $('#loginError').text(errorMsg).show();
        }
      });
    });
  });
