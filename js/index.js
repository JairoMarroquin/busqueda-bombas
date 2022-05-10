$(document).ready(function(){
    $('#div_tabla_bombas').load("partials/tabla.php");
    $('#alberca_opcion').css("text-decoration", "underline");
    $('.consultar_pozo_profundo').hide();

    $('#reg_bom_but').hide();
    $('#del_bom_but').hide();
    $('#edi_bom_but').hide();
});

$('#form_validar_contra').on('submit', validarContra);
function validarContra(event){
    event.preventDefault()
    let clave = $('#clave').val();
    if(clave == '19931994'){
        $('#reg_bom_but').show();
        $('.del_bom_but').show();
        $('.edi_bom_but').show();
    }else{
        swal.fire('La contraseña es incorrecta', '', 'error');
    }
}

$('#reg_bom_but').on('click', function(){
    $('#registrar_bomba').modal();
});

//subrayar opciones
 $('#alberca_opcion').on("click", function(){
    $('#alberca_opcion').css("text-decoration", "underline");
    $('#pozo_profundo_opcion').css("text-decoration", "none");
    $('.consultar_bomba').show();
    $('.consultar_pozo_profundo').hide();
 });

 $('#pozo_profundo_opcion').on("click", function(){
    $('#alberca_opcion').css("text-decoration", "none");
    $('#pozo_profundo_opcion').css("text-decoration", "underline");
    $('.consultar_pozo_profundo').show();
    $('.consultar_bomba').hide();
 });


//Promedio de profundidad
function promediarProfundidad(){
    //Profundidad Promedio
    let profundidad_minima = parseFloat($('#profundidad_minima').val());
    let profundidad_maxima = parseFloat($('#profundidad_maxima').val());

    if(Number.isNaN(profundidad_minima)){
        $('#profundidad_promedio').text(profundidad_maxima.toFixed(2)); //si no se escribio valir de prof minima, se muestra la maxima
    }else if(Number.isNaN(profundidad_maxima)){
        $('#profundidad_promedio').text(profundidad_minima.toFixed(2)); //si no se escribio valir de prof maxima, se muestra la minima
    }else if(Number.isNaN(profundidad_minima) && Number.isNaN(profundidad_maxima)){
        $('#profundidad_promedio').text('0'); //si no se escribe ningun numero se muestra 0
        console.log('aaa');
    }else{
        let pProP = profundidad_minima + profundidad_maxima;
        let pPro = pProP/2;
        $('#profundidad_promedio').text(pPro.toFixed(2));
    }
}

//buscar bombas
$('#form_buscar_bombas').on('submit', buscarBombas);

