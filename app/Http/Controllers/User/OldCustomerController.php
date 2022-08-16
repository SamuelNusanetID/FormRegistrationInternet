<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Approval;
use App\Models\Customer;
use App\Models\Billing;
use App\Models\Service;
use App\Models\ServiceList;
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
                    'serviceData' => ServiceList::all()
                ];

                return view('user.pages.oldcustomer.customer', $datas);
            } else {
                $response = Http::get('https://is.nusa.net.id/o/08b5411f848a2581a41672a759c87380/customer.php', [
                    'cid' => $_GET['id']
                ]);

                if ($response->successful()) {
                    $resultFetch = json_decode($response->body());
                    $returnType = gettype($resultFetch);

                    if ($returnType == "array") {
                        return back()->with('errorMessage', "Maaf, ID Pelanggan anda tidak ditemukan. Silahkan coba lagi.");
                    } else {
                        $datas = [
                            'titlePage' => 'Customer Lama',
                            'customerClass' => $resultFetch->company_name == null ? 'Personal' : 'Bussiness',
                            'customerData' => $resultFetch,
                            'serviceData' => ServiceList::all()
                        ];

                        return view('user.pages.oldcustomer.customer', $datas);
                    }
                } else {
                    return back()->with('errorMessage', "Maaf, ID Pelanggan anda tidak ditemukan. Silahkan coba lagi.");
                }
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

            // Konversi Data Yang Sudah Ada ke dalam Array
            $UUIDCustomer = $CustomerData->first()->id;
            $ServiceCustomer = Service::find($UUIDCustomer);
            $OldServiceCustomerObj = json_decode($ServiceCustomer->service_package);
            $OldServiceCustomerArr = [];
            for ($i = 0; $i < count($OldServiceCustomerObj); $i++) {
                $OldServiceCustomerArr[$i]['service_name'] = $OldServiceCustomerObj[$i]->service_name;
                $OldServiceCustomerArr[$i]['service_price'] = $OldServiceCustomerObj[$i]->service_price;
                $OldServiceCustomerArr[$i]['termofpaymentDeals'] = $OldServiceCustomerObj[$i]->termofpaymentDeals;
            }

            $newDataService = [
                'service_name' => $request->get('serviceName'),
                'service_price' => $request->get('servicePrice'),
                'termofpaymentDeals' => $request->get('termofpaymentDeals')
            ];
            array_push($OldServiceCustomerArr, $newDataService);

            $ServiceCustomer->service_package = json_encode($OldServiceCustomerArr);
            $ServiceCustomer->save();

            return redirect()->to('old-member')->with('message', 'Selamat, Anda Berhasil Registrasi.');
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

            $response = Http::get('https://is.nusa.net.id/o/08b5411f848a2581a41672a759c87380/customer.php', [
                'cid' => $id_customer
            ]);

            if ($response->failed()) {
                return back()->with('errorMessage', "Server didn't respond the request ID Number.");
            }

            $result = json_decode($response->body());
            $UUIDNewCustomer = $this->generatenewUUID();

            $primaryEmail = "";
            if ($result->email == "" || $result->email == null) {
                if ($result->billing_email == "" || $result->billing_email == null) {
                    if ($result->technical_email == "" || $result->technical_email == null) {
                        $primaryEmail = "";
                    } else {
                        $primaryEmail = $result->technical_email;
                    }
                } else {
                    $primaryEmail = $result->billing_email;
                }
            } else {
                $primaryEmail = $result->email;
            }

            // Customer Table
            $newCustomer = new Customer();
            $newCustomer->id = $UUIDNewCustomer;
            $newCustomer->customer_id = $id_customer;
            $newCustomer->name = $result->name;
            $newCustomer->address = $result->address;
            $newCustomer->geolocation = "";
            $newCustomer->class = $class_customer;
            $newCustomer->email = $primaryEmail;
            $newCustomer->identity_number = $result->identity_number;
            $newCustomer->phone_number = $result->phone_number;
            $newCustomer->company_name = $result->company_name != "" ? $result->company_name : null;
            $newCustomer->company_address = $result->company_address != "" ? $result->company_address : null;
            $newCustomer->company_npwp = $result->company_npwp != "" ? $result->company_npwp : null;
            $newCustomer->company_phone_number = $result->company_phone_number != "" ? $result->company_phone_number : null;
            $newCustomer->company_employees = $result->company_employees != "" ? $result->company_employees : null;
            $newCustomer->save();

            // Billing Table
            $newBilling = new Billing();
            $newBilling->id = $UUIDNewCustomer;
            $newBilling->billing_name = $result->billing_name;
            $newBilling->billing_contact = $result->billing_contact == null || "" ? '-' : $result->billing_contact;
            $newBilling->billing_email = json_encode([$primaryEmail, null, null]);
            $newBilling->save();

            $newTechnical = new Technical();
            $newTechnical->id = $UUIDNewCustomer;
            $newTechnical->technical_name = $result->technical_name;
            $newTechnical->technical_contact = $result->technical_contact;
            $newTechnical->technical_email = $primaryEmail;
            $newTechnical->save();

            $newService = new Service();
            $newService->id = $UUIDNewCustomer;
            $newService->service_package = json_encode([[
                'service_name' => $request->get('serviceName'),
                'service_price' => $request->get('servicePrice'),
                'termofpaymentDeals' => $request->get('termofpaymentDeals')
            ]]);
            $newService->id_photo_url = "";
            $newService->selfie_id_photo_url = "";
            $newService->save();

            $newApproval = new Approval();
            $newApproval->id = $UUIDNewCustomer;
            $newApproval->isApproved = false;
            $newApproval->isRejected = false;
            $newApproval->save();

            return redirect()->to('old-member')->with('message', 'Selamat, Anda Berhasil Registrasi.');
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
