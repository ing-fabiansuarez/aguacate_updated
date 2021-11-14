<?php

namespace App\Controllers\Admin\Category;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class Category extends BaseController
{
    public function __construct()
    {
        $this->mdlCategory = new CategoryModel();
    }

    public function create()
    {
        //validaciones
        if (!($this->validate(
            $this->rulesvalidation->getRuleGroup('newCategory')
        ))) {
            foreach ($this->validator->getErrors() as $error) {
                echo $error . '<br>';
            }
            return;
        }
        //CON TRIM QUITAMOS LOS ESPACIOS QUE ALLA EN EL INICIO O EN EL FINAL
        $inputNombre = trim($this->request->getPostGet('nombre'));

        $this->mdlCategory->save([
            'name_category' => $inputNombre
        ]);
        echo true;
        return;
    }

    public function getCategories()
    {
        return json_encode($this->mdlCategory->select('name_category,id_category')->findAll());
    }
}
