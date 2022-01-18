<?php

namespace App\Http\Controllers\products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\traits\generalTraits;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('password.confirm')->only('create');
    }
    use  generalTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $products = DB::table('products')->orderBy('name_en')->get();
        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = DB::select("SELECT `brands`.`id`,`brands`.`name_en` FROM `brands` WHERE `brands`.`status` <> 0 ORDER BY `name_en`");
        $subCategories = DB::table('subcategories')->select('id','name_en')->where('status',1)->orderBY('name_en')->get();
        return view('products.create',compact('brands','subCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->except('_token','image');
        $data['image']=$this->uploadPhoto($request->image,'products');
        DB::table('products')->insert($data);
        return redirect()->route('products.index')->with('Success','<div class="alert alert-success"> Successfull Operation </div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $product = DB::table('products')->where('id',$id)->first();
        $brands = DB::select("SELECT `brands`.`id`,`brands`.`name_en` FROM `brands` WHERE `brands`.`status` <> 0 ORDER BY `name_en`");
        $subCategories = DB::table('subcategories')->select('id','name_en')->where('status',1)->orderBY('name_en')->get();
        return view('products.edit',compact('product','brands','subCategories'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        
        $data = $request->except('_token','_method');
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadPhoto($request->image,'products');
        }
        
        try {
            DB::table('products')->where('id', $id)->update($data);
            return redirect()->back()->with('Success','Successfull Operation');
        }catch(\Exception $e){
            return redirect()->route('products.index')->with('Error','SomeThing Went Wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , $id)

    {    
       DB::table('products')->where('id', '=', $id)->delete();
       $path = public_path('images\products\\'.$request->image);
        if(file_exists($path)){
            unlink($path);
        }
        return redirect()->back()->with('Success','Product '.$id.' Deleted Successfully');

    }
}
