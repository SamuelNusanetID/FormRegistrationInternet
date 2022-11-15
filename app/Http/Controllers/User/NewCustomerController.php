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
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

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
                'X-Api-Key' => 'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc'
            ])->get('https://legacy.is5.nusa.net.id/employees/' . $salesID);

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
        $isSuccess = false;
        $message = "";

        DB::beginTransaction();
        try {
            $uuid = $request->get('uuid');
            $idPelanggan = 'NUSA' . date('YmdHis');

            $fileIdentityNPWP = $request->file('additionalnpwpphotopersonal');
            $tujuan_uploadNPWP = public_path() . '/bin/img/Personal/NPWP';
            $fileIdentityNPWP->move($tujuan_uploadNPWP, $fileIdentityNPWP->getClientOriginalName());
            $urlSavedNPWP = url('/bin/img/Personal/NPWP/' . $fileIdentityNPWP->getClientOriginalName());

            $savedDataCustomer = [
                'id' => $uuid,
                'customer_id' => $idPelanggan,
                'name' => $request->get('fullname_personal'),
                'address' => json_encode([$request->get('address_personal')]),
                'geolocation' => json_encode([$request->get('geolocation_personal')]),
                'class' => 'Personal',
                'email' => $request->get('email_address_personal'),
                'phone_number' => "0" . $request->get('phone_number_personal'),
                'identity_type' => $request->get('option_id_number_personal'),
                'identity_number' => $request->get('id_number_personal'),
                'npwp_number' => $request->get('additionalnpwpnumberpersonal'),
                'npwp_files' => $urlSavedNPWP,
                'reference_id' => $request->get('salesID') != null ? $request->get('salesID') : null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            DB::table('customers')->insert($savedDataCustomer);

            $savedDataBilling = [
                'id' => $uuid,
                'billing_name' => $request->get('fullname_biller'),
                'billing_contact' => "0" . $request->get('phone_number_biller'),
                'billing_email' => json_encode([$request->get('email_address_biller_primary'), $request->get('email_address_biller_one'), $request->get('email_address_biller_two')]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            DB::table('billings')->insert($savedDataBilling);

            $savedDataTechnical = [
                'id' => $uuid,
                'technical_name' => $request->get('fullname_technical'),
                'technical_contact' => "0" . $request->get('phone_number_technical'),
                'technical_email' => $request->get('email_address_technical'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            DB::table('technicals')->insert($savedDataTechnical);

            $fileIdentityPhoto = $request->file('service_identity_photo');
            $tujuan_upload1 = public_path() . '/bin/img/Personal/Identity';
            $fileIdentityPhoto->move($tujuan_upload1, $fileIdentityPhoto->getClientOriginalName());
            $urlSaved1 = url('/bin/img/Personal/Identity/' . $fileIdentityPhoto->getClientOriginalName());

            $fetchDataLayanan = json_decode($request->get('RequestHandler'));
            if ($fetchDataLayanan->package_top == "Bulanan") {
                $package_name = $fetchDataLayanan->package_name . ' ' . $fetchDataLayanan->package_categories . ' ' . $fetchDataLayanan->package_type . ' (' . $fetchDataLayanan->package_speed . ' Mbps)';
                $package_price = "";
                $package_top = $fetchDataLayanan->counted . ' Bulan';
            } else {
                $package_name = $fetchDataLayanan->package_name . ' ' . $fetchDataLayanan->package_type . ' (' . $fetchDataLayanan->package_speed . ' Mbps)';
                $package_price = "";
                $package_top = $fetchDataLayanan->counted . ' Tahun';
            }

            $savedDataService = [
                'id' => $uuid,
                'service_package' => json_encode([
                    [
                        'service_name' => $package_name,
                        'service_price' => $package_price,
                        'termofpaymentDeals' => $package_top
                    ],
                ]),
                'id_photo_url' => $urlSaved1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            DB::table('services')->insert($savedDataService);

            if ($request->get('salesID') == null) {
                $savedDataApproval = [
                    'id' => $uuid,
                    'array_approval' => json_encode([
                        'AuthCRO' => [
                            'PIC_Name' => null,
                            'isApproved' => false,
                            'isRejected' => false,
                            'message' => null,
                            'replied_at' => null
                        ],
                        'AuthSalesManager' => [
                            'PIC_Name' => null,
                            'isApproved' => false,
                            'isRejected' => false,
                            'message' => null,
                            'replied_at' => null
                        ],
                        'AuthSales' => [
                            'PIC_Name' => null,
                            'isApproved' => false,
                            'isRejected' => false,
                            'message' => null,
                            'replied_at' => null
                        ]
                    ]),
                    'staging_area' => 'AuthCRO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            } else {
                $PIC_Name = "";

                try {
                    $SalesID = $request->get('salesID');
                    $response = Http::withHeaders([
                        'X-Api-Key' => 'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc'
                    ])->get('https://legacy.is5.nusa.net.id/employees/' . $SalesID);
                    $resultJSON = json_decode($response->body());

                    $PIC_Name = $resultJSON->name;
                } catch (\Throwable $th) {
                    $PIC_Name = null;
                }

                $savedDataApproval = [
                    'id' => $uuid,
                    'array_approval' => json_encode([
                        'AuthCRO' => [
                            'PIC_Name' => null,
                            'isApproved' => false,
                            'isRejected' => false,
                            'message' => null,
                            'replied_at' => null
                        ],
                        'AuthSalesManager' => [
                            'PIC_Name' => null,
                            'isApproved' => false,
                            'isRejected' => false,
                            'message' => null,
                            'replied_at' => null
                        ],
                        'AuthSales' => [
                            'PIC_Name' => $PIC_Name,
                            'isApproved' => false,
                            'isRejected' => false,
                            'message' => null,
                            'replied_at' => null
                        ]
                    ]),
                    'staging_area' => 'AuthSales',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
            DB::table('approvals')->insert($savedDataApproval);

            DB::commit();

            $isSuccess = true;
        } catch (\Throwable $th) {
            $isSuccess = false;
            $message = $th->getMessage();
            DB::rollBack();
        }

        if ($isSuccess) {
            if ($request->get('salesID') == null) {
                try {
                    $dataEm = [
                        'CustNamePIC' => $request->get('fullname_personal'),
                        'CustEmailPIC' => $request->get('email_address_personal')
                    ];

                    Mail::send('email.customer', $dataEm, function ($message) use ($dataEm) {
                        $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                        $message->to($dataEm['CustEmailPIC'])->subject('Registrasi Berhasil!');
                    });

                    if (User::count() > 0) {
                        foreach (User::all() as $key => $value) {
                            if ($value->utype == 'AuthMaster') {
                                $dataEm = [
                                    'SalesNamePIC' => $value->name,
                                    'SalesEmailPIC' => $value->email,
                                    'CustNamePIC' => $request->get('fullname_personal'),
                                    'CustEmailPIC' => $request->get('email_address_personal')
                                ];

                                Mail::send('email.sales', $dataEm, function ($message) use ($value) {
                                    $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                                    $message->to($value->email)->subject('Registrasi Berhasil!');
                                });
                            }
                        }
                    }

                    return redirect()->to('new-member')->with('message', 'Selamat, Anda Berhasil Registrasi.');
                } catch (\Throwable $th) {
                    return redirect()->to(URL::to('new-member/personal/' . $request->get('uuid')))->with('errorMessage', $th->getMessage());
                }
            } else {
                try {
                    $SalesID = $request->get('salesID');
                    $response = Http::withHeaders([
                        'X-Api-Key' => 'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc'
                    ])->get('https://legacy.is5.nusa.net.id/employees/' . $SalesID);
                    $resultJSON = json_decode($response->body());

                    $dataEm = [
                        'SalesNamePIC' => $resultJSON->name,
                        'SalesEmailPIC' => $resultJSON->email,
                        'CustNamePIC' => $request->get('fullname_personal'),
                        'CustEmailPIC' => $request->get('email_address_personal')
                    ];

                    Mail::send('email.customer', $dataEm, function ($message) use ($dataEm) {
                        $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                        $message->to($dataEm['CustEmailPIC'])->subject('Registrasi Berhasil!');
                    });
                    Mail::send('email.sales', $dataEm, function ($message) use ($dataEm) {
                        $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                        $message->to($dataEm['SalesEmailPIC'])->subject('Registrasi Berhasil!');
                    });

                    return redirect()->to('new-member')->with('message', 'Selamat, Anda Berhasil Registrasi.');
                } catch (\Throwable $th) {
                    return redirect()->to(URL::to('new-member/personal/' . $request->get('uuid')))->with('errorMessage', $th->getMessage());
                }
            }
        } else {
            return redirect()->to(URL::to('new-member/personal/' . $request->get('uuid')))->with('errorMessage', $message);
        }
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
                'X-Api-Key' => 'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc'
            ])->get('https://legacy.is5.nusa.net.id/employees/' . $salesID);

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
        $isSuccess = false;
        $message = "";

        DB::beginTransaction();
        try {
            $uuid = $request->get('uuid');
            $idPelanggan = 'NUSA' . date('YmdHis');

            $fileIdentityNPWP = $request->file('company_npwp_upload');
            $tujuan_uploadNPWP = public_path() . '/bin/img/Bussiness/NPWP';
            $fileIdentityNPWP->move($tujuan_uploadNPWP, $fileIdentityNPWP->getClientOriginalName());
            $urlSavedNPWP = url('/bin/img/Bussiness/NPWP/' . $fileIdentityNPWP->getClientOriginalName());

            $fileIdentitySPPKP = $request->file('company_sppkp_upload');
            $tujuan_uploadSPPKP = public_path() . '/bin/img/Bussiness/SPPKP';
            $fileIdentitySPPKP->move($tujuan_uploadSPPKP, $fileIdentitySPPKP->getClientOriginalName());
            $urlSavedSPPKP = url('/bin/img/Bussiness/SPPKP/' . $fileIdentitySPPKP->getClientOriginalName());

            $savedDataCustomer = [
                'id' => $uuid,
                'customer_id' => $idPelanggan,
                'name' => $request->get('pic_name'),
                'address' => json_encode([$request->get('pic_address')]),
                'geolocation' => json_encode([$request->get('geolocation_bussiness')]),
                'class' => 'Bussiness',
                'email' => $request->get('pic_email_address'),
                'phone_number' => "0" . $request->get('pic_phone_number'),
                'identity_type' => $request->get('option_pic_identity_number'),
                'identity_number' => $request->get('pic_identity_number'),
                'company_name' => $request->get('company_name'),
                'company_address' => $request->get('company_address'),
                'company_npwp' => $request->get('company_npwp'),
                'company_npwp_files' => $urlSavedNPWP,
                'company_sppkp' => $request->get('company_sppkp'),
                'company_sppkp_files' => $urlSavedSPPKP,
                'company_phone_number' => $request->get('company_phone_number'),
                'company_employees' => $request->get('company_employees') != null ? $request->get('company_employees') : null,
                'reference_id' => $request->get('salesID') != null ? $request->get('salesID') : null,
                'survey_id' => $request->get('survey_id'),
                'extend_note' => $request->get('addonsnote'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            DB::table('customers')->insert($savedDataCustomer);

            $savedDataBilling = [
                'id' => $uuid,
                'billing_name' => $request->get('billing_name'),
                'billing_contact' => "0" . $request->get('billing_phone'),
                'billing_email' => json_encode([$request->get('billing_email'), $request->get('email_address_biller_one'), $request->get('email_address_biller_two')]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            DB::table('billings')->insert($savedDataBilling);

            $savedDataTechnical = [
                'id' => $uuid,
                'technical_name' => $request->get('fullname_technical'),
                'technical_contact' => "0" . $request->get('phone_number_technical'),
                'technical_email' => $request->get('email_address_technical'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            DB::table('technicals')->insert($savedDataTechnical);

            $fileIdentityPhoto = $request->file('service_identity_photo');
            $tujuan_upload1 = public_path() . '/bin/img/Bussiness/Identity';
            $fileIdentityPhoto->move($tujuan_upload1, $fileIdentityPhoto->getClientOriginalName());
            $urlSaved1 = url('/bin/img/Bussiness/Identity/' . $fileIdentityPhoto->getClientOriginalName());

            $fetchDataLayanan = json_decode($request->get('RequestHandler'));
            if ($fetchDataLayanan->package_top == "Bulanan") {
                $package_name = $fetchDataLayanan->package_name . ' ' . $fetchDataLayanan->package_categories . ' ' . $fetchDataLayanan->package_type . ' (' . $fetchDataLayanan->package_speed . ' Mbps)';
                $package_price = "";
                $package_top = $fetchDataLayanan->counted . ' Bulan';
            } else {
                $package_name = $fetchDataLayanan->package_name . ' ' . $fetchDataLayanan->package_type . ' (' . $fetchDataLayanan->package_speed . ' Mbps)';
                $package_price = "";
                $package_top = $fetchDataLayanan->counted . ' Tahun';
            }

            $savedDataService = [
                'id' => $uuid,
                'service_package' => json_encode([
                    [
                        'service_name' => $package_name,
                        'service_price' => $package_price,
                        'termofpaymentDeals' => $package_top
                    ],
                ]),
                'id_photo_url' => $urlSaved1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            DB::table('services')->insert($savedDataService);

            if ($request->get('salesID') == null) {
                $savedDataApproval = [
                    'id' => $uuid,
                    'array_approval' => json_encode([
                        'AuthCRO' => [
                            'PIC_Name' => null,
                            'isApproved' => false,
                            'isRejected' => false,
                            'message' => null,
                            'replied_at' => null
                        ],
                        'AuthSalesManager' => [
                            'PIC_Name' => null,
                            'isApproved' => false,
                            'isRejected' => false,
                            'message' => null,
                            'replied_at' => null
                        ],
                        'AuthSales' => [
                            'PIC_Name' => null,
                            'isApproved' => false,
                            'isRejected' => false,
                            'message' => null,
                            'replied_at' => null
                        ]
                    ]),
                    'staging_area' => 'AuthCRO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            } else {
                $PIC_Name = "";

                try {
                    $SalesID = $request->get('salesID');
                    $response = Http::withHeaders([
                        'X-Api-Key' => 'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc'
                    ])->get('https://legacy.is5.nusa.net.id/employees/' . $SalesID);
                    $resultJSON = json_decode($response->body());

                    $PIC_Name = $resultJSON->name;
                } catch (\Throwable $th) {
                    $PIC_Name = null;
                }

                $savedDataApproval = [
                    'id' => $uuid,
                    'array_approval' => json_encode([
                        'AuthCRO' => [
                            'PIC_Name' => null,
                            'isApproved' => false,
                            'isRejected' => false,
                            'message' => null,
                            'replied_at' => null
                        ],
                        'AuthSalesManager' => [
                            'PIC_Name' => null,
                            'isApproved' => false,
                            'isRejected' => false,
                            'message' => null,
                            'replied_at' => null
                        ],
                        'AuthSales' => [
                            'PIC_Name' => $PIC_Name,
                            'isApproved' => false,
                            'isRejected' => false,
                            'message' => null,
                            'replied_at' => null
                        ]
                    ]),
                    'staging_area' => 'AuthSales',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
            DB::table('approvals')->insert($savedDataApproval);

            DB::commit();
            $isSuccess = true;
        } catch (\Throwable $th) {
            $isSuccess = false;
            $message = $th->getMessage();
            DB::rollBack();
        }

        if ($isSuccess) {
            if ($request->get('salesID') == null) {
                try {
                    $dataEm = [
                        'CustNamePIC' => $request->get('pic_name'),
                        'CustEmailPIC' => $request->get('pic_email_address')
                    ];

                    Mail::send('email.customer', $dataEm, function ($message) use ($dataEm) {
                        $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                        $message->to($dataEm['CustEmailPIC'])->subject('Registrasi Berhasil!');
                    });

                    foreach (User::all() as $key => $value) {
                        if ($value->utype === 'AuthMaster') {
                            $dataEm = [
                                'CustNamePIC' => $request->get('pic_name'),
                                'CustEmailPIC' => $request->get('pic_email_address'),
                                'SalesNamePIC' => $value->name,
                                'SalesEmailPIC' => $value->email,
                            ];

                            Mail::send('email.sales', $dataEm, function ($message) use ($value) {
                                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                                $message->to($value->email)->subject('Registrasi Berhasil!');
                            });
                        }
                    }
                } catch (\Throwable $th) {
                    return redirect()->to(URL::to('new-member/bussiness/' . $request->get('uuid')))->with('errorMessage', $th->getMessage());
                }
            } else {
                try {
                    $SalesID = $request->get('salesID');
                    $response = Http::withHeaders([
                        'X-Api-Key' => 'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc'
                    ])->get('https://legacy.is5.nusa.net.id/employees/' . $SalesID);
                    $resultJSON = json_decode($response->body());

                    $dataEm = [
                        'SalesNamePIC' => $resultJSON->name,
                        'SalesEmailPIC' => $resultJSON->email,
                        'CustNamePIC' => $request->get('pic_name'),
                        'CustEmailPIC' => $request->get('pic_email_address')
                    ];

                    Mail::send('email.customer', $dataEm, function ($message) use ($dataEm) {
                        $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                        $message->to($dataEm['CustEmailPIC'])->subject('Registrasi Berhasil!');
                    });
                    Mail::send('email.sales', $dataEm, function ($message) use ($dataEm) {
                        $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                        $message->to($dataEm['SalesEmailPIC'])->subject('Registrasi Berhasil!');
                    });
                } catch (\Throwable $th) {
                    return redirect()->to(URL::to('new-member/bussiness/' . $request->get('uuid')))->with('errorMessage', $th->getMessage());
                }
            }

            return redirect()->to('new-member')->with('message', 'Selamat, Anda Berhasil Registrasi.');
        } else {
            return redirect()->to(URL::to('new-member/bussiness/' . $request->get('uuid')))->with('errorMessage', $message);
        }
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
