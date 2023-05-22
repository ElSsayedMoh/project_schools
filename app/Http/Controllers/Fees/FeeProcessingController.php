<?php

namespace App\Http\Controllers\Fees;

use App\Models\FeeProcessing;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\FeeProcessingInterface;

class FeeProcessingController extends Controller
{

    public $fee_processing;

    public function __construct(FeeProcessingInterface $fee_processing){
        return $this->fee_processing = $fee_processing;
    }
    public function index()
    {
        return $this->fee_processing->index();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        return $this->fee_processing->store($request);
    }

    public function show($id)
    {
        return $this->fee_processing->show($id);
    }

    public function edit($id)
    {
        return $this->fee_processing->edit($id);
    }

    public function update(Request $request)
    {
        return $this->fee_processing->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->fee_processing->destroy($request);
    }
}
