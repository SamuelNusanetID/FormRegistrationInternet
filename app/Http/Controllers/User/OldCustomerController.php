<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Approval;
use App\Models\Customer;
use App\Models\Billing;
use App\Models\Service;
use App\Models\Technical;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OldCustomerController extends Controller
{
    public function index()
    {
        if (isset($_GET['id'])) {
            $custID = $_GET['id'];
            $endpoint = "https://is.nusa.net.id/o/08b5411f848a2581a41672a759c87380/customer.php";
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', $endpoint, ['query' => [
                'cid' => $custID,
            ]]);
            $statusCode = $response->getStatusCode();
            $content = json_decode($response->getBody(), true);


            if ($statusCode == 200) {
                if (count($content) > 0) {
                    if ($content['company_name'] == null || $content['company_name'] == "") {
                        $datas = [
                            'titlePage' => 'Form Registrasi Layanan Baru - Kategori Personal',
                            'oldDataCustomer' => $content,
                            'serviceData' => json_encode([
                                [
                                    'nama_layanan' => 'Dedicated Fiber Optic',
                                    'harga_layanan' => '1000'
                                ],
                                [
                                    'nama_layanan' => 'Dedicated Wireless',
                                    'harga_layanan' => '2000'
                                ],
                                [
                                    'nama_layanan' => 'Broadband Fiber Optic',
                                    'harga_layanan' => '3000'
                                ],
                                [
                                    'nama_layanan' => 'Broadband Wireless',
                                    'harga_layanan' => '4000'
                                ],
                                [
                                    'nama_layanan' => 'Broadband Home',
                                    'harga_layanan' => '5000'
                                ]
                            ])
                        ];

                        return view('user.pages.oldcustomer.personal', $datas);
                    } else {
                        $datas = [
                            'titlePage' => 'Form Registrasi Layanan Baru - Kategori Bussiness',
                            'oldDataCustomer' => $content,
                            'serviceData' => json_encode([
                                [
                                    'nama_layanan' => 'Dedicated Fiber Optic',
                                    'harga_layanan' => '1000'
                                ],
                                [
                                    'nama_layanan' => 'Dedicated Wireless',
                                    'harga_layanan' => '2000'
                                ],
                                [
                                    'nama_layanan' => 'Broadband Fiber Optic',
                                    'harga_layanan' => '3000'
                                ],
                                [
                                    'nama_layanan' => 'Broadband Wireless',
                                    'harga_layanan' => '4000'
                                ],
                                [
                                    'nama_layanan' => 'Broadband Home',
                                    'harga_layanan' => '5000'
                                ]
                            ])
                        ];

                        return view('user.pages.oldcustomer.bussiness', $datas);
                    }
                } else {
                    $uuidCust = Customer::where('customer_id', $custID)->first();
                    if ($uuidCust !== null) {
                        $uuidCust = Customer::where('customer_id', $custID)->first()->id;
                        $CustClass = Customer::where('customer_id', $custID)->first()->class;

                        if ($CustClass === "Personal") {
                            $oldDataCustomer = [];

                            foreach (Customer::find($uuidCust)->toArray() as $key => $value) {
                                $oldDataCustomer[$key] = $value;
                            }
                            foreach (Billing::find($uuidCust)->toArray() as $key => $value) {
                                $oldDataCustomer[$key] = $value;
                            }
                            foreach (Technical::find($uuidCust)->toArray() as $key => $value) {
                                $oldDataCustomer[$key] = $value;
                            }
                            foreach (Service::find($uuidCust)->toArray() as $key => $value) {
                                $oldDataCustomer[$key] = $value;
                            }

                            $datas = [
                                'titlePage' => 'Form Registrasi Layanan Baru - Kategori Personal',
                                'oldDataCustomer' => $oldDataCustomer,
                                'serviceData' => json_encode([
                                    [
                                        'nama_layanan' => 'Dedicated Fiber Optic',
                                        'harga_layanan' => '1000'
                                    ],
                                    [
                                        'nama_layanan' => 'Dedicated Wireless',
                                        'harga_layanan' => '2000'
                                    ],
                                    [
                                        'nama_layanan' => 'Broadband Fiber Optic',
                                        'harga_layanan' => '3000'
                                    ],
                                    [
                                        'nama_layanan' => 'Broadband Wireless',
                                        'harga_layanan' => '4000'
                                    ],
                                    [
                                        'nama_layanan' => 'Broadband Home',
                                        'harga_layanan' => '5000'
                                    ]
                                ])
                            ];

                            return view('user.pages.oldcustomer.personal', $datas);
                        } elseif ($CustClass === "Bussiness") {
                            $oldDataCustomer = [];

                            foreach (Customer::find($uuidCust)->toArray() as $key => $value) {
                                $oldDataCustomer[$key] = $value;
                            }
                            foreach (Billing::find($uuidCust)->toArray() as $key => $value) {
                                $oldDataCustomer[$key] = $value;
                            }
                            foreach (Technical::find($uuidCust)->toArray() as $key => $value) {
                                $oldDataCustomer[$key] = $value;
                            }
                            foreach (Service::find($uuidCust)->toArray() as $key => $value) {
                                $oldDataCustomer[$key] = $value;
                            }

                            $datas = [
                                'titlePage' => 'Form Registrasi Layanan Baru - Kategori Bisnis',
                                'oldDataCustomer' => $oldDataCustomer,
                                'serviceData' => json_encode([
                                    [
                                        'nama_layanan' => 'Dedicated Fiber Optic',
                                        'harga_layanan' => '1000'
                                    ],
                                    [
                                        'nama_layanan' => 'Dedicated Wireless',
                                        'harga_layanan' => '2000'
                                    ],
                                    [
                                        'nama_layanan' => 'Broadband Fiber Optic',
                                        'harga_layanan' => '3000'
                                    ],
                                    [
                                        'nama_layanan' => 'Broadband Wireless',
                                        'harga_layanan' => '4000'
                                    ],
                                    [
                                        'nama_layanan' => 'Broadband Home',
                                        'harga_layanan' => '5000'
                                    ]
                                ])
                            ];

                            return view('user.pages.oldcustomer.bussiness', $datas);
                        }
                    } else {
                        $datas = [
                            'titlePage' => 'Customer Lama'
                        ];
                        return view('user.pages.oldcustomer.indexcust', $datas);
                    }
                }
            } else {
                return $this->renderHttpException($statusCode);
            }
        } else {
            $datas = [
                'titlePage' => 'Customer Lama'
            ];
            return view('user.pages.oldcustomer.indexcust', $datas);
        }
    }

    public function showDataCustomer(Request $request, $class_customer, $id_customer)
    {
        if (Customer::where('customer_id', $id_customer)->first() == null) {
            $newUUID = (string) Str::orderedUuid();
            $newUUIDUpdate = join(explode("-", $newUUID));

            $newCustomer = new Customer();
            $newCustomer->id = $newUUIDUpdate;
            $newCustomer->customer_id = $id_customer;
            $newCustomer->class = $request->get('company_name') != null ? "Bussiness" : "Personal";
            $newCustomer->name = $request->get('personal_name');
            $newCustomer->identity_number = $request->get('identity_number');
            $newCustomer->email = $request->get('email_address');
            $newCustomer->phone_number = $request->get('phone_number_biller');
            $newCustomer->address = $request->get('personal_address');
            $newCustomer->geolocation = "";
            $newCustomer->company_name = $request->get('company_name');
            $newCustomer->company_address = $request->get('company_address');
            $newCustomer->company_npwp = $request->get('company_npwp');
            $newCustomer->company_phone_number = $request->get('company_phone_number');
            $newCustomer->company_employees = $request->get('company_employees');
            $newCustomer->reference_id = $request->get('reference_id_personal') != null ? $request->get('reference_id_personal') : null;
            $newCustomer->save();

            $newBilling = new Billing();
            $newBilling->id = $newUUIDUpdate;
            $newBilling->billing_name = $request->get('fullname_biller');
            $newBilling->billing_contact = $request->get('phone_number_biller');
            $newBilling->billing_email = json_encode([$request->get('email_address_biller_one'), $request->get('email_address_biller_two'), $request->get('email_address_biller_three')]);
            $newBilling->save();

            $newTechnical = new Technical();
            $newTechnical->id = $newUUIDUpdate;
            $newTechnical->technical_name = $request->get('fullname_technical');
            $newTechnical->technical_contact = $request->get('phone_number_technical');
            $newTechnical->technical_email = $request->get('email_address_technical');
            $newTechnical->save();

            $newService = new Service();
            $newService->id = $newUUIDUpdate;
            $newService->service_package = json_encode([
                [
                    'service_name' => $request->get('serviceName'),
                    'service_price' => $request->get('servicePrice'),
                    'termofpaymentDeals' => $request->get('termofpaymentDeals')
                ]
            ]);
            $newService->id_photo_url = "";
            $newService->selfie_id_photo_url = "";
            $newService->save();

            $newApprovals = new Approval();
            $newApprovals->id = $newUUIDUpdate;
            $newApprovals->isApproved = false;
            $newApprovals->isRejected = false;
            $newApprovals->save();

            return redirect()->to('old-member')->with('message', 'Selamat, Anda Berhasil Update Data Layanan.');
        } else {
            $uuidCust = Customer::where('customer_id', $id_customer)->first()->id;

            // Service Validation
            $validator4 = Validator::make(
                $request->all(),
                [
                    'new_service_product' => 'required'
                ],
                [
                    'new_service_product.required' => 'Field Pilihan Layanan Baru Wajib Diisi'
                ]
            );

            if ($validator4->fails()) {
                return redirect('old-member?id=' . $id_customer . '#service-info')
                    ->withErrors($validator4)
                    ->withInput();
            }

            // Checking Same Data
            $duplicateChecker = $validator4->validated()['new_service_product'] == json_decode(Service::find($uuidCust)->service_package)[0]->service_name;

            if ($duplicateChecker) {
                return redirect('old-member?id=' . $id_customer . '#service-info')
                    ->withInput($request->input())
                    ->with('errMessages', 'Nilai field layanan baru tidak boleh sama dengan yang lama');
            }

            // $oldArray = json_decode(Service::find($uuidCust)->service_package);
            // array_push($oldArray, $validator4->validated()['new_service_product']);

            // $updatedData = Service::find($uuidCust);
            // $updatedData->service_package = json_encode([
            //     [
            //         'service_name' => $request->get('serviceName'),
            //         'service_price' => $request->get('servicePrice'),
            //         'termofpaymentDeals' => $request->get('termofpaymentDeals')
            //     ]
            // ]);
            // $updatedData->save();

            // return redirect()->to('old-member')->with('message', 'Selamat, Anda Berhasil Update Data Layanan.');
        }
    }
}
