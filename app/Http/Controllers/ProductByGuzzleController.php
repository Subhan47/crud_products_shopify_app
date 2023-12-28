<?php

namespace App\Http\Controllers;

use GuzzleHttp\Utils;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class ProductByGuzzleController extends Controller
{
    protected $shopifyDomain, $shopifyAccessToken, $client;

    public function __construct(){
        $this->shopifyDomain = env('SHOPIFY_DOMAIN');
        $this->shopifyAccessToken = env('SHOPIFY_ACCESS_TOKEN');

        $this->client = new Client([
            'base_uri' => "https://$this->shopifyDomain/admin/api/2023-10/",
            'headers' => [
                'X-Shopify-Access-Token' => $this->shopifyAccessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */

    public function index()
    {
//        $token = Auth::user()->api();
//        dd($token);
        try {
            $response = $this->client->request('GET', 'products.json');
            $products = json_decode($response->getBody(), true)['products'];
            //dd($products);
            return view('products.index', compact('products'));
        }
        catch (\Exception $e) {
           return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $product = [
                'product' => [
                    'title' => 'New product by subhan',
                    'body_html' => "<strong>Good Book!</strong>",
                    'vendor' => 'Admin',
                    'product_type' => 'Books',
                    'status' => 'draft'
                ],
            ];

            $response = $this->client->request('POST', 'products.json', [
                'json' => $product,
            ]);

           dd($response);

        }
        catch (\Exception $e){
            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
       try{
           $productID = $id;
           $response = $this->client->request('GET', "products/$productID.json");
           $product = json_decode($response->getBody(), true)['product'];
           return response()->json(['product' => $product]);
       }
       catch (\Exception $e){
           return response()->json($e->getMessage());
       }
    }

    public function productsCount(Request $request): void
    {
        try{
            $response = $this->client->request('GET', "products/count.json");
            $count = json_decode($response->getBody(), true)['count'];
            echo 'Count of Products is : ' . $count . '<br>';
        }
        catch (\Exception $e){
            dd($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
            $productID = 9006826094905;
            $updateData = [
                'product' => [
                    'title' => 'Updated Product Title'
                ],
            ];
            $response = $this->client->request('PUT', "products/$productID.json",[
                'json' => $updateData,
            ]);
            dd($response);
        }
        catch (\Exception $e){
            dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        try{
            $productID = 9006826094905;
            $response = $this->client->request('DEL', "products/$productID.json");
            dd($response);
        }
        catch (\Exception $e){
            dd($e->getMessage());
        }
    }
}
