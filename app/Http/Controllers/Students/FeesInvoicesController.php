<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\feeInvoice;
use App\Models\Fees;
use App\Models\StudentAccount;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeesInvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Fee_invoices = feeInvoice::all();
        return view('Pages.Students.Invoices.list_fees_invoices', compact('Fee_invoices'));

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
        $date = date(format: "Y-m-d");
        $List_Fees = $request->List_Fees;
        $student_id = $request->student_id;
        $Grade_id = $request->Grade_id;
        $Classroom_id = $request->Classroom_id;

        DB::beginTransaction();
        try{

            foreach($List_Fees as $list_fee){

                //save in table fee invoices
                $fees = new feeInvoice();
                $fees->invoice_date = $date;
                $fees->student_id = $student_id;
                $fees->grade_id = $Grade_id;
                $fees->classroom_id = $Classroom_id;
                $fees->fee_id = $list_fee['fee_id'];
                $fees->amount = $list_fee['amount'];
                $fees->description = $list_fee['description'];
                $fees->save();

                //save in table student account
                $student_account = new StudentAccount();
                $student_account->student_id = $student_id;
                $student_account->grade_id = $Grade_id;
                $student_account->classroom_id = $Classroom_id;
                $student_account->Debit = $list_fee['amount'];
                $student_account->credit = 0.00;
                $student_account->description = $list_fee['description'];
                $student_account->date = $date;
                $student_account->type = "invoice";
                $student_account->fee_invoice_id = $fees->id;

                
                $student_account->save();
            }

            DB::commit();
            toastr()->success(trans('trans_school.Success'));
            return redirect()->route('Fees_Invoices.index');
        }
        catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
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
        $student = Students::findOrFail($id);
        $fees = Fees::all();
        return view('Pages.Students.Invoices.add_invoice', compact('student', 'fees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fee_invoices = feeInvoice::findOrFail($id);
        $fees = Fees::where('classroom_id', $fee_invoices->classroom_id)->get();
        return view('Pages.Students.Invoices.edit_invoice', compact('fee_invoices' , 'fees'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try{

            $fees = feeInvoice::findOrFail($request->id);
            $fees->fee_id = $request->fee_id;
            $fees->amount = $request->amount;
            $fees->description = $request->description;
            $fees->save();

            $student_account = StudentAccount::where('fee_invoice_id',$request->id)->first();
            $student_account->Debit = $request->amount;
            $student_account->description = $request->description;
            $student_account->save();

            DB::commit();
            toastr()->success(trans('trans_school.Success'));
            return redirect()->route('Fees_Invoices.index');
        }
        catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try{
            feeInvoice::destroy($request->id);
            toastr()->error(trans('trans_school.Deleted_successfully'));
            return redirect()->route('Fees_Invoices.index');
        }
        catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
