<?php declare(strict_types = 1);

/**
 * Client class for getting Gospel Library JSON
 *
 * The following API calls are no longer valid Gospel Library calls:
 *   * `catalog.query.folder`
 *   * `book.download`
 *
 * Low-level class to ingest API data: nothing to test
 *
 * @link      https://tech.lds.org/wiki/Gospel_Library_Catalog_Web_Service
 *
 * @copyright Copyright (c) 2018 Jared Howland
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @author    Jared Howland <gospel-library@jaredhowland.com>
 */

namespace Gospel;

use GuzzleHttp\Client as GuzzleClient;

/**
 * Client class for getting Gospel Library JSON
 */
class Client
{
    /** @var object Guzzle client */
    private $client;

    /**
     * Construct Client class
     *
     * @param null
     */
    public function __construct()
    {
        $this->client = new GuzzleClient();
    }

    /**
     * Languages query
     *
     * @param null
     *
     * @return \stdClass Object containing languages for which there is content in the Gospel Library
     */
    public function languagesQuery(): \stdClass
    {
        return $this->getApiArray('languages.query');
    }

    /**
     * Platforms query
     *
     * @param null
     *
     * @return \stdClass Object containing platforms for which there is content in the Gospel Library
     */
    public function platformsQuery(): \stdClass
    {
        return $this->getApiArray('platforms.query');
    }

    /**
     * Catalog query
     *
     * @param int $languageid ID of language to get catalog content in. Available languages: use `languagesQuery()`
     * @param int $platformid ID of platform to get catalog content from. Available platforms: use `platformsQuery()`
     *
     * @return \stdClass Object containing metadata about requested Gospel Library catalog
     */
    public function catalogQuery(int $languageid, int $platformid): \stdClass
    {
        return $this->getApiArray('catalog.query', ['languageid' => $languageid, 'platformid' => $platformid]);
    }

    /**
     * Catalog query modified
     *
     * @param int $languageid ID of language to get catalog content in. Available languages: use `languagesQuery()`
     * @param int $platformid ID of platform to get catalog content from. Available platforms: use `platformsQuery()`
     *
     * @return \stdClass Object containing metadata about requested Gospel Library catalog, including the last modified date
     */
    public function catalogQueryModified(int $languageid, int $platformid): \stdClass
    {
        return $this->getApiArray('catalog.query.modified', ['languageid' => $languageid, 'platformid' => $platformid]);
    }

    /**
     * Book versions
     *
     * @param int    $languageid ID of language to get catalog content in. Available languages: use `languagesQuery()`
     * @param int    $platformid ID of platform to get catalog content from. Available platforms: use `platformsQuery()`
     * @param string $lastdate   List content updated since `$lastdate`
     *
     * @return \stdClass Object with all material IDs updated since `$lastdate`
     */
    public function bookVersions(int $languageid, int $platformid, string $lastdate): \stdClass
    {
        $lastdate = date('Y-m-d', strtotime($lastdate));

        return $this->getApiArray('book.versions',
            ['languageid' => $languageid, 'platformid' => $platformid, 'lastdate' => $lastdate]);
    }

    /**
     * Get File
     *
     * @param string $url  URL of file to get
     * @param array  $args Associative array of arguments to pass as HTTP GET query parameters. Default: `null`
     *
     * @return string Data returned from downloaded URL
     */
    public function getUrl(string $url, array $args = []): string
    {
        return (string) $this->client
            ->request('GET', $url, ['query' => $args])
            ->getBody();
    }

    /**
     * Get array from returned API JSON
     *
     * @param string $action API call to make
     * @param array  $args   Associative array of arguments to pass as HTTP GET query parameters. Default: `null`
     *
     * @return \stdClass Object containing the API call results
     */
    private function getApiArray(string $action, array $args = []): \stdClass
    {
        $args = array_merge(['action' => $action], $args, ['format' => 'json']);
        $json = $this->getUrl(Config::get('base'), $args);

        return json_decode($json);
    }
}
