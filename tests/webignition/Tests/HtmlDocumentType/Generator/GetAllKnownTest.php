<?php

namespace webignition\Tests\HtmlDocumentType\Generator;

use webignition\HtmlDocumentType\Generator;

class GetAllKnownTest extends BaseTest {        
    
    public function testGenerateAll() {
        $generator = new Generator();

        $this->assertEquals(array(
            'html-2' => '<!DOCTYPE html PUBLIC "-//IETF//DTD HTML//EN">',
            'html-2-alternative' => '<!DOCTYPE html PUBLIC "-//IETF//DTD HTML 2.0//EN">',
            'html-32' => '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">',
            'html-32-alternative1' => '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 3.2//EN">',
            'html-32-alternative2' => '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 3.2 Draft//EN">',
            'html-4-strict' => '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0//EN" "http://www.w3.org/TR/html4/strict.dtd">',
            'html-4-transitional' => '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">',
            'html-4-frameset' => '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">',
            'html-401-strict' => '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">',
            'html-401-transitional' => '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">',
            'html-401-frameset' => '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">',
            'html-5' => '<!DOCTYPE html>',
            'html-5-legacy-compat' => '<!DOCTYPE html SYSTEM "about:legacy-compat">',
            'xhtml-1-strict' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
            'xhtml-1-transitional' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
            'xhtml-1-frameset' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">',
            'xhtml-11' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">',
            'xhtml+basic-1' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.0//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic10.dtd">',
            'xhtml+basic-11' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">',
            'xhtml+print-1' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML-Print 1.0//EN" "http://www.w3.org/TR/xhtml-print/xhtml-print10.dtd">',
            'xhtml+mobile-1' => '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">',
            'xhtml+mobile-11' => '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.1//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile11.dtd">',
            'xhtml+mobile-12' => '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">',
            'xhtml+rdfa-1' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">',
            'xhtml+rdfa-11' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.1//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-2.dtd">',
            'xhtml+aria-1' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+ARIA 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-aria-1.dtd">',
            'html+aria-401' => '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML+ARIA 1.0//EN" "http://www.w3.org/WAI/ARIA/schemata/html4-aria-1.dtd">',
            'html+rdfa-401-1' => '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/html401-rdfa-1.dtd">',
            'html+rdfa-401-11' => '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01+RDFa 1.1//EN" "http://www.w3.org/MarkUp/DTD/html401-rdfa11-1.dtd">',
            'html+rdfalite-401-11' => '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01+RDFa Lite 1.1//EN" "http://www.w3.org/MarkUp/DTD/html401-rdfalite11-1.dtd">',
            'html+iso15445-1' => '<!DOCTYPE html PUBLIC "ISO/IEC 15445:2000//DTD HTML//EN">',
            'html+iso15445-1-alternative' => '<!DOCTYPE html PUBLIC "ISO/IEC 15445:2000//DTD HyperText Markup Language//EN">',
            
        ), $generator->getAllKnown());
    }     
    
}