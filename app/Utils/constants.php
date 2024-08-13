<?php 

// User roles
define('ROLE_ADMIN', 0);
define('ROLE_USER', 1);

// Deleted flag
define('DELETED_DISABLED', 0);
define('DELETED_ENABLED', 1);

// Category types
define('CATEGORY_EXPENDITURE', 1);
define('CATEGORY_INCOME', 2);
define('CATEGORY_OTHER', 3);

// Transaction types
define('TRANSACTION_EXPENDITURE', 1);
define('TRANSACTION_INCOME', 2);

// Period types
define('PERIOD_DAY', 1);
define('PERIOD_WEEK', 2);
define('PERIOD_MONTH', 3);
define('PERIOD_YEAR', 4);
define('PERIOD_ONETIME', 5);
define('PERIOD', [
    PERIOD_DAY => 'Daily',
    PERIOD_WEEK => 'Weekly',
    PERIOD_MONTH => 'Monthly',
    PERIOD_YEAR => 'Annually',
    PERIOD_ONETIME => 'One-time',
]);