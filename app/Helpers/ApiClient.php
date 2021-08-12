<?php

namespace App\Helpers;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ApiClient {

    public function __construct() {
        $this->client = new Client();
    }

    public function getHeader() {
        try {
            $getHeader = $this->client->request('GET', config('app.url_api') . '/getHeader', [
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'form_params' => []
            ]);
            $result = json_decode($getHeader->getBody()->getContents(), true);
            // dd($result);
            if ($getHeader->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['header'] = (Object) $result['data'];
                    $this->data['error_header'] = "";
                } else {
                    $this->data['header'] = array();
                    $this->data['error_header'] = $result['messages'];
                }
            } else {
                $this->data['header'] = array();
                $this->data['error_header'] = $getHeader->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['header'] = array();
            $this->data['error_header'] = $e->getMessage();
        }
    }

    public function getHelp() {
        try {
            $getHelp = $this->client->request('GET', config('app.url_api') . '/getHelp', [
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'form_params' => []
            ]);
            $result = json_decode($getHelp->getBody()->getContents(), true);
            if ($getHelp->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['help'] = (Object) $result['data'];
                    $this->data['error_help'] = "";
                } else {
                    $this->data['help'] = array();
                    $this->data['error_help'] = $result['messages'];
                }
            } else {
                $this->data['help'] = array();
                $this->data['error_help'] = $getHelp->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['help'] = array();
            $this->data['error_help'] = $e->getMessage();
        }
    }

    public function getAboutUs() {
        try {
            $getAboutUs = $this->client->request('GET', config('app.url_api') . '/aboutus', [
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'form_params' => []
            ]);
            $result = json_decode($getAboutUs->getBody()->getContents(), true);
            
            if ($getAboutUs->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['about'] = (Object) $result['data'];
                    $this->data['error_about'] = "";
                } else {
                    $this->data['about'] = array();
                    $this->data['error_about'] = $result['messages'];
                }
            } else {
                $this->data['about'] = array();
                $this->data['error_about'] = $getAboutUs->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['about'] = array();
            $this->data['error_about'] = $e->getMessage();
        }
    }

    public function getPrivacyPolicy() {
        try {
            $getPrivacyPolicy = $this->client->request('GET', config('app.url_api') . '/getPrivacy', [
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'form_params' => []
            ]);
            $result = json_decode($getPrivacyPolicy->getBody()->getContents(), true);
            if ($getPrivacyPolicy->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['privacy'] = (Object) $result['data'];
                    $this->data['error_privacy'] = "";
                } else {
                    $this->data['privacy'] = array();
                    $this->data['error_privacy'] = $result['messages'];
                }
            } else {
                $this->data['privacy'] = array();
                $this->data['error_privacy'] = $getPrivacyPolicy->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['privacy'] = array();
            $this->data['error_privacy'] = $e->getMessage();
        }
    }

    public function getTermCondition() {
        try {
            $getTermCondition = $this->client->request('GET', config('app.url_api') . '/getTerm', [
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'form_params' => []
            ]);
            $result = json_decode($getTermCondition->getBody()->getContents(), true);
            if ($getTermCondition->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['terms'] = (Object) $result['data'];
                    $this->data['error_terms'] = "";
                } else {
                    $this->data['terms'] = array();
                    $this->data['error_terms'] = $result['messages'];
                }
            } else {
                $this->data['terms'] = array();
                $this->data['error_terms'] = $getTermCondition->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['terms'] = array();
            $this->data['error_terms'] = $e->getMessage();
        }
    }

    public function getNotification() {
        //get Notif
        try {
            $getNotif = $this->client->request('POST', config('app.url_api') . '/notification', [
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'form_params' => [
                    "is_agent" => Session::get('is_agent'),
                    "user_id" => Session::get('user_id'),
                    "sort_by" => "",
                    "date_from" => "",
                    "date_to" => ""
                ]
            ]);
            $result = json_decode($getNotif->getBody()->getContents(), true);
            if ($getNotif->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['notif'] = (Object) $result['data'];
                    $this->data['error_notif'] = "";
                } else {
                    $this->data['notif'] = array();
                    $this->data['error_notif'] = $result['messages'];
                }
            } else {
                $this->data['notif'] = array();
                $this->data['error_notif'] = $getNotif->getStatusCode();
            }

            $countNotifNotRead = $this->client->request('POST', config('app.url_api') . '/countNotification', [
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'form_params' => [
                    "is_agent" => Session::get('is_agent'),
                    "user_id" => Session::get('user_id')
                ]
            ]);
            $resultCount = json_decode($countNotifNotRead->getBody()->getContents(), true);
            if ($countNotifNotRead->getStatusCode() == 200) {
                if ($resultCount['isSuccess'] == true) {
                    $this->data['count_notif'] = $resultCount['data'];
                    $this->data['error_count_notif'] = "";
                } else {
                    $this->data['count_notif'] = array();
                    $this->data['error_count_notif'] = $result['messages'];
                }
            } else {
                $this->data['count_notif'] = array();
                $this->data['error_count_notif'] = $countNotifNotRead->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['count_notif'] = array();
            $this->data['error_count_notif'] = $e->getMessage();
        }
    }

    public function getBanner() {
        //get Banner
        try {
            $getBanner = $this->client->request('GET', config('app.url_api') . '/banner', [
                'headers' => [],
                'form_params' => []
            ]);
            $result = json_decode($getBanner->getBody()->getContents(), true);
            if ($getBanner->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['banner'] = (Object) $result['data'];
                    $this->data['error_banner'] = "";
                } else {
                    $this->data['banner'] = array();
                    $this->data['error_banner'] = $result['messages'];
                }
            } else {
                $this->data['banner'] = array();
                $this->data['error_banner'] = $getBanner->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['banner'] = array();
            $this->data['error_banner'] = $e->getMessage();
        }
    }

    public function getBannerById($id) {
        try {
            $getBanner = $this->client->request('GET', config('app.url_api') . '/banner/' . $id, [
                'headers' => [],
                'form_params' => []
            ]);
            $result = json_decode($getBanner->getBody()->getContents(), true);
            if ($getBanner->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['banner'] = $result['data'];
                    $this->data['error_banner'] = "";
                } else {
                    $this->data['banner'] = array();
                    $this->data['error_banner'] = $result['message'];
                }
            } else {
                $this->data['banner'] = array();
                $this->data['error_banner'] = $getBanner->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['banner'] = array();
            $this->data['error_banner'] = $e->getMessage();
        }
    }

    public function getCategory() {
        //get category
        try {
            $getTag = $this->client->request('GET', config('app.url_api') . '/category', [
                'headers' => [],
                'form_params' => []
            ]);
            $result = json_decode($getTag->getBody()->getContents(), true);
            if ($getTag->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['category'] = (Object) $result['data'];
                    $this->data['error_category'] = "";
                } else {
                    $this->data['category'] = array();
                    $this->data['error_category'] = $result['messages'];
                }
            } else {
                $this->data['category'] = array();
                $this->data['error_category'] = $getNotif->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['category'] = array();
            $this->data['error_category'] = $e->getMessage();
        }
    }

    public function getProduct() {
        //get product
        try {
            $getProduct = $this->client->request('POST', config('app.url_api') . '/productWh/0', [
                'headers' => [
                    //"Content-Type" => "application/json",
                    "Accept" => "application/json"
                ],
                'form_params' => [
                    "isPromoMenu" => "",
                    "isProductMenu" => "1",
                    "keyword" => "",
                    "sortBy" => "1",
                    "filterByMin" => "",
                    "filterByMax" => "",
                    "filterByLocation" => "",
                    "user_id" => Session::get('user_id'),
                    "latitude" => "",
                    "longitude" => "",
                    "is_agent" => Session::get('is_agent'),
                    "page_size" => 1,
                    "page" => 1
                ]
            ]);
            $result = json_decode($getProduct->getBody()->getContents(), true);
            if ($getProduct->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['product'] = (Object) $result['data'];
                    $this->data['error_product'] = "";
                } else {
                    $this->data['product'] = array();
                    $this->data['error_product'] = $result['messages'];
                }
            } else {
                $this->data['product'] = array();
                $this->data['error_product'] = $getNotif->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['product'] = array();
            $this->data['error_product'] = $e->getMessage();
        }
    }

