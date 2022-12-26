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
 *
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */

namespace PhpOffice\PhpWord\Writer\Word2007\Element;

use PhpOffice\PhpWord\Element\SDT as SDTElement;
use PhpOffice\PhpWord\Shared\XMLWriter;

/**
 * Structured document tag element writer.
 *
 * @since 0.12.0
 * @see  http://www.datypic.com/sc/ooxml/t-w_CT_SdtBlock.html
 *
 * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
 */
class SDTContent extends Text
{
    /**
     * Write element.
     */
    public function write(): void
    {
        $element = $this->getElement();

        if (!$element instanceof \PhpOffice\PhpWord\Element\SDTContent) {
            return;
        }

        $xmlWriter = $this->getXmlWriter();

        if (!empty($element->getContent())) {
            $xmlWriter->startElement('w:sdt');
            $xmlWriter->writeRaw($element->getContent());
            $xmlWriter->endElement(); // w:sdt
        } else {
            $xmlWriter->startElement('w:sdt');

            // Properties
            $xmlWriter->startElement('w:sdtPr');
            $xmlWriter->startElement('w:docPartObj');
            $xmlWriter->writeElementBlock('w:docPartGallery', 'w:val', 'Table of Contents');
            $xmlWriter->writeElementBlock('w:docPartUnique', 'w:val', 'true');
            $xmlWriter->endElement(); // w:docPartObj
            $xmlWriter->endElement(); // w:sdtPr

            // Content
            $xmlWriter->startElement('w:sdtContent');
            $containerWriter = new Container($xmlWriter, $element);
            $containerWriter->write();
            $xmlWriter->endElement(); // w:sdtContent

            $xmlWriter->endElement(); // w:sdt
        }
    }

}
