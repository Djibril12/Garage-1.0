$(document).ready(function(){
   var app = {
       dataUser: []
   };
    
    function init(){
        $.ajax({
           url : '/Garage-1.0/web/app_dev.php/autocompletion', // on appelle le script JSON
           dataType : 'json', // on spécifie bien que le type de données est en JSON
           data : {
               search : $('#usernameSearch').val() // on donne la chaîne de caractère tapée dans le champ de recherche
           },
           success : function(donnee){
               //alert(donnee);
               for(var i =0; i<donnee.length; i++)
               {
                   var c = [];
                   c['value'] = donnee[i].username;
                   c['label'] = donnee[i].username;
                   c['desc'] = donnee[i].username;
                   
                   app.dataUser.push(c); 
               }
             //console.log(app.dataUser);
            }
       });
    }
    
    init();
   
    $('#usernameSearch').autocomplete({
        source : app.dataUser,
        select : function(event, ui){
             
             $('#description').val(ui.item.value); // lance une alerte indiquant la valeur de la proposition
        }   
    });
});
    

