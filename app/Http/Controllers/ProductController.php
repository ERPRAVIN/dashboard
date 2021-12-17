<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Hash;
use Log;
use Illuminate\Support\Facades\Auth;
//use App\Http\Controllers\Redirect;
use Redirect;
class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search=$_REQUEST['search'];
        $productArr = Product::where ( 'product_name', 'LIKE', '%' . $search . '%' )->paginate(1);
        $productArr->appends(['search' =>$search]);
        if (count( $productArr) > 0){
            return view('dashboard', compact('productArr')); 
        }
        else
        return view ( 'dashboard' )->withMessage ( 'No Details found. Try to search again !' );
    }

    /**ZZZ
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
       'product_name' => 'required|min:4|max:30',
       'product_price' => 'required|numeric|min:1',
       'product_image' =>'required'
        ]);
        if ($request->hasFile('product_image')) {
            $request->validate([
                'product_image' => 'required|mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
                
            ]);
            // Save the file locally in the storage/public/ folder under a new folder named /product
            $request->product_image->store('product','public');


            // Store the record, using the new file hashname which will be it's new filename identity.
            $product = new Product([
                "product_name"  => $request->product_name,
                "product_price" => $request->product_price,
                "product_image" => $request->product_image->hashName(),               
            ]);
           
            $product->save();  
           // $successMsg='Your Product Added  Successfully.';
            //$productArr=Product::all();
            //return view('dashboard')->with(compact('successMsg','productArr')); 
            return redirect()->route('dashboard')->with('successMsg','Your Product Added  Successfully.');   
        }       
        return dd('data not inserted ');
        
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        
        return view('show')->with('productArr',Product::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product,$id)
    {
        if (auth()->user()->is_admin == 1) {
            return view('update_product')->with('productArr',Product::find($id));
        }
        return redirect()->route('dashboard')->with('deleteMsg','Only Admin Allowed');
       
        
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
        
        $request->validate([
            'product_name' => 'required|min:4|max:30',
            'product_price' => 'required|numeric|min:1',
            'product_image' =>'required',
            'product_id' =>'required',
        ]);

           
        if ($request->hasFile('product_image')) {
            $request->validate([
                'product_image' => 'required|mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.                
            ]);
            // Save the file locally in the folder under a new folder named /product
            $request->product_image->store('product','public');

            $id                      = $request->product_id;
            $product                 = Product::find($id);
            $product->product_name   = $request->product_name;
            $product->product_price  = $request->product_price;
            $product->product_image  = $request->product_image->hashName();    

            $product->save();
           // $successMsg='Your Product Updated  Successfully.';
            //$productArr=Product::all();
           // return view('dashboard')->with(compact('successMsg','productArr'));  
           return redirect()->route('dashboard')->with('successMsg','Your Product Updated  Successfully.'); 
             
        }
            dd('not updated');       
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product,$id )
    {
        if (auth()->user()->is_admin == 1) {
        Product::destroy(array('id',$id));
       // $deleteMsg='Product Deleted.';
        //$productArr=Product::all();
        //return view('dashboard')->with(compact('deleteMsg','productArr'));   
        return redirect()->route('dashboard')->with('deleteMsg','Your Product  Deleted  Successfully.'); 
        }else{
            return redirect()->route('dashboard')->with('deleteMsg','Only Admin Allow to Delete Product'); 
        }
    }
}
