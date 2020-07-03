<?php


namespace Elliot9\EInvoiceQRcodeHash;


class QRHashFacade extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return 'QRcodeHash';
    }
}
