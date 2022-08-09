function filtro(url){
    var estado = document.getElementById("sltEstado").value;
    var municipio = document.getElementById("municipioSlt").value;
    var descAsc = $("input[name='flexRadioDefault']:checked").val();

    url += "?estado=" + estado + "&municipio=" + municipio + "&descAsc=" + descAsc;
    $.get(url, '_method=GET', function(result){
        $("#Gasolinerias-tbl").html(result.tblContent);

        var markers = [];
        for (let i = 0; i < result.gasolineras.length; i++) {
            markers.push({
                coords: {lat: convertString(result.gasolineras[i].latitude), lng: convertString(result.gasolineras[i].longitude)},
                content: "<h2>"+result.gasolineras[i].razonsocial+"</h2><p> CP: "+result.gasolineras[i].codigopostal+"</p>",
            });
            
        }
        initMap(markers);
    });
}

function convertString(numStr){
    var num;
  
    if( /^[-+]?[0-9]+\.[0-9]+$/.test( numStr ) ) {
      num = parseFloat( numStr );
    } else if( /^\d+$/.test( numStr ) ) {
      num = parseInt( numStr, 10 );
    } else {
      num = Number( numStr );
    }
    
    if( !isNaN( num ) ) {
      return num;
    } else {
      console.warn( numStr + " cannot be converted into a number" );
      return false;
    }
  }

// Initialize and add the map
function initMap(markers){
    // Se centra la vista del mapa y se establece una cercania
    var options = { zoom: 4.5, center: {lat: 24.2882, lng: -103.3992} };
    
    // Iniciamos mapa en el elmento div llamado map con su respectiva configuracion anterior
    var map = new google.maps.Map(document.getElementById("map"), options);
    
    // Recorremos todas las ubicacines de las gasolineras
    for (let i = 0; i < markers.length; i++) {
        addMarker(markers[i]);              
    }

    function addMarker(props){
        // Se coloca el marcador en la ubicacion especificada en el mapa
        var marker = new google.maps.Marker({
            position: props.coords,
            map: map,
        });

        // Checamos si tiene contenido para evitar una variable indefinida
        if(props.content){
            var infoWindow = new google.maps.InfoWindow({
                content: props.content,
            });

            marker.addListener('click', function(){
                infoWindow.open(map, marker)
            });
        }
    };
}
  
window.initMap = initMap;