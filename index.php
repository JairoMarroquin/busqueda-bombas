<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="styles/styles.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="public/css/materialize.min.css">
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
    <div class="content">
        <div class="opciones_alberca">
            <div class="row">
                <form id="form_validar_contra">
                    <div class="input-field col s3">
                        <label for="clave">Contraseña</label>
                        <input id="clave" type="password" class="validate" required>
                    </div>
                    <div class="input-field col s2">
                        <button class="btn blue lighten-1"><i class="fa-solid fa-lock-open"></i></button>
                    </div>
                </form>
                <div class="input-field col s4">
                    <a data-target="registrar_bomba" id="reg_bom_but" class="btn waves-effect waves-light blue lighten-2 modal-trigger reg_bom_but"><i class="fa-light fa-plus"></i> Nuevo producto</a>
                </div><br>
            </div>
        </div>
        <div id="clave_incorr">
            <span style="color:red;">La contraseña es incorrecta!</span>
        </div><hr>
        <div class="container_alberca">
            <div class="tabla_bombas">
                <div id="div_tabla_bombas"></div>
            </div>
            <div class="consultar_bomba">
                <h5 class="consultar_bombas_alberca">Buscar productos de alberca</h5>
                <div>
                    <form method="POST" id="form_buscar_bombas">
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
                                <span class="label" id="prof_prom_style">Profundidad Promedio: </span>
                                <span id="profundidad_promedio">0</span> MTS
                            </div>
                            <div>
                                <button class="waves-effect waves-light btn waves-effect waves-light blue lighten-2 tooltipped" data-position="bottom" data-tooltip="Ver productos adecuados para el cliente" id="buscar_bombas"><i class="fa-solid fa-magnifying-glass" id="lupa"></i></button>
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
                                <div><span>Cajas de piso veneciano requeridas:</span><span id="veneciano"></span></div>
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
            <div class="consultar_pozo_profundo">
                <h5 class="consultar_bombas_pozo_profundo">Buscar productos de pozo profundo</h5>
                <div>
                    <form id="form_buscar_bombas_pp">
                        <div class="row">
                            <div class="input-field col s3">
                                <div class="input-field">
                                    <select class="browser-default" name="lps" id="lps" required>
                                        <option value="">LPS</option>
                                        <option value="0.7">0.7</option>
                                        <option value="1">1</option>
                                        <option value="1.2">1.2</option>
                                        <option value="1.5">1.5</option>
                                        <option value="2">2</option>
                                        <option value="2.5">2.5</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-field col s4">
                                <div class="switch">
                                    <label>
                                       <span>Tanque precargado</span><br>
                                        No
                                        <input type="hidden" name="tanque_precargado" value="0">
                                        <input type="checkbox" name="tanque_precargado" value="1" checked>
                                        <span class="lever"></span>
                                        Si
                                    </label>
                                </div>
                            </div>
                            <div class="input-field col s5">
                                <div class="switch">
                                    <label>
                                       <span>Switch de presión</span><br>
                                        30-50
                                        <input type="hidden" name="switch_presion" value="0">
                                        <input type="checkbox" name="switch_presion" value="1">
                                        <span class="lever"></span>
                                        20-40
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <p>
                                    <label>
                                        <input name="custom_lps" value="0" type="hidden"/>
                                        <input id="custom_lps" name="custom_lps" value="1" type="checkbox"/>
                                        <span>Otros LPS</span>
                                    </label>
                                </p>
                            </div>
                            <div class="input-field col s6">  
                                <label for="lps_custom">LPS</label>
                                <input id="lps_custom" name="lps_custom" onkeypress="return (event.charCode >= 46 && event.charCode <= 57)" type="text" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s5">
                                <ul id="ul_cargas">
                                    <span class="titulo_cargas">Cargas</span><br>
                                    <a id="agregar_carga" onclick="return agregarCarga();" class="btn blue lighten-2 tooltipped" data-position="left" data-tooltip="Agregar una carga"><i class="fa-solid fa-plus"></i></a>
                                    <a id="quitar_carga" onclick="return quitarCarga();" class="btn red tooltipped" data-position="right" data-tooltip="Quitar una carga"><i class="fa-solid fa-minus"></i></a>
                                </ul>
                            </div>
                            <div class="col s6">
                                <ul id="ul_friccion">
                                    <span class="titulo_cargas">Fricción</span><br>
                                    <a id="agregar_carga_friccion" onclick="return agregarCargaFriccion();" class="btn blue lighten-2 tooltipped" data-position="left" data-tooltip="Agregar una carga por fricción"><i class="fa-solid fa-plus"></i></a>
                                    <a id="quitar_carga_friccion" onclick="return quitarCargaFriccion();" class="btn red tooltipped" data-position="right" data-tooltip="Quitar una carga por fricción"><i class="fa-solid fa-minus"></i></a>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s5">
                                <div>
                                    <ul id="cargas">
                                        <li class="input-field">
                                            <label for="carga">C1(mts)</label>
                                            <input id="carga" name="carga[]" onkeypress="return (event.charCode >= 46 && event.charCode <= 57)" type="text" required>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col s3">
                                <div>
                                    <ul id="fricciones">
                                        <li class="input-field">
                                            <label for="friccion">F1(mts)</label>
                                            <input id="friccion" name="carga_friccion[]" onkeypress="return (event.charCode >= 46 && event.charCode <= 57)" type="text" required>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col s4">
                                <ul id="diametros">
                                    <li class="input-field">
                                        <select class="browser-default diametros" name="diametro_val[]" id="diametro_val_1" required>
                                            <option value="" disabled selected>&Oslash1</option>
                                            <option class="diam_1" value="1">(&Oslash1) 1/2"</option>
                                            <option class="diam_2" value="2">(&Oslash1) 3/4"</option>
                                            <option class="diam_3" value="3">(&Oslash1) 1"</option>
                                            <option class="diam_4" value="4">(&Oslash1) 1 1/4"</option>
                                            <option class="diam_5" value="5">(&Oslash1) 1 1/2"</option>
                                            <option class="diam_6" value="6">(&Oslash1) 2"</option>
                                        </select>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer_pp">
                            <div class="col s10">
                                <div class="label">
                                    GPM: <span id="gpm_label">0</span>
                                </div>
                            </div>
                            <div class="col s2">
                                <button class="waves-effect waves-light btn waves-effect waves-light blue lighten-2 tooltipped" data-position="bottom" data-tooltip="Ver productos adecuados para el cliente." id="buscar_bombas_pp"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div> 
                        </div>
                    </form>
                    <br>
                    <!--CARDS PARA PRELOADERS-->
                    <center>
                        <div style="display:none;" id="preloader_cards_pp">
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
                    </center>
                    
                    <!--CARD DE BOMBAS RECOMENDADAS POZO PROFUNDO-->
                    <div class="card z-depth-2" id="bombas_recomendadas_pp_card">
                        <div>
                            <h5 id="bombas_recomendadas_pp">Bombas para <span id="titulo_cdt">0</span> MTS</h5>
                            <div class="lista_bombas_recomendadas">
                                <span id="cero_bombas_pp"></span>
                                <ul id="lista_bombas_pp"></ul>
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
                            <input type="checkbox" value= "2" name="objetivo" id="objetivo">
                            <span class="lever"></span>
                            Pozo Profundo
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4">
                        <input id="lps_reg" name="lps_reg" type="text" class="validate" onkeypress="return (event.charCode >= 46 && event.charCode <= 57)" min="1" required>
                        <label for="lps_reg">LPS</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="carga_eficiente" name="carga_eficiente" type="text" class="validate" onkeypress="return (event.charCode >= 46 && event.charCode <= 57)" min="1" required>
                        <label for="carga_eficiente">Carga Eficiente</label>
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
<script src="public/js/all.min.js"></script>

<script src="js/index.js"></script>
</html>