<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index()
    {
        $datas = [
            'titlePage' => 'Beranda'
        ];

        return view('user.pages.home', $datas);
    }

    public function newcustomerclass()
    {
        $newUUID = (string) Str::orderedUuid();

        $datas = [
            'titlePage' => 'Pelanggan Baru',
            'UUID' => join(explode("-", $newUUID))
        ];

        return view('user.pages.newcustomer', $datas);
    }
}
