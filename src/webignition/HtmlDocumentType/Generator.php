<?php
namespace webignition\HtmlDocumentType;

/**
 * Generate a doctype string for a given HTML version and variant with optional
 * URI property.
 * 
 * This will generate a well-formed doctype string for the given properties.
 * 
 * It is up to the user to ensure that allowable properties result in valid
 * doctypes.
 */
class Generator {
    
    const DOCTYPE_PREFIX = '<!DOCTYPE html';
    const DOCTYPE_SUFFIX = '>';
    
    const FPI_HTML_2 = '-//IETF//DTD HTML 2.0//EN';
    const FPI_HTML_3_2 = '-//W3C//DTD HTML 3.2 Final//EN';
    const FPI_HTML_4_STRICT = '-//W3C//DTD HTML 4.0//EN';
    const FPI_HTML_4_TRANSITIONAL = '-//W3C//DTD HTML 4.0 Transitional//EN';
    const FPI_HTML_4_FRAMESET = '-//W3C//DTD HTML 4.0 Frameset//EN';
    const FPI_HTML_4_01_STRICT = '-//W3C//DTD HTML 4.01//EN';
    const FPI_HTML_4_01_TRANSITIONAL = '-//W3C//DTD HTML 4.01 Transitional//EN';
    const FPI_HTML_4_01_FRAMESET = '-//W3C//DTD HTML 4.01 Frameset//EN';    
    const FPI_XHTML_1_STRICT = '-//W3C//DTD XHTML 1.0 Strict//EN';
    const FPI_XHTML_1_TRANSITIONAL = '-//W3C//DTD XHTML 1.0 Transitional//EN';
    const FPI_XHTML_1_FRAMESET = '-//W3C//DTD XHTML 1.0 Frameset//EN';
    const FPI_XHTML_1_BASIC = '-//W3C//DTD XHTML Basic 1.0//EN';
    const FPI_XHTML_1_1 = '-//W3C//DTD XHTML 1.1//EN';
    const FPI_XHTML_1_1_BASIC = '-//W3C//DTD XHTML Basic 1.1//EN';
    const FPI_XHTML_RDFA_1 = '-//W3C//DTD XHTML+RDFa 1.0//EN';
    const FPI_XHTML_RDFA_1_1 = '-//W3C//DTD XHTML+RDFa 1.1//EN';
    const FPI_XHTML_ARIA_1 = '-//W3C//DTD XHTML+ARIA 1.0//EN';
    
    private $fpis = array(
        self::FPI_HTML_2,
        self::FPI_HTML_3_2,
        self::FPI_HTML_4_STRICT,
        self::FPI_HTML_4_TRANSITIONAL,
        self::FPI_HTML_4_FRAMESET,
        self::FPI_HTML_4_01_STRICT,
        self::FPI_HTML_4_01_TRANSITIONAL,
        self::FPI_HTML_4_01_FRAMESET,
        self::FPI_XHTML_1_STRICT,
        self::FPI_XHTML_1_TRANSITIONAL,
        self::FPI_XHTML_1_FRAMESET,
        self::FPI_XHTML_1_BASIC,
        self::FPI_XHTML_1_1,
        self::FPI_XHTML_1_1_BASIC,
        self::FPI_XHTML_RDFA_1,
        self::FPI_XHTML_RDFA_1_1,
        self::FPI_XHTML_ARIA_1
    );
    
