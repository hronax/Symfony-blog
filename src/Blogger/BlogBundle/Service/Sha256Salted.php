<?php
namespace Blogger\BlogBundle\Service;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class Sha256Salted implements PasswordEncoderInterface
{
    public function encodePassword($raw, $salt)
    {
        return hash('sha256', $salt . $raw); // Custom function for encrypt
    }

    public function isPasswordValid($encoded, $raw, $salt)
    {
        return $encoded === $this->encodePassword($raw, $salt);
    }

    public static function encodePasswordStatic($raw, $salt)
    {
        return hash('sha256', $salt . $raw); // Custom function for encrypt
    }
}