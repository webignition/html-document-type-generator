<?php

namespace webignition\Tests\HtmlDocumentType\Generator;

use webignition\HtmlDocumentType\Generator;

class ExceptionCasesTest extends BaseTest {    
    
    public function testGenerateWithNoVersionThrowsInvalidArgumentException() {
        $this->setExpectedException('InvalidArgumentException', 'Unable to generate; no version given', 1);
        
        $generator = new Generator();
        $generator->generate();
    }
    
}