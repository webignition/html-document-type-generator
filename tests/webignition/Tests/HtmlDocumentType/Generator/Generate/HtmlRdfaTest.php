<?php

namespace webignition\Tests\HtmlDocumentType\Generator\Generate;

use webignition\Tests\HtmlDocumentType\Generator\BaseTest;
use webignition\HtmlDocumentType\Generator;

class HtmlRdfaTest extends BaseTest {    
    
    private $generator;
    
    public function setUp() {
        $this->generator = new Generator();
        $this->generator->html()->module('rdfa');    
    }
    
    public function testHtml401Rdfa1() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/html401-rdfa-1.dtd">',
                $this->generator->version('4.01')->moduleVersion(1)->generate()
         );        
    }
    
    public function testHtml401Rdfa11() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01+RDFa 1.1//EN" "http://www.w3.org/MarkUp/DTD/html401-rdfa11-1.dtd">',
                $this->generator->version('4.01')->moduleVersion('1.1')->generate()
         );        
    }
    
    public function testHtml401RdfaLite11() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01+RDFa Lite 1.1//EN" "http://www.w3.org/MarkUp/DTD/html401-rdfalite11-1.dtd">',
                $this->generator->module('rdfalite')->version('4.01')->moduleVersion('1.1')->generate()
         );        
    }    
    

}