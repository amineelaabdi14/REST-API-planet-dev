<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  public function __construct()
    //  {
    //      $this->middleware('auth:api');
    //  }
    public function index()
    {
        //
        $data = Categories::all();
        return response()->json([
                    'status' => 'success',
                    'categories' => $data
                ]);
    }

    /**
     * Show the form for creating a new resource.
     */
 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
          $Categories = Categories::create($request->all());
            return response()->json([
                'status' => true,
                'message' => "Categorie Created successfully!",
                'Categories' => $Categories
            ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
      $categories =   Categories::Find($request->id);
        if (!$categories) {
            return response()->json(['message' => 'Categories not found'], 404);
        }
        return response()->json($categories, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categories $categories)
    {
        $Categories = Categories::find($request->id);
        if($Categories){
            $Categories->update($request->all());
            return response()->json([
            'status' => true,
            'message' => "categories Updated successfully!",
            'categories' => $Categories
        ], 200);

        }else{
            return response()->json(['message' => 'Categories not found'], 404);
                }
      
        
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $Categories = Categories::find($request->id);
        if($Categories){
            Categories::destroy($request->id);
            return response()->json([
                'status' => true,
                'message' => 'Article deleted successfully'
            ], 200);
        }else{
            return response()->json([
                'message' => 'Article not found'
            ], 404);
        }
      
    }
}
