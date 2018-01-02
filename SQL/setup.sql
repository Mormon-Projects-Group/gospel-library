DROP TABLE IF EXISTS `bookVersions`;
CREATE TABLE `bookVersions` (
  `id` integer(11) NOT NULL,
  `version` integer(11) NOT NULL,
  PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `id` integer(11) NOT NULL,
  `folderId` integer(11) NOT NULL,
  `name` text(100),
  `fullName` text(100),
  `description` text(1000),
  `gospelLibraryUri` text(100),
  `url` text(100),
  `displayOrder` integer(11),
  `version` integer(11),
  `fileVersion` integer(11),
  `file` text(100),
  `dateAdded` text(20),
  `dateModified` text(20),
  `cbId` integer(11),
  `mediaAvailable` integer(1),
  `obsolete` integer(1),
  `size` integer(100),
  `sizeIndex` integer(100),
  `book` blob,
  PRIMARY KEY (`id`),
  FOREIGN KEY (folderId) REFERENCES "folders" (id) ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS `files`;
CREATE TABLE `files` (
  `id` integer(11) NOT NULL,
  `bookId` integer(11) NOT NULL,
  `order` integer(11),
  `dateAdded` text(20),
  `dateModified` text(20),
  `version` integer(11),
  `name` text(100),
  `title` text(100),
  `url` text(100),
  `size` integer(100),
  `file` blob,
  PRIMARY KEY (`id`),
  FOREIGN KEY (bookId) REFERENCES "books" (id) ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS `folders`;
CREATE TABLE `folders` (
  `id` integer(11) NOT NULL,
  `parentFolderId` integer(11),
  `languageId` integer(11),
  `name` text(100),
  `displayOrder` integer(11),
  `englishName` text(100),
  PRIMARY KEY (`id`),
  FOREIGN KEY (parentFolderId) REFERENCES "folders" (id) ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `id` integer(11) NOT NULL,
  `name` text(100) NOT NULL,
  `englishName` text(100) NOT NULL,
  `code` text(20) NOT NULL,
  `codeThree` text(5) NOT NULL,
  `ldsXmlCode` integer(11) NOT NULL,
  `androidSdkVersion` integer(11) NOT NULL,
  `dateChanged` text(20) NOT NULL,
  PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `platforms`;
CREATE TABLE `platforms` (
  `id` integer(11) NOT NULL,
  `name` text(100) NOT NULL,
  `extension` text(20) NOT NULL,
  `catalogVersion` integer(11) NOT NULL,
  PRIMARY KEY (`id`)
);