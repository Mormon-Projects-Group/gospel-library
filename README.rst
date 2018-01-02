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

All of the following methods return an array.

Languages
---------
List of languages for which the library exists.

.. code-block:: php

    <?php
        $client = new Gospel\Client;
        $results = $client->languagesQuery();
        var_dump($results);
    ?>

Result:

.. code-block:: php

    <?php
        array (size=5)
          'languages' =>
            array (size=107)
              0 =>
                array (size=7)
                  'id' => int 204
                  'name' => string 'Afrikaans' (length=9)
                  'eng_name' => string 'Afrikaans' (length=9)
                  'code' => string 'afr' (length=3)
                  'code_three' => string 'afr' (length=3)
                  'lds_xml_code' => string '501' (length=3)
                  'android_sdk_version' => string '8' (length=1)
              1 =>
                array (size=7)
                  'id' => int 25
                  'name' => string 'Shqip' (length=5)
                  'eng_name' => string 'Albanian' (length=8)
                  'code' => string 'sq' (length=2)
                  'code_three' => string 'sqi' (length=3)
                  'lds_xml_code' => string '101' (length=3)
                  'android_sdk_version' => string '8' (length=1)
              2 =>
                array (size=7)
                  'id' => int 63
                  'name' => string 'አማርኛ' (length=12)
                  'eng_name' => string 'Amharic' (length=7)
                  'code' => string 'am' (length=2)
                  'code_three' => string 'amh' (length=3)
                  'lds_xml_code' => string '506' (length=3)
                  'android_sdk_version' => string '14' (length=2)
              3 =>
                array (size=7)
                  'id' => int 64
                  'name' => string 'Apache' (length=6)
                  'eng_name' => string 'Apache' (length=6)
                  'code' => string 'ap' (length=2)
                  'code_three' => string 'apw' (length=3)
                  'lds_xml_code' => string '012' (length=3)
                  'android_sdk_version' => string '10' (length=2)
              …etc.
          'count' => int 107
          'success' => boolean true
          'date_changed' => string '2018-01-02 14:36:18' (length=19)
          'platformid' => null
    ?>

Platforms
---------
List of valid platforms for which the library exists.

.. code-block:: php

    <?php
        $client = new Gospel\Client;
        $results = $client->platformsQuery();
        var_dump($results);
    ?>

Result:

.. code-block:: php

    <?php
        array (size=3)
          'platforms' =>
            array (size=16)
              0 =>
                array (size=4)
                  'id' => int 4
                  'name' => string 'Android' (length=7)
                  'extension' => string 'db' (length=2)
                  'catalog_version' => string '1000' (length=4)
              1 =>
                array (size=4)
                  'id' => int 17
                  'name' => string 'AndroidGospelLibrary' (length=20)
                  'extension' => string 'zbook' (length=5)
                  'catalog_version' => string '1002' (length=4)
              2 =>
                array (size=4)
                  'id' => int 14
                  'name' => string 'AndroidGospelStudy' (length=18)
                  'extension' => string 'zbook' (length=5)
                  'catalog_version' => string '1001' (length=4)
              3 =>
                array (size=4)
                  'id' => int 3
                  'name' => string 'Blackberry Apps' (length=15)
                  'extension' => string 'jad' (length=3)
                  'catalog_version' => string '1000' (length=4)
              4 =>
                array (size=4)
                  'id' => int 9
                  'name' => string 'Blackberry Minimized Content' (length=28)
                  'extension' => string 'gz' (length=2)
                  'catalog_version' => string '1000' (length=4)
              5 =>
                array (size=4)
                  'id' => int 2
                  'name' => string 'ePub' (length=4)
                  'extension' => string 'epub' (length=4)
                  'catalog_version' => string '1000' (length=4)
              6 =>
                array (size=4)
                  'id' => int 1
                  'name' => string 'iPhone' (length=6)
                  'extension' => string 'zbook' (length=5)
                  'catalog_version' => string '1000' (length=4)
              7 =>
                array (size=4)
                  'id' => int 6
                  'name' => string 'Kindle' (length=6)
                  'extension' => string 'zip' (length=3)
                  'catalog_version' => string '1000' (length=4)
              8 =>
                array (size=4)
                  'id' => int 16
                  'name' => string 'ScirpturesTestIOSUPdate' (length=23)
                  'extension' => string 'zbook' (length=5)
                  'catalog_version' => string '1000' (length=4)
              9 =>
                array (size=4)
                  'id' => int 11
                  'name' => string 'ScriptureTestAndroid' (length=20)
                  'extension' => string 'zbook' (length=5)
                  'catalog_version' => string '1000' (length=4)
              10 =>
                array (size=4)
                  'id' => int 15
                  'name' => string 'ScriptureTestBlackBerry' (length=23)
                  'extension' => string 'gz' (length=2)
                  'catalog_version' => string '1000' (length=4)
              11 =>
                array (size=4)
                  'id' => int 12
                  'name' => string 'ScriptureTestIOS' (length=16)
                  'extension' => string 'zbook' (length=5)
                  'catalog_version' => string '1000' (length=4)
              12 =>
                array (size=4)
                  'id' => int 10
                  'name' => string 'WebOS' (length=5)
                  'extension' => string 'json' (length=4)
                  'catalog_version' => string '1000' (length=4)
              13 =>
                array (size=4)
                  'id' => int 7
                  'name' => string 'Windows Mobile 6.x Applications' (length=31)
                  'extension' => string 'cab' (length=3)
                  'catalog_version' => string '1000' (length=4)
              14 =>
                array (size=4)
                  'id' => int 5
                  'name' => string 'Windows Mobile 7' (length=16)
                  'extension' => string 'zip' (length=3)
                  'catalog_version' => string '1000' (length=4)
              15 =>
                array (size=4)
                  'id' => int 8
                  'name' => string 'Windows Phone' (length=13)
                  'extension' => string 'zip' (length=3)
                  'catalog_version' => string '1000' (length=4)
          'count' => int 16
          'success' => boolean true
    ?>