    private $knownMatrix = array(
        'html' => array(
            array('version' => '2'),
            array('version' => '3.2'),
            array('version' => '4', 'variant' => 'strict'),
            array('version' => '4', 'variant' => 'transitional'),
            array('version' => '4', 'variant' => 'frameset'),
            array('version' => '4.01', 'variant' => 'strict'),
            array('version' => '4.01', 'variant' => 'transitional'),
            array('version' => '4.01', 'variant' => 'frameset'),           
            array('version' => '5')
        ),
        'xhtml' => array(
            array('version' => '1', 'variant' => 'strict'),
            array('version' => '1', 'variant' => 'transitional'),
            array('version' => '1', 'variant' => 'frameset'),
            array('version' => '1', 'isBasic' => true),
            array('version' => '1.1'),
            array('version' => '1.1', 'isBasic' => true),           
        ),        
        'xhtml+rdfa' => array(
            array('version' => '1'),
            array('version' => '1.1'),            
        ),
        'xhtml+aria' => array(
            array('version' => '1'),           
        )        
    ); 
         
    
    private $versionAndVariantToFpiMap = array(
        'html' => array(
            '2' => self::FPI_HTML_2,
            '3.2' => self::FPI_HTML_3_2,
            '4' => array(
                'default' => array(
                    'strict' => self::FPI_HTML_4_STRICT,
                    'transitional' => self::FPI_HTML_4_TRANSITIONAL,
                    'frameset' => self::FPI_HTML_4_FRAMESET                   
                )
            ),
            '4.0' => array(
                'default' => array(
                    'strict' => self::FPI_HTML_4_STRICT,
                    'transitional' => self::FPI_HTML_4_TRANSITIONAL,
                    'frameset' => self::FPI_HTML_4_FRAMESET                          
                )
            ),            
            '4.01' => array(
                'default' => array(
                    'strict' => self::FPI_HTML_4_01_STRICT,
                    'transitional' => self::FPI_HTML_4_01_TRANSITIONAL,
                    'frameset' => self::FPI_HTML_4_01_FRAMESET                    
                )
            ),           
        ),
        'xhtml' => array(
            '1' => array(
                'default' => array(
                    'strict' => self::FPI_XHTML_1_STRICT,
                    'transitional' => self::FPI_XHTML_1_TRANSITIONAL,
                    'frameset' => self::FPI_XHTML_1_FRAMESET                   
                ),
                'basic' => self::FPI_XHTML_1_BASIC
            ),
            '1.1' => array(
                'default' => self::FPI_XHTML_1_1,
                'basic' => self::FPI_XHTML_1_1_BASIC            
            )
        ),
        'xhtml+rdfa' => array(
            '1' => self::FPI_XHTML_RDFA_1,
            '1.1' => self::FPI_XHTML_RDFA_1_1
        ),
        'xhtml+aria' => array(
            '1' => self::FPI_XHTML_ARIA_1,
        )        
    );
    
    private $versionAndVariantToUriMap = array(
        'html' => array(
            '4' => array(
                'default' => array(
                    'strict' => 'http://www.w3.org/TR/html4/strict.dtd',
                    'transitional' => 'http://www.w3.org/TR/html4/loose.dtd',
                    'frameset' => 'http://www.w3.org/TR/html4/frameset.dtd'                    
                )
            ), 
            '4.0' => array(
                'default' => array(
                    'strict' => 'http://www.w3.org/TR/html4/strict.dtd',
                    'transitional' => 'http://www.w3.org/TR/html4/loose.dtd',
                    'frameset' => 'http://www.w3.org/TR/html4/frameset.dtd'                    
                )
            ), 
            '4.01' => array(
                'default' => array(
                    'strict' => 'http://www.w3.org/TR/html4/strict.dtd',
                    'transitional' => 'http://www.w3.org/TR/html4/loose.dtd',
                    'frameset' => 'http://www.w3.org/TR/html4/frameset.dtd'                    
                )
            ),
            '5' => array(
                'default' => array(
                    'legacy-compat' => 'about:legacy-compat'
                )
            )
        ),
        'xhtml' => array(
            '1' => array(
                'default' => array(
                    'strict' => 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd',
                    'transitional' => 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd',
                    'frameset' => 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd'                
                ),
                'basic' => 'http://www.w3.org/TR/xhtml-basic/xhtml-basic10.dtd'
            ),
            '1.1' => array(
                'default' => 'http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd',
                'basic' => 'http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd'               
            )
        ),
        'xhtml+rdfa' => array(
            '1' => 'http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd',
            '1.1' => 'http://www.w3.org/MarkUp/DTD/xhtml-rdfa-2.dtd'
        ),
        'xhtml+aria' => array(
            '1' => 'http://www.w3.org/MarkUp/DTD/xhtml-aria-1.dtd',            
        )        
    );
    
    /**
     * Whether the DTD string is for an HTML doctype
     * 
     * @var boolean
     */
    private $isHtml = true;
    
    
    /**
     * Whether the DTD string is for an XHTML doctype
     * 
     * @var boolean
     */
    private $isXhtml = false;
    
    
    /**
     * Whether the DTD string is for an XHTML Basic doctype
     * 
     * @var boolean
     */
    private $isXhtmlBasic = false;
    
    
    /**
     * HTML version to use
     * @var string
     */
    private $version = null;
    
    
    /**
     * Variant to use (such as strict, transitional, frameset, basic)
     *  
     * @var string
     */
    private $variant = null;
    
    
    /**
     *
     * @var boolean
     */
    private $multiline = false;
    
    
    /**
     *
     * @var int
     */
    private $indent = 4;
    
    
    /**
     *
     * @var boolean
     */
    private $noUri = false;
    
    
    /**
     *
     * @var boolean
     */
    private $lowercasePrefix = false;
    
    
    /**
     * Name of XHTML 1.1 module such as 'rdfa' or 'aria'
     * 
     * @var string
     */
    private $xhtmlModule = null;
    
    
    
