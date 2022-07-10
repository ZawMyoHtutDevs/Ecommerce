<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories_data = Category::where('parent_id', null)->orderby('order', 'asc')->get();
        return view('products.categories.index', compact('categories_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    // order default
    public function order(){
        if(Category::count() == 0){
            return 1;
        }else{
            return Category::max('order') + 1;
        }
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'permalink' => 'max:255|unique:categories',
            'order' => 'unique:categories',
            'asset' => 'mimes:jpeg,png,jpg,gif,svg',
        ]
        ,[
            'name.required' => 'Category နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'permalink.unique' => 'တူညီသော Permalink ရှိနေ၍ အသစ်တစ်ခုထည့်ပြီး ထပ်မံကြိုးစားကြည့်ပါ။',
        ]);

        // edit Main image
        if($request->asset != ''){
            // insert Main Image to local file
            $asset_file = $request->file('asset');
                    
            $asset_file->move(public_path().'/images/products/categories/', $asset_name = rand(1, 1000).time().'.'.$request->asset->extension());
        }
        
        
    
        $categories = new Category();
        $categories->name = $request->name;
        $categories->asset = $asset_name ?? '';
        $categories->parent_id = $request->parent_id;
        $categories->permalink = $request->permalink ? str_replace(' ', '-', strtolower($request->permalink)) : str_replace(' ', '-', strtolower($request->name));
        $categories->description = $request->description;
        $categories->order = $request->order ?? $this->order();
        $categories->save();

        return redirect()->back()->with('success', 'Category အသစ်တစ်ခုထပ်မံထည့်သွင်းပြီးပါပြီ။');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $category_data = Category::find($category->id);
        $categories_data = Category::where('parent_id', null)->orderby('name', 'asc')->get();
            
        return view('products.categories.update', compact('category_data', 'categories_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'permalink' => 'max:255|unique:categories,permalink,'.$category->id,
            'order' => 'unique:categories,order,'.$category->id,
            'asset' => 'mimes:jpeg,png,jpg,gif,svg',
        ]
        ,[
            'name.required' => 'Category နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'permalink.unique' => 'တူညီသော Slug ရှိနေ၍ အသစ်တစ်ခုထည့်ပြီး ထပ်မံကြိုးစားကြည့်ပါ။',
        ]);

        // edit Main image
        if($request->asset != ''){
            
            // insert Main Image to local file
            $asset_file = $request->file('asset');
            
            $asset_file->move(public_path().'/images/products/categories/', $asset_name = rand(1, 1000).time().'.'.$request->asset->extension());
            
            
            // Delete old main image
            $del_main_image_path = public_path().'/images/products/categories/'.$category->asset;
            unlink($del_main_image_path);
        }else{
            $asset_name = $category->asset;
        }


        $category->name = $request->name;
        $category->asset = $asset_name ?? '';
        $category->permalink = str_replace(' ', '-', strtolower($request->permalink)) ?? str_replace(' ', '-', strtolower($request->name));
        $category->description = $request->description;
        $category->order = $request->order ?? $this->order();
        $category->parent_id = $request->parent_id;
        $category->save();

        return redirect()->back()->with('success', 'Category - '. $request->name .' - ကိုပြင်ဆင်ပြီးပါပြီ။');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

        if(count($category->subcategory)){
            return redirect()->back()->with('error', 'Category - '. $category->name .' - သည် Sub Category များရှိနေသောဖျက်၍မရပါ။');
        }else{

        $category->delete();

        }

        // Delete old main image
        $del_main_image_path = public_path().'/images/products/categories/'.$category->asset;
        unlink($del_main_image_path);


        return redirect()->back()->with('success', 'Category - ပယ်ဖျက်ပြီးပါပြီ။');
    }
}