Catalog
-------
List of the catalog content for the specified language and platform.

.. code-block:: php

    <?php
        $client = new Gospel\Client;
        // Params: Language ID, Platform ID
        $results = $client->catalogQuery(1, 1);
        print_r($results);
    ?>

Result:

.. code-block:: php

    <?php
        Array
        (
            [catalog] => Array
                (
                    [folders] => Array
                        (
                            [0] => Array
                                (
                                    [display_order] => 0
                                    [name] => Scriptures
                                    [eng_name] =>
                                    [id] => 1
                                    [languageid] => 1
                                    [daysexpire] => 0
                                    [download_all] =>
                                    [folders] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [display_order] => 0
                                                    [name] => Study Helps
                                                    [eng_name] =>
                                                    [id] => 2
                                                    [languageid] => 1
                                                    [isprivate] => 0
                                                    [download_all] =>
                                                    [daysexpire] => 0
                                                    [folders] => Array
                                                        (
                                                        )

                                                    [books] => Array
                                                        (
                                                            [0] => Array
                                                                (
                                                                    [name] => Topical Guide
                                                                    [full_name] => Topical Guide
                                                                    [description] =>
                                                                    [gl_uri] => /scriptures/tg
                                                                    [url] => http://broadcast3.lds.org/crowdsource/Mobile/glweb2/1/1/TG.9.zbook
                                                                    [display_order] => 0
                                                                    [version] => 8
                                                                    [file_version] => 9
                                                                    [file] => TG.9.zbook
                                                                    [dateadded] => 2010-06-23 16:28:49
                                                                    [datemodified] => 2013-02-28 22:00:54
                                                                    [id] => 7
                                                                    [cb_id] => 7
                                                                    [media_available] => 0
                                                                    [obsolete] =>
                                                                    [size] => 2248470
                                                                    [size_index] => 2969366
                                                                )

                                                            [1] => Array
                                                                (
                                                                    [name] => Bible Dictionary
                                                                    [full_name] => Bible Dictionary
                                                                    [description] => This dictionary has been designed to provide teachers and students with a concise collection of definitions and explanations of items that are mentioned in or are otherwise associated with the Bible. It is based primarily upon the biblical text, supplemented by information from the other books of scripture accepted as standard works by The Church of Jesus Christ of Latter-day Saints. It is not intended as an official or revealed endorsement by the Church of the doctrinal, historical, cultural, and other matters set forth. Many of the items have been drawn from the best available scholarship of the world and are subject to reevaluation based on new research and discoveries or on new revelation. The topics have been carefully selected and are treated briefly. If an elaborate discussion is desired, the student should consult a more exhaustive dictionary.
                                                                    [gl_uri] => /scriptures/bd
                                                                    [url] => http://broadcast3.lds.org/crowdsource/Mobile/glweb2/1/1/BD.9.zbook
                                                                    [display_order] => 1
                                                                    [version] => 8
                                                                    [file_version] => 9
                                                                    [file] => BD.9.zbook
                                                                    [dateadded] => 2010-06-23 16:29:13
                                                                    [datemodified] => 2013-02-28 22:01:29
                                                                    [id] => 8
                                                                    [cb_id] => 8
                                                                    [media_available] => 0
                                                                    [obsolete] =>
                                                                    [size] => 552203
                                                                    [size_index] => 765119
                                                                )
    …etc.
    ?>

Catalog Modified
----------------
Date the catalog for a specified language and platform was last updated.

.. code-block:: php

    <?php
        $client = new Gospel\Client;
        // Params: Language ID, Platform ID
        $results = $client->catalogQueryModified(1, 1);
        var_dump($results);
    ?>

Result:

.. code-block: php

    <?php
        array (size=3)
          'version' => string '159' (length=3)
          'catalog_modified' => string '2016-09-06 15:09:08' (length=19)
          'success' => boolean true
    ?>

Book Versions
-------------
List of books updated since a given date for the specified language and platform.

.. code-block:: php

    <?php
        $client = new Gospel\Client;
        // Params: Language ID, Platform ID, Date
        $results = $client->bookVersions(1, 1, '2016-09-02');
        var_dump($results);
    ?>

Result:

.. code-block:: php

    <?php
        array (size=1)
          'books' =>
            array (size=8)
              0 =>
                array (size=2)
                  'id' => int 76447
                  'version' => int 1
              1 =>
                array (size=2)
                  'id' => int 76448
                  'version' => int 1
              2 =>
                array (size=2)
                  'id' => int 76449
                  'version' => int 1
              3 =>
                array (size=2)
                  'id' => int 76450
                  'version' => int 1
              4 =>
                array (size=2)
                  'id' => int 76451
                  'version' => int 1
              5 =>
                array (size=2)
                  'id' => int 76452
                  'version' => int 1
              6 =>
                array (size=2)
                  'id' => int 76453
                  'version' => int 1
              7 =>
                array (size=2)
                  'id' => int 76454
                  'version' => int 1
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