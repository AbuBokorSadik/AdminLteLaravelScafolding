<?php

namespace App\Http\Controllers\Agent;

use App\Constant\StatusTypeConst;
use App\Constant\UserTypeConst;
use App\Http\Controllers\Controller;
use App\Http\Requests\Agent\AgentStoreRequest;
use App\Mail\Agent\AgentInvitationMail;
use App\Models\User;
use App\Models\UsersAgent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Agent List';
        try {
            $agents = User::where('user_type_id', UserTypeConst::AGENT)
                ->whereHas('agentsAdmin', function (Builder $query) {
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

            // echo '<pre>';
            // print_r($agents->toArray());
            // exit();

            $request->flash();

            return view('admin.pages.agent.agentList', compact('title', 'agents'));
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
        $title = 'Add Agent';
        try {
            return view('admin.pages.agent.agentAdd', compact('title'));
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
    public function store(AgentStoreRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $randPassword = bin2hex(random_bytes(4));
                $agent = User::create([
                    'user_type_id' => UserTypeConst::AGENT,
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'password' => Hash::make($randPassword),
                    'status' => StatusTypeConst::ACTIVE,
                ]);

                UsersAgent::create([
                    'user_id' => auth()->user()->id,
                    'agent_id' => $agent->id,
                ]);

                Mail::to($request->email)->send(new AgentInvitationMail($agent, $randPassword));
            });

            $request->session()->flash('success_alert', 'Agent Created Successfully.');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->route('agents.index');
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
        $title = 'Agent Details';
        try {
            $agent = User::where('id',$id)->first();

            return view('admin.pages.agent.agentShow', compact('title', 'agent'));
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
            DB::transaction(function () use($id){
                $agent = User::find($id);
                $agent->status = !$agent->status;
                $agent->save();
            });

            $request->session()->flash('success_alert', 'Agent Status Updated Successfully.');
            return redirect()->route('agents.index');
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->route('agents.index');
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
