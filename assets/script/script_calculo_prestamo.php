<script>
function fnccalulo_monto(){
var porcentaje = Number(document.getElementById("txt_porcentaje").value);
var monto_prestado = Number(document.getElementById("txt_monto_prestado").value);
var num_cuotas= Number(document.getElementById("txt_num_cuotas").value);
var interes = ((porcentaje*monto_prestado)/100);
var total=monto_prestado+interes;
var monto_x_cuota=total/num_cuotas;


document.getElementById("txt_interes_calculados").value =(interes);
document.getElementById("txt_total_prestamo").value =(total);
document.getElementById("txt_monto_x_cuota").value =(monto_x_cuota)

}
function fnccalulo_monto_aprobar(){
var porcentaje = Number(document.getElementById("txt_porcentaje_aprobado").value);
var monto_prestado = Number(document.getElementById("txt_monto_aprobado").value);
var num_cuotas= Number(document.getElementById("txt_num_cuotas_aprobadas").value);
var dinero_sucursal=Number(document.getElementById("txt_dinero_sucursal").value);
var interes = ((porcentaje*monto_prestado)/100);
var total=monto_prestado+interes;
var resta_dinero_sucursal=dinero_sucursal-monto_prestado;
var monto_x_cuota=total/num_cuotas;
console.log(resta_dinero_sucursal);


if (resta_dinero_sucursal<0) {
alert("Se está otorgando un Prestamo mayor al dinero que existe en Sucursal");
document.getElementById("txt_interes_calculados").value ='0';
document.getElementById("txt_total_prestamo").value ='0';
document.getElementById("txt_monto_x_cuota").value ='0';
document.getElementById('botones').style.display = 'none';
}else{
document.getElementById("txt_interes_calculados").value =(interes);
document.getElementById("txt_total_prestamo").value =(total);
document.getElementById("txt_monto_x_cuota").value =(monto_x_cuota);
document.getElementById("txt_nuevo_monto_sucursal").value =(resta_dinero_sucursal);
document.getElementById('botones').style.display = 'block';
};

}
function fnccalculo_monto_cuota(){
var monto_cuota = Number(document.getElementById("txt_monto_cuota").value);
var dinero_sucursal=Number(document.getElementById("txt_dinero_sucursal").value);
var cuotas_debe= Number(document.getElementById("txt_cuotas_debe").value);
var cuotas_amortizadas= Number(document.getElementById("txt_cuotas_amortizadas").value);
var debe_anterior = Number(document.getElementById("txt_deuda_anterior").value);
var numero_cuota_abonar = Number(document.getElementById("txt_cuota_abonar").value);
var total_abono = Number(document.getElementById("txt_total_abono").value);
var total_cuotas = (cuotas_debe-numero_cuota_abonar);
var total_debe=(monto_cuota*numero_cuota_abonar);
var nueva_deuda=(debe_anterior-total_debe);
var suma_dinero_sucursal=dinero_sucursal+total_debe;
var nuevas_cuotas_amortizadas=(cuotas_amortizadas+numero_cuota_abonar);

console.log(nueva_deuda);
if (total_cuotas<0) {
	alert("Numero de Cuotas abonadas superior a las que debe");
	}
	
		document.getElementById("txt_total_abono").value =(total_debe);
		document.getElementById("txt_nuevas_cuotas_debe").value =(total_cuotas);
		document.getElementById("txt_nueva_deuda").value =(nueva_deuda);
		document.getElementById("txt_nuevas_cuotas_amortizadas").value =(nuevas_cuotas_amortizadas);
		document.getElementById("txt_nuevo_monto_sucursal").value =(suma_dinero_sucursal);
}
function fnccalculo_monto_total_prestamo(){
var monto_cuota = Number(document.getElementById("txt_monto_cuota").value);
var dinero_sucursal=Number(document.getElementById("txt_dinero_sucursal").value);
var cuotas_debe= Number(document.getElementById("txt_cuotas_debe").value);
var cuotas_amortizadas= Number(document.getElementById("txt_cuotas_amortizadas").value);
var debe_anterior = Number(document.getElementById("txt_deuda_anterior").value);
var numero_cuota_abonar = Number(document.getElementById("txt_cuota_abonar").value);
var total_abono = Number(document.getElementById("txt_total_abono").value);
var total_cuotas = (cuotas_debe-numero_cuota_abonar);
var total_debe=(monto_cuota*numero_cuota_abonar);
var nueva_deuda=(debe_anterior-total_abono);
var suma_dinero_sucursal=dinero_sucursal+debe_anterior;
var nuevas_cuotas_amortizadas=(cuotas_amortizadas+numero_cuota_abonar);

console.log(nueva_deuda);
if (total_cuotas<0) {
	alert("Numero de Cuotas abonadas superior a las que debe");
	}else{
		if (nueva_deuda<0) {
			alert("Monto mayor a la deuda");
		}else{
		/*document.getElementById("txt_total_abono").value =(total_debe);*/
		document.getElementById("txt_nuevas_cuotas_debe").value =(total_cuotas);
		document.getElementById("txt_nueva_deuda").value =(nueva_deuda);
		document.getElementById("txt_nuevas_cuotas_amortizadas").value =(nuevas_cuotas_amortizadas);
		document.getElementById("txt_nuevo_monto_sucursal").value =(suma_dinero_sucursal);
};
}
}
function fn_aprueba_prestamo() {
	if (document.getElementById('aprueba_prestamo').style.display == 'block') {
		document.getElementById('aprueba_prestamo').style.display = 'none';
	}else{
		document.getElementById('aprueba_prestamo').style.display = 'block';
		document.getElementById("aprueba_prestamo").value ='none';
	};
}


 window.onload = fnccalulo_monto_aprobar;
</script>
