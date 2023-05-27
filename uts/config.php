<?php

$conn = mysqli_connect('localhost','root','','komik') or die('connection failed');

function query($sql)
{
    global $conn;
    $result=mysqli_query($conn,$sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result) ){
        $rows[] = $row;
    }
    return $rows;
}

function insertproduct($data)
{
    global $conn;
    $judul = $data['judul'];
    $harga = $data['harga'];
    $gambar = $_FILES['gambar']['name'];
    $file_tmp = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($file_tmp, "images/$gambar");    
    $stok = $data['stok'];
    $ringkas = $data['ringkas'];


   $result= mysqli_query($conn,"INSERT INTO produk (judul, harga, gambar, stok, ringkas) VALUES ('$judul','$harga','$gambar','$stok','$ringkas')");
    return $result;
    $rows = [];
    while ($row = mysqli_fetch_assoc($result) ){
        $rows[] = $row;
    }
    return $rows;
}

function updatekomik($data)
{
	global $conn;
    $id=$_GET["id"];
	$judul = $data['judul'];
    $harga = $data['harga'];
    $stok = $data['stok'];
    $ringkas = $data['ringkas'];
    $gambar = $_FILES['gambar']['name'];
    if ($gambar != "") {
		$file_tmp = $_FILES['gambar']['tmp_name'];
		move_uploaded_file($file_tmp, "images/$gambar");
		// query insert data
	    mysqli_query($conn, "UPDATE produk SET judul='$judul', harga='$harga', stok='$stok', ringkas='$ringkas', gambar='$gambar' WHERE idproduk=$id");
	} else {
        mysqli_query($conn, "UPDATE produk SET judul='$judul', harga='$harga', stok='$stok', ringkas='$ringkas' WHERE idproduk=$id");
	}
	return mysqli_affected_rows($conn);
}

function inserttotal()
{
    global $conn;
    $result = mysqli_query($conn,"call Inserttotal()");
    return $result;
    $rows = [];
    while ($row = mysqli_fetch_assoc($result) ){
        $rows[] = $row;
    }
    return $rows;
}
function insertsubharga()
{
    global $conn;
    $result = mysqli_query($conn,"call Insertsubharga()");
    return $result;
    $rows = [];
    while ($row = mysqli_fetch_assoc($result) ){
        $rows[] = $row;
    }
    return $rows;
}

function insertmember($username,$password, $email, $nama, $nohp, $alamat , $kodepos, $negara, $gender, $ttl)
{
    global $conn;
    $result = mysqli_query($conn,"call Insertmember('$username','$password','$email','$nama','$nohp','$alamat','$kodepos','$negara','$gender','$ttl')");
    return $result;
    $rows = [];
    while ($row = mysqli_fetch_assoc($result) ){
        $rows[] = $row;
    }
    return $rows;
}

function insertkeranjang($gambar,$judul, $harga, $quantity)
{
    global $conn;
    $result = mysqli_query($conn,"call insertkeranjang('$gambar','$judul','$harga','$quantity')");
    return $result;
    $rows = [];
    while ($row = mysqli_fetch_assoc($result) ){
        $rows[] = $row;
    }
    return $rows;
}

function hapus_pembeli($id)
{
	global $db;
	mysqli_query($db, "DELETE FROM pembeli where idpembeli=$id");
	return mysqli_affected_rows($db);
}



?>