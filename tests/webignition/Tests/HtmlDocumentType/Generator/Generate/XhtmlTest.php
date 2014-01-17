<?php

namespace webignition\Tests\HtmlDocumentType\Generator;

use webignition\HtmlDocumentType\Generator;

class XtmlTest extends BaseTest {    
    
    private $generator;
    
    public function setUp() {
        $this->generator = new Generator();
        $this->generator->xhtml();
    }
    
    public function testXhtml1Default() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
                $this->generator->version(1)->generate()
         );        
    }
    
    public function testXhtml1Strict() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
                $this->generator->version(1)->variant('strict')->generate()
         );         
    }    
    
    public function testXhtml1Transitional() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
                $this->generator->version(1)->variant('transitional')->generate()
         );         
    }    
    
    public function testXhtml1Frameset() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">',
                $this->generator->version(1)->variant('frameset')->generate()
         );         
    } 
    
    public function testXhtml11Default() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">',
                $this->generator->version('1.1')->generate()
         );         
    }   
    

}