<?php

namespace App\Http\Controllers;

use App\Plan;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    public function store(Request $request)
    {
        // get the plan after submitting the form
        $plan = Plan::findOrFail($request->plan);

        // subscribe the user
        $request->user()->newSubscription('main', $plan->braintree_plan)->create($request->payment_method_nonce);

        // redirect to home after a successful subscription
        return redirect('home');
    }
}
