<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\option;

class OptionController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:api');
    }
    public function index()
    {
    	$option = option::orderBy('created_at','desc')->get();
    	return response()->json(['option' =>$option]);
    }


     public function create()
    {
        $form = option::form();
    	return response()
    		->json([
    			'form' => $form
    		]);
    }


    public function store(Request $request)
    {
    	$this->validate($request, [
    		'option_name' => 'required|max:255',
    		'option_value' => 'required|max:3000',
    	]);



    	$option = option::create([
            'option_name' => $request->option_name,
             'option_value' => $request->option_value,
        ]);
        //return response($country);
    	
    	return response()
    	    ->json([
    	        'saved' => true,
    	        'id' => $option->id,
                'message' => 'You have successfully created option!'
    	    ]);
    }


  public function show($id)
    {
        $option = option::findOrFail($id);
         return response()
            ->json([
                'option' => $option
            ]);
    }




    public function edit($id, Request $request)
    {
        $form =option::findOrFail($id);
    	return response()
    		->json([
    			'form' => $form
    		]);
    }

     public function update(Request $request, $id)
    {
        $option = option::findOrFail($id);
        $option->update([
            'option_name' => $request->option_name,
            'option_value' => $request->option_value,
        ]);
          return response()
            ->json([
                'saved' => true,
                'id' => $option->id,
                'message' => 'You have successfully updated recipe!'
            ]);
    }

     public function destroy($id, Request $request)
    {
        $option = option::findOrFail($id);


        option::where('id', $option->id)
            ->delete();


        return response()
            ->json([
                'deleted' => true
            ]);
    }





}
