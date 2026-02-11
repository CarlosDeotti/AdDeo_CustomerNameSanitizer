<?php

/**
 * This file contains unit tests for the NameSanitizer model.
 */

namespace AdDeo\CustomerNameSanitaizer\Test\Unit\Model;

use AdDeo\CustomerNameSanitaizer\Model\NameSanitizer;
use PHPUnit\Framework\TestCase;

/**
 * This class contains unit tests for the NameSanitizer model.
 */
class NameSanitizerTest extends TestCase
{
    /**
     * This test ensures that the sanitize method removes spaces from names.
     *
     * @return void
     */
    public function testSanitizeRemovesSpaces(): void
    {
        $sanitizer = new NameSanitizer();
        $this->assertSame('Joao', $sanitizer->sanitize('Jo ao'));
        $this->assertSame('Maria', $sanitizer->sanitize('  Ma  ria  '));
    }

    /**
     * This test ensures that the sanitize method handles null values correctly.
     *
     * @return void
     */
    public function testSanitizeHandlesNull(): void
    {
        $sanitizer = new NameSanitizer();
        $this->assertNull($sanitizer->sanitize(null));
    }
}
