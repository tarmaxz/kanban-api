$('.btn-board-logout').on('click', function () {
    if (!confirm('Tem certeza que deseja sair?')) {
        return;
    }

    const token = localStorage.getItem('access_token');

    $.ajax({
        url: `/api/logout`,
        method: 'POST',
        headers: {
            'Authorization': `Bearer ${token}`
        },
        success: function(response) {
            localStorage.removeItem('access_token');
            window.location.href = '/';
        },
        error: function() {
            alert('Erro ao sair.');
        }
    });
});
