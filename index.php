<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="styles/styles.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="public/css/materialize.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin:wght@500&family=Manrope:wght@700&display=swap" rel="stylesheet">
    <title>Ferretería</title>
</head>
<body>
    <div class="container_opciones">
        <div class="opcion">
            <a href="#" id="alberca_opcion">Alberca</a>
            <hr>
            <a href="#" id="pozo_profundo_opcion">Pozo Profundo</a>
        </div>
    </div>
    <div class="alberca">
        <div class="opciones_alberca">
            <a data-target="registrar_bomba" id="reg_bom_but" class="btn waves-effect waves-light blue lighten-2 modal-trigger"><i class="left material-icons">add</i> Nuevo producto</a>
        </div><br><hr>
        <div class="container_alberca">
            <div class="tabla_bombas">
                <!--<h5 class="nombre_tabla_alberca">Artículos para alberca</h5>-->
                <div id="div_tabla_bombas"></div>
            </div>
            <div class="consultar_bomba">
                <h5 class="consultar_bombas_alberca">Buscar productos de alberca</h5>
                <div>
                    <form method="POST" id="form_buscar_bombas">
                        <div class="row">
                            <center>
                                <div class="input-field col s6">
                                    <span style="font-size: 14px;opacity:80%;">Tipo de alberca</span>
                                    <div class="switch">
                                        <label style="font-size:14px;">
                                        Normal
                                        <input type="hidden" value= "1" name="objetivo_buscar">
                                        <input type="checkbox" value= "2" name="objetivo_buscar">
                                        <span class="lever"></span>
                                        Circular
                                        </label>
                                    </div>
                                </div>
                            </center>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="largo" name="largo" type="text" class="validate" onkeypress="return (event.charCode >= 46 && event.charCode <= 57)" min="1" required>
                                <label for="largo">Largo (mts)</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="ancho" name="ancho" type="text" class="validate" onkeypress="return (event.charCode >= 46 && event.charCode <= 57)" min="1" required>
                                <label for="ancho">Ancho (mts)</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="profundidad_minima" name="profundidad_minima" type="text" class="validate" onkeypress="return (event.charCode >= 46 && event.charCode <= 57)" min="1" onchange="promediarProfundidad();"required>
                                <label for="profundidad_minima">Profundidad Mínima (mts)</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="profundidad_maxima" name="profundidad_maxima" type="text" class="validate" onkeypress="return (event.charCode >= 46 && event.charCode <= 57)" min="1" onchange="promediarProfundidad();" required>
                                <label for="profundidad_maxima">Profundidad Máxima (mts)</label>
                            </div> 
                        </div>
                        <div class="form_footer">
                            <div class="profundidad_promedio">
                                <span id="prof_prom_style">Profundidad Promedio: </span>
                                <span id="profundidad_promedio">0</span> MTS
                            </div>
                            <div>
                                <button class="waves-effect waves-light btn waves-effect waves-light blue lighten-2" id="buscar_bombas"><i class="material-icons tooltipped" id="lupa" data-position="bottom" data-tooltip="Ver bombas adecuadas para el cliente" id="buscar_bombas">search</i></button>
                            </div> 
                        </div>
                    </form>

                    <br>
                    <!--CARDS PARA PRELOADERS-->
                    <center>
                        <div style="display:none;" id="preloader_cards">
                            <div class="preloader-wrapper big active" style="display:block;" >
                                <div class="spinner-layer spinner-blue-only">
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div><div class="gap-patch">
                                        <div class="circle"></div>
                                    </div><div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>
                            <br><br><br><br><br><br>
                            <div class="preloader-wrapper big active" style="display:block;">
                                <div class="spinner-layer spinner-blue-only">
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div><div class="gap-patch">
                                        <div class="circle"></div>
                                    </div><div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </center>
                    
                    <!--CARD DE BOMBAS RECOMENDADAS-->
                    <div class="card z-depth-2" id="bombas_recomendadas_card">
                        <div>
                            <h5 id="bombas_recomendadas">Bombas para <span id="titulo_gpm"></span> GPM</h5>
                            <div class="lista_bombas_recomendadas">
                                <span id="cero_bombas"></span>
                                <ul id="lista_bombas"></ul>
                            </div>
                        </div>
                    </div>
                    <!--CARD DE FILTROS RECOMENDADOS-->
                    <div class="card z-depth-2" id="filtros_recomendados_card">
                        <div>
                            <h5 id="filtros_recomendados">Filtros para <span id="titulo_gpm2"></span> GPM</h5>
                            <div class="lista_filtros_recomendados">
                                <span id="cero_filtros"></span>
                                <ul id="lista_filtros"></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--MODALES-->
    <form id="frmAgregarProductoAlberca" onsubmit="return registrarProductoAlberca()">
        <div id="registrar_bomba" class="modal">
            <div class="modal-content">
                <h4>Registrar producto nuevo</h4>
                <div class="row">
                    <div class="input-field col s4">
                        <input id="nombre_producto" name="nombre_producto" type="text" class="validate" required>
                        <label for="nombre_producto">Nombre del producto</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="hp_producto" name="hp_producto" type="text" class="validate" onkeypress="return (event.charCode >= 46 && event.charCode <= 57)" min="1" required>
                        <label for="hp_producto">HP</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="gpm_producto" name="gpm_producto" type="text" class="validate" onkeypress="return (event.charCode >= 46 && event.charCode <= 57)" min="1" required>
                        <label for="gpm_producto">GPM</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4">
                        <div class="switch">
                            <label style="font-size:14px;">
                            Bomba
                            <input type="hidden" value= "1" name="tipo" checked>
                            <input type="checkbox" value= "2" name="tipo">
                            <span class="lever"></span>
                            Filtro
                            </label>
                        </div>
                    </div>
                    <div class="input-field col s4">
                        <div class="switch">
                            <label style="font-size:14px;">
                            Alberca
                            <input type="hidden" value= "1" name="objetivo" checked>
                            <input type="checkbox" value= "2" name="objetivo">
                            <span class="lever"></span>
                            Pozo Profundo
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a type="button" class="modal-close btn red">Cerrar</a>
                <a class="btn blue lighten-2" onclick="return registrarProductoAlberca();" id="btn_guardar_producto">Guardar</a>
            </div>
        </div> 
    </form>

    <form id="frmEditarProductoAlberca">
        <div id="editar_bomba" class="modal">
            <div class="modal-content">
            <input type="hidden" name="idBombaEditar" id="idBombaEditar" value="">
                <h4>Editar <span id="nombre_header_editar"> </span></h4>
                <div class="row">
                    <div class="input-field col s4">
                        <input id="nombre_productou" name="nombre_productou" type="text" class="validate" placeholder= "Nombre del producto" required>
                        <label for="nombre_productou">Nombre del producto</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="hp_productou" name="hp_productou" type="text" class="validate" placeholder= "HP" onkeypress="return (event.charCode >= 46 && event.charCode <= 57)" min="1" required>
                        <label for="hp_productou">HP</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="gpm_productou" name="gpm_productou" type="text" class="validate" placeholder= "GPM" onkeypress="return (event.charCode >= 46 && event.charCode <= 57)" min="1" required>
                        <label for="gpm_productou">GPM</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4">
                        <div class="switch">
                            <label style="font-size:14px;">
                            Bomba
                            <input type="hidden" value= "1" name="tipou" id="b">
                            <input type="checkbox" value= "2" name="tipou" id="f">
                            <span class="lever"></span>
                            Filtro
                            </label>
                        </div>
                    </div>
                    <div class="input-field col s4">
                        <div class="switch">
                            <label style="font-size:14px;">
                            Alberca
                            <input type="hidden" value= "1" name="objetivou" id="a">
                            <input type="checkbox" value= "2" name="objetivou" id="p">
                            <span class="lever"></span>
                            Pozo Profundo
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a type="button" class="modal-close btn red">Cerrar</a>
                <a class="btn blue lighten-2" onclick="return editarProductoAlberca();" id="btn_editar_producto">Guardar</a>
            </div>
        </div> 
    </form>

</body>

<script src="public/jquery-3.6.0.min.js"></script>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="public/js/materialize.min.js"></script>
<script src="public/sweetalert2/sweetalert2@11.js"></script>
<script src="public/js/fancyTable.min.js"></script>

<script src="js/index.js"></script>
</html>