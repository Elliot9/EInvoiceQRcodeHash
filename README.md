### Install

```php
  composer require elliot9/e-invoice-qrcode-hash
```

### Configuration

add all of the following classes to your config/app.php service providers list.
```php
  Elliot9\EInvoiceQRcodeHash\EInvoiceQRcodeHashServiceProvider::class
```

and add this below the aliases
```php
  'QRcodeHash' => Elliot9\EInvoiceQRcodeHash\QRHashFacade::class
```

Publish the storage configuration file
```php
  php artisan vendor:publish --provider="Elliot9\EInvoiceQRcodeHash\EInvoiceQRcodeHashServiceProvider" --tag="config"
```

Set Your Hash Key in config. (電子發票QRcode HashSeed 32碼)
```php
    //EIN.php
    'HASH_KEY' => 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
```

### Usage

```php
    //傳入發票號碼(10碼) & 發票隨機碼(4碼)
    $AES = QRcodeHash::AES('AB00000001','1234');
```


