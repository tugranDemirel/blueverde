<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Enum\Customer\CustomerPersonalTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CustomerStoreRequest;
use App\Models\Customer;

class TRCustomerController extends Controller
{
    public function index()
    {
            $customers = Customer::where('personal_type', CustomerPersonalTypeEnum::DOMESTIC_CUSTOMER)
                        ->get();
        return view('admin.customer.tr.index', compact('customers'));
    }

    public function create( $personal_type = null)
    {
        if (is_null($personal_type))
            abort(404);
        if($personal_type == CustomerPersonalTypeEnum::DOMESTIC_CUSTOMER->value)
        {
            return view('admin.customer.tr.create-edit');
        }
        else
            abort(404);
    }

    public function store(CustomerStoreRequest $request)
    {
        $data = $request->all();
        if(!is_null($data['personal_type']) && $data['personal_type'] == CustomerPersonalTypeEnum::DOMESTIC_CUSTOMER)
        {
            dd('here');
        }
        else
            abort(404);
    }
}
