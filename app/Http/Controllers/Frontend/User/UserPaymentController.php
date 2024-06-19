<?php

namespace App\Http\Controllers\Frontend\User;

use App\Models\Credit;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use App\Models\UserTotalCredit;
use App\Http\Controllers\Controller;

class UserPaymentController extends Controller
{
    public function index(Request $request)
    {
        $payments = $request->user()->payments;
       
        return view('frontend.user.invoices', compact('payments'));
    }

    public function creditShow(Request $request){

        // echo auth()->user()->id; exit;

        $credits = Credit::where('user_id', auth()->user()->id)->with('events')->get();
        // $credit_count = Credit::where('user_id', auth()->user()->id)->count();
        $credit_first = UserTotalCredit::where('user_id', auth()->user()->id)->where('from_user_id', 0)->first();
        if($credit_first)
            $credit_count = $credit_first->count;
        else
            $credit_count = 0;
        
        $friends = UserTotalCredit::where('user_id', auth()->user()->id)->where('from_user_id', '!=', 0)->with('users')->get();
        $credit_friend = UserTotalCredit::where('user_id', auth()->user()->id)->where('from_user_id', '!=', 0)->first();
        if($credit_friend)
            $credit_count_friend = $credit_friend->count;
        else
            $credit_count_friend = 0;
        return view('frontend.user.creditShow', compact('credits', 'credit_count', 'friends', 'credit_count_friend'));
    }

    public function sendCreditView()
    {
        $credit = UserTotalCredit::where('user_id', auth()->user()->id)->where('from_user_id', 0)->first();
        if(!$credit)
            $credit_count = 0;
        else
            $credit_count = $credit->count;
        return view('frontend.user.sendCreditToFriend', compact('credit_count'));
    }

    public function sendCreditPost(Request $request)
    {
        $chk_user = User::where('email', $request->email)->first();
        if(!$chk_user){
            return back()->withFlashDanger('Email not found!');
        }
        else{ 
            $total_credit_cancel_new = UserTotalCredit::where('user_id',auth()->user()->id)->where('from_user_id', 0)->first();
            $total_credit_cancel_new->count= $total_credit_cancel_new->count - $request->credit;
            $total_credit_cancel_new->save();
            $total_credit_get_new = UserTotalCredit::where('user_id',$chk_user->id )->where('from_user_id', 0)->first();
            if($total_credit_get_new){
                $total_credit_get_new->count = $total_credit_get_new->count + $request->credit;
                $total_credit_get_new->save();
            }
            else{
                $total_credit_get_new = new UserTotalCredit();
                $total_credit_get_new->user_id = $chk_user->id;
                $total_credit_get_new->count = $request->credit;
                $total_credit_get_new->save();
            }
            $total_credit_get_from = UserTotalCredit::where('user_id', $chk_user->id)->where('from_user_id', auth()->user()->id)->first();
            
            if($total_credit_get_from){
                $total_credit_get_from->user_id = $chk_user->id;
                $total_credit_get_from->from_user_id = auth()->user()->id;
                $total_credit_get_from->count = $total_credit_get_from->count + $request->credit;
                $total_credit_get_from->save();
            }
            else{
                $total_credit_get_from_new=new UserTotalCredit();
                $total_credit_get_from_new->user_id = $chk_user->id;
                $total_credit_get_from_new->from_user_id = auth()->user()->id;
                $total_credit_get_from_new->count = $request->credit;
                $total_credit_get_from_new->save();
            }
            return back()->withFlashSuccess('Credit Sent!');
        }
    }
}
