<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products_data = Product::select('id','name','permalink','asset','price','status','category_id','inventory_id','discount_id','user_id')->where('status', '=', '1')->orderby('updated_at', 'asc')->get();
        return view('products.index', compact('products_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories_data = Category::where('parent_id', null)->orderby('order', 'asc')->get();
        return view('products.create', compact('categories_data'));
    }

    public function uploadImage(Request $request) { 
        if($request->hasFile('upload'))
        {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            
            $request->file('upload')->move(public_path('/images/products/other/'), $fileName);
            
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('/images/products/other/'.$fileName); 
            $msg = 'Image uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    } 


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'permalink' => 'max:255|unique:products',
            'sku' => 'max:255|unique:products',
            'price' => 'required|numeric',
            'asset' => 'required|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'gallery_image[]' => 'mimes:jpeg,png,jpg,gif,svg|max:51200',
            
        ]
        ,[
            'name.required' => 'ကုန်ပစ္စည်း နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'price.required' => 'ကုန်ပစ္စည်းဈေးနုန်း ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'asset.required' => 'လိုဂိုထည့်ပေးရန် လိုအပ်ပါသည်။',
            'asset.mimes' => 'ဓာတ်ပုံ အမျိူးအစားကိုသာ ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'gallery_image[].mimes' => 'ဓာတ်ပုံ အမျိူးအစားကိုသာ ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'permalink.unique' => 'တူညီသော Permalink ရှိနေ၍ အသစ်တစ်ခုထည့်ပြီး ထပ်မံကြိုးစားကြည့်ပါ။',
            'sku.unique' => 'တူညီသော SKU ရှိနေ၍ အသစ်တစ်ခုထည့်ပြီး ထပ်မံကြိုးစားကြည့်ပါ။',
        ]
    );

   
    // insert Main Image to local file
    $main_image_name = $request->file('asset');
        
    $main_image_name->move(public_path().'/images/products/', $img = rand(1, 1000).time().'.'.$request->asset->extension());

    // inventory
    $inventory = new Inventory();
    $inventory->status = $request->quantity == '0' ? 'Out of Stock' : $request->inv_status;
    $inventory->quantity = $request->inv_status == 'Out of Stock' ? 0 : $request->quantity;
    $inventory->save();


    // inert to database
    $product = new Product();
    $product->name = $request->name;
    $product->sku = $request->sku;
    $product->asset = $img;
    $product->permalink = $request->permalink ? str_replace(' ', '-', strtolower($request->permalink)) : str_replace(' ', '-', strtolower($request->name));
    $product->description = $request->description;
    $product->detail = $request->detail;
    $product->price = $request->price;
    $product->user_id = Auth::user()->id;
    $product->inventory_id = $inventory->id; 
    $product->category_id = $request->category_id;
    $product->status = $request->status == 'on' ? 1 : 0;
    $product->save();

    // ---------------------------------------------------------------

    if($request->hasFile('gallery_image')){
        foreach ($request->gallery_image as $value) {
            // insert Main Image to local file

            $value->move(public_path().'/images/products/', $img = rand(1, 1000).time().'.'.$value->extension());

            $images = new Image();

            // insert to image table

            $images->image = $img;
            $images->alt = $request->title;
            
            $images->imageable_id = $product->id;
            $images->imageable_type = 'App\Models\Product';
            $images->save();

            
        }
    }


    return redirect()->route("products.index")->with('success','(' . $request->name.') ကုန်ပစ္စည်းကို ကိုထည့်သွင်းပြီးပါပြီ။');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories_data = Category::where('parent_id', null)->orderby('order', 'asc')->get();
        return view('products.update', compact('product', 'categories_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'permalink' => 'max:255|unique:products,permalink,'.$product->id,
            'sku' => 'max:255|unique:products,sku,'.$product->id,
            'price' => 'required|numeric',
            'asset' => 'mimes:jpeg,png,jpg,gif,svg|max:5120',
            'gallery_image[]' => 'mimes:jpeg,png,jpg,gif,svg|max:51200',
            
        ]
        ,[
            'name.required' => 'ကုန်ပစ္စည်း နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'price.required' => 'ကုန်ပစ္စည်းဈေးနုန်း ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'asset.mimes' => 'ဓာတ်ပုံ အမျိူးအစားကိုသာ ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'gallery_image[].mimes' => 'ဓာတ်ပုံ အမျိူးအစားကိုသာ ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'permalink.unique' => 'တူညီသော Permalink ရှိနေ၍ အသစ်တစ်ခုထည့်ပြီး ထပ်မံကြိုးစားကြည့်ပါ။',
            'sku.unique' => 'တူညီသော SKU ရှိနေ၍ အသစ်တစ်ခုထည့်ပြီး ထပ်မံကြိုးစားကြည့်ပါ။',
        ]
    );

   
    // insert Main Image to local file
    if($request->asset != ''){
        $main_image_name = $request->file('asset');
        
        $main_image_name->move(public_path().'/images/products/', $img = rand(1, 1000).time().'.'.$request->asset->extension());
        
        
        // Delete old main image
        $del_main_image_path = public_path().'/images/products/'.$product->asset;
        unlink($del_main_image_path);
    }else{
        $img = $product->asset;
    }

    // inventory
    $inventory = Inventory::find($product->inventory->id);
    $inventory->status = $request->quantity == '0' ? 'Out of Stock' : $request->inv_status;
    $inventory->quantity = $request->inv_status == 'Out of Stock' ? '0' : $request->quantity;
    $inventory->save();


    // inert to database
    $product->name = $request->name;
    $product->sku = $request->sku;
    $product->asset = $img;
    $product->permalink = $request->permalink ? str_replace(' ', '-', strtolower($request->permalink)) : str_replace(' ', '-', strtolower($request->name));
    $product->description = $request->description;
    $product->detail = $request->detail;
    $product->price = $request->price;
    $product->user_id = Auth::user()->id;
    $product->category_id = $request->category_id;
    $product->status = $request->status == 'on' ? 1 : 0;
    $product->save();

    // ---------------------------------------------------------------

    // edit gallery image
    if($request->delete_gallery_images != ''){
        $image_array = explode(",",$request->delete_gallery_images);

        $i = 0;
        while ($i < count($image_array))
        {
            
            $delete_gallery_file = Image::where('id','=',$image_array[$i])->first();
            // Delete local file
            $del_main_image_path = public_path().'/images/products/'.$delete_gallery_file->image;
            unlink($del_main_image_path);

            // delete Databse
            Image::find($image_array[$i])->delete();

            $i++;
        }
    }

    if($request->hasFile('gallery_image')){
        foreach ($request->gallery_image as $value) {
            // insert Main Image to local file            
            $value->move(public_path().'/images/products/', $img = rand(1, 1000).time().'.'.$value->extension());
            

            $images = new Image();

            // insert to image table

            $images->image = $img;
            $images->alt = $request->title;

            $images->imageable_id = $product->id;
            $images->imageable_type = 'App\Models\Product';

            $images->save();

            
        }
    }

    return redirect()->back()->with('success','(' . $request->name.') ကုန်ပစ္စည်းကို ကိုပြင်ဆင်ပြီးပါပြီ။');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        unlink(public_path().'/images/products/'.$product->asset);
        
        

        if(count($product->images)){
            foreach ($product->images as $value) {
                // Delete old main image
                $del_main_image_path = public_path().'/images/products/'.$value->image;
                unlink($del_main_image_path);

                Image::where('image', '=', $value->image)->delete();
            }
        }

        $product->delete();

    return redirect()->route('products.index')->with('success',' ကုန်ပစ္စည်းကို ကိုပယ်ဖျက်ပြီးပါပြီ။');
    }
}
