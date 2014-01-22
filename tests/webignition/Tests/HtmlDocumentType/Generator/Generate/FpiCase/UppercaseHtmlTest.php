<?php

namespace webignition\Tests\HtmlDocumentType\Generate\FpiCase;

use webignition\Tests\HtmlDocumentType\Generator\BaseTest;
use webignition\HtmlDocumentType\Generator;
use webignition\HtmlDocumentType\FpiList;

class UppercaseHtmlTest extends BaseTest {   
    
    private $generator;
    
    public function setUp() {
        $this->generator = new Generator();
        $this->generator->html()->uppercaseFpi();
    }
    
    public function testHtml2Default() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "' . strtoupper(FpiList::FPI_HTML_2) . '">',
                $this->generator->version(2)->generate()
         );
    }            
    
    public function testHtml2Alternative() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "' . strtoupper(FpiList::FPI_HTML_2_ALTERNATIVE) . '">',
                $this->generator->version(2)->variant('alternative')->generate()
         );
    }       

    public function testHtml32Default() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "' . strtoupper(FpiList::FPI_HTML_3_2) . '">',
                $this->generator->version('3.2')->generate()
        );
    }        
    
    public function testHtml32Alternative1() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "' . strtoupper(FpiList::FPI_HTML_3_2_ALTERNATIVE1) . '">',
                $this->generator->version('3.2')->variant('alternative1')->generate()
        );
    } 
    
    public function testHtml32Alternative2() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "' . strtoupper(FpiList::FPI_HTML_3_2_ALTERNATIVE2) . '">',
                $this->generator->version('3.2')->variant('alternative2')->generate()
        );
    }     
    
    public function testHtml40Default() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "' . strtoupper(FpiList::FPI_HTML_4_STRICT) . '" "http://www.w3.org/TR/1998/REC-html40-19980424/strict.dtd">',
                $this->generator->version('4')->generate()
        );
    }     
    
    public function testHtml40Strict() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "' . strtoupper(FpiList::FPI_HTML_4_STRICT) . '" "http://www.w3.org/TR/1998/REC-html40-19980424/strict.dtd">',
                $this->generator->version('4')->variant('strict')->generate()
        );
    } 
    
    public function testHtml40Transitional() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "' . strtoupper(FpiList::FPI_HTML_4_TRANSITIONAL) . '" "http://www.w3.org/TR/1998/REC-html40-19980424/loose.dtd">',
                $this->generator->version('4')->variant('transitional')->generate()
        );
    } 
    
    public function testHtml40Frameset() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "' . strtoupper(FpiList::FPI_HTML_4_FRAMESET) . '" "http://www.w3.org/TR/1998/REC-html40-19980424/frameset.dtd">',
                $this->generator->version('4')->variant('frameset')->generate()
        );
    }  
    
    public function testHtml41Default() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "' . strtoupper(FpiList::FPI_HTML_4_01_STRICT) . '" "http://www.w3.org/TR/html4/strict.dtd">',
                $this->generator->version('4.01')->generate()
        );
    }     
    
    public function testHtml41Strict() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "' . strtoupper(FpiList::FPI_HTML_4_01_STRICT) . '" "http://www.w3.org/TR/html4/strict.dtd">',
                $this->generator->version('4.01')->variant('strict')->generate()
        );
    } 
    
    public function testHtml41Transitional() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "' . strtoupper(FpiList::FPI_HTML_4_01_TRANSITIONAL) . '" "http://www.w3.org/TR/html4/loose.dtd">',
                $this->generator->version('4.01')->variant('transitional')->generate()
        );
    } 
    
    public function testHtml41Frameset() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "' . strtoupper(FpiList::FPI_HTML_4_01_FRAMESET) . '" "http://www.w3.org/TR/html4/frameset.dtd">',
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