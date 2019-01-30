<?php

return [
    'account' => 'dangvanduc0-facilitator@gmail.com',
    'client_id' => 'AdlGNHTRd2TP4AxeIsgaG1nBdJj-2lOvJ7NTpLmFMDJ4ob1sJpCdrzTrOnMRkl8MKotFwyGLLIPk3RJN',
    'secret' => 'EGaUQYcuuYZokKSKsHx4Qp8v5F_5qYfgbQazWF6DU8inffjzU5C7OfeViVCoKmKcduQijQ1kl9Z9UvuZ',
    'setting' => [
        'http.CURLOPT_CONNECTTIMEOUT' => 30,
        'mode' => 'sandbox', // live
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.php',
        'log.LogLevel' => 'INFO',
//        'cache.enabled' => true,
//        'cache.FileName' => '../auth.cache',
    ],
];
