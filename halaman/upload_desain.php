<?php
include("../include/_koneksi.php");
					
//$id = $_GET["id"];
//$query = mysqli_query($conn, "SELECT * FROM transaksi WHERE kdTransaksi='$id'");
//$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Upload Desain Order</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/font-awesome.css">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<div class="container-fluid px-0">
		<?php include("_menu.php"); ?>
		<div class="konten my-5">
			<div class="rounded-top bg-white shadow p-5 mx-auto" style="width: 50%; border-bottom: 5px solid teal;">
			
				<div class="text-left mb-5"><a href="keranjang1.php" class="tombol tombol-teal mb-3"><i class="fas fa-chevron-circle-left"></i> Kembali </a></div>

				<form enctype="multipart/form-data" id="formUpload">
					<div class="row mb-3">
					<p class="text-muted text-center">
						*Upload gambar desain dan tulisan-tulisan yang akan dicantumkan ke dalam pesanan
					</p>
						<div class="col-lg-12">
							<label class="border text-center w-100" style="max-height: 300px; cursor: pointer;" id="pilihGambar">
								<div class="py-5 text-muted">
									<i class="fas fa-image fa-5x"></i>
									<i class="fas fa-plus fa-2x" style="position: absolute;"></i>
								</div>
								<input type="file" name="gambar[]" id="gambar" multiple hidden>
								<input type="text" name="idOrder" id="idOrderText" hidden>
							</label>
							<div id="preview-image"></div>
						</div>
						
					</div>
                    <div class="row text-center">
						<div class="col-lg-12">
							<div class="helper text-center my-3" style="display: inline-block;">
								<span></span>
							</div>
							<button type="submit" class="btn btn-primary btn-block" id="btnUpload"/>Upload Desain</button>
						</div>
					</div>
					</div>
				</form>
			</div>
			
		</div>
	</div>

<script src="../js/jquery-3.3.1.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/font-awesome.js"></script>
<script src="../js/misc.js"></script>

<script type="text/javascript">

	// Fungsi untuk mengambil value dari parameten URL
	$.urlParam = function(paramName) {
		var result = new RegExp('[\?&]' + paramName + '=([^&#]*)').exec(window.location.href);
		return result[1] || 0;
	}

	//Membuat variabel untuk menampung idOrder pada parameter URL
	var idOrder = $.urlParam("id");
	$("#idOrderText").val(idOrder);

	$("#pilihGambar").on("click", function() {
		$("#gambar").click();
	});

	//Fungsi untuk menampilkan gambar yang telah dipilih 
		var imagesPreview = function(input, placeToPreview) {
			if(input.files) {
				var filesAmount = input.files.length;

				for(i=0; i<filesAmount; i++) {
					var reader = new FileReader();
					reader.onload = function(e) {
						$($.parseHTML("<img class='img-thumbnail mx-3' width='250'>")).attr("src", e.target.result).appendTo(placeToPreview);
					}

					reader.readAsDataURL(input.files[i]);
				}
			}
		};

	$("#gambar").on("change", function() {
		imagesPreview(this, $('#preview-image'));
		$('#pilihGambar').attr('hidden', true);
	});


	$("#btnUpload").on("click", function() {
		$("#formUpload").submit( function(e) {
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url: "../include/uploadDesainOrder.php",
				type: "POST",
				data: formData,
				contentType: false,
				cache: false,
				processData: false,
				dataType: "JSON",
				success: function(respon) {
					if(respon.status == "Berhasil") {
						location.href = "keranjang1.php";
					} else {
						$(".helper span").css("color", "red");
						$(".helper span").html(respon.status);
					}
				}, 
				error: function(XMLHttpRequest, respon, error) {
					$(".helper span").css("color", "blue");
					$(".helper span").html(error);

				}
			});
		});
	});
	

</script>
  
</body>
</html>
