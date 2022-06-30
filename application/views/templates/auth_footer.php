 <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url('assets') ?>/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url('assets') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url('assets') ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url('assets') ?>/js/sb-admin-2.min.js"></script>

  <script>
  	$(document).ready(function () {
  		$('#button').click(function(){
  			var keyword = $('#keyword').val();
  			if (keyword !='') {
  				$.ajax({
  					url : "<?php echo base_url('auth/validasihp') ?>",
  					type	:"POST",
  					data	:{id:keyword},
  					dataType : "Json",
  					success:function(data) {
  						if(data !=null) {
  							$('#id_anggota').val(data.id);
  							$('#name').val(data.nama);
  						}else {
  							alert('No Hp tidak terdaftar');
  						}
  					}
  				});
  			} else {
  				alert('no Hp Masih Kososng');
  			}
  		});
  	});
  </script>

</body>

</html>