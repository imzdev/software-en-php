<?php
if (!empty($_POST["btnregistrar"])){
    if((!empty($_POST["dia_creacion"])) and (!empty($_POST["kg_hallulla"]))  and (!empty($_POST["kg_marraqueta"]))){
        
        $id_clientes = $_POST['id_clientes'];
        $dia_creacion=$_POST["dia_creacion"];
        $kg_hallulla=$_POST["kg_hallulla"];
        $kg_marraqueta=$_POST["kg_marraqueta"];

        $sql=$conexion->query("INSERT INTO pedidos (id_clientes,dia_creacion,kg_hallulla,kg_marraqueta)VALUES('$id_clientes','$dia_creacion','$kg_hallulla','$kg_marraqueta')");

        if($sql==1){
            echo '<div class="alert alert-success">Pedido a sido Registrado.</div>';
        }else {
            echo '<div class="alert alert-danger">Error al registrar el Pedido.</div>';
        }
        
    }else{
       
        echo '<div class="alert alert-warning">Tiene Campos Vacios.</div>'; 
    }
    
}
?>