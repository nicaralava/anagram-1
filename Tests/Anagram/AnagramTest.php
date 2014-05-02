<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 5/1/14
 * Time: 11:47 PM
 */
namespace Tests\Anagram;
use Anagram\Anagram;

/**
 * Class AnagramTest
 * @package Tests\Anagram
 */
class AnagramTest extends \PHPUnit_Framework_TestCase
{

    protected $_anagram;

    /**
     * Init fresh instance of Anagram for each test run
     */
    protected function setUp()
    {
        $this->_anagram = new Anagram();
    }

    /**
     *
     */
    public function testAddWord()
    {
        $expectedDict = array('bat' => 1);
        $expectedAnag = array(serialize(array('a' => 1, 'b' => 1, 't' => 1)) => array('bat'));

        //ensure dictionary and anagrams are empty
        $this->assertEquals(array(), \PHPUnit_Framework_Assert::readAttribute($this->_anagram, '_dictionary'));
        $this->assertEquals(array(), \PHPUnit_Framework_Assert::readAttribute($this->_anagram, '_anagrams'));


        $this->_anagram->addWord('bat');
        //ensure word was added to dictionary and anagrams
        $this->assertEquals($expectedDict, \PHPUnit_Framework_Assert::readAttribute($this->_anagram, '_dictionary'));
        $this->assertEquals($expectedAnag, \PHPUnit_Framework_Assert::readAttribute($this->_anagram, '_anagrams'));

        $this->_anagram->addWord('bat');

        //ensure word duplicates are not processed
        $this->assertEquals($expectedDict, \PHPUnit_Framework_Assert::readAttribute($this->_anagram, '_dictionary'));
        $this->assertEquals($expectedAnag, \PHPUnit_Framework_Assert::readAttribute($this->_anagram, '_anagrams'));
    }


    /**
     * @dataProvider getAnagramHashProvider
     */
    public function testGetAnagramHash($word, $expected)
    {
        $actual = $this->_anagram->getAnagramHash($word);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return mixed
     */
    public function getAnagramHashProvider()
    {
        $case = "Word abc";
        $word = 'abc';
        $expected = serialize(
            array('a' => 1,
                'b' => 1,
                'c' => 1,
            )
        );
        $set[$case] = array($word, $expected);

        $case = "Word cba";
        $word = 'cba';
        $expected = serialize(
            array('a' => 1,
                'b' => 1,
                'c' => 1,
            )
        );
        $set[$case] = array($word, $expected);
        return $set;
    }

    /**
     * @dataProvider filterAnagramsProvider
     */
    public function testFilterAnagrams($data, $expected)
    {
        $actual = $this->_anagram->filterAnagrams($data);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return mixed
     */
    public function filterAnagramsProvider()
    {
        $case = "One word";
        $data = array('bat');
        $expected = false;
        $set[$case] = array($data, $expected);

        $case = "Two words";
        $data = array('bat', 'tab');
        $expected = true;
        $set[$case] = array($data, $expected);

        $case = "Three words";
        $data = array('bat', 'tab', 'abt');
        $expected = true;
        $set[$case] = array($data, $expected);
        return $set;
    }
}
