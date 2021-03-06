<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cat;
use Validator;

class CatsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Cat::all()->count() == 0) {
            $response = [
                'msg' => 'Not found cats'
            ];
        } else {
            $cats = Cat::all();
            $response = $cats;
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
                'name' => 'required|string',
                'color' => 'required|string',
                'worker_id' => 'required|integer|exists:workers,id',
                'shelter_id' => 'required|integer|exists:shelters,id'
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
            $response = Cat::create([
                    'name' => $request->name,
                    'color' => $request->color,
                    'worker_id' => $request->worker_id,
                    'shelter_id' => $request->shelter_id
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
        $cat = Cat::find($id);
        if (isset($cat->id)) {
            $response = [
                'name' => $cat->name,
                'color' => $cat->color
            ];
        } else {
            $response = [
                'msg' => 'Not found cat'
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
                'name' => 'required|string',
                'color' => 'required|string',
                'worker_id' => 'required|integer|exists:workers,id',
                'shelter_id' => 'required|integer|exists:shelters,id'
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

            $cat = Cat::where('id', '=', $id)->get();

            if ($cat->isEmpty()) {
                $response = [
                    'error' => true,
                    'msg' => 'Cat not found.'
                ];
                return response($response, 400);
            } else {
                $cat = Cat::find($id)->update([
                    'name' => $request->name,
                    'color' => $request->color,
                    'worker_id' => $request->worker_id,
                    'shelter_id' => $request->shelter_id
                ]);

                $response = [
                    'msg' => 'Cat updated.',
                    'updated' => $cat
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
        $deleted = Cat::destroy($id);
        if ($deleted == 0) {
            $response = [
                'error' => true,
                'msg' => 'There is no such cat to be removed'
            ];
            return response()
                    ->json($response, 400);
        } else {
            $response = [
                'msg' => 'The cat was removed',
                'deleted' => $deleted
            ];
            return response()->json($response);
        }
    }
}
