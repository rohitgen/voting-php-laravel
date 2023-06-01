<?php

namespace App\Services;



class LogVoteService
{
    public function logVote(): \GuzzleHttp\Psr7\Response
    {
        $client = new \GuzzleHttp\Client();

        return ($client->get('https://logvote.free.beeceptor.com/'));
    }
}
