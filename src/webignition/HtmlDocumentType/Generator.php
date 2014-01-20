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
 * 
 * For uri variants:
 * http://devfiles.myopera.com/articles/570/doctype-ci-url.htm* 
 */
class Generator {
    
    const DOCTYPE_PREFIX = '<!DOCTYPE html';
    const DOCTYPE_SUFFIX = '>';
    
    const FPI_HTML_2 = '-//IETF//DTD HTML//EN';
    const FPI_HTML_2_ALT = '-//IETF//DTD HTML 2.0//EN';
    const FPI_HTML_3_2 = '-//W3C//DTD HTML 3.2 Final//EN';
    const FPI_HTML_3_2_ALT1 = '-//W3C//DTD HTML 3.2//EN';
    const FPI_HTML_3_2_ALT2 = '-//W3C//DTD HTML 3.2 Draft//EN';
    const FPI_HTML_4_STRICT = '-//W3C//DTD HTML 4.0//EN';
    const FPI_HTML_4_TRANSITIONAL = '-//W3C//DTD HTML 4.0 Transitional//EN';
    const FPI_HTML_4_FRAMESET = '-//W3C//DTD HTML 4.0 Frameset//EN';
    const FPI_HTML_4_01_STRICT = '-//W3C//DTD HTML 4.01//EN';
    const FPI_HTML_4_01_TRANSITIONAL = '-//W3C//DTD HTML 4.01 Transitional//EN';
    const FPI_HTML_4_01_FRAMESET = '-//W3C//DTD HTML 4.01 Frameset//EN';    
    const FPI_HTML_4_01_ARIA = '-//W3C//DTD HTML+ARIA 1.0//EN';
    const FPI_HTML_4_01_RDFA_1 = '-//W3C//DTD HTML 4.01+RDFa 1.0//EN';
    const FPI_HTML_4_01_RDFA_1_1 = '-//W3C//DTD HTML 4.01+RDFa 1.1//EN';
    const FPI_HTML_4_01_RDFALITE_1_1 = '-//W3C//DTD HTML 4.01+RDFa Lite 1.1//EN';
    const FPI_HTML_ISO_15445 = 'ISO/IEC 15445:2000//DTD HTML//EN';
    const FPI_HTML_ISO_15445_ALT = 'ISO/IEC 15445:2000//DTD HyperText Markup Language//EN';
    const FPI_XHTML_1_STRICT = '-//W3C//DTD XHTML 1.0 Strict//EN';
    const FPI_XHTML_1_TRANSITIONAL = '-//W3C//DTD XHTML 1.0 Transitional//EN';
    const FPI_XHTML_1_FRAMESET = '-//W3C//DTD XHTML 1.0 Frameset//EN';
    const FPI_XHTML_1_BASIC = '-//W3C//DTD XHTML Basic 1.0//EN';
    const FPI_XHTML_1_PRINT = '-//W3C//DTD XHTML-Print 1.0//EN';
    const FPI_XHTML_MOBILE_1 = '-//WAPFORUM//DTD XHTML Mobile 1.0//EN';
    const FPI_XHTML_MOBILE_1_1 = '-//WAPFORUM//DTD XHTML Mobile 1.1//EN';
    const FPI_XHTML_MOBILE_1_2 = '-//WAPFORUM//DTD XHTML Mobile 1.2//EN';    
    const FPI_XHTML_1_1 = '-//W3C//DTD XHTML 1.1//EN';
    const FPI_XHTML_1_1_BASIC = '-//W3C//DTD XHTML Basic 1.1//EN';
    const FPI_XHTML_RDFA_1 = '-//W3C//DTD XHTML+RDFa 1.0//EN';
    const FPI_XHTML_RDFA_1_1 = '-//W3C//DTD XHTML+RDFa 1.1//EN';
    const FPI_XHTML_ARIA_1 = '-//W3C//DTD XHTML+ARIA 1.0//EN';
    
