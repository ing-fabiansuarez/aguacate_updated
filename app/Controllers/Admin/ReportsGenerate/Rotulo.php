<?php

namespace App\Controllers\Admin\ReportsGenerate;

use App\Controllers\BaseController;
use App\Models\OrderPwModel;
use FPDF;

class Rotulo extends BaseController
{
    public function __construct()
    {
        $this->mdlOrder = new OrderPwModel();
    }
    public function index()
    {
        //el dato traido para imprimir el rotulo
        $refOrder = $this->request->getPostGet('ref_orderpw');
        //verficar si existe el pedido
        if (!$orderpw = $this->mdlOrder->find($refOrder)) {
            echo "EL PEDIDO NO EXISTE";
            return;
        }
        //se trae la informacion del pedido
        $shoppingInfo = $orderpw->getShoppingInfo();
        //revisa si el pedido esta aprobado
        if ($orderpw->state_order != 'APPROVED') {
            echo "EL PEDIDO NO ESTA APROBADO";
            return;
        }

        $hCell = 10;
        $nameFont = "Courier";
        $sizefontTitles = 25;
        $sizefontBody = 18;
        $showBorder = 0; //1 fmuestra 0 no muestra

        //SE DECLARA LA CLASE DE PDF
        $pdf = new FPDF('P', 'mm', array(215, 280));
        $pdf->AddPage();
        // Imagen Fondo
        $pdf->Image(base_url('assets/img/brand/Rotulo.jpg'), 0, 0, 215);
        $pdf->Cell(30, 88, '', $showBorder, 1, 'C');

        //LINEA nombre
        $pdf->SetFont($nameFont, 'B', $sizefontTitles);
        $pdf->Cell(10, $hCell, '', $showBorder, 0, 'C');
        $pdf->Cell(55, $hCell, 'NOMBRE:', $showBorder, 0, 'R');
        $pdf->Cell(6, $hCell, '', $showBorder, 0, 'C');
        $pdf->SetFont($nameFont, '', $sizefontBody);
        $pdf->MultiCell(110, $hCell, $shoppingInfo['name_shoppinginfo'] . ' ' . $shoppingInfo['surname_shoppinginfo'], $showBorder, 'L');

        //LINEA nombre
        $pdf->SetFont($nameFont, 'B', $sizefontTitles);
        $pdf->Cell(10, $hCell, '', $showBorder, 0, 'C');
        $pdf->Cell(55, $hCell, $shoppingInfo['abre_typeinden'] . ':', $showBorder, 0, 'R');
        $pdf->Cell(6, $hCell, '', $showBorder, 0, 'C');
        $pdf->SetFont($nameFont, '', $sizefontBody);
        $pdf->MultiCell(110, $hCell, $shoppingInfo['cedula_num_shoppinginfo'], $showBorder, 'L');

        //LINEA TELEFONO
        $pdf->SetFont($nameFont, 'B', $sizefontTitles);
        $pdf->Cell(10, $hCell, '', $showBorder, 0, 'C');
        $pdf->Cell(55, $hCell,  utf8_decode('TELÉFONO:'), $showBorder, 0, 'R');
        $pdf->Cell(6, $hCell, '', $showBorder, 0, 'C');
        $pdf->SetFont($nameFont, '', $sizefontBody);
        $pdf->MultiCell(110, $hCell, $shoppingInfo['num_phone'], $showBorder, 'L');

        //LINEA EMAIL
        $pdf->SetFont($nameFont, 'B', $sizefontTitles);
        $pdf->Cell(10, $hCell, '', $showBorder, 0, 'C');
        $pdf->Cell(55, $hCell,  'E-MAIL:', $showBorder, 0, 'R');
        $pdf->Cell(6, $hCell, '', $showBorder, 0, 'C');
        $pdf->SetFont($nameFont, '', $sizefontBody);
        $pdf->MultiCell(110, $hCell, $shoppingInfo['email_shoppinginfo'], $showBorder, 'L');

        //LINEA CIUDAD
        $pdf->SetFont($nameFont, 'B', $sizefontTitles);
        $pdf->Cell(10, $hCell, '', $showBorder, 0, 'C');
        $pdf->Cell(55, $hCell,  'CIUDAD:', $showBorder, 0, 'R');
        $pdf->Cell(6, $hCell, '', $showBorder, 0, 'C');
        $pdf->SetFont($nameFont, '', $sizefontBody);
        $pdf->MultiCell(110, $hCell, $shoppingInfo['name_city'] . ' - ' . $shoppingInfo['name_department'], $showBorder, 'L');

        //LINEA BARRIO
        $pdf->SetFont($nameFont, 'B', $sizefontTitles);
        $pdf->Cell(10, $hCell, '', $showBorder, 0, 'C');
        $pdf->Cell(55, $hCell,  'BARRIO:', $showBorder, 0, 'R');
        $pdf->Cell(6, $hCell, '', $showBorder, 0, 'C');
        $pdf->SetFont($nameFont, '', $sizefontBody);
        $pdf->MultiCell(110, $hCell, $shoppingInfo['neighborhood_shippinginfo'], $showBorder, 'L');

        //LINEA DIRECCION
        $pdf->SetFont($nameFont, 'B', $sizefontTitles);
        $pdf->Cell(10, $hCell, '', $showBorder, 0, 'C');
        $pdf->Cell(55, $hCell,  utf8_decode('DIRECCIÓN:'), $showBorder, 0, 'R');
        $pdf->Cell(6, $hCell, '', $showBorder, 0, 'C');
        $pdf->SetFont($nameFont, '', $sizefontBody);
        $pdf->MultiCell(110, $hCell, $shoppingInfo['address_shippinginfo'], $showBorder, 'L');

        //LINEA TRANSPORTADORA
        $pdf->SetFont($nameFont, 'B', $sizefontTitles);
        $pdf->Cell(10, $hCell, '', $showBorder, 0, 'C');
        $pdf->Cell(55, $hCell,  utf8_decode('TRANSP.:'), $showBorder, 0, 'R');
        $pdf->Cell(6, $hCell, '', $showBorder, 0, 'C');
        $pdf->SetFont($nameFont, '', $sizefontBody);
        $pdf->MultiCell(110, $hCell, 'Servientrega', $showBorder, 'L');

        //LINEA INFO
        $pdf->SetFont($nameFont, 'B', $sizefontTitles);
        $pdf->Cell(10, $hCell, '', $showBorder, 0, 'C');
        $pdf->Cell(55, $hCell,  utf8_decode('INFO.:'), $showBorder, 0, 'R');
        $pdf->Cell(6, $hCell, '', $showBorder, 0, 'C');
        $pdf->SetFont($nameFont, '', $sizefontBody);
        $pdf->MultiCell(110, $hCell, 'Productos Aguacate By Kathe', $showBorder, 'L');

        //LINEA ref
        $pdf->SetFont($nameFont, 'B', $sizefontTitles);
        $pdf->Cell(10, $hCell, '', $showBorder, 0, 'C');
        $pdf->Cell(55, $hCell,  utf8_decode('REF:'), $showBorder, 0, 'R');
        $pdf->Cell(6, $hCell, '', $showBorder, 0, 'C');
        $pdf->SetFont($nameFont, '', $sizefontBody);
        $pdf->MultiCell(110, $hCell, $refOrder, $showBorder, 'L');

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output();
    }
}
