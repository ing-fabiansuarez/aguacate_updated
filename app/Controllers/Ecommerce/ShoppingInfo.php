<?php

namespace App\Controllers\Ecommerce;

use App\Controllers\BaseController;
use App\Models\CityModel;
use App\Models\DepartmentModel;
use App\Models\PaymentMethodModel;
use App\Models\ProductModel;
use App\Models\SizeModel;
use App\Models\TypeIdentificationModel;

class ShoppingInfo extends BaseController
{
    public function __construct()
    {
        $this->mdlDepartment = new DepartmentModel();
        $this->mdlTypeIdentification = new TypeIdentificationModel();
        $this->mdlCity = new CityModel();
        $this->mdlProduct = new ProductModel();
        $this->mdlSize = new SizeModel();
        $this->mdlPaymentMethod = new PaymentMethodModel();
    }
    public function index()
    {
        if (isset($_SESSION['shoppingcart'])) {
            if (count($_SESSION['shoppingcart']) >= 1) {
                /*  if (isset($_SESSION['shippinginformation'])) {
                    $informationshipping = $_SESSION['shippinginformation'];
                } else {
                    $informationshipping = [
                        'department' => '',
                        'city' => '',
                        'adress' => '',
                        'neighborhood' => '',
                        'name' => '',
                        'surname' => '',
                        'typeid' => '',
                        'numberid' => '',
                        'numphone' => '',
                        'email' => '',
                    ];
                } */
                return view('ecommerce/shopping_info/info', [
                    'departments' => $this->mdlDepartment->findAll(),
                    'typeiden' => $this->mdlTypeIdentification->findAll()
                ]);
            } else {
                return redirect()->route('shoppingcart');
            }
        } else {
            return redirect()->route('shoppingcart');
        }
    }

    public function finalize()
    {
        //crear el shipping  information
        if ($this->request->getPost('r') == 'create') {
            //validaciones del formulario
            if (!($this->validate(
                $this->rulesvalidation->getRuleGroup('validateShippInfoEcommerce')
            ))) {
                return redirect()->to(base_url() . route_to('view_customer_data'))->with('error_validation', $this->validator->getErrors())->withInput();
            }
            //validar si hay productos en el carrito de compras
            if (!isset($_SESSION['shoppingcart'])) {
                return redirect()->route('shoppingcart');
            }
            //datos recibidos desde el formulario
            $city = $this->request->getPost('ciudad');
            $address = $this->request->getPost('direccion');
            $neighborhood = $this->request->getPost('barrio');
            $name = $this->request->getPost('nombres');
            $surname = $this->request->getPost('apellidos');
            $typeIdentification = $this->request->getPost('tipo_identificacion');
            $numIdentification = $this->request->getPost('num_identificacion');
            $phoneNumber = $this->request->getPost('celular');
            $email = $this->request->getPost('email');

            $information = [
                'reference' => uniqid(),
                'city' => $city,
                'address' => $address,
                'neighborhood' => $neighborhood,
                'name' => $name,
                'surname' => $surname,
                'typeInden' => $typeIdentification,
                'numIdent' => $numIdentification,
                'phoneNumb' => $phoneNumber,
                'email' => $email,
                'freight' =>  $this->mdlCity->getcity($city)['price_typejourney']
            ];

            //save shippinginformation in session
            if (isset($_SESSION['shoppinginformation'])) {
                $this->session->push('shoppinginformation', $information);
            } else {
                $this->session->set('shoppinginformation', $information);
            }
        }

        //mostrar la seccion de  de finalize
        //validar si hay productos en el carrito de compras
        if (!isset($_SESSION['shoppingcart'])) {
            return redirect()->route('shoppingcart');
        }
        //validar si hay productos en el carrito de compras
        if (!isset($_SESSION['shoppinginformation'])) {
            return redirect()->route('shoppingcart');
        }
        //actualizar la referencia cada vez que la pagina cargue
        $_SESSION['shoppinginformation']['reference'] = uniqid();

        //MOSTRAR LOS CARRITOS DE COMPRAS
        $arrayProducts = array();

        foreach ($_SESSION['shoppingcart'] as $item) {
            array_push($arrayProducts, [
                'product' => $this->mdlProduct->find($item['id_product']),
                'id_size' => $item['id_size'],
                'name_size' => $this->mdlSize->find($item['id_size'])['name_size'],
                'quantity' => $item['quantity'],
            ]);
        }

        $city = $this->mdlCity->getcity($_SESSION['shoppinginformation']['city']);
        //CALCULAR EL FLETE
        /* $freight = $city['price_typejourney']; */
        $freight = $_SESSION['shoppinginformation']['freight'];

        //PASAR LOS TARJETAS DE CREDITO
        $creditCard = $this->mdlPaymentMethod->where('type_paymentmethod_id', 1)
            ->where('active_paymentmethod', true)
            ->findAll();
        return view('ecommerce/shopping_info/finalize', [
            'cityAndDepartment' => $city['name_city'] . ' - ' . $city['name_department'],
            'addressHome' => $_SESSION['shoppinginformation']['address'] . ' barrio ' . $_SESSION['shoppinginformation']['neighborhood'],
            'nameComplete' => $_SESSION['shoppinginformation']['name'] . ' ' . $_SESSION['shoppinginformation']['surname'],
            'abrev' =>  $this->mdlTypeIdentification->find($_SESSION['shoppinginformation']['typeInden'])['abre_typeinden'],
            'numIndentification' => $_SESSION['shoppinginformation']['numIdent'],
            'numPhone' => $_SESSION['shoppinginformation']['phoneNumb'],
            'email' => $_SESSION['shoppinginformation']['email'],
            'items' => $arrayProducts,
            'freight' => $freight,
            'credit_cards' => $creditCard
        ]);
    }
}
