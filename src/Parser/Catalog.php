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
    /** @var \stdClass Object containing JSON data from `catalog.query` API call */
    private $object;

    /** @var \stdClass Catalog data */
    private $catalogData;

    /** @var \stdClass Gospel library folders */
    private $folders;

    /** @var \stdClass Gospel library books */
    private $books;

    /** @var \stdClass Gospel library files */
    private $files;

    /**
     * Construct Client class
     *
     * @param \stdClass $object Object to parse
     */
    public function __construct(\stdClass $object)
    {
        $this->object = $object;
        $this->catalogData = $object->catalog->folders;
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
        return $this->object->success;
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
        $date = $this->object->catalog->date_changed;
        $dateObject = \DateTime::createFromFormat('Y-m-d H:i:s', $date);
        $errors = \DateTime::getLastErrors();
        if ($dateObject !== false && empty($errors['warning_count'])) {
            return $dateObject;
        } else {
            throw new GospelException('Invalid date used for `getModifiedDate` in class `'.__CLASS__.'``: '.$date);
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
        return $this->object->catalog->name;
    }

    /**
     * Get all folders in an adjacency list model for hierarchical data
     *
     * @link http://mikehillyer.com/articles/managing-hierarchical-data-in-mysql/
     *
     * @param null
     *
     * @return \stdClass Object containing folder data in an adjacency list model for hierarchical data
     */
    public function getFolders(): \stdClass
    {
        return (object)$this->folders;
    }

    /**
     * Get all books in an adjacency list model for hierarchical data
     *
     * @link http://mikehillyer.com/articles/managing-hierarchical-data-in-mysql/
     *
     * @param null
     *
     * @return \stdClass Object containing books data in an adjacency list model for hierarchical data
     */
    public function getBooks(): \stdClass
    {
        return (object)$this->books;
    }

    /**
     * Get all files in an adjacency list model for hierarchical data
     *
     * @link http://mikehillyer.com/articles/managing-hierarchical-data-in-mysql/
     *
     * @param null
     *
     * @return \stdClass Object containing files data in an adjacency list model for hierarchical data
     */
    public function getFiles(): \stdClass
    {
        return (object)$this->files;
    }

    /**
     * Loop through the JSON object and parse the data
     *
     * @param \stdClass $object         Object containing data from the `catalogQuery` API call. Default: `null`
     * @param int       $parentFolderId ID for the parent folder. Default: `null`
     */
    private function parseData(\stdClass $object = null, int $parentFolderId = null): void
    {
        $object = empty($object) ? $this->catalogData : $object;
        foreach ($object as $folder) {
            $this->folders[$folder->id] = (object)['parentFolderId' => $parentFolderId, 'languageId' => @$folder->landguageid, 'name' => $folder->name, 'displayOrder' => $folder->display_order, 'englishName' => $folder->eng_name];
            $this->parseBooks((object)$folder->books, $folder->id);
            if (!empty($folder->folders)) {
                $this->parseData((object)$folder->folders, $folder->id);
            }
        }
    }

    /**
     * Loop through the array and parse the books data
     *
     * @param \stdClass $books    Object containing books data. Default: `null`
     * @param int       $folderId ID for the folder that contains the book. Default: `null`
     */
    private function parseBooks(\stdClass $books = null, int $folderId): void
    {
        if (!empty($books)) {
            foreach ($books as $book) {
                $this->books[$book->id] = (object)['folderId' => $folderId, 'name' => $book->name, 'fullName' => $book->full_name, 'description' => $book->description, 'gospelLibraryUri' => $book->gl_uri, 'url' => $book->url, 'displayOrder' => $book->display_order, 'version' => $book->version, 'fileVersion' => $book->file_version, 'file' => $book->file, 'dateAdded' => $book->dateadded, 'dateModified' => $book->datemodified, 'cbId' => $book->cb_id, 'mediaAvailable' => $book->media_available, 'obsolete' => $book->obsolete, 'size' => $book->size, 'sizeIndex' => $book->size_index];
                $this->parseFiles(@$book->files, $book->id);
            }
        }
    }

    /**
     * Loop through the array and parse the files data
     *
     * @param \stdClass $files  Object containing files data. Default: `null`
     * @param int       $bookId ID for the book associated with the file. Default: `null`
     */
    private function parseFiles(\stdClass $files = null, int $bookId): void
    {
        if (!empty($files)) {
            // Currently, Gospel Library only includes PDF files
            foreach ($files->PDF as $file) {
                $this->files[$file->id] = (object)['bookId' => $bookId, 'order' => $file->order, 'dateAdded' => $file->dateadded, 'dateModified' => $file->datemodified, 'version' => $file->version, 'name' => $file->name, 'title' => $file->title, 'url' => $file->url, 'size' => $file->size];
            }
        }
    }
}
