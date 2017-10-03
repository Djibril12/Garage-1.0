$(document).ready(function(){
    
    $('.more-info').click(function(e){
        //alert('chargement jQuery');
        var dataCar = $(e.target).data('car'); 
        var data = 'car='+ dataCar; // donneé à envoyer sous forme d'URL
        alert(data);
        $.ajax({
            data: data,
            dataType: 'JSON',
            method: 'POST',
            url: '/Garage-1.0/web/app_dev.php/get-car',
            success: function(data){
               
                console.log(data);

                // construction du body de la Modal
                var modal = document.createElement('div');
                var divImage = document.createElement('div');
                var image = document.createElement('img');
                    modal.className= "row";
                    divImage.className = "col-md-4";
                    image.src = '/Garage-1.0/web/img/voiture/'+data.image;
                    image.setAttribute("height", "100");
                    image.setAttribute("width", "100");


                var divTable = document.createElement('div');
                var table = document.createElement('table');
                    divTable.className = "col-md-8 table-responsive";
                    table.className = "table table-hover";

                var thead = document.createElement('thead');
                var trhead = document.createElement('tr');
                var  thHead1 = document.createElement('th');
                var  thHead2 = document.createElement('th');
                var  thHead3 = document.createElement('th');

                var nom =   document.createTextNode("Nom");
                var slug =    document.createTextNode("Slug");
                thHead1.appendChild(nom);
                thHead2.appendChild(slug);

                 trhead.appendChild(thHead1);
                 trhead.appendChild(thHead2);
                 thead.appendChild(trhead);

                var  tdBody1 = document.createElement('td');
                var  tdBody2 = document.createElement('td');
                var  tdBody3 = document.createElement('td');

                var trbody = document.createElement('tr');
                var tbody = document.createElement('tbody');

                    tdBody1.value = data.name;
                    tdBody2.value = data.name;

                    trbody.appendChild(tdBody1);
                    trbody.appendChild(tdBody2);

                    tbody.appendChild(trbody);

                    table.appendChild(thead);
                    table.appendChild(tbody);
                    divTable.appendChild(table);




                    divImage.appendChild(image);
                    modal.appendChild(divImage);
                    modal.appendChild(divTable);

                $('.modal-body').html(modal);

            },
            error: function(err){
                console.log("error"+JSON.stringify(err));
            }
        });

    });


});


    

