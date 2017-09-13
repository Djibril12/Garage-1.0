// confirmation de la suppression d'un utilisateur

var eltBtnSupp = document.getElementsByClassName('btn-supp');

    eltBtnSupp[0].addEventListener('click', function (e) {
        e.preventDefault();
        var confirm = window.confirm('Etes-vous sûr de bien vouloir supprimer cet utilisateur ?');

        if(confirm){

            window.location.href = eltBtnSupp[0];
        }
    });