    public function getCart() {
        //get cart
        try {
            $user_id = Session::get('user_id');
            if ($user_id == NULL) {
                $this->data['cart'] = (Object) Session::get('cart');
                $qty = 0;
                $total = 0;
                $this->data['error_cart'] = "";
                $this->data['total_cart'] = $qty;
                $this->data['weight'] = 0;
                $this->data['total'] = $total;
            } else {
                $getCart = $this->client->request('POST', config('app.url_api') . '/getCart', [
                    'headers' => [
                        //"Content-Type" => "application/json",
                        "Accept" => "application/json"
                    ],
                    'form_params' => [
                        "is_agent" => Session::get('is_agent'),
                        "user_id" => Session::get('user_id'),
                    ]
                ]);
                $result = json_decode($getCart->getBody()->getContents(), true);

                if ($result['isSuccess'] == true) {
                    $this->data['cart'] = (Object) $result['data'];
                    $qty = 0;
                    $total = 0;
                    $berat = 0;
                    $subtotal = 0;
                    $ppn = 0;
                    $ppn_percentage = 0;

                    foreach ($result['data']['cart'] as $cart) {
                        $subtotal += $cart['warehouse_subtotal'];
                        foreach ($cart['cart'] as $data_cart) {
                            $qty += $data_cart['qty'];
                            $berat += $data_cart['product_pack_uom_value'];
                        }
                    }

                    $total = $subtotal;
                    if (!$result['data']['global_setting']['pricing_include_tax']) {
                        $ppn = $subtotal * $result['data']['global_setting']['tax_value'];
                        $ppn_percentage = ($result['data']['global_setting']['tax_value'] * 100) . "%";
                        $total = $subtotal + $ppn;
                    }

                    $this->data['total_cart'] = $qty;
                    $this->data['subtotal'] = $subtotal;
                    $this->data['ppn'] = $ppn;
                    $this->data['ppn_percent'] = $ppn_percentage;

                    $this->data['cart'] = $result['data']['cart'];
                    $this->data['total'] = $total;
                    $this->data['weight'] = $berat;
                    $this->data['error_cart'] = "";
                } else {
                    $this->data['cart'] = array();
                    $this->data['total_cart'] = 0;
                    $this->data['total'] = 0;
                    $this->data['weight'] = 0;
                    $this->data['error_cart'] = $result['messages'];
                }
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['cart'] = array();
            $this->data['total_cart'] = 0;
            $this->data['total'] = 0;
            $this->data['weight'] = 0;
            $this->data['error_cart'] = $e->getMessage();
        }
    }

    public function getProductByName($product_name) {
        //product
        try {
            $getProduct = $this->client->request('POST', config('app.url_api') . '/productbyName', [
                'headers' =>
                    [
                    'Accept' => 'application/json'
                ],
                'form_params' => [
                    'product_name' => $product_name
                ]
            ]);
            $result = json_decode($getProduct->getBody()->getContents(), true);
            if ($getProduct->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['cari'] = $product_name;
                    $this->data['product'] = (Object) $result['data'];
                    $this->data['error_product'] = "";
                } else {
                    $this->data['cari'] = $product_name;
                    $this->data['product'] = array();
                    $this->data['error_product'] = $result['messages'];
                }
            } else {
                $this->data['cari'] = $product_name;
                $this->data['product'] = array();
                $this->data['error_product'] = $getNotif->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['cari'] = $product_name;
            $this->data['product'] = array();
            $this->data['error_product'] = $e->getMessage();
        }
    }

    public function getProductByNameNew($product_name) {
        // $data_post = [
        //     "isPromoMenu" => "",
        //     "isProductMenu" => "1",
        //     "keyword" => $product_name,
        //     "sortBy" => "1",
        //     "filterByMin" => "",
        //     "filterByMax" => "",
        //     "filterByLocation" => "",
        //     "user_id" => Session::get('user_id'),
        //     "latitude" => "",
        //     "longitude" => "",
        //     "is_agent" => Session::get('is_agent'),
        //     "page_size" => 1,
        //     "page" => 1
        // ];
        try {
            $getProduct = $this->client->request('POST', config('app.url_api') . '/productWh/0', [
                'headers' => [
                    //"Content-Type" => "application/json",
                    "Accept" => "application/json"
                ],
                // 'body' => json_encode($data_post)
                'form_params' => [
                    "isPromoMenu" => "",
                    "isProductMenu" => "1",
                    "keyword" => $product_name,
                    "sortBy" => "1",
                    "filterByMin" => "",
                    "filterByMax" => "",
                    "filterByLocation" => "",
                    "user_id" => Session::get('user_id'),
                    "latitude" => "",
                    "longitude" => "",
                    "is_agent" => Session::get('is_agent'),
                    "page_size" => 1,
                    "page" => 1,
                    "sorting" => request()->sorting
                ]
            ]);

            $result = json_decode($getProduct->getBody()->getContents(), true);
            if ($getProduct->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['cari'] = $product_name;
                    $this->data['product'] = (Object) $result['data'];
                    $this->data['error_product'] = "";
                } else {
                    $this->data['cari'] = $product_name;
                    $this->data['product'] = array();
                    $this->data['error_product'] = $result['messages'];
                }
            } else {
                $this->data['cari'] = $product_name;
                $this->data['product'] = array();
                $this->data['error_product'] = $getNotif->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['cari'] = $product_name;
            $this->data['product'] = array();
            $this->data['error_product'] = $e->getMessage();
        }
    }

    public function getProductByCategory($id) {
        //get product
        try {
            $getProduct = $this->client->request('POST', config('app.url_api') . '/productWhByTag/' . $id, [
                'headers' => [
                    //"Content-Type" => "application/json",
                    "Accept" => "application/json"
                ],
                'form_params' => [
                    "isPromoMenu" => "",
                    "isProductMenu" => "1",
                    "keyword" => "",
                    "sortBy" => "1",
                    "filterByMin" => "",
                    "filterByMax" => "",
                    "filterByLocation" => "",
                    "user_id" => Session::get('user_id'),
                    "latitude" => "",
                    "longitude" => "",
                    "is_agent" => Session::get('is_agent'),
                    "page_size" => 1,
                    "page" => 1,
                    "sorting" => request()->sorting
                ]
            ]);

            $result = json_decode($getProduct->getBody()->getContents(), true);


            if ($getProduct->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['product'] = (Object) $result['data'];
                    $this->data['error_product'] = "";
                } else {
                    $this->data['product'] = array();
                    $this->data['error_product'] = $result['messages'];
                }
            } else {
                $this->data['product'] = array();
                $this->data['error_product'] = $getNotif->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['product'] = array();
            $this->data['error_product'] = $e->getMessage();
        }
    }

    public function register($request) {
        try {
            $fileAttachment = $request->file('npwp_image');
            $image_path = $fileAttachment->getPathname();
            $image_mime = $fileAttachment->getmimeType();
            $image_org = $fileAttachment->getClientOriginalName();
            $register = $this->client->request('POST', config('app.url_api') . '/auth/register', [
                'headers' => [],
                'multipart' => [
                    [
                    'name' => 'name',
                    'contents' => $request->nama_lengkap
                ],
                    [
                    'name' => 'npwp',
                    'contents' => $request->npwp
                ],
                    [
                    'name' => 'pic',
                    'contents' => $request->pic
                ],
                    [
                    'name' => 'npwp_address',
                    'contents' => $request->npwp_address
                ],
                    [
                    'name' => 'phone_number',
                    'contents' => $request->phone_number
                ],
                [
                    'name' => 'email',
                    'contents' => $request->email
                ],
                [
                    'name' => 'password',
                    'contents' => $request->password
                ],
                [
                    'name' => 'confirm_password',
                    'contents' => $request->confirm_password
                ],
                    [
                    'name' => 'npwp_image',
                    'filename' => $image_org,
                    'Mime-Type' => $image_mime,
                    'contents' => fopen($image_path, 'r'),
                ]
            ]
        ]);
            $result = json_decode($register->getBody()->getContents(), true);
            if ($register->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $data = array(
                        'code' => 200,
                        'isSuccess' => true,
                        'message' => $result['message']
                    );
                } else {
                    $data = array(
                        'code' => 200,
                        'isSuccess' => false,
                        'message' => $result['message']
                    );
                }
            } else {
                $data = array(
                    'code' => $register->getStatusCode(),
                    'isSuccess' => false,
                    'message' => $result['message']
                );
            }
            return response()->json($data);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $data = array(
                'code' => 400,
                'isSuccess' => false,
                'message' => $e->getMessage()
            );
        }
        return response()->json($data);
    }