function buscarBombas(){
    event.preventDefault()
    //Se esconden los componentes requeridos al pulsar el boton buscar
    $('#bombas_recomendadas_card').hide();
    $('#filtros_recomendados_card').hide();
    $('#cero_bombas').hide();
    $('#cero_filtros').hide();
    $('#lista_bombas').hide();
    $('#veneciano').hide();
    $('#lista_filtros').hide();
    $('#lista_filtros').text("");
    $('#lista_bombas').text("");
    
    let numBom = 0;
    let numFil = 0;

    let parametros={
        "largo": parseFloat($('#largo').val()),
        "ancho": parseFloat($('#ancho').val()),
        "profundidad_minima": parseFloat($('#profundidad_minima').val()),
        "profundidad_maxima": parseFloat($('#profundidad_maxima').val())
    }
    
    $.ajax({
        url: 'procesos/buscar_bombas.php',
        method: 'POST',
        data: parametros,
        beforeSend: function(){
            $('#cero_bombas').hide();
            $('#cero_filtros').hide();
            $('#preloader_cards').show();
            $('#buscar_bombas').prop('disabled', true);
        },
        error: function(jqXHR, textStatus, errorThrown){
            $('#preloader_cards').hide();
            $('#buscar_bombas').prop('disabled', false);
            if (jqXHR.status === 0) {
                console.log('Not connect: Verify Network.');
              } else if (jqXHR.status == 404) {
                console.log('Requested page not found [404]');
              } else if (jqXHR.status == 500) {
                console.log('Internal Server Error [500].');
              } else if (textStatus === 'parsererror') {
                console.log('Requested JSON parse failed.');
              } else if (textStatus === 'timeout') {
                console.log('Time out error.');
              } else if (textStatus === 'abort') {
                console.log('Ajax request aborted.');
              }
              console.log(xhr.responseText);
        },
        success: function(valor){
            $('#preloader_cards').hide();
            $('#buscar_bombas').prop('disabled', false);
            valor = jQuery.parseJSON(valor);
            //se muestra la card de bombas
            $('#bombas_recomendadas_card').show();
            //se muestra la card de filtros
            $('#filtros_recomendados_card').show();

            if(valor.status){ //verificar si trae productos o no
                let numeroProductos = valor.data.length;
                for(let i = 0; i < numeroProductos; i++){
                    $('#list_item_bomba_'+i).text("");
                    $('#list_item_filtro_'+i).text("");
                    if(valor.data[i].tipo == 1){ //cuenta las bombas que se encontraron
                        numBom = numBom + 1; 
                    }else{
                        numFil = numFil + 1;
                    }
                    if(valor.data[i].tipo == 1){ //condicion para separar filtros y bombas
                        //imprimir <li>
                        $('#lista_bombas').show();
                        $('#cero_bombas').hide();
                        $('#lista_bombas').append('<li id="list_item_bomba_'+i+'"></li>');
                        $("#list_item_bomba_"+i).text(valor.data[i].nombre+" de "+valor.data[i].hp+"HP que da "+valor.data[i].gpm+" GPM");
                    }else{
                        //imprimir <li>
                        $('#lista_filtros').show();
                        $('#cero_filtros').hide();
                        $('#lista_filtros').append('<li id="list_item_filtro_'+i+'"></li>');
                        $("#list_item_filtro_"+i).text(valor.data[i].nombre+" de "+valor.data[i].hp+"HP que da "+valor.data[i].gpm+" GPM");

                    }

                    $('#titulo_gpm').text(valor.data[0].gpm_enviado);
                    $('#titulo_gpm2').text(valor.data[0].gpm_enviado);
                    $('#veneciano').show();
                    $('#veneciano').text(valor.data[0].caja_veneciano);
                }
                if(numBom == 0){
                    $('#cero_bombas').show();
                    $('#cero_bombas').text('No se encontró ninguna bomba compatible.'); 
                }
                if(numFil == 0){
                    $('#cero_filtros').show();
                    $('#cero_filtros').text('No se encontró ningun filtro compatible.'); 
                }
                
            }else{
                $('#titulo_gpm').text(valor.gpm);
                $('#titulo_gpm2').text(valor.gpm);
                $('#cero_bombas').show();
                $('#cero_filtros').show();
                $('#cero_bombas').text(valor.msg);
                $('#cero_filtros').text(valor.msg);
                $('#veneciano').show();
                $('#veneciano').css('font-weight', 'bold');
                $('#veneciano').text(valor.cajas);
            }
        }
    });
}

//registrar productos de alberca

function registrarProductoAlberca(){
    $.ajax({
        method: "POST",
        data: $('#frmAgregarProductoAlberca').serialize(),
        url: "procesos/agregarProductoAlberca.php",
        success:function(respuesta){
            respuesta = respuesta.trim();
            console.log(respuesta);
            if(respuesta == 1){
                $('#div_tabla_bombas').load("partials/tabla.php");
                $('#frmAgregarProductoAlberca')[0].reset();
                swal.fire("¡Éxito!", "Producto agregado con éxito!", "success");
            }else{
                swal.fire("Error", ""+respuesta, "error");
            }
        }
    });
    return false;
}

//funciones de eliminar producto de la tabla

function eliminarProductoConfirmar(id, nombre){
    event.preventDefault()
    swal.fire({
        title: 'Eliminar '+nombre,
        text: "No será posible recuperar el registro",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#f44336 ',
        cancelButtonColor: '#424242  ',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Eliminar'
    }).then((result)=> {
        if(result.isConfirmed) {
            eliminarProducto(id, nombre);
        }
    })
}

