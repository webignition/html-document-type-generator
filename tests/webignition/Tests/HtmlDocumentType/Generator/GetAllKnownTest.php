<?php

namespace webignition\Tests\HtmlDocumentType\Generator;

use webignition\HtmlDocumentType\Generator;

class GetAllKnownTest extends BaseTest {        
    
    public function testGenerateAll() {
        $generator = new Generator();
        $this->assertEquals(19, count($generator->getAllKnown()));
    }
    
            
    
}