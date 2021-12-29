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

$app->get('/site/coba', function ($request, $response) {
    return successResponse($response, ['data'=>'coba']);
});
