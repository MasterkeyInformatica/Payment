<?php namespace Masterkey\Payment;

    use DOMDocument;
    use Exception;

    /**
     * XmlParser
     *
     * Parse Xml to strings
     *
     * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @author  Cassio Almeida <cassio.almeidaa@gmail.com>
     * @version 2.0.0
     * @since   15/06/2016
     */
    class XmlParser
    {
        /**
         * DOM
         *
         * @var DOMDocument
         */
        private $dom;

        /**
         * Constructor
         *
         * @param   $xml
         * @throws  Exception
         */
        public function __construct($xml)
        {
            $xml    = mb_convert_encoding($xml, "UTF-8", "UTF-8,ISO-8859-1");
            $parser = xml_parser_create();

            if (!xml_parse($parser, $xml)) {
                throw new Exception("XML parsing error: (" . xml_get_error_code($parser) .") " . xml_error_string(xml_get_error_code($parser)));
            } else {
                $this->dom = new DOMDocument();
                $xml = utf8_decode($xml);
                $this->dom->loadXml($xml);
            }
        }

        /**
         * Get Result
         *
         *
         * @param   null $node
         * @return  null|string
         * @throws  Exception
         */
        public function getResult($node = null)
        {
            $result = $this->toArray($this->dom);

            if ($node) {
                if (isset($result[$node])) {
                    return $result[$node];
                } else {
                    throw new Exception("XML parsing error: undefined index [$node]");
                }
            } else {
                return $result;
            }
        }

        /**
         * To array convert
         *
         * @param   $node
         * @return  null|string
         */
        private function toArray($node)
        {
            $occurrence = array();
            $result = null;
            if ($node->hasChildNodes()) {
                foreach ($node->childNodes as $child) {
                    if (!isset($occurrence[$child->nodeName])) {
                        $occurrence[$child->nodeName] = null;
                    }
                    $occurrence[$child->nodeName]++;
                }
            }
            if (isset($child)) {
                if ($child->nodeName == '#text') {
                    $result = html_entity_decode(
                        htmlentities($node->nodeValue, ENT_COMPAT, 'UTF-8'),
                        ENT_COMPAT,
                        'ISO-8859-15'
                    );
                } else {
                    if ($node->hasChildNodes()) {
                        $children = $node->childNodes;
                        for ($i = 0; $i < $children->length; $i++) {
                            $child = $children->item($i);
                            if ($child->nodeName != '#text') {
                                if ($occurrence[$child->nodeName] > 1) {
                                    $result[$child->nodeName][] = $this->toArray($child);
                                } else {
                                    $result[$child->nodeName] = $this->toArray($child);
                                }
                            } else {
                                if ($child->nodeName == '0') {
                                    $text = $this->toArray($child);
                                    if (trim($text) != '') {
                                        $result[$child->nodeName] = $this->toArray($child);
                                    }
                                }
                            }
                        }
                    }
                    if ($node->hasAttributes()) {
                        $attributes = $node->attributes;
                        if (!is_null($attributes)) {
                            foreach ($attributes as $key => $attr) {
                                $result["@" . $attr->name] = $attr->value;
                            }
                        }
                    }
                }
                if (isset($result['errors']) && isset($result['errors']['error']['code'])) {
                    $firstError = $result['errors']['error'];
                    $result['errors']['error'] = Array(0 => $firstError);
                }
                return $result;
            } else {
                return null;
            }
        }
    }