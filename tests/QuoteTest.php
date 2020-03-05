<?php

declare(strict_types=1);

namespace Quote\Tests;

use PHPUnit\Framework\TestCase;
use Quote\Quote;

class QuoteTest extends TestCase
{
    public function testLive()
    {
        $quote = new Quote('3afee64bc9103f8fa5ea7ffbf9a86c76');
        $quotes = $quote->live();
        echo $quotes['quotes']['USDBRL'];
    }

    public function testHistorical()
    {
        $quote = new Quote('3afee64bc9103f8fa5ea7ffbf9a86c76');
        $quotes = $quote->historical('2020-01-01');
        echo $quotes['quotes']['USDBRL'];
    }
}
