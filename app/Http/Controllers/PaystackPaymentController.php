<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaystackPaymentController extends Controller
{
    /**
     * Initialize Paystack Payment
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function initializePayment(Request $request)
    {
        // Validate the total amount
        $request->validate([
            'total' => 'required|numeric|min:1',
        ]);

        // Retrieve cart from session
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        // Calculate the total amount
        $total = $request->total * 100; // Convert to kobo
        $email = Auth::user()->email;

        // Check if PAYSTACK_SECRET_KEY is set
        $paystackSecretKey = env('PAYSTACK_SECRET_KEY');
        if (empty($paystackSecretKey)) {
            return back()->with('error', 'Payment configuration error.');
        }

        // Initialize Paystack transaction
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $paystackSecretKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.paystack.co/transaction/initialize', [
            'email' => $email,
            'amount' => $total,
            'currency' => 'NGN',
            'callback_url' => route('paystack.callback'),
        ]);

        $data = $response->json();

        if ($data['status']) {
            return redirect()->away($data['data']['authorization_url']);
        } else {
            return back()->with('error', 'Payment initialization failed.');
        }
    }

    /**
     * Handle Paystack Payment Callback
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleCallback(Request $request)
    {
        // Check if PAYSTACK_SECRET_KEY is set
        $paystackSecretKey = env('PAYSTACK_SECRET_KEY');
        if (empty($paystackSecretKey)) {
            return redirect()->route('payment.failed')->with('error', 'Payment configuration error.');
        }

        // Verify the Paystack transaction
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $paystackSecretKey,
        ])->get('https://api.paystack.co/transaction/verify/' . $request->reference);

        $paymentData = $response->json();

        if ($paymentData['status'] && $paymentData['data']['status'] === 'success') {
            // Clear cart after successful payment
            session()->forget('cart');
            return redirect()->route('payment.success')->with('success', 'Payment successful!');
        } else {
            return redirect()->route('payment.failed')->with('error', 'Payment failed.');
        }
    }
}