Intracto Elastic Synonym
============

This library reads & writes elasticsearch synonyms

Installation
============

```console
$ composer require intracto/elastic_synonym
```

Synonym file on filesystem
==========================
There are a few limitations we need to work around:
* Elasticsearch will *only* read wherever the current config file is located (usually `/etc/elasticsearch`)
* Our webuser on the filesystem will propably have not the permissions to write to the desired directory.

This is why we choose to work with a symlink.
This can also be implemented as you want, but here is a working example using vagrant:
```console
$ mkdir /vagrant/.elastic-synonym
$ touch /vagrant/.elastic-synonym/synomym.txt # name the file anyway you want

$ sudo mkdir /etc/elasticsearch/analysis # Only if it does not exist already
$ sudo ln -s /vagrant/.elastic-synonym/synonyms.txt /etc/elasticsearch/analysis/synonyms.txt
```


Synonym filter in elastic
=========================
Add the following filter under `settings.analysis.filter`:
```php
'my_synonyms' => [ // a name for your filter
    'type' => 'synonym',
    'synonyms_path' => PATH, // This needs to be the path inside /etc/elastic. f.e. 'analysis/synonyms.txt
    'updateable' => true, // *must* be true
],
```