<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 3/8/19
 * Time: 5:04 PM
 * To change this template use File | Settings | File Templates.
 */

namespace SilverStripers\AMP\Control;


use GuzzleHttp\Client;
use SilverStripe\Core\Config\Configurable;
use SilverStripe\Core\Injector\Injectable;

class AMPCache
{
    use Injectable;
    use Configurable;

    private static  $key_file = '';

    private $key = null;
    private $client = null;

    const DOCUMENT = 'c';
    const IMAGE = 'i';
    const RESOURCE = 'r';


    private $cacheList = null;

    public function __construct()
    {
        $key = $this->config()->get('key_file');

        if (!file_exists($key)) {
            throw new \Exception('Private key not found');
        }

        $this->key = $key;
        $this->client = new Client();
    }


    private static function base64encode($string)
    {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($string));
    }

    private function getCaches()
    {
        if (is_null($this->cacheList)) {
            $response = $this->client->get('https://cdn.ampproject.org/caches.json');
            $body = $response->getBody();

            $data = json_decode($body);
            if ($data) {
                $this->cacheList = $data->caches;
            }
        }

        return $this->cacheList;
    }

    public function purge($url, $contentType = self::DOCUMENT)
    {
        $timestamp = time();
        $info = parse_url($url);
        $host = strtr($info['host'], '.', '-');
        $url = "{$info['host']}{$info['path']}" . urlencode(isset($info['query']) ? "?{$info['query']}" : '');
        $ampCachePath = "/update-cache/$contentType/" . ($info['scheme'] === 'https' ? 's/' : '');
        $ampCachePath .= "{$url}?amp_action=flush&amp_ts={$timestamp}";
        $privateKey = openssl_pkey_get_private('file://' . $this->key);
        openssl_sign($ampCachePath, $signature, $privateKey, OPENSSL_ALGO_SHA256);
        openssl_free_key($privateKey);
        $signature = self::base64encode($signature);
        $status = true;
        foreach ($this->getCaches() as $cache) {
            $ampCacheBase = "https://$host.{$cache->updateCacheApiDomainSuffix}";
            $status = $status && ((string)$response->getBody() === 'OK');
        }

        return $status;
    }

    public static function key_exists()
    {
        $key = self::config()->get('key_file');
        return $key && file_exists($key);
    }


}
