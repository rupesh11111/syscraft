<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DatatableController extends Controller
{
    public function customers()
    {
        if (request('data')) {
            $data = User::select('id', 'name', 'email')->whereHas('role', fn ($q) => $q->whereName('customer'))->get();
            return datatables()->of($data)->make(true);
        }
        $data['url'] = 'customers';
        $data['heading'] = 'Customer';
        $data['subHeading'] = 'List of all customers';
        $data['tableHeadings'] = ['ID', 'Name', 'Email'];
        $data['url'] = 'customers';
        $data['columns'] = json_encode([
            [
                "data" => "id",
                "name" => "id",
            ],
            [
                "data" => "name",
                "name" => "name",
            ],
            [
                "data" => "email",
                "name" => "email",
            ],
        ]);
        return response()->json([
            'status' => true,
            'data' => view('table', $data)->render()
        ]);
    }

    public function vendors()
    {
        if (request('data')) {
            $data = User::select('id', 'name', 'email')->whereHas('role', fn ($q) => $q->whereName('vendor'))->get();
            return datatables()->of($data)->make(true);
        }
        $data['url'] = 'customers';
        $data['heading'] = 'Customer';
        $data['subHeading'] = 'List of all customers';
        $data['tableHeadings'] = ['ID', 'Name', 'Email'];
        $data['url'] = 'vendors';
        $data['columns'] = json_encode([
            [
                "data" => "id",
                "name" => "id",
            ],
            [
                "data" => "name",
                "name" => "name",
            ],
            [
                "data" => "email",
                "name" => "email",
            ],
        ]);
        return response()->json([
            'status' => true,
            'data' => view('table', $data)->render()
        ]);
    }

    public function products()
    {
        if (request('data')) {
            $data = Product::select('id', 'name', 'price', 'image')->get();
            return datatables()->of($data)->make(true);
        }
        $data['url'] = 'products';
        $data['tableHeadings'] = ['ID', 'Image', 'Name', 'Price'];
        $data['columns'] = json_encode([
            [
                "data" => "id",
                "name" => "id",
            ],
            [
                "data" => "image",
                "name" => "image",
                "render" => function ($data, $type, $full, $meta) {
                    return 'rupesh';
                }
            ],
            [
                "data" => "name",
                "name" => "name",
            ],
            [
                "data" => "price",
                "name" => "price",
            ],
        ]);
        return response()->json([
            'status' => true,
            'data' => view('table', $data)->render()
        ]);
    }

    public function orders()
    {
        if (request('data')) {
            $data = Order::select('id', 'name', 'email')->with('user')->get();
            return datatables()->of($data)->make(true);
        }
        $data['tableHeadings'] = ['ID', 'Name', 'Email'];

        $data['url'] = 'orders';
        $data['columns'] = json_encode([
            [
                "data" => "id",
                "name" => "id",
            ],
            [ 
                "data" => "name",
                "name" => "name",
            ],
            [
                "data" => "email",
                "name" => "email",
            ],
        ]);
        return response()->json([
            'status' => true,
            'data' => view('table', $data)->render()
        ]);
    }

    public function transactions()
    {
        if (request('data')) {
            $data = Order::select('id', 'name', 'email')->get();
            return datatables()->of($data)->make(true);
        }
        $data['tableHeadings'] = ['ID', 'Name', 'Email'];

        $data['url'] = 'transactions';
        $data['columns'] = json_encode([
            [
                "data" => "id",
                "name" => "id",
            ],
            [
                "data" => "name",
                "name" => "name",
            ],
            [
                "data" => "Price",
                "name" => "email",
            ],
        ]);
        return response()->json([
            'status' => true,
            'data' => view('table', $data)->render()
        ]);
    }
}