    public function generate() {
        if (!$this->hasVersion()) {
            throw new \InvalidArgumentException('Unable to generate; no version given', 1);
        }
        
        $parts = array();
        
        if ($this->requiresPublicKeyword()) {
            $parts[] = 'PUBLIC';
        }
        
        if ($this->requiresSystemKeyword()) {
            $parts[] = 'SYSTEM';
        }
        
        if ($this->hasFpi()) {
            $parts[] = '"' . $this->getFpi() . '"';
        }
        
        if ($this->noUri === false && $this->hasUri()) {
            $parts[] = '"' . $this->getUri() . '"';
        }
     
        return $this->getDoctypePrefix() . $this->getPartContents($parts) . self::DOCTYPE_SUFFIX;
    }
    
    
    /**
     * 
     * @return string
     */
    private function getDoctypePrefix() {
        return ($this->lowercasePrefix) ? strtolower(self::DOCTYPE_PREFIX) : self::DOCTYPE_PREFIX;
    }

    
    
    /**
     * 
     * @param array $parts
     * @return string
     */
    private function getPartContents($parts) {
        if (count($parts) == 0) {
            return '';
        }
        
        if ($this->multiline == false) {
            return ' ' . implode(' ', $parts);
        }
        
        return ' ' . implode("\n" . str_repeat(' ', $this->indent), $parts);
    }
    
    
    public function getAllKnown() {
        $allDoctypes = array();
        
        foreach ($this->knownMatrix as $category => $instances) {
            foreach ($instances as $instance) {
                $parentCategory = $category;
                
                $key = $parentCategory.'-'.str_replace('.', '', $instance['version']);
                $xhtmlModule = null;
                
                $generator = new Generator();
                
                if ($this->multiline === true) {
                    $generator->multiline();
                }
                
                if ($this->noUri === true) {
                    $generator->noUri();
                }
                
                if ($this->lowercasePrefix === true) {
                    $generator->lowercasePrefix();
                }
                
                if ($this->isXhtmlModuleCategory($parentCategory)) {
                    $xhtmlModule = str_replace('xhtml+', '', $parentCategory);
                    $parentCategory = 'xhtml';
                }
                
                $generator->$parentCategory();
                $generator->version($instance['version']);
                
                if (!is_null($xhtmlModule)) {
                    $generator->xhtmlModule($xhtmlModule);
                }
                
                if (isset($instance['variant'])) {
                    $key .= '-' . $instance['variant'];
                    $generator->variant($instance['variant']);
                }
                
                if (isset($instance['isBasic'])) {
                    $key .= '-basic';
                    $generator->xhtmlBasic();
                }
                
                $allDoctypes[$key] = $generator->generate();
            }
        }
        
        return $allDoctypes;
    }
    
    
    /**
     * 
     * @param string $category
     * @return boolean
     */
    private function isXhtmlModuleCategory($category) {
        return preg_match('/^xhtml\+/', $category) === 1;
    }
    
    
    /**
     * 
     * @return array
     */
    public function getFpis() {
        return $this->fpis;
    }
    
    

    /**
     * Whether the doctype string requires the public keyword to be present
     * Short answer: all but HTML5
     * 
     * @return boolean
     */
    private function requiresPublicKeyword() {
        return !($this->isHtml && $this->version == 5);
    }
    
    
    /**
     * 
     * @return boolean
     */
    private function requiresSystemKeyword() {
        return ($this->isHtml && $this->version == 5 && $this->getVariant() == 'legacy-compat');
    }
    
    
    /**
     * 
     * @return boolean
     */
    private function hasFpi() {
        return !is_null($this->getFpi());
    }
    
    
    /**
     * 
     * @return string|null
     */
    private function getFpi() {
        return $this->getMappedProperty($this->versionAndVariantToFpiMap);
    }    
    
