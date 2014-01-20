<?php

namespace webignition\Tests\HtmlDocumentType\Generator\Generate;

use webignition\Tests\HtmlDocumentType\Generator\BaseTest;
use webignition\HtmlDocumentType\Generator;

class XhtmlMobileTest extends BaseTest {    
    
    private $generator;
    
    public function setUp() {
        $this->generator = new Generator();
        $this->generator->xhtml()->module('mobile');        
    }
    
    public function testXhtmlMobile1() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">',
                $this->generator->version(1)->generate()
         );        
    }   
    
    public function testXhtmlMobile11() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.1//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile11.dtd">',
                $this->generator->version('1.1')->generate()
         );        
    } 
    
    public function testXhtmlMobile12() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">',
                $this->generator->version('1.2')->generate()
         );        
    }     

}