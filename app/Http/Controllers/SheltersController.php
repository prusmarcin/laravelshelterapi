<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shelter;
use Validator;

class SheltersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Shelter::all()->count() == 0) {
            $response = [
                'msg' => 'Not found shelters'
            ];
        } else {
            $shelters = Shelter::orderBy('id', 'desc')->get();
            $tab = array();
            foreach ($shelters as $shelter) {
                $tab[] = [
                    'name' => $shelter->name,
                    'city' => $shelter->city,
                    'size' => $shelter->size
                ];
            }
            $response = $tab;
        }

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'uskey' => 'required|string|min:5|max:5|unique:shelters,uskey',
                'name' => 'required|string',
                'city' => 'required|string',
                'size' => 'required|integer'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            $errorMessage = '';
            foreach ($errors->all() as $message) {
                $errorMessage .= $message . ' ';
            }

            $response = [
                'error' => true,
                'msg' => $errorMessage
            ];

            return response()->json($response, 400);
        } else {
            $response = Shelter::create([
                    'uskey' => $request->uskey,
                    'name' => $request->name,
                    'city' => $request->city,
                    'size' => $request->size
            ]);

            return response()->json($response);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (is_numeric($id)) {
            $param = array(['id', $id]);
        } else {
            $param = array(['uskey', $id]);
        }

        $shelter = Shelter::where($param)->first();

        if (isset($shelter->id)) {
            $response = [
                'name' => $shelter->name,
                'city' => $shelter->city
            ];
        } else {
            $response = [
                'msg' => 'Not found shelter'
            ];
        }

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
                'uskey' => 'required|string|min:5|max:5|unique:shelters,uskey',
                'name' => 'required|string',
                'city' => 'required|string',
                'size' => 'required|integer'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            $errorMessage = '';
            foreach ($errors->all() as $message) {
                $errorMessage .= $message . ' ';
            }

            $response = [
                'error' => true,
                'msg' => $errorMessage
            ];

            return response()->json($response, 400);
        } else {

            $shelter = Shelter::where('id', '=', $id)->get();

            if ($shelter->isEmpty()) {
                $response = [
                    'error' => true,
                    'msg' => 'Shelter not found.'
                ];
                return response($response, 400);
            } else {
                $shelter = Shelter::find($id)->update([
                    'uskey' => $request->uskey,
                    'name' => $request->name,
                    'city' => $request->city,
                    'size' => $request->size
                ]);

                $response = [
                    'msg' => 'Shelter updated.',
                    'updated' => $shelter
                ];
                return response()->json($response);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = Shelter::destroy($id);
        if ($deleted == 0) {
            $response = [
                'error' => true,
                'message' => 'There is no such shelter to be removed'
            ];
            return response()
                    ->json($response, 400);
        } else {
            $response = [
                'msg' => 'The shelter was removed',
                'deleted' => $deleted
            ];
            return response()->json($response);
        }
    }
}
