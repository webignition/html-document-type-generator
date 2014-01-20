<?php

namespace webignition\Tests\HtmlDocumentType\Generator;

use webignition\HtmlDocumentType\Generator;

class SettersReturnSelfTest extends BaseTest {    
    
    public function setUp() {
        $setterMethodName = strtolower(str_replace('test', '', $this->getName()));
        
        $generator = new Generator();
        $this->assertEquals($generator, $generator->$setterMethodName('foo')); 
    }
    
    
    public function testVersion() {}
    public function testVariant() {}
    public function testHtml() {}
    public function testXhtml() {}
    public function testXhtmlBasic() {}
    public function testMultiline() {}
    public function testIndent() {}        
    public function testNoUri() {}
    public function testSingleline() {}
    public function testXhtmlAria() {}
    
}