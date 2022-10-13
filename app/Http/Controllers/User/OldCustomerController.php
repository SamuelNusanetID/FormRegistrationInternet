<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Approval;
use App\Models\Customer;
use App\Models\Billing;
use App\Models\Service;
use App\Models\ServicesList;
use App\Models\PromoList;
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
                $fetchDataService = ServicesList::all();
                $arrdataLayanan = [];
                foreach ($fetchDataService as $key => $value) {
                    array_push($arrdataLayanan, $value->package_name);
                }

                $dataLayanan = [];
                foreach (array_count_values($arrdataLayanan) as $key => $value) {
                    array_push($dataLayanan, $key);
                }

                $fetchingDatas = $CustomerData->first();

                $datas = [
                    'titlePage' => 'Customer Lama',
                    'customerClass' => $fetchingDatas->class,
                    'customerData' => $fetchingDatas,
                    'packageName' => $dataLayanan,
                    'serviceData' => ServicesList::all(),
                    'promoData' => PromoList::all()
                ];

                return view('user.pages.oldcustomer.customer', $datas);
            } else {
                $response = Http::withHeaders([
                    'X-Api-Key' => 'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc',
                ])->get('https://legacy.is5.nusa.net.id/customers/' . $_GET['id']);

                if ($response->successful()) {
                    $resultFetch = json_decode($response->body());

                    $returnType = gettype($resultFetch);

                    if ($returnType == "array") {
                        return back()->with('errorMessage', "Maaf, ID Pelanggan anda tidak ditemukan. Silahkan coba lagi.");
                    } else {
                        $resultFetch->address = json_encode([$resultFetch->address]);

                        $customerClass = "Personal";
                        if (isset($resultFetch->company_name)) {
                            if ($resultFetch->company_name != null || $resultFetch->company_name != "") {
                                $customerClass = "Bussiness";
                            } else {
                                $customerClass = "Personal";
                            }
                        }

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
                            'titlePage' => 'Customer Lama',
                            'customerClass' => $customerClass,
                            'customerData' => $resultFetch,
                            'packageName' => $dataLayanan,
                            'serviceData' => ServicesList::all(),
                            'promoData' => PromoList::all()
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
                    'new_address' => 'required',
                ],
                [
                    'new_address.required' => 'Field Alamat Pemasangan Baru Wajib Diisi',
                ]
            );

            if ($validator4->fails()) {
                return redirect('old-member?id=' . $id_customer . '#service-info')
                    ->withErrors($validator4)
                    ->withInput();
            }

            // Konversi Data Yang Sudah Ada ke dalam Array
            $UUIDCustomer = $CustomerData->first()->id;
            $customerDataFetch = Customer::find($UUIDCustomer);
            $newSavedDataAddress = json_decode($customerDataFetch->address);
            $newSavedGeolocation = json_decode($customerDataFetch->geolocation);
            $isSame = false;
            foreach (json_decode($customerDataFetch->address) as $key => $value) {
                if ($value != $request->get('new_address')) {
                    $isSame = false;
                } else {
                    $isSame = true;
                }
            }

            if ($isSame == false) {
                array_push($newSavedDataAddress, $request->get('new_address'));
                array_push($newSavedGeolocation, $request->get('geolocation_existing'));
            }

            $customerDataFetch->address = json_encode($newSavedDataAddress);
            $customerDataFetch->geolocation = json_encode($newSavedGeolocation);
            $customerDataFetch->save();

            $ServiceCustomer = Service::find($UUIDCustomer);
            $OldServiceCustomerObj = json_decode($ServiceCustomer->service_package);
            $OldServiceCustomerArr = [];
            for ($i = 0; $i < count($OldServiceCustomerObj); $i++) {
                $OldServiceCustomerArr[$i]['service_name'] = $OldServiceCustomerObj[$i]->service_name;
                $OldServiceCustomerArr[$i]['service_price'] = $OldServiceCustomerObj[$i]->service_price;
                $OldServiceCustomerArr[$i]['termofpaymentDeals'] = $OldServiceCustomerObj[$i]->termofpaymentDeals;
            }

            $fetchDataLayanan = json_decode($request->get('RequestHandler'));
            if ($fetchDataLayanan->optional_package === null) {
                $package_name = $fetchDataLayanan->package_name . ' ' . $fetchDataLayanan->package_categories . ' ' . $fetchDataLayanan->package_type . ' (' . $fetchDataLayanan->package_speed . ' Mbps)';
                $package_price = $fetchDataLayanan->package_price;
                $package_top = $fetchDataLayanan->counted . ' Bulan';
            } else {
                $package_name = $fetchDataLayanan->package_name . ' ' . $fetchDataLayanan->package_type . ' (' . $fetchDataLayanan->package_speed . ' Mbps)';
                $package_price = $fetchDataLayanan->package_price;
                $package_top = $fetchDataLayanan->counted . ' Bulan';
            }

            $newDataService = [
                'service_name' => $package_name,
                'service_price' => $package_price,
                'termofpaymentDeals' => $package_top
            ];
            array_push($OldServiceCustomerArr, $newDataService);

            $ServiceCustomer->service_package = json_encode($OldServiceCustomerArr);
            $ServiceCustomer->save();

            return redirect()->to('old-member')->with('successMessage', 'Selamat, Anda Berhasil Registrasi.');
        } else {
            $validator4 = Validator::make(
                $request->all(),
                [
                    'new_address' => 'required',
                ],
                [
                    'new_address.required' => 'Field Alamat Pemasangan Baru Wajib Diisi',
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
            $newCustomer->address = $result->address == $request->get('new_address') ? json_encode([$result->address]) : json_encode([$result->address, $request->get('new_address')]);
            $newCustomer->geolocation = json_encode([$request->get('geolocation_existing')]);
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

            $fetchDataLayanan = json_decode($request->get('RequestHandler'));
            if ($fetchDataLayanan->optional_package === null) {
                $package_name = $fetchDataLayanan->package_name . ' ' . $fetchDataLayanan->package_categories . ' ' . $fetchDataLayanan->package_type . ' (' . $fetchDataLayanan->package_speed . ' Mbps)';
                $package_price = $fetchDataLayanan->package_price;
                $package_top = $fetchDataLayanan->counted . ' Bulan';
            } else {
                $package_name = $fetchDataLayanan->package_name . ' ' . $fetchDataLayanan->package_type . ' (' . $fetchDataLayanan->package_speed . ' Mbps)';
                $package_price = $fetchDataLayanan->package_price;
                $package_top = $fetchDataLayanan->counted . ' Bulan';
            }

            $newService = new Service();
            $newService->id = $UUIDNewCustomer;
            $newService->service_package = json_encode([[
                'service_name' => $package_name,
                'service_price' => $package_price,
                'termofpaymentDeals' => $package_top
            ]]);
            $newService->id_photo_url = "";
            $newService->save();

            $newApproval = new Approval();
            $newApproval->id = $UUIDNewCustomer;
            $newApproval->isApproved = false;
            $newApproval->isRejected = false;
            $newApproval->save();

            return redirect()->to('old-member')->with('successMessage', 'Selamat, Anda Berhasil Registrasi.');
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
