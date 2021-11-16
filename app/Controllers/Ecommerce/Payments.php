<?php

namespace App\Controllers\Ecommerce;

use App\Controllers\BaseController;
use App\Entities\ShoppingCartClass;
use App\Models\OrderPwModel;
use App\Models\PaymentMethodModel;
use Environment;
use Exception;
use PayU;
use PayUCountries;
use PayUParameters;
use PayUPayments;
use PayUReports;
use SupportedLanguages;

class Payments extends BaseController
{
    public function __construct()
    {
        //VARIABLES DE PAY U
        PayU::$apiKey = getenv('payu.API_KEY'); // Enter your API key here
        PayU::$apiLogin = getenv('payu.API_LOGIN'); // Enter your API Login here
        PayU::$merchantId = getenv('payu.MERCHANT_ID'); // Enter your Merchant Id here
        PayU::$language = SupportedLanguages::ES; // Enter the language here
        PayU::$isTest = getenv('payu.IS_TEST'); // assign true if you are in test mode

        // Payments URL
        Environment::setPaymentsCustomUrl(getenv('payu.PAYMENTS_URL'));
        // Reports URL
        Environment::setReportsCustomUrl(getenv('payu.REPORTS_URL'));

        //DECLARACION DE LOS MODELOS
        $this->mdlMPaymentMethod = new PaymentMethodModel();
        $this->mdlOrder = new OrderPwModel();
    }

