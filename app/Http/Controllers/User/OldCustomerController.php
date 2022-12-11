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
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OldCustomerController extends Controller
{
    public function index()
    {
        // Filter ID Pelanggan
        $id_customer = null;
        if (isset($_GET['id'])) {
            if ($_GET['id'] != "") {
                $id_customer = $_GET['id'];
            } else {
                return back()->with('errorMessage', "Maaf, ID Pelanggan anda tidak ditemukan. Silahkan coba lagi.");
            }
        }

        // Condition of Data Pelanggan
        if ($id_customer != null) {
            try {
                $response = Http::withHeaders([
                    'X-Api-Key' => 'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc',
                ])->get('https://legacy.is5.nusa.net.id/customers/' . $id_customer);

                $result = $response->json()[0];
                $customerClass = isset($result['companyAddress']) && $result['companyAddress'] != null ? 'Bussiness' : 'Personal';

                $datas = [
                    'titlePage' => 'Customer Lama',
                    'customerClass' => $customerClass,
                    'customerData' => $result
                ];

                return view('user.pages.oldcustomer.customer', $datas);
            } catch (\Throwable $th) {
                return back()->with('errorMessage', "Maaf, ID Pelanggan anda tidak ditemukan. Silahkan coba lagi.");
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
        $dataCustomerGetIS = [];

        try {
            $response = Http::withHeaders([
                'X-Api-Key' => 'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc',
            ])->get('https://legacy.is5.nusa.net.id/customers/' . $id_customer);

            $result = $response->json()[0];
            $result['class'] = isset($result['companyAddress']) && $result['companyAddress'] != null ? 'Bussiness' : 'Personal';
            $dataCustomerGetIS = $result;
        } catch (\Throwable $th) {
            $dataCustomerGetIS = [];
        }

        // $response = Http::get('https://is.nusa.net.id/o/08b5411f848a2581a41672a759c87380/customer.php', [
        //     'cid' => $id_customer
        // ]);

        // if ($response->failed()) {
        //     return back()->with('errorMessage', "Server didn't respond the request ID Number.");
        // }

        // $result = json_decode($response->body());

        if (count($dataCustomerGetIS) != 0) {
            $formDataSubmitted = $request->all();
            $UUIDNewCustomer = $this->generatenewUUID();

            // Customer Table
            $newCustomer = new Customer();
            $newCustomer->id = $UUIDNewCustomer;
            $newCustomer->branch_id = $formDataSubmitted['branch_id'];
            $newCustomer->customer_id = $dataCustomerGetIS['id'];
            $newCustomer->name = $dataCustomerGetIS['name'];

            $newCustomer->gender = "M";
            $newCustomer->place_of_birth = "Medan";
            $newCustomer->date_of_birth = date('Y-m-d');

            $newCustomer->address = json_encode([$formDataSubmitted['new_address']]);
            $newCustomer->geolocation = json_encode([$formDataSubmitted['geolocation_existing']]);
            $newCustomer->class = $dataCustomerGetIS['class'];
            $newCustomer->email = $dataCustomerGetIS['email'];
            $newCustomer->identity_number = $dataCustomerGetIS['identityNumber'];
            $newCustomer->phone_number = $dataCustomerGetIS['phoneNumber'];
            $newCustomer->company_name = isset($dataCustomerGetIS['companyName']) ? $dataCustomerGetIS['companyName'] : null;
            $newCustomer->company_address = isset($dataCustomerGetIS['companyAddress']) ? $dataCustomerGetIS['companyAddress'] : null;
            $newCustomer->company_npwp = isset($dataCustomerGetIS['companyNPWP']) ? $dataCustomerGetIS['companyNPWP'] : null;
            $newCustomer->company_phone_number = isset($dataCustomerGetIS['companyPhoneNumber']) ? $dataCustomerGetIS['companyPhoneNumber'] : null;
            $newCustomer->save();

            // Billing Table
            $newBilling = new Billing();
            $newBilling->id = $UUIDNewCustomer;
            $newBilling->billing_name = $dataCustomerGetIS['billingName'];
            $newBilling->billing_contact = $dataCustomerGetIS['billingContact'];
            $newBilling->billing_email = json_encode([$dataCustomerGetIS['billingEmail'], null, null]);
            $newBilling->save();

            $newTechnical = new Technical();
            $newTechnical->id = $UUIDNewCustomer;
            $newTechnical->technical_name = $dataCustomerGetIS['technicalName'];
            $newTechnical->technical_contact = $dataCustomerGetIS['technicalContact'];
            $newTechnical->technical_email = $dataCustomerGetIS['technicalEmail'];
            $newTechnical->save();


            if ($formDataSubmitted['inlineTopPaket'] == 'Tahunan') {
                $formDataSubmitted['custom_bulanan_tahunan'] = $formDataSubmitted['custom_bulanan_tahunan'] * 12;
            }
            if ($formDataSubmitted['inlineTopPaket'] == "Bulanan") {
                $package_name = $formDataSubmitted['package_name'];
                $package_price = $formDataSubmitted['service_charge_personal'];
                $package_top = $formDataSubmitted['custom_bulanan_tahunan'];
            } else {
                $package_name = $formDataSubmitted['package_name'];
                $package_price = $formDataSubmitted['service_charge_personal'];
                $package_top = $formDataSubmitted['custom_bulanan_tahunan'];
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
            $newApproval->array_approval = json_encode([
                'AuthCRO' => [
                    'PIC_Name' => null,
                    'isApproved' => false,
                    'isRejected' => false,
                    'message' => null,
                    'sended_at' => null,
                    'replied_at' => null
                ],
                'AuthSalesManager' => [
                    'PIC_Name' => null,
                    'isApproved' => false,
                    'isRejected' => false,
                    'message' => null,
                    'sended_at' => null,
                    'replied_at' => null
                ],
                'AuthSales' => [
                    'PIC_Name' => null,
                    'isApproved' => false,
                    'isRejected' => false,
                    'message' => null,
                    'sended_at' => null,
                    'replied_at' => null
                ]
            ]);
            $newApproval->current_staging_area = "AuthCRO";
            $newApproval->save();

            $typeEmail = gettype($dataCustomerGetIS['email']);
            if ($typeEmail == "string") {
                $dataCustomerGetIS['email'] = $dataCustomerGetIS['email'];
            } else {
                $dataCustomerGetIS['email'] = "";
            }

            if ($dataCustomerGetIS['email'] != "") {
                try {
                    $dataEm = [
                        'CustNamePIC' => $dataCustomerGetIS['name'],
                        'CustEmailPIC' => $dataCustomerGetIS['email']
                    ];

                    Mail::send('email.customer', $dataEm, function ($message) use ($dataEm) {
                        $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                        $message->to($dataEm['CustEmailPIC'])->subject('Registrasi Berhasil!');
                    });

                    if (User::count() > 0) {
                        foreach (User::where('branch_id', $request->get('branch_id'))->get() as $key => $value) {
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
                } catch (\Throwable $th) {
                    return back()->with('errorMessage', $th->getMessage());
                }
            } else {
                return redirect()->to('old-member')->with('successMessage', 'Selamat, Anda Berhasil Registrasi. Email notifikasi tidak terkirim, karena email tidak valid.');
            }

            return redirect()->to('old-member')->with('successMessage', 'Selamat, Anda Berhasil Registrasi.');
        } else {
            return back()->with('errorMessage', "Server didn't respond the request ID Number.");
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
