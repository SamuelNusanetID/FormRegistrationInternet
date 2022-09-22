<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Approval;
use App\Models\Billing;
use App\Models\Customer;
use App\Models\SalesLink;
use App\Models\Service;
use App\Models\ServicesList;
use App\Models\PromoList;
use App\Models\Technical;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class NewCustomerController extends Controller
{
    public function indexPersonal()
    {
        $fetchDataService = ServicesList::all();
        $arrdataLayanan = [];
        foreach ($fetchDataService as $key => $value) {
            array_push($arrdataLayanan, $value->package_name);
        }

        $dataLayanan = [];
        foreach (array_count_values($arrdataLayanan) as $key => $value) {
            array_push($dataLayanan, $key);
        }

        $datas = [
            'titlePage' => 'Form Registrasi Layanan Baru',
            'packageName' => $dataLayanan,
            'serviceData' => ServicesList::all(),
            'promoData' => PromoList::all()
        ];

        if (isset($_POST['salesID'])) {
            $salesID = $_POST['salesID'];

            $response = Http::withHeaders([
                'X-Api-Key'=>'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc'
            ])->get('https://legacy.is5.nusa.net.id/employees/'.$salesID);

            if ($response->successful()) {
                $result = $response->json();
                $datas['salesID'] = $result['id'];
                $datas['salesName'] = $result['name'];
            }
        }

        return view('user.pages.newcustomer.personal', $datas);
    }

    public function storePersonal(Request $request)
    {
        dd($request->all());
        DB::transaction(function () {
            $requestAPI = Request();

            $uuid = $requestAPI->get('uuid');
            $idPelanggan = 'NUSA' . date('YmdHis');

            $savedDataCustomer = [
                'id' => $uuid,
                'customer_id' => $idPelanggan,
                'name' => $requestAPI->get('fullname_personal'),
                'address' => json_encode([$requestAPI->get('address_personal')]),
                'geolocation' => $requestAPI->get('geolocation_personal'),
                'class' => 'Personal',
                'email' => $requestAPI->get('email_address_personal'),
                'phone_number' => $requestAPI->get('phone_number_personal'),
                'identity_number' => $requestAPI->get('id_number_personal'),
                'reference_id' => $requestAPI->get('salesID') != null ? $requestAPI->get('salesID') : null,
                'survey_id' => $requestAPI->get('survey_id'),
                'extend_note' => $requestAPI->get('addonsnote'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            DB::table('customers')->insert($savedDataCustomer);

            $savedDataBilling = [
                'id' => $uuid,
                'billing_name' => $requestAPI->get('fullname_biller'),
                'billing_contact' => $requestAPI->get('phone_number_biller'),
                'billing_email' => json_encode([$requestAPI->get('email_address_biller_primary'), $requestAPI->get('email_address_biller_one'), $requestAPI->get('email_address_biller_two')]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            DB::table('billings')->insert($savedDataBilling);

            $savedDataTechnical = [
                'id' => $uuid,
                'technical_name' => $requestAPI->get('fullname_technical'),
                'technical_contact' => $requestAPI->get('phone_number_technical'),
                'technical_email' => $requestAPI->get('email_address_technical'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            DB::table('technicals')->insert($savedDataTechnical);

            $fileIdentityPhoto = $requestAPI->file('service_identity_photo');
            $tujuan_upload1 = public_path().'/bin/img/Personal/Identity';
            $fileIdentityPhoto->move($tujuan_upload1, $fileIdentityPhoto->getClientOriginalName());
            $urlSaved1 = url('/bin/img/Personal/Identity/'. $fileIdentityPhoto->getClientOriginalName());

            $savedDataService = [
                'id' => $uuid,
                'service_package' => json_encode([
                    [
                        'service_name' => $requestAPI->get('serviceName'),
                        'service_price' => $requestAPI->get('servicePrice'),
                        'termofpaymentDeals' => $requestAPI->get('termofpaymentDeals')
                    ],
                ]),
                'id_photo_url' => $urlSaved1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            DB::table('services')->insert($savedDataService);

            $savedDataApproval = [
                'id' => $uuid,
                'isApproved' => false,
                'isRejected' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            DB::table('approvals')->insert($savedDataApproval);
        });

        return redirect()->to('new-member')->with('message', 'Selamat, Anda Berhasil Registrasi.');
    }

    public function indexBussiness()
    {
        $fetchDataService = ServicesList::all();
        $arrdataLayanan = [];
        foreach ($fetchDataService as $key => $value) {
            array_push($arrdataLayanan, $value->package_name);
        }

        $dataLayanan = [];
        foreach (array_count_values($arrdataLayanan) as $key => $value) {
            array_push($dataLayanan, $key);
        }

        $datas = [
            'titlePage' => 'Form Registrasi Layanan Baru',
            'packageName' => $dataLayanan,
            'serviceData' => ServicesList::all(),
            'promoData' => PromoList::all()
        ];

        if (isset($_POST['salesID'])) {
            $salesID = $_POST['salesID'];

            $response = Http::withHeaders([
                'X-Api-Key'=>'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc'
            ])->get('https://legacy.is5.nusa.net.id/employees/'.$salesID);

            if ($response->successful()) {
                $result = $response->json();
                $datas['salesID'] = $result['id'];
                $datas['salesName'] = $result['name'];
            }
        }

        return view('user.pages.newcustomer.bussiness', $datas);
    }

    public function storeBussiness(Request $request)
    {
        dd($request->all());
        DB::transaction(function () {
            $requestAPI = Request();

            $uuid = $requestAPI->get('uuid');
            $idPelanggan = 'NUSA' . date('YmdHis');

            $savedDataCustomer = [
                'id' => $uuid,
                'customer_id' => $idPelanggan,
                'name' => $requestAPI->get('pic_name'),
                'address' => json_encode([$requestAPI->get('pic_address')]),
                'geolocation' => $requestAPI->get('geolocation_bussiness'),
                'class' => 'Bussiness',
                'email' => $requestAPI->get('pic_email_address'),
                'phone_number' => $requestAPI->get('pic_phone_number'),
                'identity_number' => $requestAPI->get('pic_identity_number'),
                'company_name' => $requestAPI->get('company_name'),
                'company_address' => $requestAPI->get('company_address'),
                'company_npwp' => $requestAPI->get('company_npwp'),
                'company_phone_number' => $requestAPI->get('company_phone_number'),
                'company_employees' => $requestAPI->get('company_employees') != null ? $requestAPI->get('company_employees') : null,
                'reference_id' => $requestAPI->get('salesID') != null ? $requestAPI->get('salesID') : null,
                'survey_id' => $requestAPI->get('survey_id'),
                'extend_note' => $requestAPI->get('addonsnote'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            DB::table('customers')->insert($savedDataCustomer);

            $savedDataBilling = [
                'id' => $uuid,
                'billing_name' => $requestAPI->get('billing_name'),
                'billing_contact' => $requestAPI->get('billing_phone'),
                'billing_email' => json_encode([$requestAPI->get('billing_email'), $requestAPI->get('email_address_biller_one'), $requestAPI->get('email_address_biller_two')]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            DB::table('billings')->insert($savedDataBilling);

            $savedDataTechnical = [
                'id' => $uuid,
                'technical_name' => $requestAPI->get('fullname_technical'),
                'technical_contact' => $requestAPI->get('phone_number_technical'),
                'technical_email' => $requestAPI->get('email_address_technical'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            DB::table('technicals')->insert($savedDataTechnical);

            $fileIdentityPhoto = $requestAPI->file('service_identity_photo');
            $tujuan_upload1 = public_path().'/bin/img/Personal/Identity';
            $fileIdentityPhoto->move($tujuan_upload1, $fileIdentityPhoto->getClientOriginalName());
            $urlSaved1 = url('/bin/img/Personal/Identity/'. $fileIdentityPhoto->getClientOriginalName());

            $savedDataService = [
                'id' => $uuid,
                'service_package' => json_encode([
                    [
                        'service_name' => $requestAPI->get('serviceName'),
                        'service_price' => $requestAPI->get('servicePrice'),
                        'termofpaymentDeals' => $requestAPI->get('termofpaymentDeals')
                    ],
                ]),
                'id_photo_url' => $urlSaved1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            DB::table('services')->insert($savedDataService);

            $savedDataApproval = [
                'id' => $uuid,
                'isApproved' => false,
                'isRejected' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            DB::table('approvals')->insert($savedDataApproval);
        });

        return redirect()->to('new-member')->with('message', 'Selamat, Anda Berhasil Registrasi.');
    }

    public function generateNewLink(Request $request)
    {
        $salesName = $request->get('salesname') != null ? $request->get('salesname') : "";
        $resellerName = $request->get('resellername') != null ? $request->get('resellername') : null;

        if ($salesName == "" && $resellerName == null) {
            return redirect()->to('/');
        }

        $newUUID = (string) Str::orderedUuid();

        $newDataSalesLink = new SalesLink();
        $dataBaseSave = $newDataSalesLink->create([
            'uuid' => join(explode("-", $newUUID)),
            'nama_sales' => $salesName,
            'nama_reseller' => $resellerName,
        ]);

        return response()->json($dataBaseSave);
    }
}
