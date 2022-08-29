<?php
/*
  | --------------------------------------------------------------------
  | App Namespace
  | --------------------------------------------------------------------
  |
  | This defines the default Namespace that is used throughout
  | CodeIgniter to refer to the Application directory. Change
  | this constant to change the namespace that all application
  | classes should use.
  |
  | NOTE: changing this will require manually modifying the
  | existing namespaces of App\* namespaced-classes.
 */
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
  | --------------------------------------------------------------------------
  | Composer Path
  | --------------------------------------------------------------------------
  |
  | The path that Composer's autoload file is expected to live. By default,
  | the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH',
        ROOTPATH.'vendor/autoload.php');

/*
  |--------------------------------------------------------------------------
  | Timing Constants
  |--------------------------------------------------------------------------
  |
  | Provide simple ways to work with the myriad of PHP functions that
  | require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR') || define('HOUR', 3600);
defined('DAY') || define('DAY', 86400);
defined('WEEK') || define('WEEK', 604800);
defined('MONTH') || define('MONTH', 2_592_000);
defined('YEAR') || define('YEAR', 31_536_000);
defined('DECADE') || define('DECADE', 315_360_000);

/*
  | --------------------------------------------------------------------------
  | Exit Status Codes
  | --------------------------------------------------------------------------
  |
  | Used to indicate the conditions under which the script is exit()ing.
  | While there is no universal standard for error codes, there are some
  | broad conventions.  Three such conventions are mentioned below, for
  | those who wish to make use of them.  The CodeIgniter defaults were
  | chosen for the least overlap with these conventions, while still
  | leaving room for others to be defined in future versions and user
  | applications.
  |
  | The three main conventions used for determining exit status codes
  | are as follows:
  |
  |    Standard C/C++ Library (stdlibc):
  |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
  |       (This link also contains other GNU-specific conventions)
  |    BSD sysexits.h:
  |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
  |    Bash scripting:
  |       http://tldp.org/LDP/abs/html/exitcodes.html
  |
 */
defined('EXIT_SUCCESS') || define('EXIT_SUCCESS', 0);        // no errors
defined('EXIT_ERROR') || define('EXIT_ERROR', 1);          // generic error
defined('EXIT_CONFIG') || define('EXIT_CONFIG', 3);         // configuration error
defined('EXIT_UNKNOWN_FILE') || define('EXIT_UNKNOWN_FILE', 4);   // file not found
defined('EXIT_UNKNOWN_CLASS') || define('EXIT_UNKNOWN_CLASS', 5);  // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') || define('EXIT_USER_INPUT', 7);     // invalid user input
defined('EXIT_DATABASE') || define('EXIT_DATABASE', 8);       // database error
defined('EXIT__AUTO_MIN') || define('EXIT__AUTO_MIN', 9);      // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') || define('EXIT__AUTO_MAX', 125);    // highest automatically-assigned error code

/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_LOW instead.
 */
define('EVENT_PRIORITY_LOW', 200);

/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_NORMAL instead.
 */
define('EVENT_PRIORITY_NORMAL', 100);

/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_HIGH instead.
 */
define('EVENT_PRIORITY_HIGH', 10);

// Custom Constant Variables
define('SITE_TITLE', 'CI BLOG');
define('SITE_AUTHOR', 'CI BLOG');
define('SITE_EMAIL', 'CI BLOG');
define('FORMS', 'forms/');
define('ALLOW_MODIFICATION', 1);
define('DEMO_VERSION_MSG', 'Modification in demo version is not allowed');
define('TABLES', 'tables/');
define('VIEW', 'view/');
define('CATEGORY_IMG_PATH', 'uploads/category_image/');
define('SUBCATEGORY_IMG_PATH', 'uploads/subcategory_image/');
define('PRODUCT_IMG_PATH', 'uploads/product_image/');
define('SLIDER_IMG_PATH', 'uploads/slider_image/');
define('OFFER_IMG_PATH', 'uploads/offer_image/');
define('NOTIFICATION_IMG_PATH', 'uploads/notifications/');
define('USER_IMG_PATH', 'uploads/user_image/');
define('UPDATE_PATH', 'update/');
define('MEDIA_PATH', 'uploads/media/');
define('NO_IMAGE', 'assets/Admin/img/no-image.png');
define('EMAIL_ORDER_SUCCESS_IMG_PATH', 'assets/admin/images/order-success.png');
define('REVIEW_IMG_PATH', 'uploads/review_image/');
define('TICKET_IMG_PATH', 'uploads/tickets/');
define('DIRECT_BANK_TRANSFER_IMG_PATH', 'uploads/bank_transfer/');

//Thumbnail paths
define('THUMB_MD', 'thumb-md/');
define('THUMB_SM', 'thumb-sm/');
define('CROPPED_MD', 'cropped-md/');
define('CROPPED_SM', 'cropped-sm/');

define('PERMISSION_ERROR_MSG',
    ' You are not authorize to operate on the module ');

// ticket status
define('PENDING', '1');
define('OPENED', '2');
define('RESOLVED', '3');
define('CLOSED', '4');
define('REOPEN', '5');

// direct bank transfer

define('BANK_TRANSFER', 'Direct Bank Transfer');

// pincode delivarable type

define('NONE', '0');
define('ALL', '1');
define('INCLUDED', '2');
define('EXCLUDED', '3');
