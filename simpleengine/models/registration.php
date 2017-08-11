<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 8/11/2017
 * Time: 11:41 AM
 */

namespace simpleengine\models;


class Registration implements DbModelInterface
{

    private $firstname;
    private $lastname;
    private $email;
    private $pass1;
    private $pass2;

    /**
     * Registration constructor.
     */
    public function __construct($fn, $ln, $email, $pass1, $pass2)
    {
        $this->firstname = $fn;
        $this->lastname = $ln;
        $this->email = $email;
        $this->pass1 = $pass1;
        $this->pass2 = $pass2;
    }

    public function register

    public function find($id)
    {
        // TODO: Implement find() method.
    }

    public function save()
    {
        // TODO: Implement save() method.
    }
}