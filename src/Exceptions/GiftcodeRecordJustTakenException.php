<?php

namespace Vgplay\Giftcode\Exceptions;

use Exception;

class GiftcodeRecordJustTakenException extends Exception
{
    public function __construct($message = 'Giftcode vừa bị người nào đó lấy trước, xin vui lòng thử lại.')
    {
        parent::__construct($message);
    }
}
