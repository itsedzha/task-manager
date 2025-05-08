<?php

namespace App\Services;

class QuoteService
{
    public static function getDailyQuote()
    {
        $quotes = [
            "The only way to do great work is to love what you do.",
            "It does not matter how slowly you go as long as you do not stop.",
            "Success is not final, failure is not fatal: It is the courage to continue that counts.",
            "Believe you can and you're halfway there.",
            "Don't watch the clock; do what it does. Keep going.",
            "The future belongs to those who believe in the beauty of their dreams.",
            "Your time is limited, so don't waste it living someone else's life.",
            "The secret of getting ahead is getting started.",
            "Quality is not an act, it is a habit.",
            "The only limit to our realization of tomorrow will be our doubts of today."
        ];

        $dayOfYear = (int) date('z');
        $quoteIndex = $dayOfYear % count($quotes);
        
        return $quotes[$quoteIndex];
    }
}
