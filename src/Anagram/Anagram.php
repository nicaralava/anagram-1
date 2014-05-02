<?php
/**
 *
 */
namespace Anagram;

/**
 * Class Anagram
 * @package Anagram
 */
class Anagram
{
    protected $_anagrams = array();
    protected $_dictionary = array();

    /**
     * @param $word
     */
    public function addWord($word)
    {
        if (isset($this->_dictionary[$word])) {
            return;
        }
        $this->_dictionary[$word] = true;
        $hash = $this->getAnagramHash($word);
        $this->_anagrams[$hash][] = $word;
    }

    /**
     * @param $word
     * @return string
     */
    public function getAnagramHash($word)
    {
        $chars = array();
        foreach (str_split($word) as $char) {
            if (isset($chars[$char])) {
                $chars[$char]++;
            } else {
                $chars[$char] = 1;
            }
        }
        ksort($chars);
        return serialize($chars);
    }

    /**
     * @return array
     */
    public function getAllAnagrams()
    {
        return array_filter($this->_anagrams, array($this, "filterAnagrams"));
    }

    /**
     * Checks word has anagrams
     * @param $var
     * @return bool
     */
    public function filterAnagrams($var)
    {
        return (count($var) > 1);
    }
}