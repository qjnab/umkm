<?php 
session_start();
require_once 'config/db.php';
$db = new db();
if (!isset($_SESSION['name'])) {
  if ($_GET['content'] == "katalog_tamu" || $_GET['content'] == "omset" || $_GET['content'] == "tambah_data_umkm" || $_GET['content'] == "profile_umkm" ) {
  }else{
    header("Location: login.php");
  }
}
if (!isset($_GET['content'])) {
  # code...
  $_GET['content'] = "home_".$_SESSION['role'];
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Informasi Umkm</title>
  <link rel="shortcut icon" href="dist/img/box.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">  
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <style type="text/css">
    .aktif{
      color: cyan !important; 
    }
    .clickable:hover {background-color: #f5f5f5;cursor: pointer;}
    .small-box{cursor: pointer;}
    /*filter*/
    .port-gallery {
      margin:20px auto;
      color: #fff;
      }
      .port-gallery ul {
      padding: 0 10px;
      margin: 0;
      margin-bottom: 10px;
      float: left;
      display: inline-block;
      }
      .port-gallery ul li {
      display: inline-block;
      cursor: pointer;
      padding: 5px 10px
      }
      .port-gallery ul li.filtr-active {
      background-color: #f27f2b;
      cursor: default;
      color: #fff
      }.port-gallery ul.filterizr-sorting {
      float: right;
      }
      .filtr-item {
      width: 25%;
      padding: 10px;
      height: auto;
      }
      .filtr-item img {
      border-radius: 3px;
      width: 100%;
      margin-bottom: 0;
      height: 160px;
      display:block;
      }
      .filtr-item p {
      margin-bottom: 0
      }
      .filtr-item .desc {
        display: block;
        position: absolute;
        bottom: 10px;
        left: 10px;
        right: 10px;
        background-color: rgba(0, 0, 0, .7);
        transition: ease .5s;
        -moz-transition: ease .5s;
        -webkit-transition: ease .5s;
        color: #fff;
        padding: 10px;
        text-align: center;
      }
      .filtr-item .desc a {
        color: #fff;
        text-decoration: none;
        cursor: pointer
      }

      .wrapper-signature {
        position: relative;
        width: 400px;
        height: 200px;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      .signature-pad {
        position: absolute;
        left: 0;
        top: 0;
        width:400px;
        height:200px;
        background-color: white;
      }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-footer-fixed layout-navbar-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" id="search-nama" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" >
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>

    <!-- Right navbar links -->
    <?php if ($_GET['content']=="katalog_vanilla"): ?>
      
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php?content=cart" ><i class="fas fa-shopping-cart"></i></a>
      </li>
    </ul>
    <?php endif ?>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/box.png" alt="AdminLTE Logo" class="brand-image"
           style="opacity: .8">
      <span class="brand-text font-weight-light">SI UMKM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/admin.png" class="img-circle " alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['name'] ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <?php require_once 'template/sidebar.php'; ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <?php if (isset($_GET['content']) && $_GET['content']=='home'): ?>  
        <div class="row">
          <div class="col-lg-12">
            <div class="alert alert-info alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h5><i class="icon fas fa-info"></i>  Selamat datang di sistem informasi UMKM Bidang Pangan.</h5>
              <!-- Selamat datang di sistem informasi persuratan bidang pangan. -->
            </div>
          </div>
        </div>
        <?php endif ?>

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <!-- /.row (main row) -->
        <?php if (isset($_GET['content'])): ?>
          <?php require_once 'content/'.$_GET['content'].'.php'; ?>
        <?php else: ?>
          <?php require_once 'content/home_'.$_SESSION['role'].'.php'; ?>
        <?php endif ?>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- <footer class="main-footer">
    <div class="row">
      <div class="col-4" align="center">
        <a href="index.php?content=barang_masuk">
          <i style="color: gray" class="fas fa-sign-in-alt fa-2x"></i>
        </a>
      </div>
      <div class="col-4" align="center">
        <a href="index.php">
          <i style="color: gray" class="fas fa-home fa-2x"></i>
        </a>
      </div>
      <div class="col-4" align="center">
        <a href="index.php?content=barang_keluar">
          <i style="color: gray" class="fas fa-sign-out-alt fa-2x"></i>
        </a>
      </div>
    </div>
  </footer> -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<div id="editor"></div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->

<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="dist/js/pages/dashboard.js"></script> -->
<!-- AdminLTE for demo purposes -->
<!-- Select2 -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- quangga js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js" integrity="sha512-bCsBoYoW6zE0aja5xcIyoCDPfT27+cGr7AOCqelttLVRGay6EKGQbR6wm6SUcUGOMGXJpj+jrIpMS6i80+kZPw==" crossorigin="anonymous"></script>
<!-- filterizr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/filterizr/1.3.5/jquery.filterizr.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/filterizr/2.2.4/filterizr.min.js" integrity="sha512-1stq1YFxvbYbVjV9Hu964pds36UyBIQ3H8EFMAaaRXeqKsqqJlGucxH6ZG9tjk0DdzhS52nPpwDaoZYaUzaISw==" crossorigin="anonymous"></script> -->


<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>


<script type="text/javascript">
  //fungsi gallery 
function rupiah(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
<?php if ($_GET['content'] == "katalog_vanilla"): ?>
// $(document).ready(function() {

//     $(".filterizr-filter li").click(function() {
//     $(".filterizr-filter li").removeClass("filtr-active");
//     $(this).addClass("filtr-active");
//     });
//     $(".filterizr-sorting li").click(function() {
//     $(".filterizr-sorting li").removeClass("filtr-active");
//     $(this).addClass("filtr-active");
//     });
//     var filterizd = $(".filtr-container").filterizr();

//     filterizd.filterizr("sort", "title", "asc");

// });
<?php endif ?>
	//funsi quangga

<?php if ($_GET['content'] == "kasir" || $_GET['content'] == "input_transaksi" ): ?>
	$( document ).ready(function(){

	});

  $("#bt-scan").on("click",function(){
      Quagga.init({
        inputStream : {
          name : "Live",
          type : "LiveStream",
          locator: {
            patchSize: 'medium',
            halfSample: true
          },
          target: document.querySelector('#quangga-img')    // Or '#yourElement' (optional)
         
        },
        decoder : {
          readers : ["code_128_reader"]
        }
      }, function(err) {
          if (err) {
              console.log(err);
              return
          }
          console.log("Initialization finished. Ready to start");
          Quagga.start();
            Quagga.onDetected((res) => {
              $('#modal-scanner').modal('hide');
              // alert(res.codeResult.code);
              $('#id_produk').val(res.codeResult.code); // Select the option with a value of '1'
              $('#id_produk').trigger('change'); // Notify any JS components that the value changed
              Quagga.stop();
            });
          Quagga.onProcessed();
          // alert("started");

      });
  });
  // $('#modal-scanner').on('shown.bs.modal', function () {
    
 

  // });

  // $('#modal-scanner').on('hidden.bs.modal', function () {
  //   Quagga.stop();
  // });
<?php endif ?>
  $(function() {
    $('.select2').select2();
    $('.datepicker').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      minYear: 2018,
      locale: {
            format: 'YYYY-MM-DD'
        }
    }, function(start, end, label) {
    });
    $('.datepicker-month').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      minYear: 2018,
      changeMonth: true,
      changeYear: true,
      changeDate: false,
      showButtonPanel: true,
      locale: {
            format: 'YYYY-MM'
        }
    }, function(start, end, label) {
    });
    $('.donth').datepicker( {
      
      dateFormat: 'MM-yy',
      onClose: function(dateText, inst) { 
          $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
      }
    });
  });
  
  <?php if (isset($_GET['pesan'])): ?>
    $(document).Toasts('create', {
      class: 'bg-warning', 
      title: 'PERINGATAN',
      subtitle: '',
      body: '<?php echo $_GET['pesan'] ?>'
    })
  <?php endif ?>
    $('.select2').select2({

        theme: 'bootstrap4'
      }
      );
    $("#example1").DataTable();
    $(".data-table").DataTable({
      "scrollX": true
    });

    $(".data-table-responsive").DataTable({
      responsive : true,
      "scrollX": true,
      "pageLength": 50
    });

    $('.data-table-print-able').DataTable(
      {
              
        dom: 'Bfrtip',
        buttons: [
                {
                    extend: 'print',
                    exportOptions: {
                        stripHtml : false,
                        columns: [0, 1, 2, 3, 4] 
                        //specify which column you want to print
 
                    }
                }
 
            ]
    }
    );

    $(".row-gambar").on("click",function(){
      $("#gambar-produk").attr("src","php/images/produk/"+this.id);
    });

    $("#id_produk").on("change",function(){
      // alert("php/api.php?get_barang&id="+$("#produk").val());
      // alert("ok");
        // alert("php/api.php?get_barang&id="+$("#id_produk").val());
      $.getJSON( "php/api.php?get_barang&id="+$("#id_produk").val(), function( data ) {
        console.log(data[0]);
        // alert(data);
        var diskon = data[0].jumlah_diskon;
        var harga = data[0].harga_produk;
        if (diskon == null ) {
          diskon=0;
        }else{
          harga = harga - ((harga * diskon)/100);
        }

        $("#nama_produk").val(data[0].nama_produk);
        $("#harga_produk").val(Math.round(harga));
        $("#diskon_produk").val(diskon);
        
        //lama
        // $("#jumlah_produk").attr({
        //    "max" : data[0].jumlah_stok,        // substitute your own
        // });

        //baru
        $("#jumlah_produk").attr({
           "max" : data[0].total_stok,        // substitute your own
        });
      });
    });


    $("#tambah-nota").on("click",function(){
        if ($("#nama_produk").val()=="" || $("#harga_produk").val()=="" || $("#jumlah_produk").val() =="0" || $("#jumlah_produk").val() == "" ||$("#jumlah_produk").val() ==0  ) {}else{
          tmp_total = $("#harga_produk").val() * $("#jumlah_produk").val();
          t.row.add( [
              row,
              $("#nama_produk").val(),
              $("#harga_produk").val(),
              $("#diskon_produk").val(),
              $("#jumlah_produk").val(),
              tmp_total
          ] ).draw( false );
          data[row] = {id_produk:$("#id_produk").val(), jumlah_produk:$("#jumlah_produk").val(), harga_produk:$("#harga_produk").val(),harga_total:tmp_total,diskon_purchase:$("#diskon_produk").val()}
          row++;
          total_nota += tmp_total;
          // alert(total_nota);
          // alert($("#bayar").html());
          // console.log($("#bayar span").text());
          $("#total").text(rupiah(total_nota)); 
          inisiasi_barang();
        }
        
    });
    $("#cancel-nota").on("click",function(){
      t.clear().draw();
      inisiasi_nota();
    });
    var data = [];
    inisiasi_nota();
    function inisiasi_nota(){
      row = 1;
      data = [];
      total_nota = 0;
      $("#total").text(total_nota); 
      $("#id_voucher").prop('selectedIndex',0); 
      $("#diskon_transaksi").val(0); 

    }
    function  inisiasi_barang(){
      $("#nama_produk").val("");
      $("#harga_produk").val("");
      $("#jumlah_produk").val("0");

      $("#diskon_produk").val("0");
      $("#id_produk").prop('selectedIndex',0);
    }  
    t = $('.datatable-nosort').DataTable({
       "bSort" : false,
    });
    $("#diskon_transaksi").on("keyup",function(){
       var diskontransaksi = $("#diskon_transaksi").val();
       var afterdiskon = (total_nota * diskontransaksi) / 100;
       afterdiskon = total_nota - afterdiskon;
       $("#total").text(rupiah(afterdiskon)); 
    });
    $("#bayar-nota").on("click",function(){
      if (total_nota!=0 && !$("#cash").val() == "" ) {
        tostring = JSON.stringify(data) ;
        // alert($("#cash").val());
        <?php if ($_GET['content'] == "kasir"): ?>
        window.location.href = "php/transaksi.php?dataproduk="+tostring+"&pembayaran="+$("#cash").val()+"&id_voucher="+$("#id_voucher").val()+"&diskon_transaksi="+$("#diskon_transaksi").val();
        <?php else: ?>
        window.location.href = "php/transaksi.php?dataproduk="+tostring+"&pembayaran="+$("#cash").val()+"&id_voucher="+$("#id_voucher").val()+"&diskon_transaksi="+$("#diskon_transaksi").val()+"&tanggal_transaksi="+$("#tanggal_transaksi").val(); 
        <?php endif ?>
      }else{
        alert("Mohon isikan jumlah pembayaran");
      }
    });
    n = $('.datatable-nota').DataTable({
        "bSort" : false,
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false,
        "bFilter": false
    });
    $(".modal-cetak-nota").on("click",function(){
      // console.log($(this).attr('id'));
      n.clear().draw();
      $("#id-nota").text($(this).attr('id'));
      // console.log("php/api.php?transaksi&id="+$(this).attr('id'));
      $.getJSON("php/api.php?transaksi&id="+$(this).attr('id'),function(data){
        // console.log(data.tanggal_transaksi);  
        $("#no-nota").text(data.id_transaksi);
        $("#tanggal-nota").text(data.tanggal_transaksi);
        $("#total-nota").text(data.harga_total_transaksi);

      });
      $.getJSON( "php/api.php?purchase&id="+$(this).attr('id'), function( data ) {
        // console.log(data);
        $.each(data, function(index, value) {
            n.row.add( [
              value.nama_produk,
              value.harga_satuan_barang_purchase,
              value.jumlah_barang_purchase,
              value.harga_total_purchase
          ] ).draw( false );
        });
      });
    });
    var doc = new jsPDF();
    var specialElementHandlers = {
        '#editor': function (element, renderer) {
            return true;
        }
    };

    // $('#print-nota').click(function () {
    //     doc.fromHTML($('#printable-nota').html(), 15, 15, {
    //         'width': 170,
    //             'elementHandlers': specialElementHandlers
    //     });
    //     doc.save('nota.pdf');
    // });
    $('#print-nota').click(function () {
      window.location.href= "php/export/print_nota.php?id="+$("#id-nota").text();

    });

    // $("#kirim-stok").on("click",function(){

    // });
    $("#btn-plus").on("click",function(){
      $("#tipe").attr({
           "name" :"plus"        // substitute your own
        });
      $("#nama").text("Tambah ");
    });
    $("#btn-min").on("click",function(){
      $("#tipe").attr({
           "name" :"min"        // substitute your own
        });
      $("#nama").text("Ambil ");

    });
    $("#nama_produk_stok").on("change",function(){
      $("#stok").val("");
      $.getJSON( "php/api.php?get_stok&id="+$("#nama_produk_stok").val(), function( data ) {
        // console.log(data);
        $("#id_produk_stok").val($("#nama_produk_stok").val());
        if (data != null) {
          $("#stok").val(data.jumlah_stok);
        }
      });
    });


    $("#btn-cetak-laporan").on("click",function (){
      if (($("#tanggal-mulai").val() !="") &&($("#tanggal-selesai").val()!="")) {

        window.location.href= "php/export/laporan_penjualan.php?mulai="+$("#tanggal-mulai").val()+"&selesai="+$("#tanggal-selesai").val();
      }else{
        alert("Pilih Tanggal !!!");
      }
      // alert($("#tanggal-mulai").val()+" "+$("#tanggal-selesai").val())
    });
    $("#trigger-produk").on("change",function(){
      // alert("ok");
      calculate();
    });
    $("#harga-diskon").on("keyup",function(){
      // alert("ok");
      $.getJSON( "php/api.php?get_barang&id="+$("#trigger-produk").val(), function( data ) {
        // console.log(data[0].nama_produk);
        // alert(data);
        var dsc = data[0].harga_produk - $("#harga-diskon").val() ;
        dsc = (dsc / data[0].harga_produk) * 100;
        // var res = "";
        // res= String(data[0].harga_produk) + " -\> " +dsc;
        $("#trigger-diskon").val(dsc.toFixed(2));
      });
    });
    $("#trigger-diskon").on("keyup",function(){
      // alert("ok");
      calculate();
    });
    function calculate(){
      $.getJSON( "php/api.php?get_barang&id="+$("#trigger-produk").val(), function( data ) {
        // console.log(data[0].nama_produk);
        // alert(data);
        var dsc = data[0].harga_produk - ((data[0].harga_produk * $("#trigger-diskon").val() )/100);
        // var res = "";
        // res= String(data[0].harga_produk) + " -\> " +dsc;
        $("#harga-diskon").val(dsc);
      });
    }

    $(".min").on("click",function(){
      var id = $(this).val();
      var jumlah = $("#jmlh-"+$(this).val()).val();
      if (jumlah > 0) {
        jumlah -= 1;
      }
      $("#jmlh-"+$(this).val()).val(jumlah);
    });

    $(".plus").on("click",function(){
      var id = $(this).val();
      var jumlah = $("#jmlh-"+$(this).val()).val();
      // if (jumlah > 0) {
        jumlah = parseInt(jumlah) + 1;
      // }
      $("#jmlh-"+$(this).val()).val(jumlah);
    });

    $(".trigger-cart").on("click",function(){
      // alert($(this).val());
      if ($("#jmlh-"+$(this).val()).val() > 0) {
        var diskon = $("#dsc-"+$(this).val()).val().replace(" %","");
        var harga = $("#hrg-"+$(this).val()).val().replace(",","");
        var jumlah = $("#jmlh-"+$(this).val()).val();
        var total = parseInt(harga) * parseInt(jumlah);
        // alert("php/api.php?add_cart=&id="+$(this).val()+"&jumlah="+jumlah+"&harga_satuan="+harga+"&harga_total="+total+"&diskon="+diskon);
        $.getJSON( "php/api.php?add_cart=&id="+$(this).val()+"&jumlah="+jumlah+"&harga_satuan="+harga+"&harga_total="+total+"&diskon="+diskon, function( data ) {
          // console.log(data);
        });  
          alert("Berhasil Ditambahkan ke Keranjang");
      }
      
    });

    $("#checkout-nota").on("click",function(){
      if ($("#cash").val() != "" ) {
        window.location.href = "php/transaksi.php?checkout=&pembayaran="+$("#cash").val();
      }
    });
    $("#batal-nota").on("click",function(){
      $.getJSON( "php/api.php?clear-nota=", function( data ) {
        console.log(data);
      });
      window.location.href = "index.php?content=katalog_vanilla&pesan=Keranjang Telah Dikosongkan";
    });

    $("#search-nama").on("keyup",function(){
      // alert($("#search-nama").val());
      if ($("#search-nama").val() != "") {
        var key = $("#search-nama").val().toLowerCase();
        $(".nama_produk").each(function(){
          var text_id = $(this).attr('id');
          // console.log(text_id);
          var text = text_id.replace("nama-",""); 
          var value = $(this).html().toLowerCase();

          if (value.includes(key)) {
            $("#card-"+text).show();
          }else{
            $("#card-"+text).hide();
          }
        });

      }else{
        $(".nama_produk").each(function(){
          var text = $(this).attr('id').replace("nama-",""); 
          $("#card-"+text).show();
        });
      }
    });


    // 

    <?php if ($_GET['content'] == "profile_umkm"): ?>
      var canvas = document.getElementById('signature-pad');

      // Adjust canvas coordinate space taking into account pixel ratio,
      // to make it look crisp on mobile devices.
      // This also causes canvas to be cleared.
      function resizeCanvas() {
          // When zoomed out to less than 100%, for some very strange reason,
          // some browsers report devicePixelRatio as less than 1
          // and only part of the canvas is cleared then.
          var ratio =  Math.max(window.devicePixelRatio || 1, 1);
          canvas.width = canvas.offsetWidth * ratio;
          canvas.height = canvas.offsetHeight * ratio;
          canvas.getContext("2d").scale(ratio, ratio);
      }

      window.onresize = resizeCanvas;
      // resizeCanvas();

      var signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
      });

      $("#bt-ttd").on('click', function () {
        if (signaturePad.isEmpty()) {
          alert("Please provide a signature first.");
          return false;
        }else{
          // alert($("#signature-data").val());
          var data = signaturePad.toDataURL('image/png');
          var input = document.getElementById('signature-data');
          input.value = data; 
          console.log(input.value);
          $( "#my-form" ).submit();
        }
        
        
        return true;
      });

      document.getElementById('clear').addEventListener('click', function () {
        signaturePad.clear();
      });
    <?php endif ?>

    $("#kecamatan_umkm").on("change",function(){
      window.location.href = "index.php?content=list_umkm&kecamatan_umkm="+$("#kecamatan_umkm").val();
    });
    $("#bt-sign").on("click",function(){
        // document.body.scrollTop = 0; // For Safari
        // document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    });
</script>
</body>
</html>