function eliminarProducto(idProd){
    id={"id":idProd};
    $.ajax({
        method: "POST",
        data: id,
        url: "procesos/eliminarProducto.php",
        success: function(respuesta){
            console.log(respuesta);
            respuesta = respuesta.trim();
            if(respuesta == 1){
                $('#div_tabla_bombas').load("partials/tabla.php"); 
                swal.fire("¡Listo!", "Producto eliminado correctamente!", "success");
            }else{
                swal.fire("Error al eliminar producto", "No se pudo eliminar el producto: "+respuesta, "error");
            }
        }
    });
}

//funciones de editar productos
function obtenerDatosProductoAlberca(idProd){
    $('#editar_bomba').modal();

    $('#frmEditarProductoAlberca').val('');
    id={"id":idProd};
    $.ajax({
        method: "POST",
        data: id,
        url: "procesos/obtenerDatosEditar.php",
        error: function(){
            swal.fire("Error", 'No se pudo obtener los datos del producto', 'error');
        },
        success: function(bomba){
            bomba = jQuery.parseJSON(bomba);
            $('#idBombaEditar').val(bomba['id']);
            $('#nombre_productou').val(bomba['nombre']);
            $('#hp_productou').val(bomba['hp']);
            $('#gpm_productou').val(bomba['gpm']);
            if(bomba['tipo'] == 1){
                $('#b').prop("checked", true);
                $('#f').prop("checked", false);
            }else{
                $('#b').prop("checked", false);
                $('#f').prop("checked", true);
            }
            if(bomba['objetivo'] == 1){
                $('#a').prop("checked", true);
                $('#p').prop("checked", false);
            }else{
                $('#a').prop("checked", false);
                $('#p').prop("checked", true);
            }
            $('#nombre_header_editar').text(bomba['nombre']);
        }
    });

}

function editarProductoAlberca(){
    $.ajax({
        method: "POST",
        data: $('#frmEditarProductoAlberca').serialize(),
        url: "procesos/editar_bomba.php",
        success: function(respuesta){
            console.log(respuesta);
            respuesta = respuesta.trim();
            if(respuesta == 1){
                $('#div_tabla_bombas').load("partials/tabla.php"); 
                $("#editar_bomba").modal('close');
                swal.fire("¡Listo!", "Producto actualizado correctamente!", "success");
            }else{
                swal.fire("Error al actualizar producto", "No se pudo actualizar el producto: "+respuesta, "error");
            }
        }
    });
}

//agregar y quitar cargas y cargas por friccion
let a = 1;
function agregarCarga(){
    a++;
    let li = document.createElement('li');
    li.setAttribute('class', 'input-field');
    li.innerHTML = '<li class="input-field"> <label for="carga_'+a+'">C'+a+'</label> <input id="carga'+a+'" type="text" onkeypress="return (event.charCode >= 46 && event.charCode <= 57)"> </li>';
    document.getElementById('cargas').appendChild(li);
    
}
function quitarCarga(){
    if(a > 1){
        const li = document.getElementById('cargas');
        li.removeChild(li.lastElementChild);
        a--;
    }else{
        swal.fire('No puede haber 0 cargas', '', 'warning');
    }
}

let b = 1;
function agregarCargaFriccion(){
    b++;
    let li = document.createElement('li');
    li.setAttribute('class', 'input-field');
    li.innerHTML = '<li class="input-field"> <label for="carga_friccion_'+b+'">F'+b+'</label> <input id="carga_friccion'+b+'" type="text" onkeypress="return (event.charCode >= 46 && event.charCode <= 57)"> </li>';
    document.getElementById('fricciones').appendChild(li);
    
}
function quitarCargaFriccion(){
    if(b > 1){
        const li = document.getElementById('fricciones');
        li.removeChild(li.lastElementChild);
        b--;
    }else{
        swal.fire('No puede haber 0 cargas por fricción', '', 'warning');
    }
}

//tooltip
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.tooltipped');
    var instances = M.Tooltip.init(elems, {
        enterDelay: 200,
        transitionMovement: 10
    });
});
//dropdown
$('.dropdown-trigger').dropdown();