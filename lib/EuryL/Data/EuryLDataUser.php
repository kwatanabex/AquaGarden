<?php
/**
 * EuryL ユーザーデータクラス
 *
 * @package   SyL
 * @author    Koki Watanabe <k.watanabe@syl.jp>
 * @copyright 2006-2007 k.watanabe
 * @license   http://www.opensource.org/licenses/lgpl-license.php
 * @version   CVS: $Id:$
 * @link      http://www.syl.jp/
 */
class EuryLDataUser extends SyL_UtilPropertyOverload
{
    var $properties = array(
      'id' => null,
      'name' => null,
      'login_id' => null,
      'login_passwd' => null,
      'email' => null,
      'create_date' => null,
      'update_date' => null,
    );
}

// serialize 後は、コンストラクタが呼ばれないための対応
if (version_compare(PHP_VERSION, '5.0.0', '<')) {
    overload('EuryLDataUser');
}


?>
