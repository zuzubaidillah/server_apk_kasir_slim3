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
    $cek = validate($data,$validasi,$custom);

    return $cek;
}

$app->post('/barang', function ($request, $response) {
    $params = $request->getParams();
    $landa = new Landa();
    $db = Db::db();
    //"SELECT * FROM barang"
    $data = $db->select('*')
        ->from('barang');
    $model = $data->findAll();

    if (!empty($model)) {
        $a = [
            "barang" => $model,
            "message" => "Berhasil",
        ];
        return successResponse($response, $a);
    } else {
        return unprocessResponse($response, ['message'=>'data barang kosong']);
    }
    return unprocessResponse($response, ['message'=>'nilai belum dikirim']);
});
