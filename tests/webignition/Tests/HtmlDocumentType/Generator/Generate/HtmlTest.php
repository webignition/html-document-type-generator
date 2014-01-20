<?php

namespace webignition\Tests\HtmlDocumentType\Generator\Generate;

use webignition\Tests\HtmlDocumentType\Generator\BaseTest;
use webignition\HtmlDocumentType\Generator;

class HtmlTest extends BaseTest {    
    
    private $generator;
    
    public function setUp() {
        $this->generator = new Generator();
        $this->generator->html();
    }
    
    public function testHtml2Default() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//IETF//DTD HTML//EN">',
                $this->generator->version(2)->generate()
         );
    }            
    
    public function testHtml2Alternative() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//IETF//DTD HTML 2.0//EN">',
                $this->generator->version(2)->variant('alternative')->generate()
         );
    }       

    public function testHtml32Default() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">',
                $this->generator->version('3.2')->generate()
        );
    }        
    
    public function testHtml32Alternative1() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 3.2//EN">',
                $this->generator->version('3.2')->variant('alternative1')->generate()
        );
    } 
    
    public function testHtml32Alternative2() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 3.2 Draft//EN">',
                $this->generator->version('3.2')->variant('alternative2')->generate()
        );
    }     
    
    public function testHtml40Default() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0//EN" "http://www.w3.org/TR/html4/strict.dtd">',
                $this->generator->version('4')->generate()
        );
    }     
    
    public function testHtml40Strict() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0//EN" "http://www.w3.org/TR/html4/strict.dtd">',
                $this->generator->version('4')->variant('strict')->generate()
        );
    } 
    
    public function testHtml40Transitional() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">',
                $this->generator->version('4')->variant('transitional')->generate()
        );
    } 
    
    public function testHtml40Frameset() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">',
                $this->generator->version('4')->variant('frameset')->generate()
        );
    }  
    
    public function testHtml41Default() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">',
                $this->generator->version('4.01')->generate()
        );
    }     
    
    public function testHtml41Strict() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">',
                $this->generator->version('4.01')->variant('strict')->generate()
        );
    } 
    
    public function testHtml41Transitional() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">',
                $this->generator->version('4.01')->variant('transitional')->generate()
        );
    } 
    
    public function testHtml41Frameset() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">',
                $this->generator->version('4.01')->variant('frameset')->generate()
        );
    }     
    
    public function testHtml5Default() {
        $this->assertEquals(
                '<!DOCTYPE html>',
                $this->generator->version(5)->generate()
        );
    }    
    
    public function testHtml5LegacyCompat() {
        $this->assertEquals(
                '<!DOCTYPE html SYSTEM "about:legacy-compat">',
                $this->generator->version(5)->variant('legacy-compat')->generate()
        );
    } 
}