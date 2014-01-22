<?php

namespace webignition\Tests\HtmlDocumentType\Generator;

use webignition\HtmlDocumentType\Generator;

class GetFpisTest extends BaseTest {        
    
    public function testGetFpis() {
        $generator = new Generator();        
        $this->assertEquals(array(
            'html-2' => '-//IETF//DTD HTML//EN',
            'html-2-alternative' => '-//IETF//DTD HTML 2.0//EN',
            'html-32' => '-//W3C//DTD HTML 3.2 Final//EN',
            'html-32-alternative1' => '-//W3C//DTD HTML 3.2//EN',
            'html-32-alternative2' => '-//W3C//DTD HTML 3.2 Draft//EN',
            'html-4-strict' => '-//W3C//DTD HTML 4.0//EN',
            'html-4-transitional' => '-//W3C//DTD HTML 4.0 Transitional//EN',
            'html-4-frameset' => '-//W3C//DTD HTML 4.0 Frameset//EN',
            'html-401-strict' => '-//W3C//DTD HTML 4.01//EN',
            'html-401-transitional' => '-//W3C//DTD HTML 4.01 Transitional//EN',
            'html-401-frameset' => '-//W3C//DTD HTML 4.01 Frameset//EN',
            'html+aria-401' => '-//W3C//DTD HTML+ARIA 1.0//EN',
            'html+rdfa-401-1' => '-//W3C//DTD HTML 4.01+RDFa 1.0//EN',
            'html+rdfa-401-11' => '-//W3C//DTD HTML 4.01+RDFa 1.1//EN',
            'html+rdfalite-401-11' => '-//W3C//DTD HTML 4.01+RDFa Lite 1.1//EN',
            'html+iso15445-1' => 'ISO/IEC 15445:2000//DTD HTML//EN',
            'html+iso15445-1-alternative' => 'ISO/IEC 15445:2000//DTD HyperText Markup Language//EN',
            'xhtml-1-strict' => '-//W3C//DTD XHTML 1.0 Strict//EN',
            'xhtml-1-transitional' => '-//W3C//DTD XHTML 1.0 Transitional//EN',
            'xhtml-1-frameset' => '-//W3C//DTD XHTML 1.0 Frameset//EN',
            'xhtml+basic-1' => '-//W3C//DTD XHTML Basic 1.0//EN',
            'xhtml+print-1' => '-//W3C//DTD XHTML-Print 1.0//EN',
            'xhtml+mobile-1' => '-//WAPFORUM//DTD XHTML Mobile 1.0//EN',
            'xhtml+mobile-11' => '-//WAPFORUM//DTD XHTML Mobile 1.1//EN',
            'xhtml+mobile-12' => '-//WAPFORUM//DTD XHTML Mobile 1.2//EN',
            'xhtml-11' => '-//W3C//DTD XHTML 1.1//EN',
            'xhtml+basic-11' => '-//W3C//DTD XHTML Basic 1.1//EN',
            'xhtml+rdfa-1' => '-//W3C//DTD XHTML+RDFa 1.0//EN',
            'xhtml+rdfa-11' => '-//W3C//DTD XHTML+RDFa 1.1//EN',
            'xhtml+aria-1' => '-//W3C//DTD XHTML+ARIA 1.0//EN',

        ), $generator->getFpis());
    }
    
}