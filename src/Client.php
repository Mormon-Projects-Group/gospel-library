<?php declare(strict_types=1);

/**
 * Client class for getting Gospel Library JSON
 *
 * The following API calls are no longer valid Gospel Library calls:
 *   * `catalog.query.folder`
 *   * `book.download`
 *
 * @author  Jared Howland <gospel-library@jaredhowland.com>
 * @version 2017-12-25
 * @since   2017-12-24
 */

namespace Gospel;

use GuzzleHttp\Client as GuzzleClient;

class Client
{

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
     * @return array Array of languages for which there is content in the Gospel Library
     */
    public function languagesQuery(): array
    {
        return $this->getUrl('languages.query');
    }

    /**
     * Get URL
     *
     * @param string $action API call to make
     * @param array  $args   Array of arguments to pass as HTTP query parameters
     *
     * @return array Array of the results of the API call
     */
    private function getUrl(string $action, array $args = []): array
    {
        $args = array_merge(['action' => $action], $args, ['format' => 'json']);
        $json = $this->client
            ->request('GET', Config::get('base'), ['query' => $args])
            ->getBody();

        return json_decode((string)$json, true);
    }

    /**
     * Platforms query
     *
     * @param null
     *
     * @return array Array of platforms for which there is content in the Gospel Library
     */
    public function platformsQuery(): array
    {
        return $this->getUrl('platforms.query');
    }

    /**
     * Catalog query
     *
     * @param int $languageid ID of language to get catalog content in. Available languages: use `languagesQuery()`
     * @param int $platformid ID of platform to get catalog content from. Available platforms: use `platformsQuery()`
     *
     * @return array Array of metadata about requested Gospel Library catalog
     */
    public function catalogQuery(int $languageid, int $platformid): array
    {
        return $this->getUrl('catalog.query', ['languageid' => $languageid, 'platformid' => $platformid]);
    }

    /**
     * Catalog query modified
     *
     * @param int $languageid ID of language to get catalog content in. Available languages: use `languagesQuery()`
     * @param int $platformid ID of platform to get catalog content from. Available platforms: use `platformsQuery()`
     *
     * @return array Array of metadata about requested Gospel Library catalog, including the last modified date
     */
    public function catalogQueryModified(int $languageid, int $platformid): array
    {
        return $this->getUrl('catalog.query.modified', ['languageid' => $languageid, 'platformid' => $platformid]);
    }

    /**
     * Book versions
     *
     * @param int    $languageid ID of language to get catalog content in. Available languages: use `languagesQuery()`
     * @param int    $platformid ID of platform to get catalog content from. Available platforms: use `platformsQuery()`
     * @param string $lastdate   List content updated since `$lastdate`
     *
     * @return array Array of showing all material IDs updated since `$lastdate`
     */
    public function bookVersions(int $languageid, int $platformid, string $lastdate): array
    {
        $lastdate = date('Y-m-d', strtotime($lastdate));

        return $this->getUrl('book.versions',
            ['languageid' => $languageid, 'platformid' => $platformid, 'lastdate' => $lastdate]);
    }
}
