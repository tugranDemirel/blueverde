<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Enum\Customer\CustomerPersonalTypeEnum;
use App\Helpers\FileHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CustomerStoreRequest;
use App\Http\Requests\Customer\CustomerUpdateRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class OtherCostumerController extends Controller
{
    private string $_fileFolder = 'customers/other/';
    public function index()
    {
        $customers = Customer::where('personal_type', CustomerPersonalTypeEnum::OVERSEAS_CUSTOMER)
            ->select(['id', 'name', 'country', 'province', 'district', 'personal_type'])
            ->get();
        return view('admin.customer.other.index', compact('customers'));
    }

    public function create( $personal_type = null)
    {
        if (is_null($personal_type))
            abort(404);
        if($personal_type == CustomerPersonalTypeEnum::OVERSEAS_CUSTOMER->value)
        {
            return view('admin.customer.other.create-edit');
        }
        else
            abort(404);
    }
    public function store(CustomerStoreRequest $request)
    {
        $data = $request->all();
        if(!is_null($data['personal_type']) && $data['personal_type'] == CustomerPersonalTypeEnum::OVERSEAS_CUSTOMER->value)
        {
            if ($request->has('file'))
                $data['file'] = FileHelpers::upload($request->file('file'), $this->_fileFolder, $request->file('file')->getClientOriginalName());
            if (isset($data['authorized_person']))
            {
                $authorized_person = [];
                foreach($data['authorized_person']['name'] as $key => $name)
                {
                    $authorized_person[$key]['name'] = $name;
                    $authorized_person[$key]['phone'] = $data['authorized_person']['phone'][$key];
                    $authorized_person[$key]['email'] = $data['authorized_person']['email'][$key];
                    $authorized_person[$key]['gsm'] = $data['authorized_person']['gsm'][$key];
                }
                $data['authorized_person'] = $authorized_person;
            }
            $create = Customer::create($data);

            if ($create)
                return redirect()->route('admin.other_customer.index')->with('success', 'Müşteri başarıyla eklendi.');
            else
                return redirect()->back()->with('error', 'Müşteri eklenirken bir hata oluştu.');
        }
        else
            abort(404);
    }

    public function edit(Customer $customer, $personal_type = null)
    {
        if (is_null($personal_type))
            abort(404);
        if($personal_type == CustomerPersonalTypeEnum::OVERSEAS_CUSTOMER->value)
        {
            return view('admin.customer.other.create-edit', compact('customer'));
        }
        else
            abort(404);
    }

    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $data = $request->all();
        if(!is_null($data['personal_type']) && $data['personal_type'] == CustomerPersonalTypeEnum::OVERSEAS_CUSTOMER->value)
        {
            if ($request->has('file')){
                $data['file'] = FileHelpers::upload($request->file('file'), $this->_fileFolder, $request->file('file')->getClientOriginalName());
                FileHelpers::deleteFile($customer->file);
            }
            if (isset($data['authorized_person']))
            {
                $authorized_person = [];
                foreach($data['authorized_person']['name'] as $key => $name)
                {
                    $authorized_person[$key]['name'] = $name;
                    $authorized_person[$key]['phone'] = $data['authorized_person']['phone'][$key];
                    $authorized_person[$key]['email'] = $data['authorized_person']['email'][$key];
                    $authorized_person[$key]['gsm'] = $data['authorized_person']['gsm'][$key];
                }
                $data['authorized_person'] = $authorized_person;
            }
            $update = $customer->update($data);

            if ($update)
                return redirect()->route('admin.other_customer.index')->with('success', 'Müşteri başarıyla güncellendi.');
            else
                return redirect()->back()->with('error', 'Müşteri güncellenirken bir hata oluştu.');
        }
        else
            abort(404);
    }

    public function destroy(Customer $customer)
    {
            if ($customer->delete())
            {
                FileHelpers::deleteFile($customer->file);
                return response()->json(['success' => true, 'message' => 'Müşteri başarıyla silindi.']);
            }
            else
                return response()->json(['success' => false, 'message' => 'Müşteri silinirken bir hata oluştu.']);
    }
}
