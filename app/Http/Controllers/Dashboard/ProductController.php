<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $sections=Section::all();
        $products=Product::when($request->search,function($q)use($request){
           return $q->where('name','like','%'.$request->search.'%');
        })->when($request->section_id,function($q)use($request){
           return $q->where('section_id',$request->section_id);
        })->latest()->paginate(5);

        return view('products.index',compact('sections','products'));
    }

    public function create()
    {
        $sections = Section::get();
       return view('products.create',compact('sections'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:products,name',
        ]);
        try{
            $input = $request->all();
            if($request->image){
                Image::make($request->image)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/product-img/' . $request->image->hashName() ));
                $input['image'] = $request->image->hashName();
            }
            Product::create($input);
            session()->flash('Add', 'create successfully');
            return redirect('products');
     } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
     }
    }

    public function show(Product $product)
    {
        //
    }


    public function edit(Product $product)
    {
        $sections = Section::get();
        return view('products.edit',compact('product','sections'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=>'required|unique:products,name',
        ]);
        $input = $request->all();
        if($request->image){
            if($request->image != 'default.jpg'){
                Storage::disk('public_uploads')->delete('/product-img/' . $product->image);
            }
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/product-img/' . $request->image->hashName() ));
            $input['image'] = $request->image->hashName();
        }
        $product->update($input);
        session()->flash('Update', 'update successfully');
        return redirect('products');
    }

    public function destroy(Product $product)
    {
        if($product->image != 'default.jpg'){
            Storage::disk('public_uploads')->delete('/product-img/' . $product->image);
       }
        $product->delete();
        session()->flash('Delete', 'deleted successfully');
        return redirect('products');
    }



}
