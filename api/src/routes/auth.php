<?php

use Model\ApprovalLine;
use Model\Formula;
use Model\HakAkses;
use Service\Db;
use Service\Landa;

function Validasi($data, $custom = array())
{
    $validasi = array(
        'name' => 'required',
        'email' => 'required',
        'password' => 'required'
    );
    $cek = validate($data, $validasi, $custom);

    return $cek;
}

// Ambil set sessions
$app->post('/auth/transaksi_db', function ($request, $response) {
    $params = $request->getParams();
    $landa = new Landa();
    $db = Db::db();
//        "SELECT transaksi.id, users.nama as nama_kasir, barang.nama AS nama_barang, transaksi.jenis_pembayaran FROM `transaksi` INNER join barang on transaksi.barang_id=barang.id INNER JOIN users ON transaksi.users_id=users.id;"
    $data = $db->select('transaksi.id, users.nama as nama_kasir, barang.nama AS nama_barang, transaksi.jenis_pembayaran')
        ->from('transaksi')
        ->innerJoin('barang', 'transaksi.barang_id=barang.id')
        ->innerJoin('users', 'transaksi.users_id=users.id');
    $model = $data->findAll();
    if (!empty($model)) {
        $a = [
            "transaksi" => $model,
            "message" => "Berhasil",
        ];
        return successResponse($response, $a);
    } else {
        return unprocessResponse($response, ['username dan password salah']);
    }
    return unprocessResponse($response, ['nilai belum dikirim']);
})->setName('transaksi_db');

// Ambil set sessions
$app->post('/auth/transaksi_db/{id}', function ($request, $response) {
    $params = $request->getParams();
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');
    $landa = new Landa();
    $db = Db::db();
    // "SELECT transaksi.id, users.nama as nama_kasir, barang.nama AS nama_barang, transaksi.jenis_pembayaran FROM `transaksi` INNER join barang on transaksi.barang_id=barang.id INNER JOIN users ON transaksi.users_id=users.id  WHERE transaksi.id=200;"
    $data = $db->select('transaksi.id, users.nama as nama_kasir, barang.nama AS nama_barang, transaksi.jenis_pembayaran')
        ->from('transaksi')
        ->innerJoin('barang', 'transaksi.barang_id=barang.id')
        ->innerJoin('users', 'transaksi.users_id=users.id')
        ->where('transaksi.id',"=",$id);
    $model = $data->findAll();
    if (!empty($model)) {
        $a = [
            "transaksi_detail" => $model,
            "message" => "Berhasil",
        ];
        return successResponse($response, $a);
    } else {
        return unprocessResponse($response, ['id tidak ditemukan']);
    }
    return unprocessResponse($response, ['nilai belum dikirim']);
})->setName('transaksi_db');
