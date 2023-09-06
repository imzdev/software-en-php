<?php
if(!empty($_GET["id"])){
  $id=$_GET["id"];
  $sql=$conexion->query("DELETE FROM pedidos WHERE id=$id");
  if($sql==1){
   echo '<div class="alert alert-success">El pedido ha sido eliminado correctamente.</div>';
  }else{
    echo '<div class="alert alert-danger">Se ha producido un problema al eliminar.</div>';
  }
}
?>