    public function verifyUsername($request) {
        try {
            $check = $this->client->request('POST', config('app.url_api') . '/auth/verifyUsername', [
                'headers' => [],
                'form_params' => [
                    'username' => $request->username
                ]
            ]);
            $result = json_decode($check->getBody()->getContents(), true);
            if ($check->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $data = array(
                        'code' => 200,
                        'isSuccess' => true,
                        'message' => $result['message']
                    );
                } else {
                    $data = array(
                        'code' => 200,
                        'isSuccess' => false,
                        'message' => $result['message']
                    );
                }
            } else {
                $data = array(
                    'code' => $check->getStatusCode(),
                    'isSuccess' => false,
                    'message' => $result['message']
                );
            }
            return response()->json($data);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $data = array(
                'code' => 400,
                'isSuccess' => false,
                'message' => $e->getMessage()
            );
        }
        return response()->json($data);
    }

    public function login($request) {
        try {
            $login = $this->client->request('POST', config('app.url_api') . '/auth/login', [
                'headers' => [],
                'form_params' => [
                    'username' => $request->username,
                    'password' => $request->password
                ]
            ]);
            $result = json_decode($login->getBody()->getContents(), true);
            // dd($result);
            if ($login->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $data = array(
                        'code' => 200,
                        'isSuccess' => true,
                        'message' => $result['message'],
                        'data' => $result['data'],
                        'username' => $request->username
                    );
                    $request->session()->put('user_id_sementara', $result['data']['user_id']);
                    $request->session()->put('is_agent_sementara', $result['data']['is_agent']);
                } else {
                    $data = array(
                        'code' => 200,
                        'isSuccess' => false,
                        'message' => $result['message']
                    );
                }
            } else {
                $data = array(
                    'code' => $login->getStatusCode(),
                    'isSuccess' => false,
                    'message' => $result['message']
                );
            }
            return response()->json($data);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $data = array(
                'code' => 400,
                'isSuccess' => false,
                'message' => $e->getMessage()
            );
        }
        return response()->json($data);
    }

    public function verifyOtp($request) {
        try {
            $otp = $this->client->request('POST', config('app.url_api') . '/auth/verifyOTP', [
                'headers' => [],
                'form_params' => [
                    'user_id' => Session::get('user_id_sementara'),
                    'otp_code' => implode($request->otp_code),
                    'is_agent' => Session::get('is_agent_sementara')
                ]
            ]);

            $result = json_decode($otp->getBody()->getContents(), true);
            if ($otp->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $request->session()->put('user_id', Session::get('user_id_sementara'));
                    $request->session()->put('is_agent', Session::get('is_agent_sementara'));
                    $request->session()->put('token', $result['data']['remember_token']);
                    try {
                        $getProfile = $this->client->request('POST', config('app.url_api') . '/profile/getProfile', [
                            'headers' => [
                                //'Content-Type' => 'application/json',
                                'Accept' => 'application/json',
                                'Authorization' => 'Bearer ' . Session::get('token')
                            ],
                            'form_params' => [
                                "is_agent" => Session::get('is_agent'),
                                "user_id" => Session::get('user_id'),
                            ]
                        ]);
                        $result_profile = json_decode($getProfile->getBody()->getContents(), true);
                        if ($getProfile->getStatusCode() == 200) {
                            if ($result_profile['isSuccess'] == true) {
                                $request->session()->put('user_image', $result_profile['data']['user_image']);
                                $request->session()->put('user_name', $result_profile['data']['user_name']);
                                $request->session()->put('user_email', $result_profile['data']['user_email']);
                            } else {
                                $data = array(
                                    'code' => 200,
                                    'isSuccess' => false,
                                    'message' => $result_profile['message']
                                );
                            }
                        } else {
                            $data = array(
                                'code' => $otp->getStatusCode(),
                                'isSuccess' => false,
                                'message' => $result_profile['message']
                            );
                        }
                    } catch (\GuzzleHttp\Exception\GuzzleException $e) {
                        $data = array(
                            'code' => 400,
                            'isSuccess' => false,
                            'message' => $e->getMessage()
                        );
                    }
                    $data = array(
                        'code' => 200,
                        'isSuccess' => true,
                        'message' => $result['message'],
                        'data' => $result['data']
                    );
                } else {
                    $data = array(
                        'code' => 200,
                        'isSuccess' => false,
                        'message' => $result['message']
                    );
                }
            } else {
                $data = array(
                    'code' => $otp->getStatusCode(),
                    'isSuccess' => false,
                    'message' => $result['message']
                );
            }
            return response()->json($data);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $data = array(
                'code' => 400,
                'isSuccess' => false,
                'message' => $e->getMessage()
            );
        }
        return response()->json($data);
    }

    public function sendOTPReset($request) {
        try {
            $otp = $this->client->request('POST', config('app.url_api') . '/auth/sendOTPReset', [
                'headers' => [],
                'form_params' => [
                    'username' => $request->username
                ]
            ]);
            $result = json_decode($otp->getBody()->getContents(), true);
            if ($otp->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $data = array(
                        'code' => 200,
                        'isSuccess' => true,
                        'message' => $result['message'],
                        'data' => $result['data']
                    );
                    $request->session()->put('user_id_sementara', $result['data']['user_id']);
                    $request->session()->put('is_agent_sementara', $result['data']['is_agent']);
                } else {
                    $data = array(
                        'code' => 200,
                        'isSuccess' => false,
                        'message' => $result['message']
                    );
                }
            } else {
                $data = array(
                    'code' => $otp->getStatusCode(),
                    'isSuccess' => false,
                    'message' => $result['message']
                );
            }
            return response()->json($data);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $data = array(
                'code' => 400,
                'message' => $e->getMessage()
            );
        }
        return response()->json($data);
    }

    public function verifyForget($request) {
        try {
            $otp = $this->client->request('POST', config('app.url_api') . '/auth/verifyOTP', [
                'headers' => [],
                'form_params' => [
                    'user_id' => Session::get('user_id_sementara'),
                    'otp_code' => implode($request->otp_code),
                    'is_agent' => Session::get('is_agent_sementara')
                ]
            ]);

            $result = json_decode($otp->getBody()->getContents(), true);
            if ($otp->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $data = array(
                        'code' => 200,
                        'isSuccess' => true,
                        'message' => $result['message'],
                        'data' => $result['data']
                    );
                } else {
                    $data = array(
                        'code' => 200,
                        'isSuccess' => false,
                        'message' => $result['message']
                    );
                }
            } else {
                $data = array(
                    'code' => $otp->getStatusCode(),
                    'isSuccess' => false,
                    'message' => $result['message']
                );
            }
            return response()->json($data);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $data = array(
                'code' => 400,
                'isSuccess' => false,
                'message' => $e->getMessage()
            );
        }
        return response()->json($data);
    }

    public function changeForgotPassword($request) {
        try {
            $changePassword = $this->client->request('POST', config('app.url_api') . '/auth/changeForgotPassword', [
                'headers' => [],
                'form_params' => [
                    'user_id' => Session::get('user_id_sementara'),
                    'is_agent' => Session::get('is_agent_sementara'),
                    'new_password' => $request->new_password,
                    'confirm_password' => $request->confirm_password,
                ]
            ]);

            $result = json_decode($changePassword->getBody()->getContents(), true);
            if ($changePassword->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $data = array(
                        'code' => 200,
                        'isSuccess' => true,
                        'message' => $result['message'],
                    );
                } else {
                    $data = array(
                        'code' => 200,
                        'isSuccess' => false,
                        'message' => $result['message']
                    );
                }
            } else {
                $data = array(
                    'code' => $changePassword->getStatusCode(),
                    'isSuccess' => false,
                    'message' => $result['message']
                );
            }
            return response()->json($data);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $data = array(
                'code' => 400,
                'isSuccess' => false,
                'message' => $e->getMessage()
            );
        }
        return response()->json($data);
    }

    public function addToCart($request) {
        try {
            $user_id = Session::get('user_id');
            if ($request->qty <= 0) {
                $data = array(
                    'code' => 200,
                    'isSuccess' => false,
                    'message' => "Jumlah tidak boleh atau kurang dari 0"
                );
            } else if ($request->qty > $request->stock) {
                $data = array(
                    'code' => 200,
                    'isSuccess' => false,
                    'message' => "Jumlah melebihi stok yang ada"
                );
            } else {
                $add = $this->client->request('POST', config('app.url_api') . '/addToCart', [
                    'headers' => [],
                    'form_params' => [
                        'user_id' => Session::get('user_id'),
                        "warehouse_id" => $request->warehouse_id,
                        "product_id" => $request->product_id,
                        "amount" => $request->price,
                        "qty" => $request->qty,
                        "is_agent" => Session::get('is_agent')
                    ]
                ]);
                $result = json_decode($add->getBody()->getContents(), true);
                if ($add->getStatusCode() == 200) {
                    if ($result['isSuccess'] == true) {
                        $data = array(
                            'code' => 200,
                            'isSuccess' => true,
                            'message' => ''
                        );
                    } else {
                        $data = array(
                            'code' => 400,
                            'isSuccess' => false,
                            'message' => $result['message']
                        );
                    }
                } else {
                    $data = array(
                        'code' => $add->getStatusCode(),
                        'isSuccess' => false,
                        'message' => $result['message']
                    );
                }
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $data = array(
                'code' => 400,
                'isSuccess' => false,
                'message' => $e->getMessage()
            );
        }

        return response()->json($data);
    }

    public function addUpdateCart($request) {
        try {
            $update = $this->client->request('POST', config('app.url_api') . '/addUpdateCart', [
                'headers' => [],
                'form_params' => [
                    "user_id" => Session::get('user_id'),
                    "warehouse_id" => $request->warehouse_id,
                    "product_id" => $request->product_id,
                    "amount" => $request->amount,
                    "status" => $request->status,
                    "is_agent" => Session::get('is_agent')
                ]
            ]);
            $result = json_decode($update->getBody()->getContents(), true);
            if ($update->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $data = array(
                        'code' => 200,
                        'isSuccess' => true,
                        'message' => $result['message']
                    );
                } else {
                    $data = array(
                        'code' => 200,
                        'isSuccess' => false,
                        'message' => $result['message']
                    );
                }
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $data = array(
                'code' => 400,
                'isSuccess' => false,
                'message' => $e->getMessage()
            );
        }

        return response()->json($data);
    }

    public function deleteCart($request) {
        try {
            $delete = $this->client->request('POST', config('app.url_api') . '/deleteItemInCart', [
                'headers' => [],
                'form_params' => [
                    "user_id" => Session::get('user_id'),
                    "warehouse_id" => $request->warehouse_id,
                    "product_id" => $request->product_id,
                    "is_agent" => Session::get('is_agent')
                ]
            ]);
            $result = json_decode($delete->getBody()->getContents(), true);
            if ($delete->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $data = array(
                        'code' => 200,
                        'isSuccess' => true,
                        'message' => $result['message']
                    );
                } else {
                    $data = array(
                        'code' => 200,
                        'isSuccess' => false,
                        'message' => $result['message']
                    );
                }
            } else {
                $data = array(
                    'code' => $delete->getStatusCode(),
                    'isSuccess' => false,
                    'message' => "Error code : " + $delete->getStatusCode()
                );
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $data = array(
                'code' => 500,
                'isSuccess' => false,
                'message' => $e->getMessage()
            );
        }
        return response()->json($data);
    }

    public function getProfile() {
        //get Profile
        try {
            $getProfile = $this->client->request('POST', config('app.url_api') . '/profile/getProfile', [
                'headers' => [
                    //'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . Session::get('token')
                ],
                'form_params' => [
                    "is_agent" => Session::get('is_agent'),
                    "user_id" => Session::get('user_id'),
                ]
            ]);

            $result = json_decode($getProfile->getBody()->getContents(), true);
            if ($getProfile->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['profile'] = (Object) $result['data'];
                    $this->data['error_profile'] = "";
                } else {
                    $this->data['profile'] = array();
                    $this->data['error_profile'] = $result['messages'];
                }
            } else {
                $this->data['profile'] = array();
                $this->data['error_profile'] = $getProfile->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['profile'] = array();
            $this->data['error_profile'] = $e->getMessage();
        }
    }

    public function updateProfile($request) {
        try {
            if ($file = $request->file('profile_picture')) {
                $fileAttachment = $request->file('profile_picture');
                $image_path = $fileAttachment->getPathname();
                $image_mime = $fileAttachment->getmimeType();
                $image_org = $fileAttachment->getClientOriginalName();
                $update = $this->client->request('POST', config('app.url_api') . '/profile/updateProfileNew', [
                    'headers' => [
                        // 'Accept' => 'application/json',
                        'Authorization' => 'Bearer ' . Session::get('token')
                    ],
                    'multipart' => [
                            [
                            'name' => 'user_id',
                            'contents' => Session::get('user_id')
                        ],
                            [
                            'name' => 'is_agent',
                            'contents' => Session::get('is_agent')
                        ],
                            [
                            'name' => 'phone_number',
                            'contents' => $request->phone_number
                        ],
                            [
                            'name' => 'name',
                            'contents' => $request->name
                        ],
                            [
                            'name' => 'npwp',
                            'contents' => $request->npwp
                        ],
                            [
                            'name' => 'profile_picture',
                            'filename' => $image_org,
                            'Mime-Type' => $image_mime,
                            'contents' => fopen($image_path, 'r'),
                        ]
                    ]
                ]);
            } else {
                $update = $this->client->request('POST', config('app.url_api') . '/profile/updateProfileNew', [
                    'headers' => [
                        // 'Accept' => 'application/json',
                        'Authorization' => 'Bearer ' . Session::get('token')
                    ],
                    'multipart' => [
                            [
                            'name' => 'user_id',
                            'contents' => Session::get('user_id')
                        ],
                            [
                            'name' => 'is_agent',
                            'contents' => Session::get('is_agent')
                        ],
                            [
                            'name' => 'phone_number',
                            'contents' => $request->phone_number
                        ],
                            [
                            'name' => 'npwp',
                            'contents' => $request->npwp
                        ],
                    ]
                ]);
            }
            $result = json_decode($update->getBody()->getContents(), true);
            if ($update->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $data = array(
                        'code' => 200,
                        'isSuccess' => true,
                        'message' => $result['message']
                    );
                    return redirect('/profile')->with(['success' => 'Profile successfully changed']);
                } else {
                    $data = array(
                        'code' => 200,
                        'isSucess' => false,
                        'message' => $result['message']
                    );
                }
            } else {
                $data = array(
                    'code' => $update->getStatusCode(),
                    'isSucess' => false,
                    'message' => $result['message']
                );
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $data = array(
                'code' => 500,
                'isSuccess' => false,
                'message' => $e->getMessage()
            );
        }
        return response()->json($data);
    }

    public function changePassword($request) {
        try {
            $changePassword = $this->client->request('POST', config('app.url_api') . '/auth/changePassword', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . Session::get('token')
                ],
                'form_params' => [
                    'user_id' => Session::get('user_id'),
                    "is_agent" => Session::get('is_agent'),
                    'old_password' => $request->old_password,
                    'new_password' => $request->new_password,
                    'confirm_password' => $request->confirm_password
                ]
            ]);
            $result = json_decode($changePassword->getBody()->getContents(), true);
            if ($changePassword->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $data = array(
                        'code' => 200,
                        'isSuccess' => true,
                        'message' => $result['message']
                    );
                } else {
                    $data = array(
                        'code' => 200,
                        'isSuccess' => false,
                        'message' => $result['message']
                    );
                }
            } else {
                $data = array(
                    'code' => $changePassword->getStatusCode(),
                    'isSuccess' => false,
                    'message' => $result['message']
                );
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $data = array(
                'code' => 500,
                'isSuccess' => false,
                'message' => $e->getMessage()
            );
        }
        return response()->json($data);
    }

    public function getHistoryTransaction($request) {
        try {
            $getTransaksi = $this->client->request('POST', config('app.url_api') . '/transaction', [
                'headers' => [
                    //'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . Session::get('token')
                ],
                'form_params' => [
                    "is_agent" => Session::get('is_agent'),
                    "user_id" => Session::get('user_id'),
                    "order_id" => $request->order_id,
                    "sort_by" => $request->sort_by
                ]
            ]);
            $result = json_decode($getTransaksi->getBody()->getContents(), true);
            if ($getTransaksi->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    usort($result['data'], function ($item1, $item2) {
                        return $item2['order_id'] <=> $item1['order_id'];
                    });
                    $this->data['transaksi'] = (Object) $result['data'];
                    $this->data['error_transaksi'] = "";
                } else {
                    $this->data['transaksi'] = array();
                    $this->data['error_transaksi'] = $result['message'];
                }
            } else {
                $this->data['transaksi'] = array();
                $this->data['error_transaksi'] = $result['message'];
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['transaksi'] = array();
            $this->data['error_transaksi'] = $e->getMessage();
        }
    }

    public function getAddress() {
        try {
            $getAddress = $this->client->request('GET', config('app.url_api') . '/profile/address/' . Session::get('user_id'), [
                'headers' => [
                    "Authorization" => "Bearer " . Session::get('token'),
                ],
                'form_params' => []
            ]);
            $result = json_decode($getAddress->getBody()->getContents(), true);
            if ($getAddress->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['address'] = (Object) $result['data'];
                    $this->data['error_address'] = "";
                } else {
                    $this->data['address'] = array();
                    $this->data['error_address'] = $result['message'];
                }
            } else {
                $this->data['address'] = array();
                $this->data['error_address'] = "Error code : " + $getAddress->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['address'] = array();
            $this->data['error_address'] = $e->getMessage();
        }
    }

    public function getAddressById($request) {
        try {
            $getAddress = $this->client->request('GET', config('app.url_api') . '/profile/detailAddress/' . $request->address_id, [
                'headers' => [
                    "Authorization" => "Bearer " . Session::get('token'),
                ],
                'form_params' => []
            ]);
            $result = json_decode($getAddress->getBody()->getContents(), true);
            if ($getAddress->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['address'] = (Object) $result['data'];
                    $this->data['address_id'] = $request->address_id;
                    $this->data['zip_code'] = $result['data']['zip_code'];
                    $this->data['error_address'] = "";
                } else {
                    $this->data['address'] = array();
                    $this->data['address_id'] = "";
                    $this->data['error_address'] = $result['message'];
                }
            } else {
                $this->data['address'] = array();
                $this->data['address_id'] = "";
                $this->data['error_address'] = "Error Code : " + $getAddress->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['address'] = array();
            $this->data['address_id'] = "";
            $this->data['error_address'] = $e->getMessage();
        }
    }

    public function getListJne($zip_code, $weight) {
        try {
//            $data = array(
//                "user_id" => Session::get('user_id'),
//                    "zip_code_dest" => $zip_code,
//                    'weight' => $weight,
//                'token' => "Bearer " . Session::get('token'),
//                'url' => config('app.url_api') . '/jne/getList'
//            );
//            dd($data);
//            dd("Bearer " . Session::get('token'));
            $getAddress = $this->client->request('POST', config('app.url_api') . '/jne/getList', [
                'headers' => [
                    'Accept' => 'application/json',
                    "Authorization" => "Bearer " . Session::get('token')
                ],
                'form_params' => [
                    "user_id" => Session::get('user_id'),
                    "zip_code_dest" => $zip_code,
                    'weight' => $weight
                ]
            ]);
            $result = json_decode($getAddress->getBody()->getContents(), true);
            if ($getAddress->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['jne'] = (Object) $result['data'];
                    $this->data['error_jne'] = "";
                } else {
                    $this->data['jne'] = array();
                    $this->data['error_jne'] = $result['message'];
                }
            } else {
                $this->data['jne'] = array();
                $this->data['error_jne'] = "Error Code : " + $getAddress->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['jne'] = array();
            $this->data['error_jne'] = $e->getMessage();
        }
    }
    
    public function getListAnterAja($zip_code, $weight){
        try {
//            dd("Bearer " . Session::get('token'));
//            $array = array(
//                'url' => config('app.url_api') . '/anterAja/getListAnterAja',
//                "user_id" => Session::get('user_id'),
//                    "zip_code_dest" => $zip_code,
//                    'weight' => $weight,
//                'token' => "Bearer " . Session::get('token')
//            );
//            dd($array);
            $fix_weight = $weight * 1000;
            if((int) $fix_weight < 1000){
                $fix_weight = 1000;
            }else{
                $fix_weight = (int) $fix_weight;
            }
            $getAddress = $this->client->request('POST', config('app.url_api') . '/anterAja/getListAnterAja', [
                'headers' => [
                    'Accept' => 'application/json',
                    "Authorization" => "Bearer " . Session::get('token')
                ],
                'form_params' => [
                    "user_id" => Session::get('user_id'),
                    "zip_code_dest" => $zip_code,
                    'weight' => $fix_weight
                ]
            ]);
            $result = json_decode($getAddress->getBody()->getContents(), true);
            if ($getAddress->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['anterAja'] = (Object) $result['data'];
                    $this->data['error_anterAja'] = "";
                } else {
                    $this->data['anterAja'] = array();
                    $this->data['error_anterAja'] = $result['message'];
                }
            } else {
                $this->data['anterAja'] = array();
                $this->data['error_anterAja'] = "Error Code : " + $getAddress->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['anterAja'] = array();
            $this->data['error_anterAja'] = $e->getMessage();
        }
    }

