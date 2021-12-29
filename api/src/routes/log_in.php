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

$app->post('/log_in', function ($request, $response) {
    $params = $request->getParams();
    $landa = new Landa();
    $db = Db::db();

//    CEK APAKAH REQUEST USERNAME PASSWORD DI KIRIM
    if (isset($params['username']) && !empty($params['username']) && isset($params['password']) && !empty($params['password'])) {
        $username = $params['username'];
        $password = sha1($params['password']);

//        "SELECT * FROM users WHERE username='$username' AND password='$password'"
        $data = $db->select('*')
            ->from('users')
            ->where('username', '=', $username)
            ->andwhere('password', '=', $password);
        $model = $data->findAll();

//        CEK APAKAH PENCOCOKAN USERNAME PASSWORD ADA
        if (count($model)!=0) {
            $a = [
                "users" => $model,
                "message" => "Berhasil",
            ];
            return successResponse($response, $a);
        } else {
            return unprocessResponse($response, ['message'=>'username dan password salah']);
        }
    }
    return unprocessResponse($response, ['message'=>'nilai belum dikirim']);
});
