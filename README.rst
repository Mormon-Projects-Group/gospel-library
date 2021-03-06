|TravisCI|_ |Scrutinizer|_ |Code Climate|_ |StyleCI|_ |Packagist|_ |MIT License|_

==================
LDS Gospel Library
==================
**This project is not affiliated with, nor endorsed by, the** `LDS Church <https://www.lds.org/>`_.

This small PHP library allows easy access to the `Gospel Library Web Services <https://tech.lds.org/wiki/Gospel_Library_Catalog_Web_Service>`_. These services only provide access to the metadata of the library and not any of the content or features (like searching, highlighting, notes, tags, and bookmarks).

This project provides access to the metadata but **not to any actual content**. Intellectual Reserve, Inc. owns the copyright for all content in the Gospel Library.

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

All of the following methods return an object:

Languages
---------
List of languages for which the library exists.

.. code-block:: php

    <?php
        $client = new Gospel\Client;
        $results = $client->languagesQuery();
        var_dump($results);
    ?>

Example return:

.. code-block:: php

    <?php
        object(stdClass)[129]
          public 'languages' =>
            array (size=107)
              0 =>
                object(stdClass)[36]
                  public 'id' => int 204
                  public 'name' => string 'Afrikaans' (length=9)
                  public 'eng_name' => string 'Afrikaans' (length=9)
                  public 'code' => string 'afr' (length=3)
                  public 'code_three' => string 'afr' (length=3)
                  public 'lds_xml_code' => string '501' (length=3)
                  public 'android_sdk_version' => string '8' (length=1)
              1 =>
                object(stdClass)[38]
                  public 'id' => int 25
                  public 'name' => string 'Shqip' (length=5)
                  public 'eng_name' => string 'Albanian' (length=8)
                  public 'code' => string 'sq' (length=2)
                  public 'code_three' => string 'sqi' (length=3)
                  public 'lds_xml_code' => string '101' (length=3)
                  public 'android_sdk_version' => string '8' (length=1)
              2 =>
                object(stdClass)[33]
                  public 'id' => int 63
                  public 'name' => string '\u12a0\u121b\u122d\u129b' (length=12)
                  public 'eng_name' => string 'Amharic' (length=7)
                  public 'code' => string 'am' (length=2)
                  public 'code_three' => string 'amh' (length=3)
                  public 'lds_xml_code' => string '506' (length=3)
                  public 'android_sdk_version' => string '14' (length=2)
          …etc.
          public 'count' => int 107
          public 'success' => boolean true
          public 'date_changed' => string '2018-01-03 05:00:00' (length=19)
          public 'platformid' => null
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

Example return:

.. code-block:: php

    <?php
        object(stdClass)[28]
          public 'platforms' =>
            array (size=16)
              0 =>
                object(stdClass)[27]
                  public 'id' => int 1
                  public 'name' => string 'iPhone' (length=6)
                  public 'extension' => string 'zbook' (length=5)
                  public 'catalog_version' => string '1000' (length=4)
              1 =>
                object(stdClass)[16]
                  public 'id' => int 10
                  public 'name' => string 'WebOS' (length=5)
                  public 'extension' => string 'json' (length=4)
                  public 'catalog_version' => string '1000' (length=4)
          …etc.
          public 'count' => int 16
          public 'success' => boolean true
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

Example return:

.. code-block:: php

    <?php
        stdClass Object
        (
          [catalog] => stdClass Object
           (
            [folders] => Array
                (
                 [0] => stdClass Object
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
                        [0] => stdClass Object
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
                            [0] => stdClass Object
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

                            [1] => stdClass Object
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
                          )
                       )
                    )
                 )
              )
            …etc
            [name] => All English content
            [date_changed] => 2016-09-06 15:09:08
            [display_order] => 0
           )

           [success] => 1
         )
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

Example return:

.. code-block:: php

    <?php
        object(stdClass)[36]
          public 'version' => string '159' (length=3)
          public 'catalog_modified' => string '2016-09-06 15:09:08' (length=19)
          public 'success' => boolean true
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

Example return:

.. code-block:: php

    <?php
        object(stdClass)[20]
          public 'books' =>
            array (size=8)
              0 =>
                object(stdClass)[36]
                  public 'id' => int 76447
                  public 'version' => int 1
              1 =>
                object(stdClass)[38]
                  public 'id' => int 76448
                  public 'version' => int 1
              2 =>
                object(stdClass)[33]
                  public 'id' => int 76449
                  public 'version' => int 1
              3 =>
                object(stdClass)[39]
                  public 'id' => int 76450
                  public 'version' => int 1
              4 =>
                object(stdClass)[31]
                  public 'id' => int 76451
                  public 'version' => int 1
              5 =>
                object(stdClass)[32]
                  public 'id' => int 76452
                  public 'version' => int 1
              6 =>
                object(stdClass)[27]
                  public 'id' => int 76453
                  public 'version' => int 1
              7 =>
                object(stdClass)[21]
                  public 'id' => int 76454
                  public 'version' => int 1
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
        // Return: stdObject object
        $results = $client->catalogQuery(1, 1);

        $parser = new Gospel\Parser\Catalog($results);

        // Return: boolean
        $success = $parser->getSuccessStatus();
        // Return: DateTime object
        $modifiedDate = $parser->getModifiedDate();
        // Return: string
        $catalogName = $parser->getCatalogName();
        // Return: stdObject Object containing an adjacency list model for hierarchical data
        $folders = $parser->getFolders();
        // Return: stdObject Object containing an adjacency list model for hierarchical data
        $books = $parser->getBooks();
        // Return: stdObject Object containing an adjacency list model for hierarchical data
        $files = $parser->getFiles();
    ?>

.. note::
    The same book will have a different ID number if it is a different language but not if it is a different platform. For example, the English Book of Mormon has an ID of ``95`` while the Spanish edition has an ID of ``1686``. However, both the ``.zbook`` and ``.json`` versions of the Book of Mormon share an ID of ``95``.

==========
Contribute
==========
* Issue Tracker: https://github.com/Mormon-Projects-Group/gospel-library/issues
* Source Code: https://github.com/Mormon-Projects-Group/gospel-library

.. |TravisCI| image:: https://img.shields.io/travis/Mormon-Projects-Group/gospel-library/master.svg?style=flat-square&label=Build
.. _TravisCI: https://travis-ci.org/Mormon-Projects-Group/gospel-library

.. |Scrutinizer| image:: https://img.shields.io/scrutinizer/g/Mormon-Projects-Group/gospel-library.svg?style=flat-square&label=Code%20Quality
.. _Scrutinizer: https://scrutinizer-ci.com/g/Mormon-Projects-Group/gospel-library/

.. |Code Climate| image:: https://img.shields.io/codeclimate/maintainability/Mormon-Projects-Group/gospel-library.svg?style=flat-square&label=Maintainability
.. _Code Climate: https://codeclimate.com/github/Mormon-Projects-Group/gospel-library

.. |StyleCI| image:: https://styleci.io/repos/115206912/shield?branch=master
.. _StyleCI: https://styleci.io/repos/115206912

.. |Packagist| image:: https://img.shields.io/packagist/v/Mormon-Projects-Group/gospel-library.svg?style=flat-square&label=Packagist
.. _Packagist: https://packagist.org/packages/Mormon-Projects-Group/gospel-library

.. |MIT License| image:: https://img.shields.io/badge/License-MIT-blue.svg?style=flat-square&label=License
.. _MIT License: LICENSE.rst
