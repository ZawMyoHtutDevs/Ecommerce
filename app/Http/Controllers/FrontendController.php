<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    // Home Page
    public function index(){
        $latest_products = Product::orderby('updated_at', 'desc')->limit(8)->get();
        $featured_products = Product::orderby('updated_at', 'desc')->limit(9)->get();
        return view('frontend.index', compact('latest_products', 'featured_products'));
    }

    // About Page
    public function about(){
        return view('frontend.about');
    }

    // Contact Page
    public function contact(){
        return view('frontend.contact');
    }

    // Shop Page
    public function shop(){
        $products = Product::orderby('updated_at', 'desc')->paginate(9);
        $featured_products = Product::orderby('updated_at', 'desc')->limit(3)->get();
        $categories_data = Category::where('parent_id', NULL)->orderby('order', 'asc')->get();
        return view('frontend.shop', compact('products', 'categories_data', 'featured_products'));
    }

    // Shop Detail Page
    public function shopDetail($permalink){
        $product = Product::where('permalink', $permalink)->first();
        $category_products = Product::where('category_id', '=', $product->category->id)
                    ->orderby('updated_at', 'desc')->limit(9)->get();
        return view('frontend.shop_detail', compact('product', 'category_products'));
    }

    // Category item Page
    public function categoryItem($permalink){
        $category = Category::where('permalink', $permalink)->first();
        // $products = $category->products()->orderby('updated_at', 'desc')->paginate(9);
        $products = Product::where('category_id', '=', $category->id)
                    ->orderby('updated_at', 'desc')->paginate(9);

        $featured_products = Product::orderby('updated_at', 'desc')->limit(3)->get();
        $categories_data = Category::where('parent_id', NULL)->orderby('order', 'asc')->get();
        return view('frontend.category_item', compact('category', 'products', 'categories_data', 'featured_products'));
    }


    // Shop Page
    public function myAccount(){
        $products = Product::orderby('updated_at', 'desc')->get();
        return view('frontend.index', compact('products'));
    }

    public function cart()
    {
        return view('frontend.cart');

    }


    public function addToCart($id)

    {

        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;

        } else {

            $cart[$id] = [

                "name" => $product->name,

                "quantity" => 1,

                "price" => $product->price,

                "asset" => $product->asset

            ];

        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function buyNow($id)

    {

        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;

        } else {

            $cart[$id] = [

                "name" => $product->name,

                "quantity" => 1,

                "price" => $product->price,

                "asset" => $product->asset

            ];

        }

        session()->put('cart', $cart);

        return redirect()->route('checkout')->with('success', 'Product added to cart successfully!');
    }

  

    public function update(Request $request)
    {

        if($request->id && $request->quantity){

            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            session()->flash('success', 'Cart updated successfully');
        }

    }



    public function remove(Request $request)
    {

        if($request->id) {

            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);

            }

            session()->flash('success', 'Product removed successfully');

        }

    }

    public function checkout()
    {
        $products = Product::all();
        return view('frontend.checkout', compact('products'));
    }
}