    private $fpis = array(
        self::FPI_HTML_2,
        self::FPI_HTML_2_ALT,
        self::FPI_HTML_3_2,
        self::FPI_HTML_3_2_ALT1,
        self::FPI_HTML_3_2_ALT2,
        self::FPI_HTML_4_STRICT,
        self::FPI_HTML_4_TRANSITIONAL,
        self::FPI_HTML_4_FRAMESET,
        self::FPI_HTML_4_01_STRICT,
        self::FPI_HTML_4_01_TRANSITIONAL,
        self::FPI_HTML_4_01_FRAMESET,
        self::FPI_HTML_4_01_ARIA,
        self::FPI_HTML_4_01_RDFA_1,
        self::FPI_HTML_4_01_RDFA_1_1,
        self::FPI_HTML_4_01_RDFALITE_1_1,
        self::FPI_HTML_ISO_15445,
        self::FPI_HTML_ISO_15445_ALT,
        self::FPI_XHTML_1_STRICT,
        self::FPI_XHTML_1_TRANSITIONAL,
        self::FPI_XHTML_1_FRAMESET,
        self::FPI_XHTML_1_BASIC,        
        self::FPI_XHTML_1_PRINT,
        self::FPI_XHTML_MOBILE_1,
        self::FPI_XHTML_MOBILE_1_1,
        self::FPI_XHTML_MOBILE_1_2,        
        self::FPI_XHTML_1_1,
        self::FPI_XHTML_1_1_BASIC,
        self::FPI_XHTML_RDFA_1,
        self::FPI_XHTML_RDFA_1_1,
        self::FPI_XHTML_ARIA_1
    );
    
    private $knownMatrix = array(
        'html' => array(
            array('version' => '2'),
            array('version' => '2', 'variant' => 'alternative'),
            array('version' => '3.2'),
            array('version' => '3.2', 'variant' => 'alternative1'),
            array('version' => '3.2', 'variant' => 'alternative2'),
            array('version' => '4', 'variant' => 'strict'),
            array('version' => '4', 'variant' => 'transitional'),
            array('version' => '4', 'variant' => 'frameset'),
            array('version' => '4.01', 'variant' => 'strict'),
            array('version' => '4.01', 'variant' => 'transitional'),
            array('version' => '4.01', 'variant' => 'frameset'),           
            array('version' => '5'),
            array('version' => '5', 'variant' => 'legacy-compat')
        ),
        'xhtml' => array(
            array('version' => '1', 'variant' => 'strict'),
            array('version' => '1', 'variant' => 'transitional'),
            array('version' => '1', 'variant' => 'frameset'),
            array('version' => '1.1'),    
        ),        
        'xhtml+basic' => array(
            array('version' => '1'),
            array('version' => '1.1'),            
        ),        
        'xhtml+print' => array(
            array('version' => '1'),          
        ),              
        'xhtml+mobile' => array(
            array('version' => '1'),
            array('version' => '1.1'),
            array('version' => '1.2'),
        ),        
        'xhtml+rdfa' => array(
            array('version' => '1'),
            array('version' => '1.1'),            
        ),
        'xhtml+aria' => array(
            array('version' => '1'),           
        ),
        'html+aria' => array(
            array('version' => '4.01'),
        ),
        'html+rdfa' => array(
            array('version' => '4.01', 'moduleVersion' => '1'),
            array('version' => '4.01', 'moduleVersion' => '1.1'),
        ),
        'html+rdfalite' => array(
            array('version' => '4.01', 'moduleVersion' => '1.1'),
        ),
        'html+iso15445' => array(
            array('version' => '1'),
            array('version' => '1', 'variant' => 'alternative'),
        )
    );
         
    
    private $versionAndVariantToFpiMap = array(
        'html' => array(
            '2' => array(
                'default' => self::FPI_HTML_2,
                'alternative' => self::FPI_HTML_2_ALT,
            ),
            '3.2' => array(
                'default' => self::FPI_HTML_3_2,
                'alternative1' => self::FPI_HTML_3_2_ALT1,
                'alternative2' => self::FPI_HTML_3_2_ALT2
            ),
            '4' => array(
                'strict' => self::FPI_HTML_4_STRICT,
                'transitional' => self::FPI_HTML_4_TRANSITIONAL,
                'frameset' => self::FPI_HTML_4_FRAMESET
            ),
            '4.0' => array(
                'strict' => self::FPI_HTML_4_STRICT,
                'transitional' => self::FPI_HTML_4_TRANSITIONAL,
                'frameset' => self::FPI_HTML_4_FRAMESET
            ),            
            '4.01' => array(
                'strict' => self::FPI_HTML_4_01_STRICT,
                'transitional' => self::FPI_HTML_4_01_TRANSITIONAL,
                'frameset' => self::FPI_HTML_4_01_FRAMESET
            ),           
        ),
        'xhtml' => array(
            '1' => array(
                'strict' => self::FPI_XHTML_1_STRICT,
                'transitional' => self::FPI_XHTML_1_TRANSITIONAL,
                'frameset' => self::FPI_XHTML_1_FRAMESET
            ),
            '1.1' => self::FPI_XHTML_1_1
        ),
        'xhtml+basic' => array(
            '1' => self::FPI_XHTML_1_BASIC,
            '1.1' => self::FPI_XHTML_1_1_BASIC
        ),        
        'xhtml+print' => array(
            '1' => self::FPI_XHTML_1_PRINT
        ),         
        'xhtml+mobile' => array(
            '1' => self::FPI_XHTML_MOBILE_1,
            '1.1' => self::FPI_XHTML_MOBILE_1_1,
            '1.2' => self::FPI_XHTML_MOBILE_1_2
        ),         
        'xhtml+rdfa' => array(
            '1' => self::FPI_XHTML_RDFA_1,
            '1.1' => self::FPI_XHTML_RDFA_1_1
        ),
        'xhtml+aria' => array(
            '1' => self::FPI_XHTML_ARIA_1,
        ),
        'html+aria' => array(
            '4.01' => self::FPI_HTML_4_01_ARIA
        ),
        'html+rdfa' => array(
            '4.01' => array(
                '1' => self::FPI_HTML_4_01_RDFA_1,
                '1.1' => self::FPI_HTML_4_01_RDFA_1_1,
            )
        ),
        'html+rdfalite' => array(
            '4.01' => array(
                '1.1' => self::FPI_HTML_4_01_RDFALITE_1_1,
            )            
        ),
        'html+iso15445' => array(
            '1' => array(
                'default' => self::FPI_HTML_ISO_15445,
                'alternative' => self::FPI_HTML_ISO_15445_ALT,
            )
        )
    );
    
