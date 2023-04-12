$(document).ready(function(){
	//ambil event id
	if($('#eventid').val()==''){
		$.getJSON(base_url+'/aulakoronka/Bookevent/getEventId', function(data) {
			
			$('#eventid').val(data.kode);
		});
	} 

	//panggil datepicker
	$('#tglevent').datepicker({
		format: 'yyyy-mm-dd',
		autoclose:true
		//endDate:'0d'
	   });
});

//hapus list penjualan berdasarkan barang
function hapuslist(id){
	if(confirm('Apakah anda yakin akan menghapus data?')){
		idrow = "listbrg_"+id;
		$('#'+idrow).hide().remove();
		hitungulang();
	}
}
//simpan list penjualan berdasarkan barang
function savelist(id){
	idrow = "listbrg_"+id;
	harga = $('#hargajual_'+id).val();
	kdbrg = $('#kdbrgjual_'+id).val();
	qty = parseInt($('#qtyjual_'+id).val());
	//cek dulu nih stok ada gak?
	$.post(base_url+'/penjualan/Penjualan/getDataBarang',{'id':kdbrg},function(data){
		kdbrg = data.kdbarang;
		nmbrg = data.nmbarang;
		harga = parseInt(data.harga);
		stok = data.stok;
		if(parseInt(qty) > parseInt(stok)){
			$('#qtyjual_'+id).val(parseInt(qty));
			alert('Stok Sisa '+stok);
		}else{
			totalharga = harga * qty;
			$('#spantotaljual_'+id).html(totalharga);
			hitungulang();
		}
	},'json');
	
}

function checkedpayment(){
	//alert('x');
	var checkBox = document.getElementById("checkpayment");  
	var div = document.getElementById("divpopuppayment");  
	// If the checkbox is checked, display the output text
	if (checkBox.checked == true){
	  div.style.display = "block";
	} else {
	  div.style.display = "none";
	}
}

function addpayment(){
	var x = ('#showaddpayment').val();
	
}

function paymentlist(){
	var x = $('#eventid').val();
	$('#divpopup2').modal('show');
	//$('#divpopup').modal('show');
}

//popup event list
function carieventid(){
	$('#divpopup').modal('show');
	//var x = (id.value || id.options[id.selectedIndex].value);  //crossbrowser solution =)
}

//saat dipilih salah satu no penjualan, pindah ke functin tampil
function pilihevent(id){
	lokasi = base_url+'/aulakoronka/Bookevent/tampil/'+id;
	document.location = lokasi;
}
function backbutton(){
	lokasi = base_url+'/aulakoronka/Bookevent/'
	document.location = lokasi;
}


function myFunction() {
	var input, filter, table, tr, td, i;
	input = document.getElementById("myInput");
	filter = input.value.toUpperCase();
	table = document.getElementById("tabelpopfpb");
	tr = table.getElementsByTagName("tr");
	for (i = 0; i < tr.length; i++) {
	  td = tr[i].getElementsByTagName("td")[0];
	  if (td) {
		if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
		  tr[i].style.display = "";
		} else {
		  tr[i].style.display = "none";
		}
	  }       
	}
  }
  
  function myFunction2() {
	var input, filter, table, tr, td, i;
	input = document.getElementById("myInput2");
	filter = input.value.toUpperCase();
	table = document.getElementById("tabelpopfpb");
	tr = table.getElementsByTagName("tr");
	for (i = 0; i < tr.length; i++) {
	  td = tr[i].getElementsByTagName("td")[1];
	  if (td) {
		if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
		  tr[i].style.display = "";
		} else {
		  tr[i].style.display = "none";
		}
	  }       
	}
  }
  
  function myFunction3() {
	var input, filter, table, tr, td, i;
	input = document.getElementById("myInput3");
	filter = input.value.toUpperCase();
	table = document.getElementById("tabelpopfpb");
	tr = table.getElementsByTagName("tr");
	for (i = 0; i < tr.length; i++) {
	  td = tr[i].getElementsByTagName("td")[2];
	  if (td) {
		if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
		  tr[i].style.display = "";
		} else {
		  tr[i].style.display = "none";
		}
	  }       
	}
  }