<?php

namespace App\Controllers\Ecommerce;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\SizeModel;

class Shoppingcart extends BaseController
{
    public function __construct()
    {
        $this->mdlProduct = new ProductModel();
        $this->mdlSize = new SizeModel();
    }
    public function index()
    {
        //ADD PRODUCT TO SHOPPING CART
        if ($this->request->getPostGet('r') == 'addproduct') {

            $idProduct = $this->request->getPostGet('id_product');
            $idSize = $this->request->getPostGet('id_size');

            $product = $this->mdlProduct->find($idProduct);

            //VERIFICA QUE NO INGRESEN MAS DE TRES PRENDAS
            if (isset($_SESSION['shoppingcart'])) {
                $contadorQuantity = 0;
                foreach ($_SESSION['shoppingcart'] as $abc) {
                    $contadorQuantity += $abc['quantity'];
                }
                if ($contadorQuantity > 2) {
                    return redirect()
                        ->to(base_url() . route_to('view_single_product') . '?id=' . $idProduct)
                        ->with('stock', 'Por hoy, dia sin IVA, solo puedes agregar 3 productos al carrito de compras.');
                }
            }

            //verfica si hay stock o productos en stock
            if (!$product->isInStock($idSize, 1)) {
                return redirect()
                    ->to(base_url() . route_to('view_single_product') . '?id=' . $idProduct)
                    ->with('stock', 'No hay existencia en esa talla, te sugerimos escoger otra talla o ver más productos.');
            }

            //---------------
            $item = 'prod' . $idProduct . 'size' .  $idSize;

            if (isset($_SESSION['shoppingcart'])) {
                $created = false;
                foreach ($_SESSION['shoppingcart'] as $key => $value) {
                    if ($key == $item) {

                        $quantityShoppingCart = $_SESSION['shoppingcart'][$item]['quantity'] + 1;
                        if ($product->isInStock($idSize, $quantityShoppingCart)) {
                            $_SESSION['shoppingcart'][$item]['quantity'] += 1;
                            $created = true;
                        } else {
                            return redirect()
                                ->to(base_url() . route_to('view_single_product') . '?id=' . $idProduct)
                                ->with('stock', 'No hay existencia en esa talla, te sugerimos escoger otra talla o ver más productos.');
                        }
                    }
                }
                if (!$created) {
                    $this->session->push('shoppingcart',  [
                        $item => [
                            'id_product'  => $idProduct,
                            'id_size'     => $idSize,
                            'quantity' => 1
                        ]
                    ]);
                }
            } else {
                $this->session->set('shoppingcart', [
                    $item => [
                        'id_product'  => $idProduct,
                        'id_size'     => $idSize,
                        'quantity' => 1
                    ]
                ]);
            }
        }

        //MOSTRAR LOS CARRITOS DE COMPRAS
        $arrayProducts = array();
        if (empty($_SESSION['shoppingcart'])) {
            return view('ecommerce/shopping_cart/empty_cart');
        }

        foreach ($_SESSION['shoppingcart'] as $item) {
            array_push($arrayProducts, [
                'product' => $this->mdlProduct->find($item['id_product']),
                'id_size' => $item['id_size'],
                'name_size' => $this->mdlSize->find($item['id_size'])['name_size'],
                'quantity' => $item['quantity'],
            ]);
        }
        return view('ecommerce/shopping_cart/cart', [
            'items' => $arrayProducts
        ]);
    }

    public function deleteItemCart()
    {
        $idSize = $this->request->getPost('id_size');
        $idProduct = $this->request->getPost('id_product');
        $item = 'prod' . $idProduct . 'size' .  $idSize;
        unset($_SESSION['shoppingcart'][$item]);
        return redirect()->to(base_url() . route_to('shoppingcart'));
    }

    public function destroy()
    {
        $this->session->destroy('shoppingcart');
    }
    public function show()
    {
        dd($_SESSION['shoppingcart']);
    }
}
