<?php

namespace App\Http\Controllers\apis;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\traits\generalTraits;

class ProductController extends Controller
{
    use generalTraits;
    public function index(){
        $products =  Product::all();
        // return response()->json(['products'=>$products],201);
        return $this->returnData('products',$products);
    }
    public function create(){
        $brands = Brand::where('status',1)->orderBy('name_en')->get();
        $subcategories = Subcategory::where('status',1)->orderBy('name_en')->get();
        // return response()->json(['brands'=>$brands,'subcategories'=>$subcategories]);
        return $this->returnData('data',['brands'=>$brands,'subcategories'=>$subcategories]);
    }
    public function edit($id){
        $product = Product::findOrFail($id);
        // return response()->json(['products'=>$product],201);
        return $this->returnData('product',$product,"product Data",201);
    }
    public function store(Request $request){
        $rules = [
            'name_en'=>['required','string','max:100'],
            'name_ar'=>['required','string','max:100'],
            'price'=>['required','numeric','min:1','max:100000'],
            'quantity'=>['required','min:1','integer'],
            'code'=>['required','integer','digits:5','unique:products'],
            'status'=>['required','between:0,1','integer'],
            'details_en'=>['nullable','string'],
            'details_ar'=>['nullable','string'],
            'brand_id'=>['nullable','integer','exists:brands,id'],
            'subcategory_id'=>['required','integer','exists:subcategories,id'],
            'image'=>['required','max:1000','mimes:png,jpg,jpeg']
        ];
        $validator = Validator :: make($request->all(),$rules);
        if($validator->fails()){
            // return response()->json(['errors'=>$validator->errors()],400);
            return $this->returnValidationError($validator);
        }
        $data = $request->except('image');
        $data['image'] = $this->uploadPhoto($request->image,'products');
        Product::create($data);
        // 
        return $this->returnSuccessMessage("product inserted successfully");

    }
    public function update(Request $request){
        $rules=[
            'name_en'=>['required','string','max:100'],
        'name_ar'=>['required','string','max:100'],
        'price'=>['required','numeric','min:1','max:100000'],
        'quantity'=>['required','min:1','integer'],
        'code'=>['required','integer','digits:5','unique:products,code,'.$request->id],
        'status'=>['required','min:0','max:1','integer'],
        'details_en'=>['nullable','string'],
        'details_ar'=>['nullable','string'],
        'brand_id'=>['nullable','integer','exists:brands,id'],
        'subcategory_id'=>['required','integer','exists:subcategories,id'],
        'image'=>['nullable','max:1000','mimes:png,jpg,jpeg']
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            // return response()->json(['errors'=>$validator->errors()],400);
            return $this->returnValidationError($validator);
        }

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadPhoto($request->image,'products');
        }
        try {
            Product::Where('id',$request->id)->update($data);
            // return response()->json(['message'=>'data updated'],200);
            return $this->returnSuccessMessage("product updated successfully");
            
        }catch(\Exception $e){
            // return response()->json(['message'=>'something went wrong'],500);
            return $this->returnErrorMessage(NULL,"something went wrong",500);
            
        }
    }
    public function destroy($id)
    {
        $product = Product::find($id);
        $path = public_path('images\products\\'.$product->image);
        if(file_exists($path)){
            unlink($path);
        }
        $product->delete();
        ("product deleted");
        // return response()->json(['message'=>'product deleted'],200);
        return $this->returnSuccessMessage("product deleted");
    }
        

}
    
    

