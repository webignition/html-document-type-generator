<?php

namespace webignition\Tests\HtmlDocumentType\Generator\Generate;

use webignition\Tests\HtmlDocumentType\Generator\BaseTest;
use webignition\HtmlDocumentType\Generator;

class XhtmlRdfaTest extends BaseTest {    
    
    private $generator;
    
    public function setUp() {
        $this->generator = new Generator();
        $this->generator->xhtml()->module('rdfa');    
    }
    
    public function testXhtml1Default() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">',
                $this->generator->version('1')->generate()
         );        
    }
    
    public function testXhtml11Default() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.1//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-2.dtd">',
                $this->generator->version('1.1')->generate()
         );         
    }   
    

}