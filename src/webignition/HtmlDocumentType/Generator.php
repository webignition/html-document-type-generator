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
        'xhtmlrdfa' => array(
            array('version' => '1'),
            array('version' => '1.1'),            
        )
    ); 
         
    
    private $versionAndVariantToFpiMap = array(
        'html' => array(
            '2' => '-//IETF//DTD HTML 2.0//EN',
            '3.2' => '-//W3C//DTD HTML 3.2 Final//EN',
            '4' => array(
                'default' => array(
                    'strict' => '-//W3C//DTD HTML 4.0//EN',
                    'transitional' => '-//W3C//DTD HTML 4.0 Transitional//EN',
                    'frameset' => '-//W3C//DTD HTML 4.0 Frameset//EN'                    
                )
            ),
            '4.0' => array(
                'default' => array(
                    'strict' => '-//W3C//DTD HTML 4.0//EN',
                    'transitional' => '-//W3C//DTD HTML 4.0 Transitional//EN',
                    'frameset' => '-//W3C//DTD HTML 4.0 Frameset//EN'                    
                )
            ),            
            '4.01' => array(
                'default' => array(
                    'strict' => '-//W3C//DTD HTML 4.01//EN',
                    'transitional' => '-//W3C//DTD HTML 4.01 Transitional//EN',
                    'frameset' => '-//W3C//DTD HTML 4.01 Frameset//EN'                    
                )
            ),           
        ),
        'xhtml' => array(
            '1' => array(
                'default' => array(
                    'strict' => '-//W3C//DTD XHTML 1.0 Strict//EN',
                    'transitional' => '-//W3C//DTD XHTML 1.0 Transitional//EN',
                    'frameset' => '-//W3C//DTD XHTML 1.0 Frameset//EN'                   
                ),
                'basic' => '-//W3C//DTD XHTML Basic 1.0//EN'
            ),
            '1.1' => array(
                'default' => '-//W3C//DTD XHTML 1.1//EN',
                'basic' => '-//W3C//DTD XHTML Basic 1.1//EN'             
            )
        ),
        'xhtml+rdfa' => array(
            '1' => '-//W3C//DTD XHTML+RDFa 1.0//EN',
            '1.1' => '-//W3C//DTD XHTML+RDFa 1.1//EN'
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
     * Whether the DTD is for a XHTML+RDFa doctype
     * 
     * @var boolean
     */
    private $isXhtmlRdfa = false;
    
    
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
    
    
    
    public function generate() {
        if (!$this->hasVersion()) {
            throw new \InvalidArgumentException('Unable to generate; no version given', 1);
        }
        
        $parts = array();
        
        if ($this->requiresPublicKeyword()) {
            $parts[] = 'PUBLIC';
        }
        
        if ($this->hasFpi()) {
            $parts[] = '"' . $this->getFpi() . '"';
        }
        
        if ($this->noUri === false && $this->hasUri()) {
            $parts[] = '"' . $this->getUri() . '"';
        }        
     
        return self::DOCTYPE_PREFIX . $this->getPartContents($parts) . self::DOCTYPE_SUFFIX;
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
                $key = $category.'-'.str_replace('.', '', $instance['version']);
                
                $generator = new Generator();
                $generator->$category();
                $generator->version($instance['version']);
                
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
            return 'xhtml';
        }
        
        if ($this->isXhtmlRdfa) {
            return 'xhtml+rdfa';
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
        $this->isXhtmlRdfa = false;
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
        $this->isXhtmlRdfa = false;
        return $this;
    } 
    

    /**
     * Generate for a XHTML+RDFa document
     * 
     * @return \webignition\HtmlDocumentType\Generator
     */    
    public function xhtmlRdfa() {
        $this->isHtml = false;
        $this->isXhtml = false;
        $this->isXhtmlBasic = false;
        $this->isXhtmlRdfa = true;
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
    
}