    private $versionAndVariantToUriMap = array(
        'html' => array(
            '4' => array(
                'strict' => 'http://www.w3.org/TR/html4/strict.dtd',
                'transitional' => 'http://www.w3.org/TR/html4/loose.dtd',
                'frameset' => 'http://www.w3.org/TR/html4/frameset.dtd'
            ), 
            '4.0' => array(
                'strict' => 'http://www.w3.org/TR/html4/strict.dtd',
                'transitional' => 'http://www.w3.org/TR/html4/loose.dtd',
                'frameset' => 'http://www.w3.org/TR/html4/frameset.dtd'
            ), 
            '4.01' => array(
                'strict' => 'http://www.w3.org/TR/html4/strict.dtd',
                'transitional' => 'http://www.w3.org/TR/html4/loose.dtd',
                'frameset' => 'http://www.w3.org/TR/html4/frameset.dtd'
            ),
            '5' => array(
                'legacy-compat' => 'about:legacy-compat'
            )
        ),
        'xhtml' => array(
            '1' => array(
                'strict' => 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd',
                'transitional' => 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd',
                'frameset' => 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd'                
            ),
            '1.1' => 'http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd',
        ),
        'xhtml+basic' => array(
            '1' => 'http://www.w3.org/TR/xhtml-basic/xhtml-basic10.dtd',
            '1.1' => 'http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd'
        ),          
        'xhtml+print' => array(
            '1' => 'http://www.w3.org/TR/xhtml-print/xhtml-print10.dtd',
        ),        
        'xhtml+mobile' => array(
            '1' => 'http://www.wapforum.org/DTD/xhtml-mobile10.dtd',
            '1.1' => 'http://www.openmobilealliance.org/tech/DTD/xhtml-mobile11.dtd',
            '1.2' => 'http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd',
        ),         
        'xhtml+rdfa' => array(
            '1' => 'http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd',
            '1.1' => 'http://www.w3.org/MarkUp/DTD/xhtml-rdfa-2.dtd'
        ),
        'xhtml+aria' => array(
            '1' => 'http://www.w3.org/MarkUp/DTD/xhtml-aria-1.dtd',            
        ),
        'html+aria' => array(
            '4.01' => 'http://www.w3.org/WAI/ARIA/schemata/html4-aria-1.dtd',            
        ),
        'html+rdfa' => array(
            '4.01' => array(
                '1' => 'http://www.w3.org/MarkUp/DTD/html401-rdfa-1.dtd',
                '1.1' => 'http://www.w3.org/MarkUp/DTD/html401-rdfa11-1.dtd',
            )
        ),
        'html+rdfalite' => array(
            '4.01' => array(
                '1.1' => 'http://www.w3.org/MarkUp/DTD/html401-rdfalite11-1.dtd',
            )            
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
     * HTML version to use
     * @var string
     */
    private $version = null;
    
    
    /**
     * Variant to use (such as strict, transitional, frameset)
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
     * Name of (X)HTML module such as 'basic', 'print', 'mobile', 'rdfa' or 'aria'
     * 
     * @var string
     */
    private $module = null;
    
    
    /**
     *
     * @var string
     */
    private $moduleVersion = null;
    
    
    
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
                $module = null;
                
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
                
                if ($this->isModuleCategory($parentCategory)) {
                    $module = $this->getModuleFromCategory($parentCategory);
                    $parentCategory = $this->getParentCategoryFromModuleCategory($parentCategory);
                }
                
                $generator->$parentCategory();
                $generator->version($instance['version']);
                
                if (!is_null($module)) {
                    $generator->module($module);
                }
                
                if (isset($instance['variant'])) {
                    $key .= '-' . $instance['variant'];
                    $generator->variant($instance['variant']);
                }
                
                if (isset($instance['moduleVersion'])) {
                    $key .= '-' . str_replace('.', '', $instance['moduleVersion']);
                    $generator->moduleVersion($instance['moduleVersion']);
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
    private function isModuleCategory($category) {
        return preg_match('/^(xhtml\+)|(html\+)/', $category) === 1;
    }
    
    
    /**
     * 
     * @param string $category
     * @return string
     */
    private function getModuleFromCategory($category) {
        return str_replace(array('xhtml+', 'html+'), '', $category);
    }
    
    
    /**
     * 
     * @param string $category
     * @return string
     */
    private function getParentCategoryFromModuleCategory($category) {
        if (!substr_count($category, '+')) {
            return $category;
        }
        
        $categoryParts = explode('+', $category);
        return $categoryParts[0];
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
        if ($this->versionSubsetHasModuleVersions($versionSubset)) {
            if (is_null($this->moduleVersion)) {
                $versionSubset = $versionSubset[key($versionSubset)];
            } else {
                $versionSubset = $versionSubset[$this->moduleVersion];
            }
        }        
        
        if (is_string($versionSubset)) {
            return $versionSubset;
        }       
        
        return (isset($versionSubset[$this->getVariant()])) ? $versionSubset[$this->getVariant()] : null;        
    }  
    

    /**
     * 
     * @param array $versionSubset
     * @return boolean
     */
    private function versionSubsetHasModuleVersions($versionSubset) {        
        if (!is_array($versionSubset)) {
            return false;
        }
        
        $keys = array_keys($versionSubset);            
        return preg_match('/[0-9]/', $keys[0]) > 0; 
    }
    
    
    /**
     * 
     * @return string|null
     */
    private function getMapRootSubsetKey() {
        $keyParts = array(
            ($this->isHtml) ? 'html' : 'xhtml'
        );
        
        if (!is_null($this->module)) {
            $keyParts[] = $this->module;
        }
        
        return implode('+', $keyParts);
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
        //$this->isXhtmlBasic = false;
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
        
        if ($this->isHtml && in_array($this->version, array('4', '4.01')) && is_null($this->moduleVersion)) {
            return 'strict';
        }
        
        if ($this->isHtml && $this->version == 2) {
            return 'default';
        }
        
        if ($this->isHtml && $this->version == '3.2') {
            return 'default';
        }
        
        if ($this->module == 'iso15445') {
            return 'default';
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
    public function module($module) {
        $this->module = $module;
        return $this;
    }
    
    
    /**
     * 
     * @param string $version
     * @return \webignition\HtmlDocumentType\Generator
     */
    public function moduleVersion($version) {
        $this->moduleVersion = $version;
        return $this;
    }
    
}