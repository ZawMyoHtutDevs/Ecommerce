<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts_data = Discount::orderby('updated_at', 'asc')->get();
        return view('products.discounts.index', compact('discounts_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products_data = Product::select('id','name','discount_id', 'price')->whereNull('discount_id')->orderby('updated_at', 'asc')->get();
        return view('products.discounts.create', compact('products_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    $status = $request->status;
    $discount = new Discount();

    switch ($status) {
        case 'fit price':
            
            $product = Product::find($request->fit_product_id);

            $validated = $request->validate([
                'name' => 'required|max:255',
                'status' => 'required|max:255',
                'discount_price' => 'numeric|min:0|max:'.$product->price,
            ]
            ,[
                'name.required' => 'Discount နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
                'status.required' => 'Discount Type ထည့်ပေးရန် လိုအပ်ပါသည်။',
            ]
        );
            
            // fit Price Discount
            $discount->name = $request->name;
            $discount->description = $request->description;
            $discount->discount_price = $request->discount_price;
            $discount->status = $status;

            $discount->save();

            // Save Product
            $product->discount_id = $discount->id;
            $product->save();

            return redirect()->route("discounts.index")->with('success','(' . $request->name.') Discount ကို ကိုထည့်သွင်းပြီးပါပြီ။');

            break;
        case 'percentage price';

            $validated = $request->validate([
                'name' => 'required|max:255',
                'status' => 'required|max:255',
                'discount_percent' => 'required',
            ]
            ,[
                'name.required' => 'Discount နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
                'status.required' => 'Discount Type ထည့်ပေးရန် လိုအပ်ပါသည်။',
            ]
        );
            // Percentage Price Discount
            $discount->name = $request->name;
            $discount->description = $request->description;
            $discount->discount_percent = $request->discount_percent;
            $discount->status = $status;

            $discount->save();

            foreach ($request->percentage_product_id as $value) {
                $product = Product::find($value);
                $product->discount_id = $discount->id;
                $product->save();
            }
            

            return redirect()->route("discounts.index")->with('success','(' . $request->name.') Discount ကို ကိုထည့်သွင်းပြီးပါပြီ။');

            break;
        case 'free gif':
            
            $validated = $request->validate([
                'name' => 'required|max:255',
                'status' => 'required|max:255',
            ]
            ,[
                'name.required' => 'Discount နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
                'status.required' => 'Discount Type ထည့်ပေးရန် လိုအပ်ပါသည်။',
            ]
        );
            // Free Gif Discount
            $discount->name = $request->name;
            $discount->description = $request->description;
            $discount->gif_products_id = implode(" - ", $request->gif_products_id);
            $discount->status = $status;


            $discount->save();

            $product = Product::find($request->gif_single_product_id);
            $product->discount_id = $discount->id;
            $product->save();
            

            return redirect()->route("discounts.index")->with('success','(' . $request->name.') Discount ကို ကိုထည့်သွင်းပြီးပါပြီ။');


            break;
        case 'free shipping':

            $validated = $request->validate([
                'name' => 'required|max:255',
                'status' => 'required|max:255',
            ]
            ,[
                'name.required' => 'Discount နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
                'status.required' => 'Discount Type ထည့်ပေးရန် လိုအပ်ပါသည်။',
            ]
        );
            // Free Shipping Discount
            $discount->name = $request->name;
            $discount->description = $request->description;
            $discount->status = $status;
            $discount->save();

            foreach ($request->free_ship_products_id as $value) {
                $product = Product::find($value);
                $product->discount_id = $discount->id;
                $product->save();
            }

            return redirect()->route("discounts.index")->with('success','(' . $request->name.') Discount ကို ကိုထည့်သွင်းပြီးပါပြီ။');
            break;
        case 'buy one get one':
                
            $validated = $request->validate([
                'name' => 'required|max:255',
                'status' => 'required|max:255',
            ]
            ,[
                'name.required' => 'Discount နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
                'status.required' => 'Discount Type ထည့်ပေးရန် လိုအပ်ပါသည်။',
            ]
        );
            // Buy one Get one Discount
            $discount->name = $request->name;
            $discount->description = $request->description;
            $discount->status = $status;


            $discount->save();

            $product = Product::find($request->get_one_product_id);
            $product->discount_id = $discount->id;
            $product->save();
            

            return redirect()->route("discounts.index")->with('success','(' . $request->name.') Discount ကို ကိုထည့်သွင်းပြီးပါပြီ။');

            break;
        default:
            // Error Return
            return redirect()->back()->with('Discount Type သေချာ ရွေးချယ်ပေးရန်');

            break;
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show(Discount $discount)
    // {
    //     return view('products.discounts.show', compact('discount'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        $products_data = Product::select('id','name','discount_id', 'price')->whereNull('discount_id')->orderby('updated_at', 'asc')->get();

        return view('products.discounts.update', compact('discount', 'products_data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
