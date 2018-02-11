<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Bridge\PhpUnit;

use PHPUnit\Framework\Test;
use PHPUnit\Framework\TestListener;
use PHPUnit\Framework\TestListenerDefaultImplementation;
use PHPUnit\Framework\TestSuite;
use PHPUnit\Framework\Warning;

/**
 * Collects and replays skipped tests.
 *
 * (Version of SymfonyTestsListener for PHPUnit 7+, and PHP 7.1+.)
 *
 * @author Nicolas Grekas <p@tchwork.com>
 *
 * @final
 */
class SymfonyTestsListenerWithReturnTypes implements TestListener
{
    use TestListenerDefaultImplementation;

    private $trait;

    public function __construct(array $mockedNamespaces = array())
    {
        $this->trait = new Legacy\SymfonyTestsListenerTrait($mockedNamespaces);
    }

    public function globalListenerDisabled()
    {
        $this->trait->globalListenerDisabled();
    }

    public function startTestSuite(TestSuite $suite): void
    {
        $this->trait->startTestSuite($suite);
    }

    public function addSkippedTest(Test $test, \Throwable $t, float $time): void
    {
        $this->trait->addSkippedTest($test, $t, $time);
    }

    public function startTest(Test $test): void
    {
        $this->trait->startTest($test);
    }

    public function addWarning(Test $test, Warning $e, float $time): void
    {
        $this->trait->addWarning($test, $e, $time);
    }

    public function endTest(Test $test, float $time): void
    {
        $this->trait->endTest($test, $time);
    }
}