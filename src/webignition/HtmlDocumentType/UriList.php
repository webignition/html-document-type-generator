<?php
namespace webignition\HtmlDocumentType;

class UriList {
   
    const URI_HTML_4_STRICT = 'http://www.w3.org/TR/1998/REC-html40-19980424/strict.dtd';
    const URI_HTML_4_STRICT_ALTERNATIVE = 'http://www.w3.org/TR/REC-html40-971218/strict.dtd';  
    const URI_HTML_4_TRANSITIONAL = 'http://www.w3.org/TR/1998/REC-html40-19980424/loose.dtd';
    const URI_HTML_4_TRANSITIONAL_ALTERNATIVE = 'http://www.w3.org/TR/REC-html40-971218/loose.dtd';    
    const URI_HTML_4_FRAMESET = 'http://www.w3.org/TR/1998/REC-html40-19980424/frameset.dtd';
    const URI_HTML_4_FRAMESET_ALTERNATIVE = 'http://www.w3.org/TR/REC-html40-971218/frameset.dtd';    
    const URI_HTML_4_01_STRICT = 'http://www.w3.org/TR/html4/strict.dtd'; 
    const URI_HTML_4_01_STRICT_ALTERNATIVE1 = 'http://www.w3.org/TR/REC-html40/strict.dtd';
    const URI_HTML_4_01_STRICT_ALTERNATIVE2 = 'http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd';    
    const URI_HTML_4_01_STRICT_ALTERNATIVE3 = 'http://www.w3.org/TR/html40/strict.dtd';
    const URI_HTML_4_01_TRANSITIONAL = 'http://www.w3.org/TR/html4/loose.dtd'; 
    const URI_HTML_4_01_TRANSITIONAL_ALTERNATIVE1 = 'http://www.w3.org/TR/REC-html40/loose.dtd';
    const URI_HTML_4_01_TRANSITIONAL_ALTERNATIVE2 = 'http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd';    
    const URI_HTML_4_01_TRANSITIONAL_ALTERNATIVE3 = 'http://www.w3.org/TR/html40/loose.dtd';
    const URI_HTML_4_01_FRAMESET = 'http://www.w3.org/TR/html4/frameset.dtd'; 
    const URI_HTML_4_01_FRAMESET_ALTERNATIVE1 = 'http://www.w3.org/TR/REC-html40/frameset.dtd';
    const URI_HTML_4_01_FRAMESET_ALTERNATIVE2 = 'http://www.w3.org/TR/1999/REC-html401-19991224/frameset.dtd';    
    const URI_HTML_4_01_FRAMESET_ALTERNATIVE3 = 'http://www.w3.org/TR/html40/frameset.dtd';        
    const URI_HTML_5_LEGACY_COMPAT = 'about:legacy-compat';        
    const URI_XHTML_1_STRICT = 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd';
    const URI_XHTML_1_STRICT_ALTERNATIVE1 = 'http://www.w3.org/TR/2002/REC-xhtml1-20020801/DTD/xhtml1-strict.dtd';
    const URI_XHTML_1_STRICT_ALTERNATIVE2 = 'http://www.w3.org/TR/2000/REC-xhtml1-20000126/DTD/xhtml1-strict.dtd';    
    const URI_XHTML_1_STRICT_ALTERNATIVE3 = 'http://www.w3.org/MarkUp/DTD/xhtml1-strict.dtd';    
    const URI_XHTML_1_TRANSITIONAL = 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd';
    const URI_XHTML_1_TRANSITIONAL_ALTERNATIVE1 = 'http://www.w3.org/TR/2002/REC-xhtml1-20020801/DTD/xhtml1-transitional.dtd';
    const URI_XHTML_1_TRANSITIONAL_ALTERNATIVE2 = 'http://www.w3.org/TR/2000/REC-xhtml1-20000126/DTD/xhtml1-transitional.dtd';    
    const URI_XHTML_1_TRANSITIONAL_ALTERNATIVE3 = 'http://www.w3.org/MarkUp/DTD/xhtml1-transitional.dtd';
    const URI_XHTML_1_FRAMESET = 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd';
    const URI_XHTML_1_FRAMESET_ALTERNATIVE1 = 'http://www.w3.org/TR/2002/REC-xhtml1-20020801/DTD/xhtml1-frameset.dtd';
    const URI_XHTML_1_FRAMESET_ALTERNATIVE2 = 'http://www.w3.org/TR/2000/REC-xhtml1-20000126/DTD/xhtml1-frameset.dtd';
    const URI_XHTML_1_FRAMESET_ALTERNATIVE3 = 'http://www.w3.org/MarkUp/DTD/xhtml1-frameset.dtd';    
    const URI_XHTML_1_1 = 'http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd';
    const URI_XHTML_1_1_ALTERNATIVE1 = 'http://www.w3.org/MarkUp/DTD/xhtml11.dtd';
    const URI_XHTML_1_1_ALTERNATIVE2 = 'http://www.w3.org/TR/2010/REC-xhtml11-20101123/DTD/xhtml11.dtd';
    const URI_XHTML_1_1_ALTERNATIVE3 = 'http://www.w3.org/TR/2001/REC-xhtml11-20010531/DTD/xhtml11.dtd';    
    const URI_XHTML_BASIC_1 = 'http://www.w3.org/TR/xhtml-basic/xhtml-basic10.dtd';
    const URI_XHTML_BASIC_1_ALTERNATIVE1 = 'http://www.w3.org/TR/2010/REC-xhtml-basic-20101123/xhtml-basic10.dtd';
    const URI_XHTML_BASIC_1_ALTERNATIVE2 = 'http://www.w3.org/TR/2008/REC-xhtml-basic-20080729/xhtml-basic10.dtd';
    const URI_XHTML_BASIC_1_ALTERNATIVE3 = 'http://www.w3.org/MarkUp/DTD/xhtml-basic10.dtd';        
    const URI_XHTML_BASIC_1_1 = 'http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd';
    const URI_XHTML_BASIC_1_1_ALTERNATIVE_1 = 'http://www.w3.org/TR/2010/REC-xhtml-basic-20101123/xhtml-basic11.dtd';
    const URI_XHTML_BASIC_1_1_ALTERNATIVE_2 = 'http://www.w3.org/TR/2008/REC-xhtml-basic-20080729/xhtml-basic11.dtd';
    const URI_XHTML_BASIC_1_1_ALTERNATIVE_3 = 'http://www.w3.org/MarkUp/DTD/xhtml-basic11.dtd';        
    const URI_XHTML_PRINT_1 = 'http://www.w3.org/TR/xhtml-print/DTD/xhtml-print10.dtd';
    const URI_XHTML_PRINT_1_ALTERNATIVE1 = 'http://www.w3.org/TR/2010/REC-xhtml-print-20101123/DTD/xhtml-print10.dtd';
    const URI_XHTML_PRINT_1_ALTERNATIVE2 = 'http://www.w3.org/TR/2006/REC-xhtml-print-20060920/DTD/xhtml-print10.dtd';
    const URI_XHTML_PRINT_1_ALTERNATIVE3 = 'http://www.w3.org/MarkUp/DTD/xhtml-print10.dtd';       
    const URI_XHTML_MOBILE_1 = 'http://www.wapforum.org/DTD/xhtml-mobile10.dtd';    
    const URI_XHTML_MOBILE_1_1 = 'http://www.openmobilealliance.org/tech/DTD/xhtml-mobile11.dtd';    
    const URI_XHTML_MOBILE_1_2 = 'http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd';    
    const URI_XHTML_RDFA_1 = 'http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd';    
    const URI_XHTML_RDFA_1_1 = 'http://www.w3.org/MarkUp/DTD/xhtml-rdfa-2.dtd';
    const URI_XHTML_ARIA_1 = 'http://www.w3.org/WAI/ARIA/schemata/xhtml-aria-1.dtd';
    const URI_XHTML_ARIA_1_ALTERNATIVE = 'http://www.w3.org/MarkUp/DTD/xhtml-aria-1.dtd';
    const URI_HTML_ARIA_4_01_1 = 'http://www.w3.org/WAI/ARIA/schemata/html4-aria-1.dtd';
    const URI_HTML_RDFA_4_01_1 = 'http://www.w3.org/MarkUp/DTD/html401-rdfa-1.dtd';
    const URI_HTML_RDFA_4_01_1_1 = 'http://www.w3.org/MarkUp/DTD/html401-rdfa11-1.dtd';
    const URI_HTML_RDFALITE_4_01_1_1 = 'http://www.w3.org/MarkUp/DTD/html401-rdfalite11-1.dtd';
    
}