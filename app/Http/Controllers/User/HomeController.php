<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


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

        if (isset($_GET['am'])) {
            if ($_GET['am'] != null || $_GET['am'] != "") {
                $datas = [
                    'titlePage' => 'Pelanggan Baru',
                    'salesID' => $_GET['am'],
                    'UUID' => join(explode("-", $newUUID))
                ];
            } else {
                $datas = [
                    'titlePage' => 'Pelanggan Baru',
                    'UUID' => join(explode("-", $newUUID))
                ];
            }
        } else {
            $datas = [
                'titlePage' => 'Pelanggan Baru',
                'UUID' => join(explode("-", $newUUID))
            ];
        }

        return view('user.pages.newcustomer', $datas);
    }
}
