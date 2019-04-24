<?php


namespace AppBundle\Entity;


use Symfony\Component\Security\Core\Exception\InvalidArgumentException;

class SimplifiedClient
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $company;

    /**
     * SimplifiedClient constructor.
     * @param $name
     * @param $email
     * @param $phone
     * @param $company
     */
    public function __construct($name = '', $email = '', $phone='', $company='')
    {
        $this->isValid($name, $email, $phone, $company);

        $this->name = $name;
        $this->email=$email;
        $this->phone=$phone;
        $this->company=$company;

    }

    public function toArray(){
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->company
            ];
    }

    public function isValid($name, $email, $phone, $company)
    {
        if('' == $name && '' == $email && '' == $phone && '' == $company){
            throw new InvalidArgumentException("Some value must not be empty");
        }
    }
}