    public function creditCard()
    {
        //verificar si existe shopping cart y la informacion en la session
        if (empty($_SESSION['shoppingcart']) || empty($_SESSION['shoppinginformation'])) {
            return redirect()->to(base_url() . route_to('shoppingcart'));
        }

        //VARIALES RECIBIDAS DE LA TARJETA DE CREDITO
        $paymentMethod = $this->request->getPost('method_payment');
        $cardNumber = str_replace(' ', '', $this->request->getPost('card-number'));
        $expiryMonth = $this->request->getPost('expiry-month');
        $expiryYear = $this->request->getPost('expiry-year');
        echo $expiryMonth . '<br>';
        echo $expiryYear;
        if ($expiryMonth < 10) {
            $expiryMonth = "0" . $expiryMonth;
        }
        $cvc = $this->request->getPost('cvc');
        $cuotasNumber = $this->request->getPost('num-cuotas');

        // se crea el objeto de shopping cart
        $shoppingCartClass = new ShoppingCartClass($_SESSION['shoppingcart'], $_SESSION['shoppinginformation']);

        $values = $shoppingCartClass->getPrices();
        $cityAndDepartment = $shoppingCartClass->getCityAndDepartment();

        //informaicon del device
        $deviceSessionId = md5(session_id() . microtime());
        $player_cookies = session_id();
        $user_agente = $_SERVER['HTTP_USER_AGENT'];

        $parameters = array(
            //Ingrese aquí el identificador de la cuenta.
            PayUParameters::ACCOUNT_ID => getenv('payu.ACCOUNT_ID'),
            //Ingrese aquí el código de referencia.
            PayUParameters::REFERENCE_CODE => $shoppingCartClass->reference,
            //Ingrese aquí la descripción.
            PayUParameters::DESCRIPTION => $shoppingCartClass->description,

            // -- Valores --
            //Ingrese aquí el valor de la transacción.
            PayUParameters::VALUE =>  $values['TOTAL'],
            //Ingrese aquí el valor del IVA (Impuesto al Valor Agregado solo valido para Colombia) de la transacción,
            //si se envía el IVA nulo el sistema aplicará el 19% automáticamente. Puede contener dos dígitos decimales.
            //Ej: 19000.00. En caso de no tener IVA debe enviarse en 0.
            PayUParameters::TAX_VALUE => $values['TAX_VALUE'],
            //Ingrese aquí el valor base sobre el cual se calcula el IVA (solo valido para Colombia).
            //En caso de que no tenga IVA debe enviarse en 0.
            PayUParameters::TAX_RETURN_BASE => $values['TAX_RETURN_BASE'],
            //Ingrese aquí la moneda.
            PayUParameters::CURRENCY => "COP",

            // -- Comprador
            //Ingrese aquí el nombre del comprador.
            PayUParameters::BUYER_NAME => $shoppingCartClass->getNameCompleteCustomer(),
            //Ingrese aquí el email del comprador.
            PayUParameters::BUYER_EMAIL => $shoppingCartClass->sessionShoppingInfo['email'],
            //Ingrese aquí el teléfono de contacto del comprador.
            PayUParameters::BUYER_CONTACT_PHONE => $shoppingCartClass->sessionShoppingInfo['phoneNumb'],
            //Ingrese aquí el documento de contacto del comprador.
            PayUParameters::BUYER_DNI =>  $shoppingCartClass->sessionShoppingInfo['numIdent'],
            //Ingrese aquí la dirección del comprador.
            PayUParameters::BUYER_STREET => $shoppingCartClass->sessionShoppingInfo['address'],
            PayUParameters::BUYER_STREET_2 => $shoppingCartClass->sessionShoppingInfo['neighborhood'],
            PayUParameters::BUYER_CITY => $cityAndDepartment['name_city'],
            PayUParameters::BUYER_STATE => $cityAndDepartment['name_department'],
            PayUParameters::BUYER_COUNTRY => "CO",
            PayUParameters::BUYER_POSTAL_CODE => "000000",
            PayUParameters::BUYER_PHONE => $shoppingCartClass->sessionShoppingInfo['phoneNumb'],

            // -- pagador --
            //Ingrese aquí el nombre del pagador.
            PayUParameters::PAYER_NAME => $shoppingCartClass->getNameCompleteCustomer(),
            //Ingrese aquí el email del pagador.
            PayUParameters::PAYER_EMAIL => $shoppingCartClass->sessionShoppingInfo['email'],
            //Ingrese aquí el teléfono de contacto del pagador.
            PayUParameters::PAYER_CONTACT_PHONE => $shoppingCartClass->sessionShoppingInfo['phoneNumb'],
            //Ingrese aquí el documento de contacto del pagador.
            PayUParameters::PAYER_DNI => $shoppingCartClass->sessionShoppingInfo['numIdent'],
            //Ingrese aquí la dirección del pagador.
            PayUParameters::PAYER_STREET => $shoppingCartClass->sessionShoppingInfo['address'],
            PayUParameters::PAYER_STREET_2 =>  $shoppingCartClass->sessionShoppingInfo['neighborhood'],
            PayUParameters::PAYER_CITY => $cityAndDepartment['name_city'],
            PayUParameters::PAYER_STATE => $cityAndDepartment['name_department'],
            PayUParameters::PAYER_COUNTRY => "CO",
            PayUParameters::PAYER_POSTAL_CODE => "000000",
            PayUParameters::PAYER_PHONE => $shoppingCartClass->sessionShoppingInfo['phoneNumb'],

            // -- Datos de la tarjeta de crédito --
            //Ingrese aquí el número de la tarjeta de crédito
            PayUParameters::CREDIT_CARD_NUMBER => $cardNumber,
            //Ingrese aquí la fecha de vencimiento de la tarjeta de crédito
            PayUParameters::CREDIT_CARD_EXPIRATION_DATE => "20" . $expiryYear . "/" . $expiryMonth,
            //Ingrese aquí el código de seguridad de la tarjeta de crédito
            PayUParameters::CREDIT_CARD_SECURITY_CODE =>  $cvc,
            //Ingrese aquí el nombre de la tarjeta de crédito
            //VISA||MASTERCARD||AMEX||DINERS
            PayUParameters::PAYMENT_METHOD => $paymentMethod,

            //Ingrese aquí el número de cuotas.
            PayUParameters::INSTALLMENTS_NUMBER =>  $cuotasNumber,
            //Ingrese aquí el nombre del pais.
            PayUParameters::COUNTRY => PayUCountries::CO,

            //Session id del device.
            PayUParameters::DEVICE_SESSION_ID => $deviceSessionId,
            //IP del pagadador
            PayUParameters::IP_ADDRESS => "127.0.0.1",
            //Cookie de la sesión actual.
            PayUParameters::PAYER_COOKIE =>  $player_cookies,
            //Cookie de la sesión actual.
            PayUParameters::USER_AGENT => $user_agente
        );

        $msg = '';
        try {
            $response = PayUPayments::doAuthorizationAndCapture($parameters);
        } catch (Exception $error) {
            $msg = $error->getMessage();
            $state = 'ERROR';
            return redirect()->to(base_url() . route_to('view_request_page_credit_card_payment') . '?state=' . $state . '&msg=' . $msg);
        }

        if ($response) {
            $orderId = $response->transactionResponse->orderId;
            $transactionId = $response->transactionResponse->transactionId;
            $state = $response->transactionResponse->state;
            if ($state == "PENDING") {
            }
            $shoppingCartClass->save($state, $orderId);
            return redirect()->to(base_url() . route_to('view_request_page_credit_card_payment') . '?state=' . $state . '&msg=' . $msg);
        }
    }


