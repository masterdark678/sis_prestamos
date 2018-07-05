<script>
function fnccalculo(){
var cobrado = Number(document.getElementById("txt_cobrado").value);
var recibido = Number(document.getElementById("txt_dinero_recibido").value);
var total =cobrado-recibido;
document.getElementById("txt_dinero_total").value =(total);
}
</script>