<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    // check Status
    public function status($data)
    {
        if($data == 'on'){

            $update_currency = Currency::where('status', '=', '1')->get();

            foreach ($update_currency as $item) {
                $update = Currency::find($item->id);
                $update->status = '0';
                $update->save();
            }
            return 1;
        }else{
            return 0;
        }
    }


    public function index()
    {
        $currencies_data = Currency::all();
        return view('products.currencies.index', compact('currencies_data'));
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|max:255',
            'asset' => 'mimes:jpeg,png,jpg,gif,svg',
        ]
        ,[
            'name.required' => 'Currency နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'code.required' => 'Currency Code ထည့်ပေးရန် လိုအပ်ပါသည်။',
        ]);

        // insert Main Image to local file
        $asset_file = $request->file('asset');
        
        $asset_file->move(public_path().'/images/products/currencies/', $asset_name = rand(1, 1000).time().'.'.$request->asset->extension());
        
    
        $currencies = new Currency();
        $currencies->name = $request->name;
        $currencies->asset = $asset_name;
        $currencies->code = $request->code;
        $currencies->status = $this->status($request->status);
        $currencies->save();

        return redirect()->back()->with('success', 'Currency အသစ်တစ်ခုထပ်မံထည့်သွင်းပြီးပါပြီ။');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        $currency_data = Currency::find($currency->id);
            
        return view('products.currencies.update', compact('currency_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $currency)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|max:255',
            'asset' => 'mimes:jpeg,png,jpg,gif,svg',
        ]
        ,[
            'name.required' => 'Currency နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'code.required' => 'Currency Code ထည့်ပေးရန် လိုအပ်ပါသည်။',
        ]);

        // edit Main image
        if($request->asset != ''){
            
            // insert Main Image to local file
            $asset_file = $request->file('asset');
            
            $asset_file->move(public_path().'/images/products/currencies/', $asset_name = rand(1, 1000).time().'.'.$request->asset->extension());
            
            
            // Delete old main image
            $del_main_image_path = public_path().'/images/products/currencies/'.$currency->asset;
            unlink($del_main_image_path);
        }else{
            $asset_name = $currency->asset;
        }

        $currency->name = $request->name;
        $currency->asset = $asset_name;
        $currency->code = $request->code;
        $currency->status = $this->status($request->status);
        $currency->save();

        return redirect()->back()->with('success', 'Currency - '. $request->name .' - ကိုပြင်ဆင်ပြီးပါပြီ။');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        $title = $currency->title;
        $currency->delete();
        // Delete old main image
        $del_main_image_path = public_path().'/images/products/currencies/'.$currency->asset;
        unlink($del_main_image_path);


        return redirect()->back()->with('success', 'Currency - '. $title .' - ပယ်ဖျက်ပြီးပါပြီ။');
    }
}
