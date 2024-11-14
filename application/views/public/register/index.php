<!--==============================
    Breadcumb
============================== -->
<div class="breadcumb-wrapper " data-bg-src="<?php echo base_url(); ?>assets/public/assets/img/bg/breadcumb-bg.jpg" data-overlay="theme">
	<div class="container">
		<div class="breadcumb-content">
			<h1 class="breadcumb-title">Registrasi Anggota ISNU Kab. Jombang</h1>
			<ul class="breadcumb-menu">
				<li><a href="index.html">Home</a></li>
				<li>Registrasi</li>
			</ul>
		</div>
	</div>
</div><!--==============================
Checkout Arae
==============================-->
<div class="th-checkout-wrapper space-top space-extra-bottom">
	<div class="container">
		<!-- <div class="woocommerce-form-login-toggle">
			<div class="woocommerce-info">Returning customer? <a href="#" class="showlogin">Click here to login</a>
			</div>
		</div> -->
		<form id="register" class="woocommerce-form-login mb-3">
			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<label>Nama Lengkap</label>
						<input required name="nama" type="text" class="form-control" placeholder="Masukan Nama Lengkap">
					</div>
					<div class="form-group">
						<label>Jenis Kelamin</label>
						<select required name="jk" class="form-select">
							<option value="L">Laki-Laki</option>
							<option value="P">Perempuan</option>
						</select>
					</div>
					<div class="form-group">
						<label>No KTP</label>
						<input required name="ktp" type="text" class="form-control" placeholder="No KTP">
					</div>
					<div class="form-group">
						<label>Pilih Strata Pendidikan</label>
						<select name="strata" class="form-select">
							<option value="S1">S1</option>
							<option value="S2">S2</option>
							<option value="S3">S3</option>
						</select>
					</div>
					<div class="form-group">
						<label>Bidang Pendidikan</label>
						<input required name="bidang" type="text" class="form-control" placeholder="Bidang Pendidikan">
					</div>
					<div class="col-12 form-group">
						<label>Email</label>
						<input name="email" type="text" class="form-control" placeholder="Email Address">
						<label>Nomor HP/WA</label>
						<input name="hp" type="text" class="form-control" placeholder="Phone number">
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<label>Password *</label>
						<input type="text" class="form-control" placeholder="Password">
					</div>
					<div class="col-12 form-group">
						<label>Alamat Lengkap</label>
						<!-- <input type="text" class="form-control" placeholder="Street Address"> -->
						<textarea name="alamat" id=""></textarea>
					</div>
					<div class="col-12 form-group">
						<label>Kab./Kota</label>
						<input name="kabkota" type="text" class="form-control" placeholder="Kab./Kota">
					</div>
					<div class="col-md-6 form-group">
						<label>Kecamatan</label>
						<input name="kec" type="text" class="form-control" placeholder="Kecamatan">
					</div>
					<div class="col-md-6 form-group">
						<label>Kelurahan</label>
						<input name="kel" type="text" class="form-control" placeholder="Kelurahan">
					</div>
					<div class="col-md-6 form-group">
						<label>RT/RW</label>
						<input name="rtrw" type="text" class="form-control" placeholder="RT/RW">
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="th-btn">Daftar</button>
					<!-- <p class="mt-3 mb-0"><a class="text-reset" href="#">Lost your password?</a></p> -->
				</div>
		</form>
	</div>




</div>
</div>