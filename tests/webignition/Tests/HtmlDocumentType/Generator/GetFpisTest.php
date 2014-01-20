<?php

namespace webignition\Tests\HtmlDocumentType\Generator;

use webignition\HtmlDocumentType\Generator;

class GetFpisTest extends BaseTest {        
    
    public function testGetFpis() {
        $generator = new Generator();        
        $this->assertEquals(array(
            '-//IETF//DTD HTML 2.0//EN',
            '-//W3C//DTD HTML 3.2 Final//EN',
            '-//W3C//DTD HTML 4.0//EN',
            '-//W3C//DTD HTML 4.0 Transitional//EN',
            '-//W3C//DTD HTML 4.0 Frameset//EN',
            '-//W3C//DTD HTML 4.01//EN',
            '-//W3C//DTD HTML 4.01 Transitional//EN',
            '-//W3C//DTD HTML 4.01 Frameset//EN',
            '-//W3C//DTD XHTML 1.0 Strict//EN',
            '-//W3C//DTD XHTML 1.0 Transitional//EN',
            '-//W3C//DTD XHTML 1.0 Frameset//EN',
            '-//W3C//DTD XHTML Basic 1.0//EN',
            '-//W3C//DTD XHTML-Print 1.0//EN',
            '-//WAPFORUM//DTD XHTML Mobile 1.0//EN',
            '-//WAPFORUM//DTD XHTML Mobile 1.1//EN',
            '-//WAPFORUM//DTD XHTML Mobile 1.2//EN',            
            '-//W3C//DTD XHTML 1.1//EN',
            '-//W3C//DTD XHTML Basic 1.1//EN',
            '-//W3C//DTD XHTML+RDFa 1.0//EN',
            '-//W3C//DTD XHTML+RDFa 1.1//EN',
            '-//W3C//DTD XHTML+ARIA 1.0//EN'
        ), $generator->getFpis());
    }
    
}