Anagram
=======================

Introduction
------------
Code reads in a file of words, with one word per line, and generate output that contains all the combinations of words that are anagrams. 
Each line in the output contain all the words from the input that are anagrams of each other.

Installation
------------
Install project and generate class map

    php composer.phar install -o

Usage
------------

    php cli/anagram.php path/to/datafile.txt

Tests
------------

    vendor/bin/phpunit.bat Tests/

