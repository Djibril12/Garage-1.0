$(document).ready(function () {
  
    var dataUser = { 
       username: [],
       email: [],
       city: []
    };          
      
    function init() {
        $.ajax({
            url: '/Garage-1.0/web/app_dev.php/autocompletion', // on appelle le script JSON
            dataType: 'json', // on spécifie bien que le type de données est en JSON      
            success: function (donnee) {
                for (var i = 0; i < donnee.length; i++)
                {
                    
                    dataUser.username.push({
                                'value': donnee[i].username,
                                'label': donnee[i].username,
                                'desc': donnee[i].username
                            });
                    dataUser.email.push({
                                'value': donnee[i].email,
                                'label': donnee[i].email,
                                'desc': donnee[i].email
                            });
                    dataUser.city.push({
                                'value': donnee[i].city,
                                'label': donnee[i].city,
                                'desc': donnee[i].city
                            });
                    
                }
                console.log(dataUser);
            }
        });
    }

    init();

    $('#usernameSearch').autocomplete({
        source: dataUser.username,
        select: function (event, ui) {
            $('#descUsername').val(ui.item.value); // lance une alerte indiquant la valeur de la proposition
        }
    });

    $('#emailSearch').autocomplete({
        source: dataUser.email,
        select: function (event, ui) {
            $('#descEmail').val(ui.item.value); // lance une alerte indiquant la valeur de la proposition
        }
    });
    
    $('#citySearch').autocomplete({
        source: dataUser.city,
        select: function (event, ui) {
            $('#descCity').val(ui.item.value); // lance une alerte indiquant la valeur de la proposition
        }
    });
});


