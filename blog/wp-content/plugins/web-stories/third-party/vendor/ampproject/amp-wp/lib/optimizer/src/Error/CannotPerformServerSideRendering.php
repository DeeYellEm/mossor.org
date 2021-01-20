<?php

namespace Google\Web_Stories_Dependencies\AmpProject\Optimizer\Error;

use Google\Web_Stories_Dependencies\AmpProject\Optimizer\Error;
use DOMElement;
final class CannotPerformServerSideRendering implements \Google\Web_Stories_Dependencies\AmpProject\Optimizer\Error
{
    use ErrorProperties;
    const INVALID_INPUT_WIDTH = 'Cannot perform serverside rendering, invalid input width: ';
    const INVALID_INPUT_HEIGHT = 'Cannot perform serverside rendering, invalid input height: ';
    const UNSUPPORTED_LAYOUT = 'Cannot perform serverside rendering, unsupported layout: ';
    /**
     * Instantiate a CannotPerformServerSideRendering object for an element with an invalid input width.
     *
     * @param DOMElement $element Element that has an invalid input width.
     * @return self
     */
    public static function fromInvalidInputWidth(\DOMElement $element)
    {
        return new self(self::INVALID_INPUT_WIDTH . new \Google\Web_Stories_Dependencies\AmpProject\Optimizer\Error\ElementDump($element));
    }
    /**
     * Instantiate a CannotPerformServerSideRendering object for an element with an invalid input height.
     *
     * @param DOMElement $element Element that has an invalid input height.
     * @return self
     */
    public static function fromInvalidInputHeight(\DOMElement $element)
    {
        return new self(self::INVALID_INPUT_HEIGHT . new \Google\Web_Stories_Dependencies\AmpProject\Optimizer\Error\ElementDump($element));
    }
    /**
     * Instantiate a CannotPerformServerSideRendering object for an element with an invalid input height.
     *
     * @param DOMElement $element Element that has an invalid input height.
     * @param string     $layout  Resulting layout.
     * @return self
     */
    public static function fromUnsupportedLayout(\DOMElement $element, $layout)
    {
        return new self(self::UNSUPPORTED_LAYOUT . new \Google\Web_Stories_Dependencies\AmpProject\Optimizer\Error\ElementDump($element) . " => {$layout}");
    }
}
