<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shelter;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