    /**
     * 
     * @return string|null
     */    
    private function getUri() {
        return $this->getMappedProperty($this->versionAndVariantToUriMap);        
    }
    
    
    /**
     * 
     * @return string|null
     */    
    private function getMappedProperty($values) {
        $rootSubsetKey = $this->getMapRootSubsetKey();        
        if (is_null($rootSubsetKey)) {
            return null;
        }
        
        if (!isset($values[$rootSubsetKey])) {
            return null;
        }
        
        $rootElementSubset = $values[$rootSubsetKey];                
        if (!isset($rootElementSubset[$this->version])) {
            return null;
        }
        
        $versionSubset = $rootElementSubset[$this->version];
        if (is_string($versionSubset)) {
            return $versionSubset;
        }
        
        $familySubset = $versionSubset[$this->getFamilySubsetKey()];         
        if (is_string($familySubset)) {
            return $familySubset;
        }        
        
        return (isset($familySubset[$this->getVariant()])) ? $familySubset[$this->getVariant()] : null;        
    }    
    
    
    /**
     * 
     * @return string
     */
    private function getFamilySubsetKey() {        
        if ($this->isXhtml && $this->isXhtmlBasic) {
            return 'basic';
        }
        
        return 'default';
    }    
    
    
    /**
     * 
     * @return string|null
     */
    private function getMapRootSubsetKey() {
        if ($this->isHtml) {
            return 'html';
        }
        
        if ($this->isXhtml) {
            return (is_null($this->xhtmlModule)) ? 'xhtml' : 'xhtml+' . $this->xhtmlModule;
        }
        
        if ($this->isXhtmlBasic) {
            return 'xhtml-basic';
        }
        
        return null;
    }
    
    
    /**
     * 
     * @return boolean
     */
    private function hasUri() {
        return !is_null($this->getUri());
    }
    
    
    
    /**
     * Generate for a HTML document
     * 
     * @return \webignition\HtmlDocumentType\Generator
     */
    public function html() {
        $this->isHtml = true;
        $this->isXhtml = false;
        $this->isXhtmlBasic = false;
        return $this;
    }
    
    /**
     * Generate for a XHTML document
     * 
     * @return \webignition\HtmlDocumentType\Generator
     */
    public function xhtml() {
        $this->isHtml = false;
        $this->isXhtml = true;
        return $this;
    }
    
    /**
     * Generate for a XHTML Basic document
     * 
     * @return \webignition\HtmlDocumentType\Generator
     */    
    public function xhtmlBasic() {
        $this->isXhtml = true;
        $this->isXhtmlBasic = true;
        return $this;        
    }    
    
    
    /**
     * 
     * @param string $version
     * @return \webignition\HtmlDocumentType\Generator
     */
    public function version($version) {
        $this->version = (string)$version;
        return $this;
    }    
    
    
    /**
     * 
     * @param string $variant
     * @return \webignition\HtmlDocumentType\Generator
     */
    public function variant($variant) {
        $this->variant = (string)$variant;
        return $this;
    } 
    
    
    /**
     * 
     * @return \webignition\HtmlDocumentType\Generator
     */
    public function multiline() {
        $this->multiline = true;
        return $this;
    }
    
    
    /**
     * 
     * @return \webignition\HtmlDocumentType\Generator
     */
    public function singleline() {
        $this->multiline = false;
        return $this;
    }
    
    
    /**
     * 
     * @param int $indentLevel
     * @return \webignition\HtmlDocumentType\Generator
     */
    public function indent($indentLevel) {
        $this->indent = $indentLevel;
        return $this;
    }
    
    
    /**
     * 
     * @return boolean
     */
    private function hasVersion() {
        return !is_null($this->version);
    }
    
    
    /**
     * 
     * @return string|null
     */
    private function getVariant() {
        if (isset($this->variant)) {
            return $this->variant;
        }
        
        if ($this->isXhtml) {
            return 'strict';
        }        
        
        if ($this->isHtml && in_array($this->version, array('4', '4.01'))) {
            return 'strict';
        }
        
        return null;
    }    
    
    
    /**
     * 
     * @return \webignition\HtmlDocumentType\Generator
     */
    public function noUri() {
        $this->noUri = true;
        return $this;
    }
    
    
    /**
     * 
     * @return \webignition\HtmlDocumentType\Generator
     */
    public function lowercasePrefix() {
        $this->lowercasePrefix = true;
        return $this;
    }
    
    
    /**
     * 
     * @return \webignition\HtmlDocumentType\Generator
     */
    public function uppercasePrefix() {
        $this->lowercasePrefix = false;
        return $this;
    }
    
    
    /**
     * 
     * @param string $module
     * @return \webignition\HtmlDocumentType\Generator
     */
    public function xhtmlModule($module) {
        $this->xhtmlModule = $module;
        return $this;
    }
    
}