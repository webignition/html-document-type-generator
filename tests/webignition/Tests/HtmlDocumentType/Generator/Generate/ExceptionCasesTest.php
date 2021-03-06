<?php

namespace webignition\Tests\HtmlDocumentType\Generator\Generate;

use webignition\Tests\HtmlDocumentType\Generator\BaseTest;
use webignition\HtmlDocumentType\Generator;

class ExceptionCasesTest extends BaseTest {    
    
    public function testGenerateWithNoVersionThrowsInvalidArgumentException() {
        $this->setExpectedException('InvalidArgumentException', 'Unable to generate; no version given', 1);
        
        $generator = new Generator();
        $generator->generate();
    }
    
}