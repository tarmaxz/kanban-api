$(document).ready(function () {
    const token = localStorage.getItem('access_token');

    $.ajax({
      url: '/api/verify',
      type: 'GET',
      headers: {
        'Authorization': 'Bearer ' + token
      },
      success: function (data) {
        const typeId = data?.user?.type_id;
        if (typeId === 1) {
          $('.btn-navigation-board').remove();
        }
      },
      error: function (err) {
        console.error('sem acesso', err);
        window.location.href = '/';
      }
    });
});
