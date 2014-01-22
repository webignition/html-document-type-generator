<?php
namespace webignition\HtmlDocumentType;

class FpiToUriMap {  
    
    private $map = array(
        FpiList::FPI_HTML_4_STRICT => array(
            UriList::URI_HTML_4_STRICT,
            UriList::URI_HTML_4_STRICT_ALTERNATIVE,
            UriList::URI_HTML_4_01_STRICT,
            UriList::URI_HTML_4_01_STRICT_ALTERNATIVE1,
            UriList::URI_HTML_4_01_STRICT_ALTERNATIVE2,
            UriList::URI_HTML_4_01_STRICT_ALTERNATIVE3,            
        ),
        FpiList::FPI_HTML_4_TRANSITIONAL => array(
            UriList::URI_HTML_4_TRANSITIONAL,
            UriList::URI_HTML_4_TRANSITIONAL_ALTERNATIVE,
            UriList::URI_HTML_4_01_TRANSITIONAL,
            UriList::URI_HTML_4_01_TRANSITIONAL_ALTERNATIVE1,
            UriList::URI_HTML_4_01_TRANSITIONAL_ALTERNATIVE2,
            UriList::URI_HTML_4_01_TRANSITIONAL_ALTERNATIVE3,            
        ),
        FpiList::FPI_HTML_4_FRAMESET => array(
            UriList::URI_HTML_4_FRAMESET,
            UriList::URI_HTML_4_FRAMESET_ALTERNATIVE,
            UriList::URI_HTML_4_01_FRAMESET,
            UriList::URI_HTML_4_01_FRAMESET_ALTERNATIVE1,
            UriList::URI_HTML_4_01_FRAMESET_ALTERNATIVE2,
            UriList::URI_HTML_4_01_FRAMESET_ALTERNATIVE3,            
        ),
        FpiList::FPI_HTML_4_01_STRICT => array(
            UriList::URI_HTML_4_01_STRICT,
            UriList::URI_HTML_4_01_STRICT_ALTERNATIVE1,
            UriList::URI_HTML_4_01_STRICT_ALTERNATIVE2,
            UriList::URI_HTML_4_01_STRICT_ALTERNATIVE3,
        ),
        FpiList::FPI_HTML_4_01_TRANSITIONAL => array(
            UriList::URI_HTML_4_01_TRANSITIONAL,
            UriList::URI_HTML_4_01_TRANSITIONAL_ALTERNATIVE1,
            UriList::URI_HTML_4_01_TRANSITIONAL_ALTERNATIVE2,
            UriList::URI_HTML_4_01_TRANSITIONAL_ALTERNATIVE3,
        ),
        FpiList::FPI_HTML_4_01_FRAMESET => array(
            UriList::URI_HTML_4_01_FRAMESET,
            UriList::URI_HTML_4_01_FRAMESET_ALTERNATIVE1,
            UriList::URI_HTML_4_01_FRAMESET_ALTERNATIVE2,
            UriList::URI_HTML_4_01_FRAMESET_ALTERNATIVE3,
        ),
        FpiList::FPI_HTML_4_01_ARIA => array(
            UriList::URI_HTML_ARIA_4_01_1
        ),
        FpiList::FPI_HTML_4_01_RDFA_1 => array(
            UriList::URI_HTML_RDFA_4_01_1
        ),
        FpiList::FPI_HTML_4_01_RDFA_1_1 => array(
            UriList::URI_HTML_RDFA_4_01_1_1
        ),
        FpiList::FPI_HTML_4_01_RDFALITE_1_1 => array(
            UriList::URI_HTML_RDFALITE_4_01_1_1
        ),
        FpiList::FPI_XHTML_1_STRICT => array(
            UriList::URI_XHTML_1_STRICT,
            UriList::URI_XHTML_1_STRICT_ALTERNATIVE1,
            UriList::URI_XHTML_1_STRICT_ALTERNATIVE2
        ),
        FpiList::FPI_XHTML_1_TRANSITIONAL => array(
            UriList::URI_XHTML_1_TRANSITIONAL,
            UriList::URI_XHTML_1_TRANSITIONAL_ALTERNATIVE1,
            UriList::URI_XHTML_1_TRANSITIONAL_ALTERNATIVE2,
        ),
        FpiList::FPI_XHTML_1_FRAMESET => array(
            UriList::URI_XHTML_1_FRAMESET,
            UriList::URI_XHTML_1_FRAMESET_ALTERNATIVE1,
            UriList::URI_XHTML_1_FRAMESET_ALTERNATIVE2,
        ),
        FpiList::FPI_XHTML_1_BASIC => array(
            UriList::URI_XHTML_BASIC_1,
            UriList::URI_XHTML_BASIC_1_ALTERNATIVE1,
            UriList::URI_XHTML_BASIC_1_ALTERNATIVE2,
            UriList::URI_XHTML_BASIC_1_ALTERNATIVE3,
        ),
        FpiList::FPI_XHTML_1_PRINT => array(
            UriList::URI_XHTML_PRINT_1,
            UriList::URI_XHTML_PRINT_1_ALTERNATIVE1,
            UriList::URI_XHTML_PRINT_1_ALTERNATIVE2,
            UriList::URI_XHTML_PRINT_1_ALTERNATIVE3,
        ),
        FpiList::FPI_XHTML_MOBILE_1 => array(
            UriList::URI_XHTML_MOBILE_1
        ),
        FpiList::FPI_XHTML_MOBILE_1_1 => array(
            UriList::URI_XHTML_MOBILE_1_1
        ),
        FpiList::FPI_XHTML_MOBILE_1_2 => array(
            UriList::URI_XHTML_MOBILE_1_2
        ),
        FpiList::FPI_XHTML_1_1 => array(
            UriList::URI_XHTML_1_1,
            UriList::URI_XHTML_1_1_ALTERNATIVE1,
            UriList::URI_XHTML_1_1_ALTERNATIVE2,
            UriList::URI_XHTML_1_1_ALTERNATIVE3,
        ),
        FpiList::FPI_XHTML_1_1_BASIC => array(
            UriList::URI_XHTML_BASIC_1_1,
            UriList::URI_XHTML_BASIC_1_1_ALTERNATIVE_1,
            UriList::URI_XHTML_BASIC_1_1_ALTERNATIVE_2,
            UriList::URI_XHTML_BASIC_1_1_ALTERNATIVE_3,
        ),
        FpiList::FPI_XHTML_RDFA_1 => array(
            UriList::URI_XHTML_RDFA_1
        ),
        FpiList::FPI_XHTML_RDFA_1_1 => array(
            UriList::URI_XHTML_RDFA_1_1
        ),
        FpiList::FPI_XHTML_ARIA_1 => array(
            UriList::URI_XHTML_ARIA_1,
            UriList::URI_XHTML_ARIA_1_ALTERNATIVE
        ),
    );
    
    
    /**
     * 
     * @return array
     */
    public function get() {
        return $this->map;
    }
    
    
    /**
     * 
     * @param string $fpi
     * @return array
     */
    public function getForFpi($fpi) {
        return (isset($this->map[$fpi])) ? $this->map[$fpi] : array();
    }
    
}