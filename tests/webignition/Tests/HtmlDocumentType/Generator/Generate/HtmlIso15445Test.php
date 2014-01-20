<?php

namespace webignition\Tests\HtmlDocumentType\Generator\Generate;

use webignition\Tests\HtmlDocumentType\Generator\BaseTest;
use webignition\HtmlDocumentType\Generator;

class HtmlIso15445Test extends BaseTest {    
    
    private $generator;
    
    public function setUp() {
        $this->generator = new Generator();
        $this->generator->html()->module('iso15445');        
    }
    
    public function testHtmlIso15445Default() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "ISO/IEC 15445:2000//DTD HTML//EN">',
                $this->generator->version(1)->generate()
         );        
    } 
    
    public function testHtmlIso15445Alternative() {
        $this->assertEquals(
                '<!DOCTYPE html PUBLIC "ISO/IEC 15445:2000//DTD HyperText Markup Language//EN">',
                $this->generator->version(1)->variant('alternative')->generate()
         );        
    }     

}