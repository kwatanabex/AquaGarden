<?php
/**
 * EuryL 権限データクラス
 *
 * @package   SyL
 * @author    Koki Watanabe <k.watanabe@syl.jp>
 * @copyright 2006-2007 k.watanabe
 * @license   http://www.opensource.org/licenses/lgpl-license.php
 * @version   CVS: $Id:$
 * @link      http://www.syl.jp/
 */
class EuryLDataAuthority extends SyL_UtilPropertyOverload
{
    var $properties = array(
      'site_id' => array(),
      'menu_id' => array(),
      'is_admin' => false,
    );

}

// serialize 後は、コンストラクタが呼ばれないための対応
if (version_compare(PHP_VERSION, '5.0.0', '<')) {
    overload('EuryLDataAuthority');
}


?>
