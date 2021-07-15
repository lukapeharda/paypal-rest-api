<?php

namespace LukaPeharda\PayPal\Billing;

class Subscriber
{
    /**
     * @var string
     */
    protected $payerId;

    /**
     * @var string
     */
    protected $emailAddress;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * Init subscriber from array.
     *
     * @param   array  $data
     *
     * @return  self
     */
    public static function fromArray($data)
    {
        $subscriber = new self;

        if (isset($data['payer_id'])) {
            $subscriber->setPayerId($data['payer_id']);
        }

        if (isset($data['email_address'])) {
            $subscriber->setEmailAddress($data['email_address']);
        }

        if (isset($data['name'], $data['name']->given_name)) {
            $subscriber->setFirstName($data['name']->given_name);
        }

        if (isset($data['name'], $data['name']->surname)) {
            $subscriber->setLastName($data['name']->surname);
        }

        return $subscriber;
    }

    /**
     * Return as array.
     *
     * @return  array
     */
    public function toArray()
    {
        return [
            'payer_id' => $this->getPayerId(),
            'email_address' => $this->getEmailAddress(),
            'name' => [
                'given_name' => $this->getFirstName(),
                'surname' => $this->getLastName(),
            ],
        ];
    }

    /**
     * Return payer ID.
     *
     * @return  string
     */
    public function getPayerId()
    {
        return $this->payerId;
    }

    /**
     * Set payer ID.
     *
     * @param   string  $payerId
     *
     * @return  self
     */
    public function setPayerId($payerId)
    {
        $this->payerId = $payerId;

        return $this;
    }

    /**
     * Return email address.
     *
     * @return  string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * Set email address.
     *
     * @param   string  $emailAddress
     *
     * @return  self
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    /**
     * Return first name.
     *
     * @return  string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set payer ID.
     *
     * @param   string  $firstName
     *
     * @return  self
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Return last name.
     *
     * @return  string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set last name.
     *
     * @param   string  $lastName
     *
     * @return  self
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }
}
