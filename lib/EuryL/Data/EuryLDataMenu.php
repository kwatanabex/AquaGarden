<?php
/**
 * EuryL メニューデータクラス
 *
 * @package   SyL
 * @author    Koki Watanabe <k.watanabe@syl.jp>
 * @copyright 2006-2007 k.watanabe
 * @license   http://www.opensource.org/licenses/lgpl-license.php
 * @version   CVS: $Id:$
 * @link      http://www.syl.jp/
 */
class EuryLDataMenu extends SyL_UtilPropertyOverload
{
    var $properties = array(
      'id'        => null, // メニューID
      'parent_id' => null, // 親メニューID
      'name'      => null, // メニュー名称
      'url_name'  => null, // URL名称
      'display_flag' => null,  // 表示フラグ
      'is_current_depth' => false, // カレント階層フラグ
      'link'  => null,
        /*
      'default_title' => null,       // デフォルトタイトル
      'default_keywords' => null,    // デフォルトkeywords
      'default_description' => null, // デフォルトdescription
      'redirect_url' => null,        // リダイレクトURL
      */
    );

}

// serialize 後は、コンストラクタが呼ばれないための対応
if (version_compare(PHP_VERSION, '5.0.0', '<')) {
    overload('EuryLDataMenu');
}

?>
