<?php

namespace App\Http\Controllers;

use App\Traits\ValidateRequestTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    use ValidateRequestTrait;
    /**
     * Display a listing of the products.
     * Calls the shopify rest API to get all Products
     * @return Application|Factory|View
     */
    public function index()
    {
        try{
            $shop = Auth::user()->api()->rest('GET', 'admin/api/2023-10/products.json');
            $products = collect($shop['body']['products']);
            $products = $this->paginate($products, 6);
            if(@request()->get('page')){
                return view('partials.products', compact('products'));
            }

            return view('products.index', compact('products'));
        }
        catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validator = $this->validateProductStoreRequest($request);
        if ($validator->fails()) {
            $validationErrors = implode(', ', $validator->errors()->all());
            return response()->json(['error' => $validationErrors], 400);
        }

        try{
           // $image = @$request->hasFile('image') ? $request->file('image') : null;
            $product = [
                'product' => [
                    'title' => $request['title'],
                    'body_html' => $request['body_html'],
                    'vendor' => $request['vendor'],
                    'product_type' => $request['product_type'],
                    'status' => $request['status'],
                   // 'image' => $image
                ],
            ];
            $shop = Auth::user()->api()->rest('POST', 'admin/api/2023-10/products.json', [
                'json' => $product
            ]);
            if ($shop['status'] == 201) {
                return response()->json(['success' => 'Product Successfully Inserted'], 201);
            } else {
                $errorMessages = implode('. ', (array) $shop['body']['status']);
                return response()->json(['error' => $errorMessages], 400);
            }


            return response()->json(['success' => 'Product Successfully Inserted']);

        }
        catch (\Exception $e){
            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        try{
            $productID = $id;
            $shop = Auth::user()->api()->rest('GET', "admin/api/2023-10/products/$productID.json");
            if ($shop['status'] == 200) {
                $product = $shop['body']['product'];
                return view('products.show', compact('product'));
            } else {
                return response()->json(['error' => 'Something went wrong'], 400);
            }
        }
        catch (\Exception $e){
            return response()->json($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        try{
            $productID = $id;
            $shop = Auth::user()->api()->rest('GET', "admin/api/2023-10/products/$productID.json");
            if ($shop['status'] == 200) {
                $product = $shop['body']['product'];
                return view('products.edit', compact('product'));
            } else {
                return response()->json(['error' => 'Something went wrong'], 400);
            }
        }
        catch (\Exception $e){
            return response()->json($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $validator = $this->validateProductUpdateRequest($request);
        if ($validator->fails()) {
            $validationErrors = implode(', ', $validator->errors()->all());
            return response()->json(['error' => $validationErrors], 400);
        }
        try{
            $productID = $request['id'];
           // $image = @$request->hasFile('image') ? $request->file('image') : null;
            $product = [
                'product' => [
                    'title' => $request['title'],
                    'body_html' => $request['body_html'],
                    'vendor' => $request['vendor'],
                    'product_type' => $request['product_type'],
                    'status' => $request['status'],
                    // 'image' => $image
                ],
            ];

            $shop = Auth::user()->api()->rest('PUT', "admin/api/2023-10/products/$productID.json", [
                'json' => $product
            ]);
            if ($shop['status'] == 200) {
                return response()->json(['success' => 'Product Updated Successfully'], 200);
            } else {
                $errorMessages = implode('. ', (array) $shop['body']['status']);
                return response()->json(['error' => $errorMessages], 400);
            }


        }
        catch (\Exception $e){
            dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        try{
            $productID = $id;
            $shop = Auth::user()->api()->rest('DELETE', "admin/api/2023-10/products/$productID.json");

            if ($shop['status'] == 200) {
                return response()->json(['success' => 'Product Deleted Successfully'], 200);
            } else {
                return response()->json(['error' => 'Something Went Wrong'], 400);
            }

           }
        catch (\Exception $e){
            dd($e->getMessage());
        }
    }
}
