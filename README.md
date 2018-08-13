# Elasticsearch PDF importer

It allows you import PDF files to elasticsearch and search in them.

## Requirements

- Elasticsearch (version 6)
- ingest-attachment plugin (see the [doc](https://www.elastic.co/guide/en/elasticsearch/plugins/master/ingest-attachment.html))

If you haven't installed `ingest-attachment` plugin run this in your server:
```
sudo bin/elasticsearch-plugin ingest-attachment
```

## Installation

##### Installing composer package
```
composer require eze/elasticsearch-pdf-importer
```

##### Installing the Attachment Processor in a Pipeline

You need to create a pipeline with the attachment processor. For it, you can choose following:
 - Create a symfony's command ([see here](examples/SetupCommand.php))
 - Create a php file and run it ([see here](examples/setup.php))
 - Or via `curl` in command line:
```
PUT _ingest/pipeline/attachment
{
  "description" : "Extract attachment information",
  "processors" : [
    {
      "attachment" : {
        "field" : "data",
        "indexed_chars": -1
      }
    }
  ]
}
```

## How to use

The basic is create a Index, a Document and call to importer.

```
$client = (new \Eze\Elastic\Factory())->getClient('localhost:9200');
$resolver = new \Eze\Elastic\Importer\Reader\ReaderResolver([
    new \Eze\Elastic\Importer\Reader\UrlReader(),
    new \Eze\Elastic\Importer\Reader\FileReader()
]);
$importer = new \Eze\Elastic\Importer\AttachmentImporter($client, $resolver);

$file = 'PATH_TO_PDF_FILE.pdf';

$index = new Eze\Elastic\Model\Index('INDEX', 'TYPE', 'ID:OPTIONAL');
$document = new Eze\Elastic\Model\Document();
$document->setFile($file)->setIndex($index);
$id = $importer->import($document);
```
You can add more field calling to:
```
$document->addField('FIELD-NAME-ONE', 'VALUE)
    ->addField('FIELD-NAME-TWO', 'VALUE)
    ->addField('FIELD-NAME-THREE', 'VALUE);
```

Also you can do data processing before send its to elasticsearch, you only need to do an implementation of `ProcessorInterface`

I have implemented a processor to reduce pdf size with Ghostscript via command line.

_Requirements: php need to allow `exec` function, server need to have installed `ghostscript libgs-dev imagemagick` on ubuntu server_

```
$client = (new \Eze\Elastic\Factory())->getClient('localhost:9200');
$resolver = new \Eze\Elastic\Importer\Reader\ReaderResolver([
    new \Eze\Elastic\Importer\Reader\UrlReader(),
    new \Eze\Elastic\Importer\Reader\FileReader()
]);
$processor = new \Eze\Elastic\Importer\Processor\GhostscriptProcessor();
$importer = new \Eze\Elastic\Importer\AttachmentImporter($client, $resolver, $processor);
//
// or..
//
/**
$manyProcessor = new \Eze\Elastic\Importer\Processor\MultiProcessor([
    $processor1,
    $processor2,
    $processor3,
]);

$importer = new \Eze\Elastic\Importer\AttachmentImporter($client, $resolver, $manyProcessor);
*/

$file = 'PATH_TO_PDF_FILE.pdf';

$index = new Eze\Elastic\Model\Index('INDEX', 'TYPE', 'ID:OPTIONAL');
$document = new Eze\Elastic\Model\Document();
$document->setFile($file)->setIndex($index);
$id = $importer->import($document);
```

