|TravisCI|_ |Scrutinizer|_ |StyleCI|_ |Packagist|_ |MIT License|_

========================
[WIP] LDS Gospel Library
========================
**This project is not affiliated with, nor endorsed by, the** `LDS Church <https://www.lds.org/>`_

This small PHP library allows easy access to the `Gospel Library Web Services <https://tech.lds.org/wiki/Gospel_Library_Catalog_Web_Service>`_. These services only provide API access to the content of the library and not any of the features (like searching, highlighting, notes, tags, and bookmarks).

=====================
Gospel Library Client
=====================
There are currently five (5) valid API actions for the `LDS Gospel Library <https://www.lds.org/pages/mobileapps/gospellibrary?lang=eng>`_:

    * ``languages.query``
        * List of languages for which the library exists
    * ``platforms.query``
        * List of valid platforms for which the library exists
    * ``catalog.query``
        * List of the catalog content for the specified language and platform
    * ``catalog.query.modified``
        * Date the catalog for a specified language and platform was last updated
    * ``book.versions``
        * List of books updated since a given date for the specified language and platform

Languages
---------

.. code-block:: php

    <?php
        $client = new Gospel\Client;
        $results = $client->languagesQuery();
    ?>

Platforms
---------

.. code-block:: php

    <?php
        $client = new Gospel\Client;
        $results = $client->platformsQuery();
    ?>

Catalog
-------

.. code-block:: php

    <?php
        $client = new Gospel\Client;
        // Params: Language ID, Platform ID
        // Return: array
        $results = $client->catalogQuery(1, 1);
    ?>

Catalog Modified
----------------

.. code-block:: php

    <?php
        $client = new Gospel\Client;
        // Params: Language ID, Platform ID
        // Return: array
        $results = $client->catalogQueryModified(1, 1);
    ?>

Book Versions
-------------

.. code-block:: php

    <?php
        $client = new Gospel\Client;
        // Params: Language ID, Platform ID
        // Return: array
        $results = $client->bookVersions(1, 1, '2018-01-02');
    ?>

=======
Parsers
=======

Catalog Parser
--------------
Parses data returned by the ``catalogQuery()`` method.

.. code-block:: php

    <?php
        $client = new Gospel\Client;
        // Params: Language ID, Platform ID
        // Return: array
        $results = $client->catalogQuery(1, 1);

        $parser = new Gospel\Parser\Catalog($results);

        // Return: boolean
        $success = $parser->getSuccessStatus();
        // Return: DateTime object
        $modifiedDate = $parser->getModifiedDate();
        // Return: string
        $catalogName = $parser->getCatalogName();
        // Return: array (flattened) in an adjacency list model for hierarchical data
        $folders = $parser->getFolders();
        // Return: array (flattened) in an adjacency list model for hierarchical data
        $books = $parser->getBooks();
        // Return: array (flattened) in an adjacency list model for hierarchical data
        $files = $parser->getFiles();
    ?>

==========
Contribute
==========
* Issue Tracker: https://github.com/Mormon-Projects-Group/gospel-library/issues
* Source Code: https://github.com/Mormon-Projects-Group/gospel-library

.. |TravisCI| image:: https://img.shields.io/travis/Mormon-Projects-Group/gospel-library/master.svg?style=flat-square
.. _TravisCI: https://travis-ci.org/Mormon-Projects-Group/gospel-library

.. |Scrutinizer| image:: https://img.shields.io/scrutinizer/g/Mormon-Projects-Group/gospel-library.svg?style=flat-square
.. _Scrutinizer: https://scrutinizer-ci.com/g/Mormon-Projects-Group/gospel-library/

.. |StyleCI| image:: https://styleci.io/repos/115206912/shield?branch=master
.. _StyleCI: https://styleci.io/repos/115206912

.. |Packagist| image:: https://img.shields.io/packagist/v/Mormon-Projects-Group/gospel-library.svg?style=flat-square
.. _Packagist: https://packagist.org/packages/Mormon-Projects-Group/gospel-library

.. |MIT License| image:: https://img.shields.io/badge/License-MIT-blue.svg?style=flat-square
.. _MIT License: LICENSE.rst