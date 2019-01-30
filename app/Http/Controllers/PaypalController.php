<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 1. Autoload the SDK Package. This will include all the files and classes to your autoloader
// Used for composer based installation
require __DIR__ . './../../../vendor/autoload.php';
// Use below for direct download installation
// require __DIR__  . '/PayPal-PHP-SDK/autoload.php';
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PaypalController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                config('paypal.client_id'),
                config('paypal.secret')
            )
        );
        $this->apiContext->setConfig(config('paypal.setting'));
    }

    public function index()
    {
        return view('paypal.index');
    }

    public function create(Request $request)
    {
        if (isset($_GET['token']) && isset($_GET['paymentId'])) {
            // Get the payment Object by passing paymentId
            // payment id was previously stored in session in
            // CreatePaymentUsingPayPal.php
            $paymentId = $_GET['paymentId'];
            $payment = Payment::get($paymentId, $this->apiContext);
            // ### Payment Execute
            // PaymentExecution object includes information necessary
            // to execute a PayPal account payment.
            // The payer_id is added to the request query parameters
            // when the user is redirected from paypal back to your site
            $execution = new PaymentExecution();
            $execution->setPayerId($_GET['PayerID']);
            // ### Optional Changes to Amount
            // If you wish to update the amount that you wish to charge the customer,
            // based on the shipping address or any other reason, you could
            // do that by passing the transaction object with just `amount` field in it.
            // Here is the example on how we changed the shipping to $1 more than before.
            $transaction = new Transaction();
            $amount = new Amount();
            $details = new Details();
            $details->setShipping(2.2)
                ->setTax(1.3)
                ->setSubtotal(17.50);
            $amount->setCurrency('USD');
            $amount->setTotal(21);
            $amount->setDetails($details);
            $transaction->setAmount($amount);
            // Add the above transaction object inside our Execution object.
            $execution->addTransaction($transaction);
            try {
                // Execute the payment
                // (See bootstrap.php for more on `ApiContext`)
                $result = $payment->execute($execution, $this->apiContext);
                // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
//                ResultPrinter::printResult("Executed Payment", "Payment", $payment->getId(), $execution, $result);
                echo "Executed Payment" . $payment->getId();
                try {
                    $payment = Payment::get($paymentId, $this->apiContext);
                } catch (Exception $ex) {
                    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
//                    ResultPrinter::printError("Get Payment", "Payment", null, null, $ex);
                    echo "Get Payment" ;
                    exit(1);
                }
            } catch (Exception $ex) {
                // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
//                ResultPrinter::printError("Executed Payment", "Payment", null, null, $ex);
                echo "Executed Payment";
                exit(1);
            }
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
//            ResultPrinter::printResult("Get Payment", "Payment", $payment->getId(), null, $payment);
            echo "<pre>" ;
            return $payment;
        } else {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
//            ResultPrinter::printResult("User Cancelled the Approval", null);
            echo "User Cancelled the Approval";
            exit;
        }
    }

    public function store(Request $request)
    {
        // ### Payer
// A resource representing a Payer that funds a payment
// For paypal account payments, set payment method
// to 'paypal'.
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");
// ### Itemized information
// (Optional) Lets you specify item wise
// information
        $item1 = new Item();
        $item1->setName('Ground Coffee 40 oz')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setSku("123123")// Similar to `item_number` in Classic API
            ->setPrice(7.5);
        $item2 = new Item();
        $item2->setName('Granola bars')
            ->setCurrency('USD')
            ->setQuantity(5)
            ->setSku("321321")// Similar to `item_number` in Classic API
            ->setPrice(2);
        $itemList = new ItemList();
        $itemList->setItems(array($item1, $item2));
// ### Additional payment details
// Use this optional field to set additional
// payment information such as tax, shipping
// charges etc.
        $details = new Details();
        $details->setShipping(1.2)
            ->setTax(1.3)
            ->setSubtotal(17.50);
// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal(20)
            ->setDetails($details);
// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it.
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());
// ### Redirect urls
// Set the urls that the buyer must be redirected to after
// payment approval/ cancellation.
        $baseUrl = url('/');
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(url('/paypal/create'))
            ->setCancelUrl(url('/paypal/error'));
// ### Payment
// A Payment Resource; create one using
// the above types and intent set to 'sale'
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
// For Sample Purposes Only.
        $request = clone $payment;
// ### Create Payment
// Create a payment by calling the 'create' method
// passing it a valid apiContext.
// (See bootstrap.php for more on `ApiContext`)
// The return object contains the state and the
// url to which the buyer must be redirected to
// for payment approval
        try {
            $payment->create($this->apiContext);
        } catch (Exception $ex) {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            echo "Created Payment Using PayPal. Please visit the URL to Approve.";
            exit(1);
        }
// ### Get redirect url
// The API response provides the url that you must redirect
// the buyer to. Retrieve the url from the $payment->getApprovalLink()
// method
        $approvalUrl = $payment->getApprovalLink();
// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
        return redirect()->to($approvalUrl);
    }

    public function success()
    {
        return view('paypal.success');
    }

    public function error()
    {
        return view('paypal.error');
    }
}
