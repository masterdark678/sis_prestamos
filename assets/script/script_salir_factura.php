<script language="JavaScript" type="text/javascript">
function salir(){
	var respuesta = confirm("Desea Salir?")

// Caso de Aceptar
if(respuesta){
   var id=Number(document.getElementById("txt_id_factura").value);
function fncSumar(){
	  $.ajax({
		url: "/prestamos/gasto/eliminar_gasto",
		type:"POST",
		data:{id:id},
		success:function(respuesta){
		}
		});
}

}
else{

}
}
</script>