//    public function getTarifCodeDest($zip_code) {
//        try {
//            $getAddress = $this->client->request('POST', config('app.url_api') . '/jne/getTarifCodeByZip/', [
//                'headers' => [
//                    'Accept' => 'application/json',
//                    "Authorization" => "Bearer " . Session::get('token')
//                ],
//                'form_params' => [
//                    "zip_code" => $zip_code
//                ]
//            ]);
//            $result = json_decode($getAddress->getBody()->getContents(), true);
//            if ($getAddress->getStatusCode() == 200) {
//                if ($result['isSuccess'] == true) {
//                    $this->data['address'] = (Object) $result['data'];
//                    $this->data['address_id'] = $request->address_id;
//                    $this->data['zip_code'] = $result['data']['tarif_code'];
//                    $this->data['error_address'] = "";
//                } else {
//                    $this->data['address'] = array();
//                    $this->data['address_id'] = "";
//                    $this->data['error_address'] = $result['message'];
//                }
//            } else {
//                $this->data['address'] = array();
//                $this->data['address_id'] = "";
//                $this->data['error_address'] = "Error Code : " + $getAddress->getStatusCode();
//            }
//        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
//            $this->data['address'] = array();
//            $this->data['address_id'] = "";
//            $this->data['error_address'] = $e->getMessage();
//        }
//    }

    public function addAddress($request) {
        try {
            $add_address = $this->client->request('POST', config('app.url_api') . '/profile/addAddress', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . Session::get('token')
                ],
                'form_params' => [
                    "user_id" => Session::get('user_id'),
                    "is_agent" => Session::get('is_agent'),
                    // "address_id" => $request->address_id,
                    "address_name" => $request->address_name,
                    "address_detail" => $request->address_detail,
                    "contact_person" => $request->contact_person,
                    "phone_number" => $request->phone_number,
                    "gps_point" => $request->latitude . ',' . $request->longitude,
                    "address_info" => $request->address_info,
                    "kelurahan_desa_id" => $request->kelurahan_desa_id,
                    "kecamatan_id" => $request->kecamatan_id,
                    "kabupaten_kota_id" => $request->kabupaten_kota_id,
                    "provinsi_id" => $request->provinsi_id
                ]
            ]);

            $result = json_decode($add_address->getBody()->getContents(), true);
            if ($add_address->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $data = array(
                        'code' => 200,
                        'isSuccess' => true,
                        'message' => ""
                    );
                } else {
                    $data = array(
                        'code' => 200,
                        'isSuccess' => false,
                        'message' => $result['message']
                    );
                }
            } else {
                $data = array(
                    'code' => $add_address->getStatusCode(),
                    'isSuccess' => false,
                    'message' => $result['message']
                );
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $data = array(
                'code' => 500,
                'isSuccess' => false,
                'message' => $e->getMessage()
            );
        }
        return response()->json($data);
    }

    public function updateAddress($request) {
        try {
            $update = $this->client->request('POST', config('app.url_api') . '/profile/updateAddress', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . Session::get('token')
                ],
                'form_params' => [
                    "user_id" => Session::get('user_id'),
                    "address_id" => $request->address_id,
                    "address_name" => $request->address_name,
                    "address_detail" => $request->address_detail,
                    "contact_person" => $request->contact_person,
                    "phone_number" => $request->phone_number,
                    "gps_point" => $request->latitude . ',' . $request->longitude,
                    "address_info" => $request->address_info,
                    "kelurahan_desa_id" => $request->kelurahan_desa_id,
                    "kecamatan_id" => $request->kecamatan_id,
                    "kabupaten_kota_id" => $request->kabupaten_kota_id,
                    "provinsi_id" => $request->provinsi_id,
                    "is_agent" => Session::get('is_agent')
                ]
            ]);

            $result = json_decode($update->getBody()->getContents(), true);
            if ($update->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $data = array(
                        'code' => 200,
                        'isSuccess' => true,
                        'message' => $result['message']
                    );
                } else {
                    $data = array(
                        'code' => 200,
                        'isSuccess' => false,
                        'message' => $result['message']
                    );
                }
            } else {
                $data = array(
                    'code' => $Update->getStatusCode(),
                    'isSuccess' => false,
                    'message' => $result['message']
                );
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $data = array(
                'code' => 500,
                'isSuccess' => false,
                'message' => $e->getMessage()
            );
        }
        return response()->json($data);
    }

    public function getProvince() {
        try {
            $getProvinsi = $this->client->request('GET', config('app.url_api') . '/provinsi', [
                'headers' => [],
                'form_params' => []
            ]);
            $result = json_decode($getProvinsi->getBody()->getContents(), true);
            if ($getProvinsi->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['provinces'] = (Object) $result['data'];
                    $this->data['error_provinces'] = "";
                } else {
                    $this->data['provinces'] = array();
                    $this->data['error_provinces'] = $result['message'];
                }
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['provinces'] = array();
            $this->data['error_provinces'] = $e->getMessage();
        }
    }

    public function getKota($provinsi_id) {
        try {
            $getKota = $this->client->request('GET', config('app.url_api') . '/kabkota/' . $provinsi_id, [
                'headers' => [],
                'form_params' => []
            ]);
            $result = json_decode($getKota->getBody()->getContents(), true);
            if ($getKota->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['kota'] = (Object) $result['data'];
                    $this->data['error_kota'] = "";
                } else {
                    $this->data['kota'] = array();
                    $this->data['error_kota'] = $result['data'];
                }
            } else {
                $this->data['kota'] = array();
                $this->data['error_kota'] = "Error code : " + $getKota->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['kota'] = array();
            $this->data['error_kota'] = "Error code : " + $e->getMessage();
        }
    }

    public function getShipmentMethod() {
        try {
            $getShipment = $this->client->request('GET', config('app.url_api') . '/shipmentMethod', [
                'headers' => [],
                'form_params' => []
            ]);
            $result = json_decode($getShipment->getBody()->getContents(), true);
            if ($getShipment->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['shipment'] = (Object) $result['data'];
                    $this->data['error_shipment'] = "";
                } else {
                    $this->data['shipment'] = array();
                    $this->data['error_shipment'] = $result['message'];
                }
            } else {
                $this->data['shipment'] = array();
                $this->data['error_shipment'] = $getShipment->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['shipment'] = array();
            $this->data['error_shipment'] = $e->getMessage();
        }
    }

    public function getVoucher($request) {
        try {
            $getVoucher = $this->client->request('POST', config('app.url_api') . '/voucher', [
                'headers' => [
                    "Authorization" => "Bearer " . Session::get('token')
                ],
                'form_params' => [
                    "user_id" => Session::get('user_id'),
                    "voucher_code" => "",
                    "subtotal" => $request->subtotal
                ]
            ]);
            $result = json_decode($getVoucher->getBody()->getContents(), true);
            if ($getVoucher->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['voucher'] = (Object) $result['data'];
                    $this->data['error_vourcer'] = "";
                } else {
                    $this->data['voucher'] = array();
                    $this->data['error_vourcer'] = $result['message'];
                }
            } else {
                $this->data['voucher'] = array();
                $this->data['error_vourcer'] = "Error Code : " + $getVoucher->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['voucher'] = array();
            $this->data['error_vourcer'] = $e->getMessage();
        }
    }

    public function getPaymentMethod() {
        try {
            $getPaymentMethod = $this->client->request('GET', config('app.url_api') . '/paymentMethod'.'/'. Session::get('user_id'), [
                'headers' => [],
                'form_params' => []
            ]);
            $result = json_decode($getPaymentMethod->getBody()->getContents(), true);
            if ($getPaymentMethod->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['payment'] = (Object) $result['data'];
                    $this->data['error_payment'] = "";
                } else {
                    $this->data['payment'] = array();
                    $this->data['error_payment'] = $result['message'];
                }
            } else {
                $this->data['payment'] = array();
                $this->data['error_payment'] = $getPaymentMethod->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['payment'] = array();
            $this->data['error_payment'] = $e->getMessage();
        }
    }

    public function order($request) {
        try {
//            $zip_code_dest = $request->zip_code_dest;
//            $weight = $request->weight;
//            $qty = $request->qty;
//            $array = array(
//                "user_id" => Session::get('user_id'),
//                    "payment_method_id" => $request->payment_id,
//                    "data" => array([
//                            "warehouse_id" => $request->warehouse_id,
//                            "shipment_method_id" => $request->shipment_method_id,
//                            "shipment_price" => $request->shipment_method_price
//                        ]),
//                    "address_id" => $request->address_id,
//                    "voucher_id" => $request->voucher_id,
//                    "asuransi" => $request->asuransi,
//                    "is_agent" => Session::get('is_agent'),
//                    "cashback" => false,
//                    "use_balance" => $request->use_balance,
//                    "zip_code_dest" => $zip_code_dest,
//                    "weight" => $weight,
//                    "qty" => $qty,
//                    "shipment_method_name" => $request->shipment_method_name,
//                    "shipment_method_code" => $request->shipment_method_code,
//                    "shipment_method_providers" => $request->shipment_method_providers,
//                    "shipment_method_id" => $request->shipment_method_id
//            );
//            dd(json_encode($array));
            //order via jne
            $zip_code_dest = $request->zip_code_dest;
            $weight = $request->weight;
            $qty = $request->qty;
            $submit = $this->client->request('POST', config('app.url_api') . '/orderViaJne', [
                'headers' => [
                    "Accept" => "application/json",
                    "Authorization" => "Bearer " . Session::get('token')
                ],
                'form_params' => [
                    "user_id" => Session::get('user_id'),
                    "payment_method_id" => $request->payment_id,
                    "data" => array([
                            "warehouse_id" => $request->warehouse_id,
                            "shipment_method_id" => $request->shipment_method_id,
                            "shipment_price" => $request->shipment_method_price
                        ]),
                    "address_id" => $request->address_id,
                    "voucher_id" => $request->voucher_id,
                    "asuransi" => $request->asuransi,
                    "is_agent" => Session::get('is_agent'),
                    "cashback" => false,
                    "use_balance" => $request->use_balance,
                    "zip_code_dest" => $zip_code_dest,
                    "weight" => $weight,
                    "qty" => $qty,
                    "shipment_method_name" => $request->shipment_method_name,
                    "shipment_method_code" => $request->shipment_method_code,
                    "shipment_method_providers" => $request->shipment_method_providers,
                    "shipment_method_id" => $request->shipment_method_id,
                    "url_web" => url('/')
                ]
            ]);
            //order lama tanpa jne
//            $submit = $this->client->request('POST', config('app.url_api') . '/order', [
//                'headers' => [
//                    "Accept" => "application/json",
//                    "Authorization" => "Bearer " . Session::get('token')
//                ],
//                'form_params' => [
//                    "user_id" => Session::get('user_id'),
//                    "payment_method_id" => $request->payment_id,
//                    "data" => array([
//                            "warehouse_id" => $request->warehouse_id,
//                            "shipment_method_id" => $request->shipment_method_id,
//                            "shipment_price" => $request->shipment_method_price
//                        ]),
//                    "address_id" => $request->address_id,
//                    "voucher_id" => $request->voucher_id,
//                    "asuransi" => $request->asuransi,
//                    "is_agent" => Session::get('is_agent'),
//                    "cashback" => false,
//                    "use_balance" => $request->use_balance
//                ]
//            ]);
            $result = json_decode($submit->getBody()->getContents(), true);
            if ($submit->getStatusCode() == 200) {

                if ($result['isSuccess'] == true) {
                    $redirect_url = isset($result['redirect_url']) ? $result['redirect_url'] : url('/profile/history');
                    $data = array(
                        'code' => 200,
                        'isSuccess' => true,
                        'message' => $result['message'],
                        'redirect_url' => $redirect_url
                    );
                } else {
                    $redirect_url = isset($result['redirect_url']) ? $result['redirect_url'] : url('/profile/history');
                    $data = array(
                        'code' => 200,
                        'isSuccess' => false,
                        'message' => $result['message'],
                        'redirect_url' => $redirect_url
                    );
                }
            } else {
                $data = array(
                    'code' => $submit->getStatusCode(),
                    'isSuccess' => false,
                    'message' => $result['message']
                );
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $data = array(
                'code' => 500,
                'isSuccess' => false,
                'message' => $e->getMessage()
            );
        }
        return response()->json($data);
    }

    public function getTransaction($id) {
        try {
            $getTransaksi = $this->client->request('POST', config('app.url_api') . '/transaction', [
                'headers' => [
                    //'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . Session::get('token')
                ],
                'form_params' => [
                    "is_agent" => Session::get('is_agent'),
                    "user_id" => Session::get('user_id'),
                    "order_id" => $id,
                    "sort_by" => ''
                ]
            ]);
            $result = json_decode($getTransaksi->getBody()->getContents(), true);
            if ($getTransaksi->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['transaction_detail'] = (Object) $result['data'];
                    $this->data['address'] = (Object) $result['data']['destination_address'];
                    $this->data['payment_detail'] = (Object) $result['data']['detail_payment'];
                    $this->data['error_transaction'] = "";
                } else {
                    $this->data['transaction_detail'] = array();
                    $this->data['address'] = array();
                    $this->data['payment_detail'] = array();
                    $this->data['error_transaction'] = $result['message'];
                }
            } else {
                $this->data['transaction_detail'] = array();
                $this->data['address'] = array();
                $this->data['payment_detail'] = array();
                $this->data['error_transaction'] = "Error code : " + $getTransaksi->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['transaction_detail'] = array();
            $this->data['address'] = array();
            $this->data['payment_detail'] = array();
            $this->data['error_transaction'] = "Error code : " + $e->getMessage();
        }
    }

    public function getTransactionDetail($id) {
        try {
            $getTransactionDetail = $this->client->request('POST', config('app.url_api') . '/getPurchasedProduct', [
                'headers' => [
                    //'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . Session::get('token')
                ],
                'form_params' => [
                    "is_agent" => Session::get('is_agent'),
                    "user_id" => Session::get('user_id'),
                    "order_id" => $id,
                    "sort_by" => ''
                ]
            ]);
            $result = json_decode($getTransactionDetail->getBody()->getContents(), true);
            if ($getTransactionDetail->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['order_detail'] = (Object) $result['data'];
                    $this->data['error_order'] = "";
                } else {
                    $this->data['order_detail'] = array();
                    $this->data['error_order'] = $result['message'];
                }
            } else {
                $this->data['order_detail'] = array();
                $this->data['error_order'] = $getTransactionDetail->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['order_detail'] = array();
            $this->data['error_order'] = $e->getMessage();
        }
//        dd($this->data);
    }

    public function orderTracking($id) {
        try {
            $getTracking = $this->client->request('POST', config('app.url_api') . '/getTrackingHistory', [
                'headers' => [
                    //'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                // 'Authorization' => 'Bearer '. Session::get('token')
                ],
                'form_params' => [
                    // "is_agent" =>Session::get('is_agent'),
                    "user_id" => Session::get('user_id'),
                    "order_id" => $id
                ]
            ]);
            $result = json_decode($getTracking->getBody()->getContents(), true);
            if ($getTracking->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['order_tracking'] = (Object) $result['data'];
                    $this->data['error_order'] = "";
                } else {
                    $this->data['order_tracking'] = array();
                    $this->data['error_order'] = $result['message'];
                }
            } else {
                $this->data['order_tracking'] = array();
                $this->data['error_order'] = $getTracking->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['order_tracking'] = array();
            $this->data['error_order'] = $e->getMessage();
        }
    }

    public function getPaymentOrder($invoiceNo) {
        try {
            $getPaymentOrder = $this->client->request('GET', config('app.url_api') . '/getOrder/' . $invoiceNo, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . Session::get('token')
                ],
                'form_params' => []
            ]);
            $result = json_decode($getPaymentOrder->getBody()->getContents(), true);
            if ($getPaymentOrder->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['payment_order'] = (Object) $result['data'];
                    $this->data['error_payment'] = "";
                } else {
                    $this->data['payment_order'] = array();
                    $this->data['error_payment'] = $result['message'];
                }
            } else {
                $this->data['payment_order'] = array();
                $this->data['error_payment'] = $getPaymentOrder->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['payment_order'] = array();
            $this->data['error_payment'] = $e->getMessage();
        }
    }

    public function confirmOrder($request) {
        try {
            $confirm = $this->client->request('POST', config('app.url_api') . '/confirmOrder', [
                'headers' => [
                    "Accept" => "application/json",
                    "Authorization" => "Bearer " . Session::get('token')
                ],
                'form_params' => [
                    "user_id" => Session::get('user_id'),
                    "is_agent" => Session::get('is_agent'),
                    "order_id" => $request->id
                ]
            ]);
            $result = json_decode($confirm->getBody()->getContents(), true);
            if ($confirm->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $data = array(
                        'code' => 200,
                        'isSuccess' => true,
                        'message' => $result['message']
                    );
                } else {
                    $data = array(
                        'code' => 200,
                        'isSuccess' => false,
                        'message' => $result['message']
                    );
                }
            } else {
                $data = array(
                    'code' => $confirm->getStatusCode(),
                    'isSuccess' => false,
                    'message' => $result['message']
                );
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $data = array(
                'code' => 500,
                'isSuccess' => false,
                'message' => $e->getMessage()
            );
        }
        return response()->json($data);
    }

    public function getRekening() {
        //get Banner
        try {
            $getRekening = $this->client->request('GET', config('app.url_api') . '/rekening', [
                'headers' => [],
                'form_params' => []
            ]);
            $result = json_decode($getRekening->getBody()->getContents(), true);
            if ($getRekening->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['rekening'] = (Object) $result['data'];
                    $this->data['error_rekening'] = "";
                } else {
                    $this->data['rekening'] = array();
                    $this->data['error_rekening'] = $result['messages'];
                }
            } else {
                $this->data['rekening'] = array();
                $this->data['error_rekening'] = $getRekening->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['rekening'] = array();
            $this->data['error_rekening'] = $e->getMessage();
        }
    }

    public function getPembayaran($id) {
        try {
            $pembayaran = $this->client->request('POST', config('app.url_api') . '/getPembayaran', [
                'headers' => [],
                'form_params' => [
                    "order_id" => $id
                ]
            ]);
            $result = json_decode($pembayaran->getBody()->getContents(), true);
            // dd($result);
            if ($pembayaran->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['pembayaran'] = (Object) $result['data'];
                    $this->data['error_pembayaran'] = "";
                } else {
                    $this->data['pembayaran'] = array();
                    $this->data['error_pembayaran'] = $result['messages'];
                }
            } else {
                $this->data['pembayaran'] = array();
                $this->data['error_pembayaran'] = $pembayaran->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['pembayaran'] = array();
            $this->data['error_pembayaran'] = $e->getMessage();
        }
    }

    public function updatePembayaran(Request $request) {
        try {
            if ($file = $request->file('upload_pembayaran')) {
                $fileAttachment = $request->file('upload_pembayaran');
                $image_path = $fileAttachment->getPathname();
                $image_mime = $fileAttachment->getmimeType();
                $image_org = $fileAttachment->getClientOriginalName();
                if ($image_mime === 'image/jpeg' || $image_mime === 'image/png' || $image_mime === 'image/jpeg') {
                    $update = $this->client->request('POST', config('app.url_api') . '/uploadPembayaran', [
                        'headers' => [],
                        'multipart' => [
                                [
                                'name' => 'order_id',
                                'contents' => $request->order_id
                            ],
                                [
                                'name' => 'upload_pembayaran',
                                'filename' => $image_org,
                                'Mime-Type' => $image_mime,
                                'contents' => fopen($image_path, 'r'),
                            ]
                        ]
                            ]
                    );
                    $result = json_decode($update->getBody()->getContents(), true);
                    if ($update->getStatusCode() == 200) {
                        if ($result['isSuccess'] == true) {
                            $data = array(
                                'code' => 200,
                                'isSuccess' => true,
                                'message' => $result['message']
                            );
                            return redirect('/profile/detailOrder/' . $request->order_id . '/' . $request->billing_code)->with(['success' => 'Pembayaran berhasil di Upload']);
                        } else {
                            $data = array(
                                'code' => 200,
                                'isSucess' => false,
                                'message' => $result['message']
                            );
                            return redirect('/profile/detailOrder/' . $request->order_id . '/' . $request->billing_code)->with(['failed' => $result['message']]);
                        }
                    } else {
                        $data = array(
                            'code' => $update->getStatusCode(),
                            'isSucess' => false,
                            'message' => $result['message']
                        );
                        return redirect('/profile/detailOrder/' . $request->order_id . '/' . $request->billing_code)->with(['failed' => $result['message']]);
                    }
                } else {
                    return redirect('/profile/detailOrder/' . $request->order_id . '/' . $request->billing_code)->with(['failed' => 'Extension yang diperbolehkan hanya jpg, jpeg dan png']);
                }
            } else {
                $data = array(
                    'code' => 200,
                    'isSucess' => false,
                    'message' => 'Harap pilih file terlebih dahulu'
                );
                return redirect('/profile/detailOrder/' . $request->order_id . '/' . $request->billing_code)->with(['failed' => 'Harap pilih file terlebih dahulu']);
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $data = array(
                'code' => 500,
                'isSuccess' => false,
                'message' => $e->getMessage()
            );
            return redirect('/profile/detailOrder/' . $request->order_id . '/' . $request->billing_code)->with(['failed' => $e->getMessage()]);
        }
//        return response()->json($data);
    }

    public function getChatByUserId($user_id) {
        try {
            $getHeader = $this->client->request('GET', config('app.url_api') . '/getChatByUserId/' . $user_id, [
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'form_params' => []
            ]);
            $result = json_decode($getHeader->getBody()->getContents(), true);
            if ($getHeader->getStatusCode() == 200) {
                if ($result['status'] == 200) {
                    $this->data['chat'] = (Object) $result['data'];
                    $this->data['error_chat'] = "";
                } else {
                    $this->data['chat'] = array();
                    $this->data['error_chat'] = $result['messages'];
                }
            } else {
                $this->data['chat'] = array();
                $this->data['error_chat'] = $getHeader->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['chat'] = array();
            $this->data['error_chat'] = $e->getMessage();
        }
    }

    public function getAsuransi() {
        try {
            $getAsuransi = $this->client->request('GET', config('app.url_api') . '/asuransi', [
                'headers' => [],
                'form_params' => []
            ]);
            $result = json_decode($getAsuransi->getBody()->getContents(), true);
            if ($getAsuransi->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['insurance'] = (Object) $result['data'];
                    $this->data['error_insurance'] = "";
                } else {
                    $this->data['insurance'] = array();
                    $this->data['error_insurance'] = $result['message'];
                }
            } else {
                $this->data['insurance'] = array();
                $this->data['error_insurance'] = $getAsuransi->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['insurance'] = array();
            $this->data['error_insurance'] = $e->getMessage();
        }
    }

    public function getProductById($id) {
        try {
            $getProduct = $this->client->request('POST', config('app.url_api') . '/productbyid/0', [
                'headers' => [
                    "Accept" => "application/json"
                ],
                'form_params' => [
                    "product_id" => $id,
                    "user_id" => Session::get('user_id'),
                ]
            ]);
            $result = json_decode($getProduct->getBody()->getContents(), true);

            if ($getProduct->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['product'] = $result['data'];
                    $this->data['error_product'] = "";
                } else {
                    $this->data['product'] = array();
                    $this->data['error_product'] = $result['messages'];
                }
            } else {
                $this->data['product'] = array();
                $this->data['error_product'] = $getProduct->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['product'] = array();
            $this->data['error_product'] = $e->getMessage();
        }
//        dd($this->data['product']);
    }

    public function getTotalChat() {
        try {
            $getHeader = $this->client->request('GET', config('app.url_api') . '/getTotalChatByUserId/' . Session::get('user_id'), [
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'form_params' => []
            ]);
            $result = json_decode($getHeader->getBody()->getContents(), true);
            if ($getHeader->getStatusCode() == 200) {
                if ($result['status'] == 200) {
                    $this->data['total_chat'] = $result['data'];
                    $this->data['error_total_chat'] = "";
                } else {
                    $this->data['total_chat'] = 0;
                    $this->data['error_total_chat'] = $result['messages'];
                }
            } else {
                $this->data['total_chat'] = 0;
                $this->data['error_total_chat'] = $getHeader->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['total_chat'] = 0;
            $this->data['error_total_chat'] = $e->getMessage();
        }
    }

    public function updateTotalChat() {
        try {
            $getHeader = $this->client->request('GET', config('app.url_api') . '/updateTotalChatByUserId/' . Session::get('user_id'), [
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'form_params' => []
            ]);
            $result = json_decode($getHeader->getBody()->getContents(), true);
            if ($getHeader->getStatusCode() == 200) {
                if ($result['status'] == 200) {
                    $this->data['update_chat'] = 'success';
                    $this->data['error_update_chat'] = "";
                } else {
                    $this->data['update_chat'] = 'gagal';
                    $this->data['error_update_chat'] = $result['messages'];
                }
            } else {
                $this->data['update_chat'] = 'gagal';
                $this->data['error_update_chat'] = $getHeader->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['update_chat'] = 'gagal';
            $this->data['error_update_chat'] = $e->getMessage();
        }
    }

    public function getCategoryComplaint() {
        try {
            $getHeader = $this->client->request('POST', config('app.url_api') . '/complaint/category', [
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'form_params' => []
            ]);
            $result = json_decode($getHeader->getBody()->getContents(), true);
            if ($getHeader->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['issue_category'] = (Object) $result['data'];
                    $this->data['error_issue_category'] = "";
                } else {
                    $this->data['issue_category'] = array();
                    $this->data['error_issue_category'] = $result['messages'];
                }
            } else {
                $this->data['issue_category'] = array();
                $this->data['error_issue_category'] = $getHeader->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['issue_category'] = array();
            $this->data['error_issue_category'] = $e->getMessage();
        }
    }

    public function getComplaintSolution() {
        try {
            $getHeader = $this->client->request('POST', config('app.url_api') . '/solution', [
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'form_params' => []
            ]);
            $result = json_decode($getHeader->getBody()->getContents(), true);
            if ($getHeader->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['issue_solution'] = (Object) $result['data'];
                    $this->data['error_issue_solution'] = "";
                } else {
                    $this->data['issue_solution'] = array();
                    $this->data['error_issue_solution'] = $result['messages'];
                }
            } else {
                $this->data['issue_solution'] = array();
                $this->data['error_issue_solution'] = $getHeader->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['issue_solution'] = array();
            $this->data['error_issue_solution'] = $e->getMessage();
        }
//        dd($this->data);
    }

    public function insertComplaint(Request $request) {
        $data = array(
            'user_id' => Session::get('user_id'),
            'order_id' => $request->order_id,
            'issue_solution' => $request->issue_solution,
            'products' => array(),
            'complain_pict' => array()
        );


        for ($i = 0; $i < count($request->product_id); $i++) {
            if (($request->issue_category[$i] != '' || $request->issue_category[$i] != null) || ($request->notes[$i] != '' || $request->notes[$i] != '')) {
                $arr = array(
                    'product_id' => $request->product_id[$i],
                    'product_qty' => $request->product_qty[$i],
                    'issue_category' => $request->issue_category[$i],
                    'notes' => $request->notes[$i]
                );
                array_push($data['products'], $arr);
            }
        }

        for ($x = 0; $x < count($request->complain_pict); $x++) {
            $path = $request->complain_pict[$x];
            $type = $path->getClientMimeType();
            $file = file_get_contents($path);
            $base64 = 'data:' . $type . ';base64,' . base64_encode($file);
            array_push($data['complain_pict'], $base64);
        }

        try {
            $sendComplaint = $this->client->request('POST', config('app.url_api') . '/complain', [
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'form_params' => $data
            ]);
            $resultComplaint = json_decode($sendComplaint->getBody()->getContents(), true);
            if ($sendComplaint->getStatusCode() == 200) {
                if ($resultComplaint['isSuccess'] == true) {
                    $this->data['complaint'] = "success";
                    $this->data['error_complaint'] = "";

                    Session::flash('success_complaint', 'Complain berhasil dikirim!');
                } else {
                    $this->data['complaint'] = "failed";
                    $this->data['error_complaint'] = $resultComplaint['messages'];
                    Session::flash('error_complaint', 'Complain gagal dikirim!');
                }
            } else {
                $this->data['complaint'] = "error";
                $this->data['error_complaint'] = $sendComplaint->getStatusCode();
                Session::flash('error_complaint', 'Complain gagal dikirim!');
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['complaint'] = "error";
            $this->data['error_complaint'] = $e->getMessage();
            Session::flash('error_complaint', 'Complain gagal dikirim!');
        }
    }

    public function getHistoryComplaint() {
        try {
            $getComplaintHistory = $this->client->request('POST', config('app.url_api') . '/getComplaintHistory', [
                'headers' => [
                    //'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . Session::get('token')
                ],
                'form_params' => [
                    "is_agent" => Session::get('is_agent'),
                    "user_id" => Session::get('user_id')
                ]
            ]);

            $result = json_decode($getComplaintHistory->getBody()->getContents(), true);
            if ($getComplaintHistory->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['complaint_history'] = (Object) $result['data'];
                    $this->data['error_transaksi'] = "";
                } else {
                    $this->data['complaint_history'] = array();
                    $this->data['error_transaksi'] = $result['message'];
                }
            } else {
                $this->data['complaint_history'] = array();
                $this->data['error_transaksi'] = $result['message'];
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['complaint_history'] = array();
            $this->data['error_transaksi'] = $e->getMessage();
        }
    }

    public function getDetailComplaint($issue_id) {
        try {
            $getComplaintDetail = $this->client->request('POST', config('app.url_api') . '/getComplaintDetail', [
                'headers' => [
                    //'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . Session::get('token')
                ],
                'form_params' => [
                    "user_id" => Session::get('user_id'),
                    "issue_id" => $issue_id
                ]
            ]);

            $result = json_decode($getComplaintDetail->getBody()->getContents(), true);
            if ($getComplaintDetail->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['complaint_detail'] = (Object) $result['data'];
                    $this->data['error_transaksi'] = "";
                } else {
                    $this->data['complaint_detail'] = array();
                    $this->data['error_transaksi'] = $result['message'];
                }
            } else {
                $this->data['complaint_detail'] = array();
                $this->data['error_transaksi'] = $result['message'];
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['complaint_detail'] = array();
            $this->data['error_transaksi'] = $e->getMessage();
        }
    }

    public function getSaldo() {
        //get Banner
        try {
            $getSaldo = $this->client->request('POST', config('app.url_api') . '/getSaldo', [
                'headers' => [
                    //'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . Session::get('token')
                ],
                'form_params' => [
                    "user_id" => Session::get('user_id')
                ]
            ]);
            $result = json_decode($getSaldo->getBody()->getContents(), true);
            if ($getSaldo->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['saldo'] = (Object) $result['data'];
                    $this->data['error_saldo'] = "";
                } else {
                    $this->data['saldo'] = array();
                    $this->data['error_saldo'] = $result['messages'];
                }
            } else {
                $this->data['saldo'] = array();
                $this->data['error_saldo'] = $getSaldo->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['saldo'] = array();
            $this->data['error_saldo'] = $e->getMessage();
        }
    }
    
    public function getTracing($id, $shipment_method_id) {
        try {
            $getTransaksi = $this->client->request('POST', config('app.url_api') . '/shipment/tracing', [
                'headers' => [
                    //'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . Session::get('token')
                ],
                'form_params' => [
                    "is_agent" => Session::get('is_agent'),
                    "user_id" => Session::get('user_id'),
                    "order_id" => $id,
                    "shipment_method_id" => $shipment_method_id
                ]
            ]);
            $result = json_decode($getTransaksi->getBody()->getContents(), true);
            if ($getTransaksi->getStatusCode() == 200) {
                if ($result['isSuccess'] == true) {
                    $this->data['tracing'] = (Object) $result['data'];
                    $this->data['shipment_method_id'] = $shipment_method_id;
                    $this->data['error_tracing'] = "";
                } else {
                    $this->data['tracing'] = array();
                    $this->data['shipment_method_id'] = $shipment_method_id;
                    $this->data['error_tracing'] = $result['message'];
                }
            } else {
                $this->data['tracing'] = array();
                $this->data['shipment_method_id'] = $shipment_method_id;
                $this->data['error_tracing'] = "Error code : " + $getTransaksi->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['tracing'] = array();
            $this->data['shipment_method_id'] = $shipment_method_id;
            $this->data['error_tracing'] = "Error code : " + $e->getMessage();
        }
    }
    
    public function courierMerge($jne, $anterAja){
        $data = array();
        $dataJne = (array) $jne;
        if (array_key_exists('services', $anterAja)) {
            $dataAnteraja = (array) $anterAja->services;
        }else{
            $dataAnteraja = array();
        }
        try{
            if(count($dataJne) > 0){
                $arrJne = array(
                    'id' => '17',
                    'providers' => 'JNE', 
                    'data' => $dataJne
                );
                array_push($data, $arrJne);
            }
            if(count($dataAnteraja) > 0){
                $arrAnteraja = array(
                    'id' => '18',
                    'providers' => 'Anter Aja', 
                    'data' => $dataAnteraja,
                );
                array_push($data, $arrAnteraja);
            }
            $this->data['allCourier'] = (Object) $data;
            $this->data['error_allCourier'] = "";
        }catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['allCourier'] = array();
            $this->data['error_allCourier'] = "Error code : " + $e->getMessage();
        }
    }

}

?>