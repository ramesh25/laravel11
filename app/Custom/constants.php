<?php
use Carbon\Carbon;
//date
define('CUR_DATE_TIME', Carbon::now());
define('CUR_MONTH', date('m',strtotime(CUR_DATE_TIME)));
define('CUR_YEAR', date('Y',strtotime(CUR_DATE_TIME)));
define('CUR_DAY', date('d',strtotime(CUR_DATE_TIME)));	
define('CUR_DATE', CUR_YEAR.'-'.CUR_MONTH.'-'.CUR_DAY);

define('RPP', 30);//admin - row per page
define('NEW_PAGE', 'New Page');
define('ABS', '<li>');//bredcrumb sepetator admin
define('BS', '<li>');//bredcrumb sepetator

define('POST', 'trip');//post url.. eg. post, trip, product etc.
define('POSTS', 'trips');//post url.. eg. posts, trips, products etc.

define('COMMENT_LEVEL', '3');



//messages
define('CREATED', 'record(s) has been created.');
define('UPDATED', 'record(s) has been updated.');
define('DELETED', 'record(s) has been deleted.');
define('IMPORTED', 'record(s) has been imported.');
define('COMPLETED', 'task has been created.');

define('NEWSLETTER_CREATED', 'newsletter(s) has been created/sent.');
define('NEWSLETTER_UPDATED', 'newsletter(s) has been updated/sent.');

define('NO_RECORD', '<div class="no_record">- - - - - - 0 record(s) found - - - - - -</div>');


//array seperator
define('STRING_SEPERATOR', '@@@rraySeper#ator@@@');
