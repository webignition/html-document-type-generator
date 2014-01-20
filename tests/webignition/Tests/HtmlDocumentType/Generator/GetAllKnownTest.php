<?php

namespace webignition\Tests\HtmlDocumentType\Generator;

use webignition\HtmlDocumentType\Generator;

class GetAllKnownTest extends BaseTest {        
    
    public function testGenerateAll() {
        $generator = new Generator();        
        $this->assertEquals(18, count($generator->getAllKnown()));
    }
    
            
    
}