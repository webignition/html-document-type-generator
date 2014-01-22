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
     
    private $fpis = array(
        'html-2' => FpiList::FPI_HTML_2,
        'html-2-alternative' => FpiList::FPI_HTML_2_ALTERNATIVE,
        'html-32' => FpiList::FPI_HTML_3_2,
        'html-32-alternative1' => FpiList::FPI_HTML_3_2_ALTERNATIVE1,
        'html-32-alternative2' => FpiList::FPI_HTML_3_2_ALTERNATIVE2,
        'html-4-strict' => FpiList::FPI_HTML_4_STRICT,
        'html-4-transitional' => FpiList::FPI_HTML_4_TRANSITIONAL,
        'html-4-frameset' => FpiList::FPI_HTML_4_FRAMESET,
        'html-401-strict' => FpiList::FPI_HTML_4_01_STRICT,
        'html-401-transitional' => FpiList::FPI_HTML_4_01_TRANSITIONAL,
        'html-401-frameset' => FpiList::FPI_HTML_4_01_FRAMESET,
        'html+aria-401' => FpiList::FPI_HTML_4_01_ARIA,
        'html+rdfa-401-1' => FpiList::FPI_HTML_4_01_RDFA_1,
        'html+rdfa-401-11' => FpiList::FPI_HTML_4_01_RDFA_1_1,
        'html+rdfalite-401-11' => FpiList::FPI_HTML_4_01_RDFALITE_1_1,
        'html+iso15445-1' => FpiList::FPI_HTML_ISO_15445,
        'html+iso15445-1-alternative' => FpiList::FPI_HTML_ISO_15445_ALTERNATIVE,
        'xhtml-1-strict' => FpiList::FPI_XHTML_1_STRICT,
        'xhtml-1-transitional' => FpiList::FPI_XHTML_1_TRANSITIONAL,
        'xhtml-1-frameset' => FpiList::FPI_XHTML_1_FRAMESET,
        'xhtml+basic-1' => FpiList::FPI_XHTML_1_BASIC,        
        'xhtml+print-1' => FpiList::FPI_XHTML_1_PRINT,
        'xhtml+mobile-1' => FpiList::FPI_XHTML_MOBILE_1,
        'xhtml+mobile-11' => FpiList::FPI_XHTML_MOBILE_1_1,
        'xhtml+mobile-12' => FpiList::FPI_XHTML_MOBILE_1_2,        
        'xhtml-11' => FpiList::FPI_XHTML_1_1,
        'xhtml+basic-11' => FpiList::FPI_XHTML_1_1_BASIC,
        'xhtml+rdfa-1' => FpiList::FPI_XHTML_RDFA_1,
        'xhtml+rdfa-11' => FpiList::FPI_XHTML_RDFA_1_1,
        'xhtml+aria-1' => FpiList::FPI_XHTML_ARIA_1
    );
    
    private $knownMatrix = array(
        'html' => array(
            array('version' => '2'),
            array('version' => '2', 'variant' => 'alternative'),
            array('version' => '3.2'),
            array('version' => '3.2', 'variant' => 'alternative1'),
            array('version' => '3.2', 'variant' => 'alternative2'),
            array('version' => '4', 'variant' => 'strict'),
            array('version' => '4', 'variant' => 'strict-alternative'),
            array('version' => '4', 'variant' => 'strict-401-alternative1'),
            array('version' => '4', 'variant' => 'strict-401-alternative2'),
            array('version' => '4', 'variant' => 'strict-401-alternative3'),
            array('version' => '4', 'variant' => 'strict-401-alternative4'),
            array('version' => '4', 'variant' => 'transitional'),
            array('version' => '4', 'variant' => 'transitional-alternative'),
            array('version' => '4', 'variant' => 'transitional-401-alternative1'),
            array('version' => '4', 'variant' => 'transitional-401-alternative2'),
            array('version' => '4', 'variant' => 'transitional-401-alternative3'),
            array('version' => '4', 'variant' => 'transitional-401-alternative4'),
            array('version' => '4', 'variant' => 'frameset'),
            array('version' => '4', 'variant' => 'frameset-alternative'),
            array('version' => '4', 'variant' => 'frameset-401-alternative1'),
            array('version' => '4', 'variant' => 'frameset-401-alternative2'),
            array('version' => '4', 'variant' => 'frameset-401-alternative3'),
            array('version' => '4', 'variant' => 'frameset-401-alternative4'),
            array('version' => '4.01', 'variant' => 'strict'),
            array('version' => '4.01', 'variant' => 'strict-alternative1'),
            array('version' => '4.01', 'variant' => 'strict-alternative2'),
            array('version' => '4.01', 'variant' => 'strict-alternative3'),
            array('version' => '4.01', 'variant' => 'transitional'),
            array('version' => '4.01', 'variant' => 'transitional-alternative1'),
            array('version' => '4.01', 'variant' => 'transitional-alternative2'),
            array('version' => '4.01', 'variant' => 'transitional-alternative3'),
            array('version' => '4.01', 'variant' => 'frameset'),
            array('version' => '4.01', 'variant' => 'frameset-alternative1'),
            array('version' => '4.01', 'variant' => 'frameset-alternative2'),
            array('version' => '4.01', 'variant' => 'frameset-alternative3'),
            array('version' => '5'),
            array('version' => '5', 'variant' => 'legacy-compat')
        ),
        'xhtml' => array(
            array('version' => '1', 'variant' => 'strict'),
            array('version' => '1', 'variant' => 'strict-alternative1'),
            array('version' => '1', 'variant' => 'strict-alternative2'),
            array('version' => '1', 'variant' => 'strict-alternative3'),
            array('version' => '1', 'variant' => 'transitional'),
            array('version' => '1', 'variant' => 'transitional-alternative1'),
            array('version' => '1', 'variant' => 'transitional-alternative2'),
            array('version' => '1', 'variant' => 'transitional-alternative3'),
            array('version' => '1', 'variant' => 'frameset'),
            array('version' => '1', 'variant' => 'frameset-alternative1'),
            array('version' => '1', 'variant' => 'frameset-alternative2'),
            array('version' => '1', 'variant' => 'frameset-alternative3'),
            array('version' => '1.1'),
            array('version' => '1.1', 'variant' => 'alternative1'), 
            array('version' => '1.1', 'variant' => 'alternative2'), 
            array('version' => '1.1', 'variant' => 'alternative3'),
        ),        
        'xhtml+basic' => array(
            array('version' => '1'),
            array('version' => '1', 'variant' => 'alternative1'),
            array('version' => '1', 'variant' => 'alternative2'),
            array('version' => '1', 'variant' => 'alternative3'),
            array('version' => '1.1'),            
            array('version' => '1.1', 'variant' => 'alternative1'),
            array('version' => '1.1', 'variant' => 'alternative2'),
            array('version' => '1.1', 'variant' => 'alternative3'),            
        ),        
        'xhtml+print' => array(
            array('version' => '1'),          
            array('version' => '1', 'variant' => 'alternative1'),
            array('version' => '1', 'variant' => 'alternative2'),
            array('version' => '1', 'variant' => 'alternative3'),            
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
            array('version' => '1', 'variant' => 'alternative'), 
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
                'default' => FpiList::FPI_HTML_2,
                'alternative' => FpiList::FPI_HTML_2_ALTERNATIVE,
            ),
            '3.2' => array(
                'default' => FpiList::FPI_HTML_3_2,
                'alternative1' => FpiList::FPI_HTML_3_2_ALTERNATIVE1,
                'alternative2' => FpiList::FPI_HTML_3_2_ALTERNATIVE2
            ),
            '4' => array(
                'strict' => FpiList::FPI_HTML_4_STRICT,
                'transitional' => FpiList::FPI_HTML_4_TRANSITIONAL,
                'frameset' => FpiList::FPI_HTML_4_FRAMESET,
            ),            
            '4.01' => array(
                'strict' => FpiList::FPI_HTML_4_01_STRICT,
                'transitional' => FpiList::FPI_HTML_4_01_TRANSITIONAL,
                'frameset' => FpiList::FPI_HTML_4_01_FRAMESET
            ),           
        ),
        'xhtml' => array(
            '1' => array(
                'strict' => FpiList::FPI_XHTML_1_STRICT,
                'transitional' => FpiList::FPI_XHTML_1_TRANSITIONAL,
                'frameset' => FpiList::FPI_XHTML_1_FRAMESET
            ),
            '1.1' => FpiList::FPI_XHTML_1_1
        ),
        'xhtml+basic' => array(
            '1' => FpiList::FPI_XHTML_1_BASIC,
            '1.1' => FpiList::FPI_XHTML_1_1_BASIC
        ),        
        'xhtml+print' => array(
            '1' => FpiList::FPI_XHTML_1_PRINT
        ),         
        'xhtml+mobile' => array(
            '1' => FpiList::FPI_XHTML_MOBILE_1,
            '1.1' => FpiList::FPI_XHTML_MOBILE_1_1,
            '1.2' => FpiList::FPI_XHTML_MOBILE_1_2
        ),         
        'xhtml+rdfa' => array(
            '1' => FpiList::FPI_XHTML_RDFA_1,
            '1.1' => FpiList::FPI_XHTML_RDFA_1_1
        ),
        'xhtml+aria' => array(
            '1' => FpiList::FPI_XHTML_ARIA_1,
        ),
        'html+aria' => array(
            '4.01' => FpiList::FPI_HTML_4_01_ARIA
        ),
        'html+rdfa' => array(
            '4.01' => array(
                '1' => FpiList::FPI_HTML_4_01_RDFA_1,
                '1.1' => FpiList::FPI_HTML_4_01_RDFA_1_1,
            )
        ),
        'html+rdfalite' => array(
            '4.01' => array(
                '1.1' => FpiList::FPI_HTML_4_01_RDFALITE_1_1,
            )            
        ),
        'html+iso15445' => array(
            '1' => array(
                'default' => FpiList::FPI_HTML_ISO_15445,
                'alternative' => FpiList::FPI_HTML_ISO_15445_ALTERNATIVE,
            )
        )
    );
    
    private $versionAndVariantToUriMap = array(
        'html' => array(
            '4' => array(
                'strict' => UriList::URI_HTML_4_STRICT,
                'strict-alternative' => UriList::URI_HTML_4_STRICT_ALTERNATIVE,
                '401-strict' => UriList::URI_HTML_4_01_STRICT,
                '401-strict-alternative1' => UriList::URI_HTML_4_01_STRICT_ALTERNATIVE1,
                '401-strict-alternative2' => UriList::URI_HTML_4_01_STRICT_ALTERNATIVE2,
                '401-strict-alternative3' => UriList::URI_HTML_4_01_STRICT_ALTERNATIVE3,
                'transitional' => UriList::URI_HTML_4_TRANSITIONAL,
                'transitional-alternative' => UriList::URI_HTML_4_TRANSITIONAL_ALTERNATIVE,
                '401-transitional' => UriList::URI_HTML_4_01_TRANSITIONAL,
                '401-transitional-alternative1' => UriList::URI_HTML_4_01_TRANSITIONAL_ALTERNATIVE1,
                '401-transitional-alternative2' => UriList::URI_HTML_4_01_TRANSITIONAL_ALTERNATIVE2,
                '401-transitional-alternative3' => UriList::URI_HTML_4_01_TRANSITIONAL_ALTERNATIVE3,
                'frameset' => UriList::URI_HTML_4_FRAMESET,
                'frameset-alternative' => UriList::URI_HTML_4_FRAMESET_ALTERNATIVE,
                '401-frameset' => UriList::URI_HTML_4_01_FRAMESET,
                '401-frameset-alternative1' => UriList::URI_HTML_4_01_FRAMESET_ALTERNATIVE1,
                '401-frameset-alternative2' => UriList::URI_HTML_4_01_FRAMESET_ALTERNATIVE2,
                '401-frameset-alternative3' => UriList::URI_HTML_4_01_FRAMESET_ALTERNATIVE3,
            ), 
            '4.01' => array(
                'strict' => UriList::URI_HTML_4_01_STRICT,
                'strict-alternative1' => UriList::URI_HTML_4_01_STRICT_ALTERNATIVE1,
                'strict-alternative2' => UriList::URI_HTML_4_01_STRICT_ALTERNATIVE2,
                'strict-alternative3' => UriList::URI_HTML_4_01_STRICT_ALTERNATIVE3,
                'transitional' => UriList::URI_HTML_4_01_TRANSITIONAL,
                'transitional-alternative1' => UriList::URI_HTML_4_01_TRANSITIONAL_ALTERNATIVE1,
                'transitional-alternative2' => UriList::URI_HTML_4_01_TRANSITIONAL_ALTERNATIVE2,
                'transitional-alternative3' => UriList::URI_HTML_4_01_TRANSITIONAL_ALTERNATIVE3,
                'frameset' => UriList::URI_HTML_4_01_FRAMESET,
                'frameset-alternative1' => UriList::URI_HTML_4_01_FRAMESET_ALTERNATIVE1,
                'frameset-alternative2' => UriList::URI_HTML_4_01_FRAMESET_ALTERNATIVE2,
                'frameset-alternative3' => UriList::URI_HTML_4_01_FRAMESET_ALTERNATIVE3
            ),
            '5' => array(
                'legacy-compat' => UriList::URI_HTML_5_LEGACY_COMPAT
            )
        ),
        'xhtml' => array(
            '1' => array(
                'strict' => UriList::URI_XHTML_1_STRICT,
                'strict-alternative1' => UriList::URI_XHTML_1_STRICT_ALTERNATIVE1,
                'strict-alternative2' => UriList::URI_XHTML_1_STRICT_ALTERNATIVE2,
                'strict-alternative3' => UriList::URI_XHTML_1_STRICT_ALTERNATIVE3,
                'transitional' => UriList::URI_XHTML_1_TRANSITIONAL,
                'transitional-alternative1' => UriList::URI_XHTML_1_TRANSITIONAL_ALTERNATIVE1,
                'transitional-alternative2' => UriList::URI_XHTML_1_TRANSITIONAL_ALTERNATIVE2,
                'transitional-alternative3' => UriList::URI_XHTML_1_TRANSITIONAL_ALTERNATIVE3,
                'frameset' => UriList::URI_XHTML_1_FRAMESET,
                'frameset-alternative1' => UriList::URI_XHTML_1_FRAMESET_ALTERNATIVE1,
                'frameset-alternative2' => UriList::URI_XHTML_1_FRAMESET_ALTERNATIVE2,
                'frameset-alternative3' => UriList::URI_XHTML_1_FRAMESET_ALTERNATIVE3
            ),
            '1.1' => array(
                'strict' => UriList::URI_XHTML_1_1,
                'alternative1' => UriList::URI_XHTML_1_1_ALTERNATIVE1,
                'alternative2' => UriList::URI_XHTML_1_1_ALTERNATIVE2,
                'alternative3' => UriList::URI_XHTML_1_1_ALTERNATIVE3,
            )
        ),
        'xhtml+basic' => array(
            '1' => array(
                'strict' => UriList::URI_XHTML_BASIC_1,
                'alternative1' => UriList::URI_XHTML_BASIC_1_ALTERNATIVE1,
                'alternative2' => UriList::URI_XHTML_BASIC_1_ALTERNATIVE2,
                'alternative3' => UriList::URI_XHTML_BASIC_1_ALTERNATIVE3,
            ),
            '1.1' => array(
                'strict' => UriList::URI_XHTML_BASIC_1_1,
                'alternative1' => UriList::URI_XHTML_BASIC_1_1_ALTERNATIVE_1,
                'alternative2' => UriList::URI_XHTML_BASIC_1_1_ALTERNATIVE_2,
                'alternative3' => UriList::URI_XHTML_BASIC_1_1_ALTERNATIVE_3,
            ),
        ),          
        'xhtml+print' => array(
            '1' => array(
                'strict' => UriList::URI_XHTML_PRINT_1,
                'alternative1' => UriList::URI_XHTML_PRINT_1_ALTERNATIVE1,
                'alternative2' => UriList::URI_XHTML_PRINT_1_ALTERNATIVE2,
                'alternative3' => UriList::URI_XHTML_PRINT_1_ALTERNATIVE3,
            ),
        ),        
        'xhtml+mobile' => array(
            '1' => UriList::URI_XHTML_MOBILE_1,
            '1.1' => UriList::URI_XHTML_MOBILE_1_1,
            '1.2' => UriList::URI_XHTML_MOBILE_1_2
        ),         
        'xhtml+rdfa' => array(
            '1' => UriList::URI_XHTML_RDFA_1,
            '1.1' => UriList::URI_XHTML_RDFA_1_1
        ),
        'xhtml+aria' => array(
            '1' => array(
                'default' => UriList::URI_XHTML_ARIA_1,
                'alternative' => UriList::URI_XHTML_ARIA_1_ALTERNATIVE
            ),            
        ),
        'html+aria' => array(
            '4.01' => UriList::URI_HTML_ARIA_4_01_1            
        ),
        'html+rdfa' => array(
            '4.01' => array(
                '1' => UriList::URI_HTML_RDFA_4_01_1,
                '1.1' => UriList::URI_HTML_RDFA_4_01_1_1
            )
        ),
        'html+rdfalite' => array(
            '4.01' => array(
                '1.1' => UriList::URI_HTML_RDFALITE_4_01_1_1
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
     *
     * @var boolean
     */
    private $lowercaseFpi = false;
    
    
    /**
     *
     * @var boolean
     */
    private $uppercaseFpi = false;
    
    
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
                
                if ($this->lowercaseFpi === true) {
                    $generator->lowercaseFpi();
                }
                
                if ($this->uppercaseFpi === true) {
                    $generator->uppercaseFpi();
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
        $value = $this->getMappedProperty($this->versionAndVariantToFpiMap);
        if (is_null($value)) {
            return $value;
        }
        
        if ($this->lowercaseFpi === true) {
            return strtolower($value);
        }

        if ($this->uppercaseFpi === true) {
            return strtoupper($value);
        } 
        
        return $value;
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
        
        $variant = $this->getVariant();
        
        if (isset($versionSubset[$variant])) {
            return $versionSubset[$variant];
        }
        
        $variants = $this->getAlternativeVariants($variant);
        
        foreach ($variants as $variant) {
            if (isset($versionSubset[$variant])) {
                return $versionSubset[$variant];
            }
        }
        
        return null;
    }
    
    
    private function getAlternativeVariants($variant) {
        $variants = array();
        
        if (preg_match('/-alternative[0-9]?$/', $variant)) {
            $variantParts = explode('-', preg_replace('/-alternative[0-9]?$/', '', $variant));
            $currentVariantParts = array();
            
            foreach ($variantParts as $variantPart) {
                $currentVariantParts[] = $variantPart;
                $variants[] = implode('-', $currentVariantParts);
            }
        }
        
        return $variants;
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
        $version = trim($version);
        if (preg_match('/\.0$/', $version)) {
            $version = preg_replace('/\.0$/', '', $version);
        }
        
        $this->version = $version;
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
        
        if ($this->isXhtml && $this->module == 'aria') {
            return 'default';
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
    
    
    /**
     * 
     * @return \webignition\HtmlDocumentType\Generator
     */
    public function lowercaseFpi() {
        $this->lowercaseFpi = true;
        $this->uppercaseFpi = false;
        return $this;
    }
    
    /**
     * 
     * @return \webignition\HtmlDocumentType\Generator
     */    
    public function uppercaseFpi() {
        $this->lowercaseFpi = false;
        $this->uppercaseFpi = true;
        return $this;        
    }
    
    /**
     * 
     * @return \webignition\HtmlDocumentType\Generator
     */    
    public function defaultCaseFpi() {
        $this->lowercaseFpi = false;
        $this->uppercaseFpi = false;
        return $this;          
    }
    
    
}