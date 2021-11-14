<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------

    public $loginForm = [
        'usuario' => [
            'rules'  => 'required|numeric|is_not_unique[user.id_user]',
            'errors' => [
                'is_not_unique' => 'El usuario no exite.',

            ]
        ],
        'clave'    => [
            'rules'  => 'required',
        ],
    ];

    public $newCategory = [
        'nombre' => [
            'rules'  => 'required',
            'errors' => [
                'is_not_unique' => 'El usuario no exite.',
            ]
        ],
    ];

    public $newProduct = [
        'nombre' => [
            'rules'  => 'required|alpha_numeric_space',
        ],
        'categoria' => [
            'rules'  => 'required|is_not_unique[category.id_category]',
        ],
        'descripcion' => [
            'rules'  => 'alpha_numeric_punct|permit_empty',
        ],
        'image1'    => [
            'rules'  => 'is_image[image1]',
        ],
        'image2'    => [
            'rules'  => 'is_image[image2]',
        ],
        'image3'    => [
            'rules'  => 'is_image[image3]',
        ],
        'precio'    => [
            'rules'  => 'required|decimal',
        ],
        'unica' => [
            'rules'  => 'numeric|permit_empty',
        ],
        'xxxs' => [
            'rules'  => 'numeric|permit_empty',
        ],
        'xxs' => [
            'rules'  => 'numeric|permit_empty',
        ],
        'xs' => [
            'rules'  => 'numeric|permit_empty',
        ],
        's' => [
            'rules'  => 'numeric|permit_empty',
        ],
        'm' => [
            'rules'  => 'numeric|permit_empty',
        ],
        'l' => [
            'rules'  => 'numeric|permit_empty',
        ],
        'xl' => [
            'rules'  => 'numeric|permit_empty',
        ],
        'xxl' => [
            'rules'  => 'numeric|permit_empty',
        ],
        'xxxl' => [
            'rules'  => 'numeric|permit_empty',
        ],
    ];

    public $validateShippInfoEcommerce = [
        'ciudad' => [
            'rules'  => 'required|is_not_unique[city.idcity]',
        ],
        'direccion' => [
            'rules'  => 'required|alpha_numeric_punct',
        ],
        'barrio' => [
            'rules'  => 'required|alpha_numeric_punct',
        ],
        'nombres' => [
            'rules'  => 'required|alpha_numeric_punct',
        ],
        'apellidos' => [
            'rules'  => 'required|alpha_numeric_punct',
        ],
        'tipo_identificacion' => [
            'rules'  => 'required|is_not_unique[typeidentification.id_typeiden]',
        ],
        'num_identificacion' => [
            'rules'  => 'required|numeric',
        ],
        'celular' => [
            'rules'  => 'required|numeric',
        ],
        'email' => [
            'rules'  => 'required|valid_email',
        ],
    ];
}
