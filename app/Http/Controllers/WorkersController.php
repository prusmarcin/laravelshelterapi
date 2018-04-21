<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Worker;
use Validator;

class WorkersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Worker::all()->count() == 0) {
            $response = [
                'msg' => 'Not found workers'
            ];
        } else {
            $workers = Worker::all();
            $response = $workers;
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
                'age' => 'required|integer',
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
            $response = Worker::create([
                    'name' => $request->name,
                    'age' => $request->age,
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
        $worker = Worker::find($id);
        if (isset($worker->id)) {
            $response = [
                'name' => $worker->name,
                'age' => $worker->age,
                'shelter_id' => $worker->shelter_id,
                'created_at' => $worker->created_at,
                'updated_at' => $worker->updated_at
            ];
        } else {
            $response = [
                'msg' => 'Not found worker'
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
                'age' => 'required|integer',
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

            $worker = Worker::where('id', '=', $id)->get();

            if ($worker->isEmpty()) {
                $response = [
                    'error' => true,
                    'msg' => 'Worker not found.'
                ];
                return response($response, 400);
            } else {
                $worker = Worker::find($id)->update([
                    'name' => $request->name,
                    'age' => $request->age,
                    'shelter_id' => $request->shelter_id
                ]);

                $response = [
                    'msg' => 'Worker updated.',
                    'updated' => $worker
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
        $deleted = Worker::destroy($id);
        if ($deleted == 0) {
            $response = [
                'error' => true,
                'msg' => 'There is no such worker to be removed'
            ];
            return response()
                    ->json($response, 400);
        } else {
            $response = [
                'msg' => 'The worker was removed',
                'deleted' => $deleted
            ];
            return response()->json($response);
        }
    }
}
