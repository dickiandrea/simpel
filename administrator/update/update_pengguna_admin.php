<?php
error_reporting(E_ALL);
$data = Input::get('set');
$kode = Input::get('kode_admin');

if(Input::get('tambah') == "data_admin"){
	$unik = Input::get('unik');
	//die($unik);die();

// Keterangan update : ada 3 parameter; 1. Nama table, 2. Kondisi atau syarat, 3. isi menggunakan array	
  $result = $update->update('admin', "kode_admin='$unik'", array(
    'nama_admin' => Input::get('nama'),
    'kode_akses' => Input::get('kode_akses'),
    'username' => Input::get('username'),
    'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT),
    'no_hp' => Input::get('phone'),
  	'email' => Input::get('email')
  ));

  if($result){

    ?><script language="JavaScript">alert("Update data berhasil !");
    document.location='?page=lihat_pengguna_admin'; </script><?php
  }else{
    ?><script language="JavaScript">alert("Update data gagal Bro !");
	document.location='?page=lihat_pengguna_admin'; 
    </script><?php
  }

}


if($data == "delete"){
	
	$delete->delete("admin","kode_admin='$kode'");
	?>	<script language="JavaScript">
		document.location='?page=lihat_pengguna_admin'; </script>
	<?php
	
}else{	
$kode = Input::get('kode_admin');
$data = "select * from admin where kode_admin ='$kode'";
$result = $mysqli->query($data);
while($data = $result->fetch_assoc()){
	$nama_admin = $data['nama_admin'];
	$kode_admin = $data['kode_admin'];
	$username = $data['username'];
	$email = $data['email'];
	$kodeakses = $data['kode_akses'];
	$password = $data['password'];
	$telp = $data['no_hp'];
	
?>



<div id="tambah" class="modal" style="display: block;">
<div class="row animate-zoom">
<div  style="width: 80%; margin:auto !important;">
	<div class="x_panel">
	  <div class="x_title">
		<a class="collapse-link btn btn-info">Update Pengguna</a>		
		<a href="?page=lihat_pengguna_admin"><span class="close" title="Close Modal"><i class="fa fa-close"></i></span></a> 
		<div class="clearfix"></div>
	  </div>
	  <div class="x_content" style="display:block;">

	  <form class="form-horizontal form-label-left" novalidate="" action="" method="post">
		  <span class="section">Masukan Data Anda!</span>

		  <div class="item form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama <span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <input id="nama" class="form-control col-md-7 col-xs-12" data-validate-words="1" name="nama" placeholder="Masukan nama" required="required" type="text" value="<?php echo $nama_admin;?>">
			</div>
		  </div>
		  <div class="item form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $email;?>">
			</div>
		  </div>
		  <div class="item form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="kodesp">Jenis Akses <span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<select class="selectpicker" data-live-search="true" name="kode_akses">
					<option value="">Pilih disini</option>
				<?php
					$data = "select kode_akses, jenis_akses from hak_akses";
					$result = $mysqli->query($data);
					while($hasil = $result->fetch_assoc()){
						if($kodeakses == $hasil['kode_akses']){
							echo "<option value='".$hasil['kode_akses']."' selected>".$hasil['jenis_akses']."</option>";
						}else{
							echo "<option value='".$hasil['kode_akses']."'>".$hasil['jenis_akses']."</option>";
						}
						
					}
				?>
				</select>
			</div>
		  </div>
		  <div class="item form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Telephone <span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <input type="tel" id="telephone" name="phone" required="required" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12" value="<?php echo $telp;?>">
			</div>
		  </div>
		  <div class="item form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Old Username <span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <input type="text" id="username" name="username" data-validate-length-range="6" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $username;?>">
			</div>
		  </div>
		  <div class="item form-group">
			<label for="password" class="control-label col-md-3">New Password</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <input id="password" type="password" name="password" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required">
			</div>
		  </div>
		  <div class="item form-group">
			<label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Password</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <input id="password2" type="password" name="password2" data-validate-linked="password" class="form-control col-md-7 col-xs-12" required="required">
			</div>
		  </div>
		  <div class="ln_solid"></div>
		  <div class="form-group">
			<div class="col-md-6 col-md-offset-3">
				<input class="btn btn-primary" type="hidden" name="tambah" value="data_admin">
				<input class="btn btn-primary" type="reset" value="Reset">
				<input class="btn btn-primary" type="hidden" name="unik" value="<?php echo $kode_admin;?>">
				<input type="submit" class="btn btn-default" name="ok" value="Update" >					
			</div>
		  </div>
		</form>

	  </div>
	</div>
  </div>
 </div>
</div>
<?php 
	}
}
?>