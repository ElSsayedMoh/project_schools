<?php

    namespace App\Repository;

use App\Models\FeeProcessing;
use App\Models\StudentAccount;
use App\Models\Students;
use Illuminate\Support\Facades\DB;

    class FeeProcessingRepo implements FeeProcessingInterface {
        public function index(){
            $ProcessingFees = FeeProcessing::all();
            return view('Pages.Fees.FeeProcessing.index', compact('ProcessingFees'));
        }

        public function store($request){
            DB::beginTransaction();
            $date = date('Y-m-d H:i:s');
            try{
                //Create in Table FeeRrocessing 
                $fee_process = new FeeProcessing();
                $fee_process->date = $date;
                $fee_process->student_id = $request->student_id;
                $fee_process->amount = $request->Debit;
                $fee_process->description = $request->description;
                $fee_process->save();

                //Create in Table StudentAccount 
                $student_account = new StudentAccount();
                $student_account->date = $date;
                $student_account->type = 'FeeRrocessing';
                $student_account->student_id = $request->student_id;
                $student_account->processing_id  = $fee_process->id;
                $student_account->Debit = 0.00;
                $student_account->credit = $request->Debit;
                $student_account->description = $request->description;
                $student_account->save();
                
                DB::commit();
                toastr()->success(trans('trans_school.Success'));
                return redirect()->route('fee_processing.index');
            }
            catch(\Exception $e){
                DB::rollback();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }

        public function show($id){
            $student = Students::findOrFail($id);
            return view('Pages.Fees.FeeProcessing.add', compact('student'));
        }

        public function edit($id){
            $fee_process = FeeProcessing::findOrFail($id);
            return view('Pages.Fees.FeeProcessing.edit', compact('fee_process'));
        }

        public function update($request){
            DB::beginTransaction();
            $date = date('Y-m-d H:i:s');
            try{
                //Create in Table FeeRrocessing 
                $fee_process = FeeProcessing::findOrFail($request->id);
                $fee_process->date = $date;
                $fee_process->amount = $request->Debit;
                $fee_process->description = $request->description;
                $fee_process->save();

                //Create in Table StudentAccount 
                $student_account = StudentAccount::where('processing_id' , $request->id)->first();
                $student_account->date = $date;
                $student_account->credit = $request->Debit;
                $student_account->description = $request->description;
                $student_account->save();
                
                DB::commit();
                toastr()->success(trans('trans_school.Success'));
                return redirect()->route('fee_processing.index');
            }
            catch(\Exception $e){
                DB::rollback();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }

        public function destroy($request){
            try{
                FeeProcessing::findOrFail($request->id)->delete();
                toastr()->error(trans('trans_school.Deleted_successfully'));
                return redirect()->route('fee_processing.index');
            }
            catch(\Exception $e){
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }
    }