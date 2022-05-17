<?php

namespace Tungyao\TQueue;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class TQueue
{
    private string $host;

    public function __construct(string $host)
    {
        $this->host = $host;
    }

    /**
     * @param string $unikey 唯一id
     * @param int $clock 执行时间戳
     * @param string $url 回调地址
     * @return bool
     */
    public
    function Push(string $unikey, int $clock, string $url): bool
    {
        $client = HttpClient::create();
        try {
            $client->request("POST", $this->host . "timer",
                [
                    'json' => [
                        'unikey' => $unikey,
                        'clock' => $client,
                        'url' => $url
                    ]
                ]);
        } catch (\Exception|TransportExceptionInterface $exception) {
            return false;
        }
        return false;
    }

// 中断
    public
    function Abort(string $unikey)
    {
        $client = HttpClient::create();
        try {
            $client->request("PUT", $this->host . "timer?unikey=$unikey");
        } catch (\Exception|TransportExceptionInterface $exception) {
            return false;
        }
        return false;
    }
}
