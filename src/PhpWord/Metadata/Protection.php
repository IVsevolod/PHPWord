<?php
/**
 * This file is part of PHPWord - A pure PHP library for reading and writing
 * word processing documents.
 *
 * PHPWord is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/PHPWord/contributors.
 *
 * @see         https://github.com/PHPOffice/PHPWord
 * @copyright   2010-2017 PHPWord contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */

namespace PhpOffice\PhpWord\Metadata;

use PhpOffice\PhpWord\SimpleType\DocProtect;

/**
 * Document protection class
 *
 * @since 0.12.0
 * @see http://www.datypic.com/sc/ooxml/t-w_CT_DocProtect.html
 */
class Protection
{
    /**
     * Editing restriction none|readOnly|comments|trackedChanges|forms
     *
     * @var string
     * @see  http://www.datypic.com/sc/ooxml/a-w_edit-1.html
     */
    private $editing;

    /**
     * password
     *
     * @var string
     */
    private $password;

    /**
     * Iterations to Run Hashing Algorithm
     *
     * @var int
     */
    private $spinCount = 100000;

    /**
     * Cryptographic Hashing Algorithm (see to \PhpOffice\PhpWord\Writer\Word2007\Part\Settings::$algorithmMapping)
     *
     * @var int
     */
    private $mswordAlgorithmSid = 4;

    /**
     * Salt for Password Verifier
     *
     * @var string
     */
    private $salt;

    /**
     * Create a new instance
     *
     * @param string $editing
     */
    public function __construct($editing = null)
    {
        if ($editing != null) {
            $this->setEditing($editing);
        }
    }

    /**
     * Get editing protection
     *
     * @return string
     */
    public function getEditing()
    {
        return $this->editing;
    }

    /**
     * Set editing protection
     *
     * @param string $editing Any value of \PhpOffice\PhpWord\SimpleType\DocProtect
     * @return self
     */
    public function setEditing($editing = null)
    {
        DocProtect::validate($editing);
        $this->editing = $editing;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set password
     *
     * @param $password
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get count for hash iterations
     *
     * @return int
     */
    public function getSpinCount()
    {
        return $this->spinCount;
    }

    /**
     * Set count for hash iterations
     *
     * @param $spinCount
     * @return self
     */
    public function setSpinCount($spinCount)
    {
        $this->spinCount = $spinCount;

        return $this;
    }

    /**
     * Get algorithm-sid
     *
     * @return int
     */
    public function getMswordAlgorithmSid()
    {
        return $this->mswordAlgorithmSid;
    }

    /**
     * Set algorithm-sid (see \PhpOffice\PhpWord\Writer\Word2007\Part\Settings::$algorithmMapping)
     *
     * @param $mswordAlgorithmSid
     * @return self
     */
    public function setMswordAlgorithmSid($mswordAlgorithmSid)
    {
        $this->mswordAlgorithmSid = $mswordAlgorithmSid;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set salt. Salt HAS to be 16 characters, or an exception will be thrown.
     *
     * @param $salt
     * @throws \InvalidArgumentException
     * @return self
     */
    public function setSalt($salt)
    {
        if ($salt !== null && strlen($salt) !== 16) {
            throw new \InvalidArgumentException('salt has to be of exactly 16 bytes length');
        }

        $this->salt = $salt;

        return $this;
    }
}