    public function pse()
    {
        //verificar si existe shopping cart y la informacion en la session
        if (empty($_SESSION['shoppingcart']) || empty($_SESSION['shoppinginformation'])) {
            return redirect()->to(base_url() . route_to('shoppingcart'));
        }

        //VARIALES RECIBIDAS PARA HACER EL PAGO POR PSE
        $typePerson = $this->request->getPost('type_person');
        $typeDocument = $this->request->getPost('type_document');
        $numDocument = $this->request->getPost('number_document');
        $bank = $this->request->getPost('bank');

        // se crea el objeto de shopping cart
        $shoppingCartClass = new ShoppingCartClass($_SESSION['shoppingcart'], $_SESSION['shoppinginformation']);

        $values = $shoppingCartClass->getPrices();
        $cityAndDepartment = $shoppingCartClass->getCityAndDepartment();

        //informaicon del device
        $deviceSessionId = md5(session_id() . microtime());
        $player_cookies = session_id();
        $user_agente = $_SERVER['HTTP_USER_AGENT'];




        $reference = "payment_test_00000001";
        $value = "65000";

        $parameters = array(
            //Ingresa aquí el identificador de la cuenta
            PayUParameters::ACCOUNT_ID => getenv('payu.ACCOUNT_ID'),
            // Ingresa aquí la referencia de pago.
            PayUParameters::REFERENCE_CODE => $shoppingCartClass->reference,
            // Ingresa aquí la descripción del pago.
            PayUParameters::DESCRIPTION => $shoppingCartClass->description,

            // -- Valores --
            //Ingresa aquí el valor.
            PayUParameters::VALUE => $values['TOTAL'],
            // Ingresa el valor del IVA (Impuesto al valor agregado válido únicamente en Colombia) de la transacción,
            // Si no se envía IVA, ell sistema aplica el 19% automáticamente. Puede contener dos dígitos decimales
            // Ejemplo 19000.00. En caso de ser exento de IVA, asigna 0.
            PayUParameters::TAX_VALUE => $values['TAX_VALUE'],
            // Ingresa el valor base sobre el que se calcula el IVA (válido únicamente en Colombia).
            // En caso de ser exento de IVA, asigna 0.
            PayUParameters::TAX_RETURN_BASE => $values['TAX_RETURN_BASE'],
            // Ingresa aquí la moneda.
            PayUParameters::CURRENCY => "COP",

            // -- Comprador --
            // Ingresa aquí el identificador del comprador.
            PayUParameters::BUYER_ID => "1",
            // Ingresa aquí el nombre del comprador.
            PayUParameters::BUYER_NAME => $shoppingCartClass->getNameCompleteCustomer(),
            // Ingresa aquí el correo electrónico del comprador.
            PayUParameters::BUYER_EMAIL => $shoppingCartClass->sessionShoppingInfo['email'],
            // Ingresa aquí el teléfono de contacto del comprador.
            PayUParameters::BUYER_CONTACT_PHONE => $shoppingCartClass->sessionShoppingInfo['phoneNumb'],
            // Ingresa aquí el número de identificación del comprador.
            PayUParameters::BUYER_DNI => $numDocument,
            // Ingresa aquí la dirección del comprador.
            PayUParameters::BUYER_STREET => $shoppingCartClass->sessionShoppingInfo['address'],
            PayUParameters::BUYER_STREET_2 => $shoppingCartClass->sessionShoppingInfo['neighborhood'],
            PayUParameters::BUYER_CITY =>  $cityAndDepartment['name_city'],
            PayUParameters::BUYER_STATE => $cityAndDepartment['name_department'],
            PayUParameters::BUYER_COUNTRY => "CO",
            PayUParameters::BUYER_POSTAL_CODE => "000000",
            PayUParameters::BUYER_PHONE => $shoppingCartClass->sessionShoppingInfo['phoneNumb'],


            // -- Pagador --
            // Ingresa aquí el identificador del pagador.
            //PayUParameters::PARAMETERS . PAYER_ID => "1",
            /// Ingresa aquí el nombre del pagador
            PayUParameters::PAYER_NAME => $shoppingCartClass->getNameCompleteCustomer(),
            // Ingresa aquí el correo electrónico del pagador
            PayUParameters::PAYER_EMAIL =>  $shoppingCartClass->sessionShoppingInfo['email'],
            // Ingresa aquí el número de teléfono del pagador.
            PayUParameters::PAYER_CONTACT_PHONE => $shoppingCartClass->sessionShoppingInfo['phoneNumb'],
            // Ingresa aquí el número de identificación del pagador.
            PayUParameters::PAYER_DNI => $numDocument,
            // Ingresa aquí la dirección del pagador.
            PayUParameters::PAYER_STREET => $shoppingCartClass->sessionShoppingInfo['address'],
            PayUParameters::PAYER_STREET_2 =>  $shoppingCartClass->sessionShoppingInfo['neighborhood'],
            PayUParameters::PAYER_CITY =>  $cityAndDepartment['name_city'],
            PayUParameters::PAYER_STATE =>  $cityAndDepartment['name_department'],
            PayUParameters::PAYER_COUNTRY => "CO",
            PayUParameters::PAYER_POSTAL_CODE => "000000",
            PayUParameters::PAYER_PHONE => $shoppingCartClass->sessionShoppingInfo['phoneNumb'],

            //-- Información obligatoria para PSE –
            // Ingresa aquí el código PSE del banco.
            PayUParameters::PSE_FINANCIAL_INSTITUTION_CODE => $bank,
            // Ingresa aquí el tipo de persona (Natural o Jurídica).
            PayUParameters::PAYER_PERSON_TYPE => $typePerson,
            // or PayUParameters::PAYER_PERSON_TYPE => "J"
            // Ingresa aquí el número de identificación del pagador.
            PayUParameters::PAYER_DNI => $numDocument,
            // Ingresa aquí el tipo de documento del pagador.
            PayUParameters::PAYER_DOCUMENT_TYPE => $typeDocument,

            // Ingresa aquí el nombre del método de pago
            PayUParameters::PAYMENT_METHOD => "PSE",

            // Ingresa aquí el nombre del país.
            PayUParameters::COUNTRY => PayUCountries::CO,

            // Device Session ID
            PayUParameters::DEVICE_SESSION_ID => $deviceSessionId,
            // IP del pagador
            PayUParameters::IP_ADDRESS => "127.0.0.1",
            // Cookie de la sesión actual
            PayUParameters::PAYER_COOKIE =>  $player_cookies,
            // User agent de la sesión actual
            PayUParameters::USER_AGENT =>  $user_agente,

            // Página de respuesta a donde será redireccionado el pagador.
            PayUParameters::RESPONSE_URL => base_url() . route_to('view_request_page_payment')
        );

        // Petición de Autorización
        $response = PayUPayments::doAuthorizationAndCapture($parameters);

        d($response);
        // Puedes obtener las propiedades en la respuesta
        if ($response) {
            $orderId = $response->transactionResponse->orderId;
            $transactionId = $response->transactionResponse->transactionId;
            $state = $response->transactionResponse->state;
            if ($state == "PENDING") {
                $response->transactionResponse->pendingReason;
                $response->transactionResponse->trazabilityCode;
                //$response->transactionResponse->authorizationCode;
                $shoppingCartClass->save($state, $orderId);
                return redirect()->to($response->transactionResponse->extraParameters->BANK_URL);
            }
            $shoppingCartClass->save($state, $orderId);
            return redirect()->to($response->transactionResponse->extraParameters->BANK_URL);
            /* $response->transactionResponse->paymentNetworkResponseCode;
            $response->transactionResponse->paymentNetworkResponseErrorMessage;
            $response->transactionResponse->trazabilityCode;
            $response->transactionResponse->responseCode;
            $response->transactionResponse->responseMessage; */
        }
    }


