<?php

namespace App\Http\Controllers\Merchant;

use App\Constant\StatusTypeConst;
use App\Constant\UserTypeConst;
use App\Http\Controllers\Controller;
use App\Http\Requests\Merchant\MerchantStorRequest;
use App\Mail\Merchant\MerchantInvitationMail;
use App\Models\User;
use App\Models\UsersMerchant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Merchant List';
        $merchant_list_active = 'active';

        try {
            $merchants = User::where('user_type_id', UserTypeConst::MERCHANT)
                ->whereHas('merchantsAdmin', function (Builder $query) {
                    $query->where('user_id', auth()->user()->id);
                })
                ->filterByID($request)
                ->filterByName($request)
                ->filterByEmail($request)
                ->filterByMobile($request)
                ->filterByStatus($request)
                ->filterByCreatedAtDateRange($request)
                ->orderBy('id', 'DESC')
                ->paginate(20);

            $request->flash();

            return view('admin.pages.merchant.merchantList', compact('title', 'merchant_list_active', 'merchants'));
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $title = 'Add Merchant';
        $merchant_create_active = 'active';

        try {
            return view('admin.pages.merchant.merchantAdd', compact('title', 'merchant_create_active'));
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MerchantStorRequest $request)
    {

        try {
            $merchant = User::where([
                'user_type_id' => UserTypeConst::MERCHANT,
                'email' => $request->email
            ])->first();

            return DB::transaction(function () use ($merchant, $request) {
                if (!$merchant) {

                    $randPassword = bin2hex(random_bytes(4));
                    $merchant = User::create([
                        'user_type_id' => UserTypeConst::MERCHANT,
                        'name' => $request->name,
                        'email' => $request->email,
                        'mobile' => $request->mobile,
                        'password' => Hash::make($randPassword),
                        'status' => StatusTypeConst::ACTIVE,
                    ]);
                    Mail::to($request->email)->send(new MerchantInvitationMail($merchant, $randPassword));
                }

                $usersMerchant = UsersMerchant::where([
                    'user_id' => auth()->user()->id,
                    'merchant_id' => $merchant->id,
                ])
                    ->first();

                if ($usersMerchant) {
                    $request->session()->flash('error_alert', 'You have already added this merchant.');
                    return redirect()->route('merchants.create');
                }

                UsersMerchant::create([
                    'user_id' => auth()->user()->id,
                    'merchant_id' => $merchant->id,
                ]);
                
                $request->session()->flash('success_alert', 'Merchant Created Successfully.');
                return redirect()->route('merchants.create');
            });
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->route('merchants.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $title = 'Merchant Details';
        try {
            $merchant = User::where('id',$id)->first();

            return view('admin.pages.merchant.merchantShow', compact('title', 'merchant'));
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->back();
        }
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
        try {
            DB::transaction(function () use ($request, $id) {
                $merchant = User::find($id);
                $merchant->status = !$merchant->status;
                $merchant->save();
            });

            $request->session()->flash('success_alert', 'Merchant Status Updated Successfully.');
            return redirect()->route('merchants.index');
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->route('merchants.index');
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
