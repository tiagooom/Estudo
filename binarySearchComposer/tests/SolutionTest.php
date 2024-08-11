<?php

use PHPUnit\Framework\TestCase;

require 'vendor/autoload.php';

class SolutionTest extends TestCase
{
    private $solution;

    protected function setUp(): void
    {
        $this->solution = new Solution();
    }

    public function testBinarySearchFound()
    {
        $nums = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        $find = 5;
        $result = $this->solution->binarySearch($nums, $find);
        $this->assertEquals(4, $result);  // 5 is at index 4
    }

    public function testBinarySearchNotFound()
    {
        $nums = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        $find = 10;
        $result = $this->solution->binarySearch($nums, $find);
        $this->assertEquals("Não encontrado.", $result);
    }

    public function testBinarySearchEmptyArray()
    {
        $nums = [];
        $find = 1;
        $result = $this->solution->binarySearch($nums, $find);
        $this->assertEquals("Não encontrado.", $result);
    }

    public function testBinarySearchFirstElement()
    {
        $nums = [1, 2, 3, 4, 5];
        $find = 1;
        $result = $this->solution->binarySearch($nums, $find);
        $this->assertEquals(0, $result);  // 1 is at index 0
    }

    public function testBinarySearchLastElement()
    {
        $nums = [1, 2, 3, 4, 5];
        $find = 5;
        $result = $this->solution->binarySearch($nums, $find);
        $this->assertEquals(4, $result);  // 5 is at index 4
    }

    public function testBinarySearchNegativeNumbers()
    {
        $nums = [-10, -5, 0, 5, 10];
        $find = -5;
        $result = $this->solution->binarySearch($nums, $find);
        $this->assertEquals(1, $result);  // -5 is at index 1
    }
}
