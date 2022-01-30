<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\crud;


class CrudController extends Controller
{
    // Create Record with laravel 8
    public function store(Request $request)
    {
        try {
            // Validator Default
            $validator = $request->validate([
                'name'=>'required|string|max:255',
                'email'=>'required|string|max:255',
                'mobile'=>'required|string|max:16',
                'password'=>'required|string'
            ]);

            // Create Model Data to insert
            $crud = new crud([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'mobile' => $request->get('mobile'),
                'password' => md5($request->get('password'))
            ]);

            // Save data to db
            $crud->save();

            // Response to user 
            return response()->json(['message'=> 'success', 'obj'=> $crud]);

        } catch(Exception $ex) {
            // Failure case
            return response()->json(['message'=> 'failure']);
        }
    }

    // Reading only one data with laravel 8
    public function getOne(Request $request, $id)
    {
        try {

            // Validate id 
            $validator = $request->validate([$id], [
                'id'=> 'required|integer'
            ]);
            
            // Get one record
            $record = (new crud())->find($id);
            
            // Returning response with record
            return response()->json(['message'=> 'success', 'obj'=> $record, 'req'=> $id]);

        } catch(Exception $ex) {
            // Fail Case
            return response()->json(['message'=> 'failure']);
        }
    }
    // Read all data in the db and show
    public function getAll(Request $request)
    {
        try {
            // Get all data
            $crud = (new crud())->all();
            
            // Return data success
            return response()->json(['message'=> 'success', 'obj'=> $crud]);
        } catch(Exception $ex) {
            // Fail Case
            return response()->json(['message'=> 'failure']);
        }
    }

    public function updateRecord(Request $request)
    {
        try {
            // Validation
            $validator = $request->validate([
                'id'=>'required|string|max:255',
                'name'=>'required|string|max:255',
                'email'=>'required|string|max:255',
                'mobile'=>'required|string|max:16'
            ]);
            
            // Update query
            $crud = (new crud())->where('id', $validator['id'])->update([
                'name' => $validator['name'],
                'email' => $validator['email'],
                'mobile' => $validator['mobile']
            ]);

            // Success
            return response()->json(['message'=> 'success', 'obj'=> $crud]);
        } catch(Exception $ex) {
            return response()->json(['message'=> 'failure']);
        }
    }

    // Delete record 
    public function deleteRecord(Request $request)
    {
        try {
            $validator = $request->validate([
                'id'=>'required'
            ]);

            // return response()->json(['message'=> 'success', 'obj'=> $validator]);
            $response = (new crud())->where($validator)->delete();

            return response()->json(['message'=> 'success', 'obj'=> $response]);
        } catch(Exception $ex) {
            return response()->json(['message'=> 'failure']);
        }
    }
}
