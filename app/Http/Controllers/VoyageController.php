<?php

namespace App\Http\Controllers;

use App\Models\Voyage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use \Illuminate\Http\Response;
class VoyageController extends Controller
{

    private $VoyageExecutor;

    public function __construct(Voyage $VoyageExecutor){

        $this->VoyageExecutor = $VoyageExecutor;
    }

    public function getById($id)
    {
        dd($this->VoyageExecutor->getByID($id));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {

        request()->validate([
            'vessel_id' => 'required',
            'code' => 'required',
            'start' => 'required', // 1
            'end' => 'required_with:start|date|gt:start',  // must be greater than the starting date
            'status' => 'required', // 1
            'revenues' => 'required',
            'expenses' => 'required',
            'profit' => 'required',
        ]);

        $requeststatus = ['requeststatus' => 200];

        $vessel_id = $request->input('vessel_id');

        $vessel = DB::select('select name from vassels where id = "'.$vessel_id.'"');
        $vesselName = $vessel; // pairnei to name tou vessel me vasi to id
        $start = $request->input('start');
//        $code = $request->input('code');
        $end = $request->input('end');
        $status = 'pending';
        $revenues = $request->input('revenues');
        $expenses = $request->input('expenses');
        $profit = $request->input('profit');

        try {
            $data = array('vessel_id' => $vessel_id, 'code' => $vesselName . '-' . $start, 'start' => $start,

                'end' => $end, 'status' => $status, 'revenues' => $revenues, 'expenses' => $expenses, 'profit' => $profit);

            DB::table('voyages')->insert($data);
        } catch (\Exception $e) {
            $requeststatus = [
                'requeststatus' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($data, $requeststatus['requeststatus']);
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
        $voyage = $this->VoyageExecutor->getByID($id);
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
        request()->validate([
            'vessel_id' => 'required',
            'code' => 'required',
            'start' => 'required', // 1
            'end' => 'required_with:start|date|gt:start',  // must be greater than the starting date
            'status' => 'required', // 1
            'revenues' => 'required',
            'expenses' => 'required',
            'profit' => 'required',
        ]);

        $vessel_id = $request->input('vessel_id');

        $vessel = DB::select('select name from vassels where id = "'.$vessel_id.'"');
        $vesselName = $vessel; // pairnei to name tou vessel me vasi to id
        $start = $request->input('start');
//        $code = $request->input('code');
        $end = $request->input('end');
        $status = $request->input('status');
        $revenues = $request->input('revenues');
        $expenses = $request->input('expenses');
        $profit = $request->input('profit');

        $statuscheck = DB::select('select $vesselName from vassels where id = "'.$vessel_id.'"');

        if($status = 'ongoing') {

            if ($statuscheck != 'ongoing') {

                $data = array('vessel_id' => $vessel_id, 'code' => $vesselName . '-' . $start, 'start' => $start,
                    'end' => $end, 'status' => $status, 'revenues' => $revenues, 'expenses' => $expenses, 'profit' => $profit);

                DB::table('voyages')->insert($data);
            } else
                echo 'A vessel cannot have two ‘ongoing’ voyages at the same time!!!';
        }
        else if($status = 'submitted') {                            // Otan einai submitted kanei to check gia
            if($start & $end & $revenues & $expenses){              // ‘start’, ‘end’, ‘revenues’ and ‘expenses’ an einai null an den einai sunexizei

                $profit = $revenues - $expenses;                    // upologizei to profit

                $data = array('vessel_id' => $vessel_id, 'code' => $vesselName . '-' . $start, 'start' => $start,
                    'end' => $end, 'status' => $status, 'revenues' => $revenues, 'expenses' => $expenses, 'profit' => $profit);

                DB::table('voyages')->insert($data);
            }
            else
                echo 'voyage CANT be submitted because one or more of values ‘start’, ‘end’, ‘revenues’ and ‘expenses’ are null!!!!';

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
        //
    }
}
