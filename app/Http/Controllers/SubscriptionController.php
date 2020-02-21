<?php

namespace App\Http\Controllers;

use App\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('subscription.add_subscription');
    }

    public function manage()
    {

        $subscriptions = Subscription::query();

        if (request()->has('name')) {
            $subscriptions = $subscriptions->where('name','like', '%'.request()->get('name').'%');
        }
        if (request()->has('phone')) {
            $subscriptions = $subscriptions->where('phone','like', '%'.request()->get('phone').'%');
        }
        if (request()->has('address')) {
            $subscriptions = $subscriptions->where('address','like', '%'.request()->get('address').'%');
        }
        if (request()->has('payment')) {
            $subscriptions = $subscriptions->where('payment', request()->get('payment'));
        }
        if (request()->has('interval') && request()->get('interval') != "0") {
            $subscriptions = $subscriptions->where('interval', request()->get('interval'));
        }

        $subscriptions = $subscriptions->get();
        return view('subscription.manage_subscriptions', ['subscriptions' => $subscriptions]);
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $subscription = new Subscription();
        $subscription->name = $request->input('name');
        $subscription->address = $request->input('address');
        $subscription->interval = $request->input('interval');
        $subscription->payment = $request->input('payment');
        $subscription->phone = $request->input('phone');
        $subscription->hints = $request->input('hints');
        $subscription->health = $request->input('health');

        $interval = $request->input('interval');
        $subscription->start_at = \Carbon\Carbon::now()->format('Y-m-d');
        $subscription->end_at = $this->subscriptionEndAt($interval);
        $subscription->save();


        echo json_encode(['result' => 'success', 'subscription' => $subscription]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $subscription = Subscription::find($id);
        $new_interval = $request->input('interval');
        $old_interval = $subscription->interval;

        $subscription->name = $request->input('name');
        $subscription->address = $request->input('address');
        $subscription->interval = $request->input('interval');
        $subscription->payment = $request->input('payment');
        $subscription->phone = $request->input('phone');
        $subscription->hints = $request->input('hints');
        $subscription->health = $request->input('health');

        if ($this->checkIntervalChanges($old_interval, $new_interval)) {
//            $subscription->start_at = \Carbon\Carbon::now()->format('Y-m-d');
            $subscription->end_at = $this->subscriptionEndAt($new_interval);
        }


        $subscription->save();


        echo json_encode(['result' => 'success', 'subscription' => $subscription]);
    }

    public function recycle_bin($subscription_id)
    {
        $subscription = Subscription::find($subscription_id);
        $subscription->delete();
        $result = 'success';

        echo json_encode(['result'=>$result]);
    }

    protected function subscriptionEndAt($interval)
    {
        if ($interval == 1) return \Carbon\Carbon::now()->addDay(1)->format('Y-m-d');
        if ($interval == 2) return \Carbon\Carbon::now()->addMonth(1)->format('Y-m-d');
        if ($interval == 3) return \Carbon\Carbon::now()->addMonth(3)->format('Y-m-d');
        if ($interval == 4) return \Carbon\Carbon::now()->addMonth(6)->format('Y-m-d');
        if ($interval == 5) return \Carbon\Carbon::now()->addYear(1)->format('Y-m-d');
        if ($interval == 6) return \Carbon\Carbon::now()->addYear(1)->format('Y-m-d');
    }

    protected function checkIntervalChanges($old_interval, $new_interval)
    {

        if ($old_interval != $new_interval) return true;

        return false;
    }


}