    public function getBanksAvailable()
    {
        // Ingresa aquí el nombre del método de pago
        $parameters = array(
            // Ingresa aquí el nombre del método de pago.
            PayUParameters::PAYMENT_METHOD => "PSE",
            // Ingresa aquí el nombre del país.
            PayUParameters::COUNTRY => PayUCountries::CO,
        );
        $array = PayUPayments::getPSEBanks($parameters);
        $banks = $array->banks;

        echo json_encode($banks);
    }


    public function updateStateOrder()
    {
        foreach ($this->mdlOrder->where('state_order', 'PENDING')->findAll() as $orderPw) {
            // Incluye aquí la referencia de la orden.
            $parameters = array(PayUParameters::REFERENCE_CODE => $orderPw->ref_orderpw);
            $response = PayUReports::getOrderDetailByReferenceCode($parameters);
            d($response);
            foreach ($response as $order) {
                $order->accountId;
                $order->status;
                $order->referenceCode;
                $order->additionalValues->TX_VALUE->value;
                $order->additionalValues->TX_TAX->value;

                if ($order->buyer) {
                    $order->buyer->emailAddress;
                    $order->buyer->fullName;
                }

                $transactions = $order->transactions;
                foreach ($transactions as $transaction) {
                    $transaction->type;
                    $transaction->transactionResponse->state;
                    $transaction->transactionResponse->paymentNetworkResponseCode;
                    $transaction->transactionResponse->trazabilityCode;
                    $transaction->transactionResponse->responseCode;
                    if ($transaction->payer) {
                        $transaction->payer->fullName;
                        $transaction->payer->emailAddress;
                    }
                }
                $orderPw->changeState($transaction->transactionResponse->state);
                if ($orderPw->hasChanged()) {
                    $this->mdlOrder->save($orderPw);
                }

                d($orderPw);
            }
        }
    }
}
