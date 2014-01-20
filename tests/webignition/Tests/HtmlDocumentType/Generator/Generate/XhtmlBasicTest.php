<?php

namespace webignition\Tests\HtmlDocumentType\Generator\Generate;

use webignition\Tests\HtmlDocumentType\Generator\BaseTest;
use webignition\HtmlDocumentType\Generator;

class XhtmlBasicTest extends BaseTest {    
    
    private $generator;
    
    public function setUp() {
        $this->generator = new Generator();
        $this->generator->xhtml()->xhtmlModule('basic');        
    }
    
    public function testXhtml1Default() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.0//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic10.dtd">',
                $this->generator->version(1)->generate()
         );        
    }
    
    public function testXhtml11Default() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">',
                $this->generator->version('1.1')->generate()
         );         
    }   
    

}