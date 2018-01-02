<?php declare(strict_types = 1);

/**
 * Catalog parser class for parsing catalog JSON
 *
 * @link      https://tech.lds.org/wiki/Gospel_Library_Catalog_Web_Service
 *
 * @copyright Copyright (c) 2018 Jared Howland
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @author    Jared Howland <gospel-library@jaredhowland.com>
 */

namespace Gospel\Parser;

use Gospel\GospelException;

/**
 * Catalog parser class for parsing catalog JSON
 */
class Catalog
{
    /** @var array JSON data as associative array to parse */
    private $array;

    /** @var array Catalog data */
    private $catalogData;

    /** @var array Array of all gospel library folders */
    private $folders;

    /** @var array Array of all gospel library books */
    private $books;

    /** @var array Array of all gospel library files */
    private $files;

    /**
     * Construct Client class
     *
     * @param array $array Array to parse
     */
    public function __construct(array $array)
    {
        $this->array = $array;
        $this->catalogData = $this->array['catalog']['folders'];
        $this->parseData();
    }

    /**
     * Status of API call
     *
     * @param null
     *
     * @return bool `true` if successful, `false` otherwise
     */
    public function getSuccessStatus(): bool
    {
        return $this->array['success'];
    }

    /**
     * Date catalog was last modified
     *
     * @param null
     *
     * @throws GospelException if date is invalid
     *
     * @return \DateTime object of the last time the catalog was modified
     */
    public function getModifiedDate(): \DateTime
    {
        $date = $this->array['catalog']['date_changed'];
        if (\DateTime::createFromFormat('Y-m-d H:i:s', $date)) {
            return \DateTime::createFromFormat('Y-m-d H:i:s', $date);
        } else {
            throw new GospelException('Invalid date used for `getModifiedDate`: '.$date);
        }
    }

    /**
     * Catalog name
     *
     * @param null
     *
     * @return string Name of the catalog
     */
    public function getCatalogName(): string
    {
        return $this->array['catalog']['name'];
    }

    /**
     * Get all folders in an adjacency list model for hierarchical data
     *
     * @param null
     *
     * @return array Flattened array of folder data in an adjacency list model for hierarchical data
     */
    public function getFolders(): array
    {
        return $this->folders;
    }

    /**
     * Get all books in an adjacency list model for hierarchical data
     *
     * @param null
     *
     * @return array Flattened array of books data in an adjacency list model for hierarchical data
     */
    public function getBooks(): array
    {
        return $this->books;
    }

    /**
     * Get all files in an adjacency list model for hierarchical data
     *
     * @param null
     *
     * @return array Flattened array of files data in an adjacency list model for hierarchical data
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * Loop through the array and parse the data
     *
     * @param array $array Array of data from the `catalogQuery` API call. Default: `null`
     * @param int $parentFolderId ID for the parent folder. Default: `null`
     */
    private function parseData(array $array = null, int $parentFolderId = null): void
    {
        $array = empty($array) ? $this->catalogData : $array;
        foreach ($array as $folder) {
            $this->folders[$folder['id']] = ['parentFolderId' => $parentFolderId, 'languageId' => @$folder['landguageid'], 'name' => $folder['name'], 'displayOrder' => $folder['display_order'], 'englishName' => $folder['eng_name']];
            $this->parseBooks($folder['books'], $folder['id']);
            if (!empty($folder['folders'])) {
                $this->parseData($folder['folders'], $folder['id']);
            }
        }
    }

    /**
     * Loop through the array and parse the books data
     *
     * @param array $books Array of books data. Default: `null`
     * @param int $folderId ID for the folder that contains the book. Default: `null`
     */
    private function parseBooks(array $books = null, int $folderId): void
    {
        if (!empty($books)) {
            foreach ($books as $book) {
                $this->books[$book['id']] = ['folderId' => $folderId, 'name' => $book['name'], 'fullName' => $book['full_name'], 'description' => $book['description'], 'gospelLibraryUri' => $book['gl_uri'], 'url' => $book['url'], 'displayOrder' => $book['display_order'], 'version' => $book['version'], 'fileVersion' => $book['file_version'], 'file' => $book['file'], 'dateAdded' => $book['dateadded'], 'dateModified' => $book['datemodified'], 'cbId' => $book['cb_id'], 'mediaAvailable' => $book['media_available'], 'obsolete' => $book['obsolete'], 'size' => $book['size'], 'sizeIndex' => $book['size_index']];
                $this->parseFiles(@$book['files'], $book['id']);
            }
        }
    }

    /**
     * Loop through the array and parse the files data
     *
     * @param array $files Array of files data. Default: `null`
     * @param int $bookId ID for the book associated with the file. Default: `null`
     */
    private function parseFiles(array $files = null, int $bookId): void
    {
        if (!empty($files)) {
            foreach ($files['PDF'] as $file) {
                $this->files[$file['id']] = ['bookId' => $bookId, 'order' => $file['order'], 'dateAdded' => $file['dateadded'], 'dateModified' => $file['datemodified'], 'version' => $file['version'], 'name' => $file['name'], 'title' => $file['title'], 'url' => $file['url'], 'size' => $file['size']];
            }
        }
    }
}
