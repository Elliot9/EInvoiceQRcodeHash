<?php


namespace Elliot9\EInvoiceQRcodeHash;


class QRcodeHash
{

    /*
		到電子發票官網登入營業人帳號後 選擇營業人功能選單>人員帳號與權限管理>密碼及種子管理(QRcode)
        設定密碼後，到 https://www.einvoice.nat.gov.tw/EINSM/ein_upload/html/ENV/1428905476324-1.html 下載 電子發票QRCode加解密工具
		後打開 tool 資料夾中的 genKey.bat，輸入密碼，將會回傳一組 HashKey(32碼)，定將此 Key 至 config設定
	*/

    private $iv;
    private $HASH_KEY;

    public function __construct($HASH_KEY)
    {
        $this->iv = base64_decode("Dt8lyToo17X/XkXaQvihuA=="); //官方文件中 固定值
        $this->HASH_KEY = hex2bin($HASH_KEY);
    }


    /**
     * 回傳 AES 雜湊後值
     * @param $InvoiceNumber 發票號碼 (10碼)
     * @param $RandomNumber  發票隨機碼 (4碼)
     * @return string
     */
    public function AES($InvoiceNumber, $RandomNumber):string
    {
        $aes_data = $InvoiceNumber.$RandomNumber;
        return base64_encode(openssl_encrypt($this->pkcs5_pad($aes_data),'AES-128-CBC', $this->HASH_KEY, OPENSSL_RAW_DATA | OPENSSL_NO_PADDING, $this->iv));
    }

    private function pkcs5_pad($text, $blocksize = 16)
    {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }
}
