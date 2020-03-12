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
        $dateTime = new \DateTime();
        $dateTime = $dateTime->sub(new \DateInterval('P1D'));

        $quotes = $quote->historical(['date' => $dateTime->format('Y-m-d')]);
        echo $quotes['quotes']['USDBRL'];
    }
}
