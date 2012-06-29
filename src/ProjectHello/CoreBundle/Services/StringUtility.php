<?php

namespace ProjectHello\CoreBundle\Services;

use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

/**
 * This utility class provides helper methods that format strings
 *
 * @author Nherrisa Mae U. Celeste <nherrisa.celeste@goabroad.com>
 * @since  June 29, 2012
 */
class StringUtility
{
    /**
     * Instantiates utility class
     */
    public function __construct()
    {

    }

    /**
     * Encodes password
     *
     * @param string $password The password to encode
     * @param string $salt     The user's salt
     *
     * @return string
     */
    public function encodePassword($password, $salt)
    {
        if (trim($password)) {
            $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);

            return $encoder->encodePassword($password, $salt);
        }

        return $password;
    }
}