<?php
    session_start();
    require "../config/conexion.php";
    $con = new Conexion();
    $conexion = $con->conectar();

    $sql = "SELECT * FROM bombas_alberca";
    $respuesta = mysqli_query($conexion,$sql);
?>

<table class="responsive-table highlight" id="tabla_bombas">
    <thead>
        <tr>
            <th id="nombre_header">Nombre</th>
            <th id="gpm_header">GPM</th>
            <th id="lps_header">LPS</th>
            <th id="cdt_header">CDT</th>
            <th id="opciones">Opciones</th>
        </tr>
    </thead>
    <?php
        while($mostrar = mysqli_fetch_array($respuesta)){
            if($mostrar['eliminado'] == 0){
                if($mostrar['lps'] == NULL){
                    $lps = '- -';
                }else{
                    $lps = $mostrar['lps'];
                }
                if($mostrar['carga_eficiente'] == NULL){
                    $cdt = '- -';
                }else{
                    $cdt = $mostrar['carga_eficiente'];
                }
                if($mostrar['objetivo'] == 1){
                    $objetivo = 'alberca';
                }else{
                    $objetivo = 'pozo profundo';
                }
    ?>
        <tr>
            <td><?php echo $mostrar['nombre'];?> de <?php echo $mostrar['hp'];?> HP para <?php echo $objetivo;?></td>
            <td id="gpm_body"><?php echo $mostrar['gpm'];?></td>
            <td id="tabla_lps"><?php echo $lps; ?></td>
            <td id="tabla_cdt"><?php echo $cdt; ?></td>
            <td id="opc_tabla">
                <a data-target="editar_bomba" id="edi_bom_but" class="modal-trigger btn teal accent-3 edi_bom_but" onclick="return obtenerDatosProductoAlberca(<?php echo $mostrar['id_bomba'] ?>);"><i class="fa-regular fa-pen-to-square"></i></a>
                <a class="btn red del_bom_but" id="del_bom_but" onclick="return eliminarProductoConfirmar(<?php echo $mostrar['id_bomba'] ?> , '<?php echo $mostrar['nombre']; ?>');"><i class="fa-regular fa-trash-can"></i></a>
            </td>
        </tr>
    <?php
            }
        }
    ?>
</table>

<script>
    $(document).ready(function(){
        $('#tabla_bombas').DataTable({
            "language": {
            "lengthMenu": " ",
            "zeroRecords": "No existen registros.",
            "info": "Mostrando p??gina _PAGE_ de _PAGES_",
            "infoEmpty": "No existen registros.",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search": "Buscar coincidencias",
            "processing": "Procesando...",
            "paginate": {
                "first": "Primero",
                "last": "??ltimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
            }
        });
        $("#tabla_bombas").fancyTable({
            inputPlaceholder:"Buscar"
        });
        /*$('.del_bom_but').hide();
        $('.edi_bom_but').hide();*/
    });
    
</script>