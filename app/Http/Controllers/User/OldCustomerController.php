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
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OldCustomerController extends Controller
{
    public function index()
    {
        if (isset($_GET['id'])) {
            $CustomerData = Customer::where('customer_id', $_GET['id']);

            if ($CustomerData->exists()) {
                $fetchingDatas = $CustomerData->first();

                $datas = [
                    'titlePage' => 'Customer Lama',
                    'customerClass' => $fetchingDatas->class,
                    'customerData' => $fetchingDatas,
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

                return view('user.pages.oldcustomer.customer', $datas);
            } else {
                $response = Http::get('https://is.nusa.net.id/o/08b5411f848a2581a41672a759c87380/customer.php', [
                    'cid' => $_GET['id']
                ]);

                if ($response->failed()) {
                    return back()->with('errorMessage', "Server didn't respond the request ID Number.");
                }

                $result = json_decode($response->body());

                $datas = [
                    'titlePage' => 'Customer Lama',
                    'customerClass' => $result->company_name == null ? 'Personal' : 'Bussiness',
                    'customerData' => $result,
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

                return view('user.pages.oldcustomer.customer', $datas);
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
        $CustomerData = Customer::where('customer_id', $id_customer);

        if ($CustomerData->exists()) {
            $validator4 = Validator::make(
                $request->all(),
                [
                    'service_product' => 'required',
                    'topRadioBtnBussiness' => 'required'
                ],
                [
                    'service_product.required' => 'Field Pilihan Layanan Wajib Diisi',
                    'topRadioBtnBussiness.required' => 'Field Jenis Pembayaran Wajib Diisi'
                ]
            );

            if ($validator4->fails()) {
                return redirect('old-member?id=' . $id_customer . '#service-info')
                    ->withErrors($validator4)
                    ->withInput();
            }

            // Checking Data Before
            dd($request->all());
        } else {
            $validator4 = Validator::make(
                $request->all(),
                [
                    'service_product' => 'required',
                    'topRadioBtnBussiness' => 'required'
                ],
                [
                    'service_product.required' => 'Field Pilihan Layanan Wajib Diisi',
                    'topRadioBtnBussiness.required' => 'Field Jenis Pembayaran Wajib Diisi'
                ]
            );

            if ($validator4->fails()) {
                return redirect('old-member?id=' . $id_customer . '#service-info')
                    ->withErrors($validator4)
                    ->withInput();
            }

            // Checking Data Before
            dd($request->all());

            // $response = Http::get('https://is.nusa.net.id/o/08b5411f848a2581a41672a759c87380/customer.php', [
            //     'cid' => $id_customer
            // ]);

            // if ($response->failed()) {
            //     return back()->with('errorMessage', "Server didn't respond the request ID Number.");
            // }

            // $result = json_decode($response->body());

            // $newUUID = $this->generatenewUUID();

            // $newCustomer = new Customer();
            // $newCustomer->id = $newUUID;
        }
    }

    public function generatenewUUID()
    {
        $allIDCustomer = [];
        $allDataCustomer = Customer::all();
        foreach ($allDataCustomer as $customer) {
            array_push($allIDCustomer, $customer->id);
        }

        $newUUID = join(explode('-', (string) Str::orderedUuid()));

        if (in_array($newUUID, $allIDCustomer)) {
            $this->generatenewUUID();
        }

        return $newUUID;
    }
}
