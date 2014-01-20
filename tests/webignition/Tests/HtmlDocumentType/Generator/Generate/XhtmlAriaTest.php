<?php

namespace webignition\Tests\HtmlDocumentType\Generator\Generate;

use webignition\Tests\HtmlDocumentType\Generator\BaseTest;
use webignition\HtmlDocumentType\Generator;

class XhtmlAriaTest extends BaseTest {    
    
    private $generator;
    
    public function setUp() {
        $this->generator = new Generator();
        $this->generator->xhtmlRdfa();        
    }
    
    public function testXhtmlAria1Default() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+ARIA 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-aria-1.dtd">',
                $this->generator->xhtmlAria()->version('1')->generate()
         );        
    }    

}