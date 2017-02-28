<?php
/**
 * EuryL アプリケーションデータクラス
 *
 * @package   SyL
 * @author    Koki Watanabe <k.watanabe@syl.jp>
 * @copyright 2006-2007 k.watanabe
 * @license   http://www.opensource.org/licenses/lgpl-license.php
 * @version   CVS: $Id:$
 * @link      http://www.syl.jp/
 */
class EuryLDataApplication extends SyL_UtilPropertyOverload
{
    var $properties = array(
      'site_id' => null,
      'site_name' => null,
      'application_id' => null,
      'application_name' => null,
      'application_dir_name' => null,
      'domain_name' => null,
      'title' => null,
      'keywords' => null,
      'description' => null,
      'headers' => null,
    );
}

// serialize 後は、コンストラクタが呼ばれないための対応
if (version_compare(PHP_VERSION, '5.0.0', '<')) {
    overload('EuryLDataApplication');
}


?>
